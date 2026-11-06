<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index(Request $request): Response
    {
        $query = Project::query()->orderBy('sort_order')->latest('id');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('client_name', 'like', "%{$search}%");
            });
        }

        $projects = $query->paginate(10)->withQueryString();

        return Inertia::render('Admin/Projects/Index', [
            'projects' => $projects,
            'filters' => $request->only(['category', 'search']),
        ]);
    }

    /**
     * Show the form for creating a new project.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Projects/Form', [
            'project' => null,
            'isEdit' => false,
        ]);
    }

    /**
     * Store a newly created project.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug',
            'category' => 'required|string|in:company,sekolah,toko,sistem',
            'summary' => 'required|string|max:500',
            'description' => 'nullable|string',
            'client_name' => 'nullable|string|max:255',
            'live_url' => 'nullable|url|max:255',
            'cover_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'gallery_files.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'tech_stack' => 'nullable',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $slug = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        // Ensure slug is unique
        $originalSlug = $slug;
        $counter = 1;
        while (Project::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        $coverPath = null;
        if ($request->hasFile('cover_file')) {
            $coverPath = ImageUploadService::uploadAsWebp($request->file('cover_file'), 'projects');
        }

        $galleryPaths = [];
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $galleryPaths[] = ImageUploadService::uploadAsWebp($file, 'projects/gallery');
            }
        }

        $techStack = $this->parseTechStack($request->tech_stack);

        Project::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'],
            'summary' => $validated['summary'],
            'description' => $validated['description'] ?? null,
            'client_name' => $validated['client_name'] ?? null,
            'live_url' => $validated['live_url'] ?? null,
            'cover_image' => $coverPath,
            'gallery' => $galleryPaths,
            'tech_stack' => $techStack,
            'is_featured' => $request->boolean('is_featured', true),
            'is_published' => $request->boolean('is_published', true),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        Cache::forget('home_page_data');

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the project.
     */
    public function edit(Project $project): Response
    {
        return Inertia::render('Admin/Projects/Form', [
            'project' => $project,
            'isEdit' => true,
        ]);
    }

    /**
     * Update the specified project.
     */
    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug,'.$project->id,
            'category' => 'required|string|in:company,sekolah,toko,sistem',
            'summary' => 'required|string|max:500',
            'description' => 'nullable|string',
            'client_name' => 'nullable|string|max:255',
            'live_url' => 'nullable|url|max:255',
            'cover_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'gallery_files.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'tech_stack' => 'nullable',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $coverPath = $project->cover_image;
        if ($request->hasFile('cover_file')) {
            $coverPath = ImageUploadService::uploadAsWebp($request->file('cover_file'), 'projects');
        }

        $galleryPaths = $project->gallery ?? [];
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $galleryPaths[] = ImageUploadService::uploadAsWebp($file, 'projects/gallery');
            }
        }

        $techStack = $this->parseTechStack($request->tech_stack);

        $slug = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['title']);

        $project->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'],
            'summary' => $validated['summary'],
            'description' => $validated['description'] ?? null,
            'client_name' => $validated['client_name'] ?? null,
            'live_url' => $validated['live_url'] ?? null,
            'cover_image' => $coverPath,
            'gallery' => $galleryPaths,
            'tech_stack' => $techStack,
            'is_featured' => $request->boolean('is_featured', true),
            'is_published' => $request->boolean('is_published', true),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        Cache::forget('home_page_data');

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    /**
     * Remove the specified project.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();
        Cache::forget('home_page_data');

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil dihapus.');
    }

    /**
     * Helper to parse tech stack array or comma separated string.
     */
    private function parseTechStack(mixed $input): array
    {
        if (is_array($input)) {
            return array_values(array_filter(array_map('trim', $input)));
        }

        if (is_string($input)) {
            return array_values(array_filter(array_map('trim', explode(',', $input))));
        }

        return [];
    }
}
