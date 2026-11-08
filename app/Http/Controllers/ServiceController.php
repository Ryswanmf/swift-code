<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Service;
use App\Models\Setting;
use Inertia\Inertia;
use Inertia\Response;

class ServiceController extends Controller
{
    /**
     * Display the public services listing page.
     */
    public function index(): Response
    {
        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get(['id', 'icon', 'title', 'description', 'badge', 'suitable_for', 'features']);

        $packages = Package::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get(['id', 'name', 'price', 'price_note', 'features', 'is_highlighted']);

        return Inertia::render('Services/Index', [
            'services' => $services,
            'packages' => $packages,
            'settings' => Setting::getAllAsKeyMap(),
        ]);
    }
}
