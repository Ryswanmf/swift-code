<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class ServiceController extends Controller
{
    /**
     * Display a listing of the services.
     */
    public function index(Request $request): Response
    {
        $status = $request->input('status', 'all');
        $search = $request->input('search');

        $counts = [
            'all' => Service::count(),
            'active' => Service::where('is_active', true)->count(),
            'inactive' => Service::where('is_active', false)->count(),
        ];

        $query = Service::query()->orderBy('sort_order')->latest('id');

        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('badge', 'like', "%{$search}%");
            });
        }

        $services = $query->paginate(12)->withQueryString();

        return Inertia::render('Admin/Services/Index', [
            'services' => $services,
            'filters' => [
                'status' => $status,
                'search' => $search,
            ],
            'counts' => $counts,
        ]);
    }

    /**
     * Show the form for creating a new service.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Services/Form', [
            'service' => null,
            'isEdit' => false,
        ]);
    }

    /**
     * Store a newly created service.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'suitable_for' => 'nullable|string|max:255',
            'features' => 'nullable',
            'badge' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $features = $this->parseFeatures($request->input('features'));

        Service::create([
            'icon' => $validated['icon'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'suitable_for' => $validated['suitable_for'] ?? null,
            'features' => $features,
            'badge' => $validated['badge'] ?? null,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        Cache::forget('home_page_data');
        Cache::forget('nav_services');

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    /**
     * Show the specified service (redirects to edit).
     */
    public function show(Service $service): RedirectResponse
    {
        return redirect()->route('admin.services.edit', $service);
    }

    /**
     * Show the form for editing the service.
     */
    public function edit(Service $service): Response
    {
        return Inertia::render('Admin/Services/Form', [
            'service' => $service,
            'isEdit' => true,
        ]);
    }

    /**
     * Update the specified service.
     */
    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'suitable_for' => 'nullable|string|max:255',
            'features' => 'nullable',
            'badge' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $features = $this->parseFeatures($request->input('features'));

        $service->update([
            'icon' => $validated['icon'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'suitable_for' => $validated['suitable_for'] ?? null,
            'features' => $features,
            'badge' => $validated['badge'] ?? null,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        Cache::forget('home_page_data');
        Cache::forget('nav_services');

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * Parse multiline or array features input into a clean indexed array.
     */
    protected function parseFeatures(mixed $features): array
    {
        if (is_array($features)) {
            return array_values(array_filter(array_map('trim', $features)));
        }

        if (is_string($features)) {
            return array_values(array_filter(array_map('trim', explode("\n", $features))));
        }

        return [];
    }

    /**
     * Remove the specified service.
     */
    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();
        Cache::forget('home_page_data');
        Cache::forget('nav_services');

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
