<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Package;
use App\Models\Project;
use App\Models\Service;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display the Admin dashboard with statistics and recent activity.
     */
    public function index(): Response
    {
        $stats = [
            'new_leads' => Lead::where('status', 'new')->count(),
            'total_leads' => Lead::count(),
            'total_projects' => Project::count(),
            'total_services' => Service::count(),
            'total_packages' => Package::count(),
        ];

        $recentLeads = Lead::latest()
            ->limit(5)
            ->get(['id', 'name', 'phone', 'service_type', 'budget', 'status', 'created_at']);

        $recentProjects = Project::latest()
            ->limit(5)
            ->get(['id', 'title', 'category', 'client_name', 'is_published', 'created_at']);

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'recentLeads' => $recentLeads,
            'recentProjects' => $recentProjects,
        ]);
    }
}
