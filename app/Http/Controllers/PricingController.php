<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Package;
use App\Models\Setting;
use Inertia\Inertia;
use Inertia\Response;

class PricingController extends Controller
{
    /**
     * Display the pricing packages page.
     */
    public function index(): Response
    {
        $packages = Package::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $faqs = Faq::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get();

        return Inertia::render('Pricing/Index', [
            'packages' => $packages,
            'faqs' => $faqs,
            'settings' => Setting::getAllAsKeyMap(),
        ]);
    }
}
