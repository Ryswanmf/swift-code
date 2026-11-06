<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Package;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Display the public homepage.
     */
    public function index(): Response
    {
        $data = Cache::remember('home_page_data', 1800, function () {
            return [
                'services' => Service::query()
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->get(['id', 'icon', 'title', 'description', 'badge']),

                'projects' => Project::query()
                    ->where('is_published', true)
                    ->orderBy('sort_order')
                    ->get(['id', 'title', 'slug', 'category', 'summary', 'client_name', 'live_url', 'cover_image', 'tech_stack', 'is_featured']),

                'packages' => Package::query()
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->get(['id', 'name', 'price', 'price_note', 'features', 'is_highlighted']),

                'testimonials' => Testimonial::query()
                    ->where('is_published', true)
                    ->orderBy('sort_order')
                    ->get(['id', 'name', 'role', 'company', 'quote', 'avatar', 'rating']),

                'faqs' => Faq::query()
                    ->where('is_published', true)
                    ->orderBy('sort_order')
                    ->get(['id', 'question', 'answer']),

                'settings' => Setting::getAllAsKeyMap(),
            ];
        });

        return Inertia::render('Home', $data);
    }
}
