<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class SettingController extends Controller
{
    /**
     * Show the website settings page.
     */
    public function edit(): Response
    {
        return Inertia::render('Admin/Settings', [
            'settings' => Setting::getAllAsKeyMap(),
        ]);
    }

    /**
     * Update website settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'whatsapp' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        Cache::forget('home_page_data');

        return redirect()->back()->with('success', 'Pengaturan situs berhasil disimpan.');
    }
}
