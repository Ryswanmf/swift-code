<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use Inertia\Inertia;
use Inertia\Response;

class AboutController extends Controller
{
    /**
     * Display the public about us page.
     */
    public function index(): Response
    {
        $partners = Partner::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get(['id', 'name', 'category', 'color', 'icon', 'logo_image']);

        $testimonials = Testimonial::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->take(3)
            ->get(['id', 'name', 'role', 'company', 'quote', 'avatar', 'rating']);

        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get(['id', 'title', 'badge', 'description', 'icon']);

        $publishedProjectsCount = Project::query()
            ->where('is_published', true)
            ->count();

        return Inertia::render('About/Index', [
            'partners' => $partners,
            'testimonials' => $testimonials,
            'services' => $services,
            'projectsCount' => $publishedProjectsCount,
            'settings' => Setting::getAllAsKeyMap(),
        ]);
    }
}
