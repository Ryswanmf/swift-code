<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Faq;
use App\Models\Lead;
use App\Models\Package;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class HomePageController extends Controller
{
    /**
     * Show the homepage management editor with sync statistics.
     */
    public function edit(): Response
    {
        $settings = Setting::getAllAsKeyMap();

        // Gathers live synchronization status from all connected CRUD resources
        $syncStats = [
            'services' => [
                'active' => Service::where('is_active', true)->count(),
                'total' => Service::count(),
                'sample' => Service::where('is_active', true)->orderBy('sort_order')->limit(3)->get(['id', 'title', 'badge', 'icon']),
            ],
            'projects' => [
                'published' => Project::where('is_published', true)->count(),
                'featured' => Project::where('is_published', true)->where('is_featured', true)->count(),
                'total' => Project::count(),
                'sample' => Project::where('is_published', true)->orderBy('sort_order')->limit(3)->get(['id', 'title', 'category', 'is_featured']),
            ],
            'packages' => [
                'active' => Package::where('is_active', true)->count(),
                'highlighted' => Package::where('is_active', true)->where('is_highlighted', true)->count(),
                'total' => Package::count(),
                'sample' => Package::where('is_active', true)->orderBy('sort_order')->limit(3)->get(['id', 'name', 'price', 'is_highlighted']),
            ],
            'testimonials' => [
                'published' => Testimonial::where('is_published', true)->count(),
                'total' => Testimonial::count(),
            ],
            'faqs' => [
                'published' => Faq::where('is_published', true)->count(),
                'total' => Faq::count(),
            ],
            'articles' => [
                'published' => Article::where('is_published', true)->count(),
                'total' => Article::count(),
            ],
            'leads' => [
                'total' => Lead::count(),
                'new' => Lead::where('status', 'new')->count(),
            ],
        ];

        return Inertia::render('Admin/Home/Edit', [
            'settings' => $settings,
            'syncStats' => $syncStats,
        ]);
    }

    /**
     * Update homepage sections and settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // Hero Section
            'hero_badge' => 'nullable|string|max:100',
            'hero_headline' => 'required|string|max:255',
            'hero_subheadline' => 'required|string|max:1000',
            'hero_cta_primary_text' => 'nullable|string|max:100',
            'hero_cta_primary_link' => 'nullable|string|max:255',
            'hero_cta_secondary_text' => 'nullable|string|max:100',
            'hero_cta_secondary_link' => 'nullable|string|max:255',
            'hero_trust_1' => 'nullable|string|max:100',
            'hero_trust_2' => 'nullable|string|max:100',
            'hero_trust_3' => 'nullable|string|max:100',

            // Section Headers & Descriptions
            'section_services_title' => 'nullable|string|max:255',
            'section_services_desc' => 'nullable|string|max:500',
            'section_portfolio_title' => 'nullable|string|max:255',
            'section_portfolio_desc' => 'nullable|string|max:500',
            'section_pricing_title' => 'nullable|string|max:255',
            'section_pricing_desc' => 'nullable|string|max:500',
            'section_why_us_title' => 'nullable|string|max:255',
            'section_why_us_desc' => 'nullable|string|max:500',
            'section_testimonials_title' => 'nullable|string|max:255',
            'section_testimonials_desc' => 'nullable|string|max:500',
            'section_faq_title' => 'nullable|string|max:255',
            'section_faq_desc' => 'nullable|string|max:500',

            // Section Visibility Toggles (1 for show, 0 for hide)
            'show_partner_marquee' => 'nullable|string|in:0,1',
            'show_services' => 'nullable|string|in:0,1',
            'show_portfolio' => 'nullable|string|in:0,1',
            'show_pricing' => 'nullable|string|in:0,1',
            'show_why_us' => 'nullable|string|in:0,1',
            'show_testimonials' => 'nullable|string|in:0,1',
            'show_faq' => 'nullable|string|in:0,1',
            'show_articles' => 'nullable|string|in:0,1',
            'show_contact' => 'nullable|string|in:0,1',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        // Flush all relevant caches to ensure instant sync
        Cache::forget('home_page_data');
        Cache::forget('all_settings_map');

        return redirect()->back()->with('success', 'Pengaturan halaman beranda dan sinkronisasi berhasil disimpan.');
    }
}
