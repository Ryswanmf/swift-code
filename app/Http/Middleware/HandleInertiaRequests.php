<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
            ],
            'siteSettings' => fn () => \App\Models\Setting::getAllAsKeyMap(),
            'navServices' => fn () => \Illuminate\Support\Facades\Cache::remember('nav_services', 1800, function () {
                return \App\Models\Service::query()
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->get(['id', 'title', 'badge']);
            }),
        ];
    }
}
