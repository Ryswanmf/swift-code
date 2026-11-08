<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class PackageController extends Controller
{
    /**
     * Display a listing of packages with optional filters.
     */
    public function index(Request $request): Response
    {
        $query = Package::query()->orderBy('sort_order')->latest('id');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('price_note', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $isActive = $request->status === 'active';
            $query->where('is_active', $isActive);
        }

        if ($request->filled('highlight') && $request->highlight !== 'all') {
            $isHighlighted = $request->highlight === 'yes';
            $query->where('is_highlighted', $isHighlighted);
        }

        $packages = $query->get();

        $counts = [
            'all' => Package::count(),
            'active' => Package::where('is_active', true)->count(),
            'inactive' => Package::where('is_active', false)->count(),
            'highlighted' => Package::where('is_highlighted', true)->count(),
        ];

        return Inertia::render('Admin/Packages/Index', [
            'packages' => $packages,
            'counts' => $counts,
            'filters' => $request->only(['search', 'status', 'highlight']),
        ]);
    }

    /**
     * Show the form for creating a new package.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Packages/Form', [
            'package' => null,
            'isEdit' => false,
        ]);
    }

    /**
     * Store a newly created package in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'price_note' => 'nullable|string|max:255',
            'features' => 'required',
            'is_highlighted' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $features = $this->parseFeatures($request->features);

        if (empty($features)) {
            return redirect()->back()->withErrors(['features' => 'Daftar fitur minimal harus berisi 1 poin deliverable.'])->withInput();
        }

        Package::create([
            'name' => $validated['name'],
            'price' => $validated['price'] !== null && $validated['price'] !== '' ? (int) $validated['price'] : null,
            'price_note' => $validated['price_note'] ?? null,
            'features' => $features,
            'is_highlighted' => $request->boolean('is_highlighted', false),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        Cache::forget('home_page_data');

        return redirect()->route('admin.packages.index')->with('success', 'Paket harga berhasil ditambahkan.');
    }

    /**
     * Display the specified package (redirect to edit).
     */
    public function show(Package $package): RedirectResponse
    {
        return redirect()->route('admin.packages.edit', $package);
    }

    /**
     * Show the form for editing the specified package.
     */
    public function edit(Package $package): Response
    {
        return Inertia::render('Admin/Packages/Form', [
            'package' => $package,
            'isEdit' => true,
        ]);
    }

    /**
     * Update the specified package in storage.
     */
    public function update(Request $request, Package $package): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'price_note' => 'nullable|string|max:255',
            'features' => 'required',
            'is_highlighted' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $features = $this->parseFeatures($request->features);

        if (empty($features)) {
            return redirect()->back()->withErrors(['features' => 'Daftar fitur minimal harus berisi 1 poin deliverable.'])->withInput();
        }

        $package->update([
            'name' => $validated['name'],
            'price' => $validated['price'] !== null && $validated['price'] !== '' ? (int) $validated['price'] : null,
            'price_note' => $validated['price_note'] ?? null,
            'features' => $features,
            'is_highlighted' => $request->boolean('is_highlighted', false),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => (int) ($validated['sort_order'] ?? $package->sort_order),
        ]);

        Cache::forget('home_page_data');

        return redirect()->route('admin.packages.index')->with('success', 'Paket harga berhasil diperbarui.');
    }

    /**
     * Remove the specified package from storage.
     */
    public function destroy(Package $package): RedirectResponse
    {
        $package->delete();
        Cache::forget('home_page_data');

        return redirect()->route('admin.packages.index')->with('success', 'Paket harga berhasil dihapus.');
    }

    /**
     * Parse multiline or array features input into a clean indexed array.
     */
    private function parseFeatures(mixed $input): array
    {
        if (is_array($input)) {
            return array_values(array_filter(array_map('trim', $input)));
        }

        if (is_string($input)) {
            $lines = preg_split('/\r\n|\r|\n/', $input);

            return array_values(array_filter(array_map('trim', $lines)));
        }

        return [];
    }
}
