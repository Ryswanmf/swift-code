<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use App\Models\Lead;
use App\Models\Setting;
use App\Notifications\NewLeadNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    /**
     * Store a newly created contact lead and redirect to WhatsApp.
     */
    public function store(StoreLeadRequest $request): Response
    {
        $validated = $request->validated();

        $lead = Lead::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'service_type' => $validated['service_type'],
            'budget' => $validated['budget'] ?? null,
            'message' => $validated['message'],
            'status' => 'new',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Dispatch notification to admin email if configured
        try {
            $adminEmail = Setting::get('email', config('mail.from.address', 'halo@swiftcode.id'));
            if ($adminEmail) {
                Notification::route('mail', $adminEmail)->notify(new NewLeadNotification($lead));
            }
        } catch (\Throwable $e) {
            Log::error('Failed to dispatch NewLeadNotification: '.$e->getMessage());
        }

        // Prepare pre-filled WhatsApp message
        $targetWa = Setting::get('whatsapp', '62895325852575');
        $cleanWa = preg_replace('/[^0-9]/', '', $targetWa);

        $text = "Halo Swift Code Lampung,\n\n"
              ."Saya *{$lead->name}* ingin berkonsultasi mengenai pembuatan website:\n"
              ."• *Layanan:* {$lead->service_type}\n"
              .'• *Perkiraan Budget:* '.($lead->budget ?: 'Fleksibel')."\n"
              ."• *Kontak:* {$lead->phone}\n\n"
              ."Pesan Kebutuhan:\n\"{$lead->message}\"";

        $whatsappUrl = 'https://wa.me/'.$cleanWa.'?text='.urlencode($text);

        return Inertia::location($whatsappUrl);
    }
}
