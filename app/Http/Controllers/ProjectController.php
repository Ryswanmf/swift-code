<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Setting;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    /**
     * Display the full portfolio archive listing page.
     */
    public function index(): Response
    {
        $projects = Project::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get(['id', 'title', 'slug', 'category', 'summary', 'client_name', 'cover_image', 'tech_stack', 'live_url']);

        return Inertia::render('Projects/Index', [
            'projects' => $projects,
            'settings' => Setting::getAllAsKeyMap(),
        ]);
    }

    /**
     * Display a single portfolio project detail.
     */
    public function show(string $slug): Response
    {
        $project = Project::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $relatedProjects = Project::query()
            ->where('id', '!=', $project->id)
            ->where('is_published', true)
            ->where('category', $project->category)
            ->orderBy('sort_order')
            ->limit(3)
            ->get(['id', 'title', 'slug', 'category', 'summary', 'client_name', 'cover_image']);

        return Inertia::render('Projects/Show', [
            'project' => $project,
            'relatedProjects' => $relatedProjects,
            'settings' => Setting::getAllAsKeyMap(),
        ]);
    }
}
