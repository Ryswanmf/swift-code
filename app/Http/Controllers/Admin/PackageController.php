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
    public function index(): Response
    {
        $packages = Package::query()->orderBy('sort_order')->get();

        return Inertia::render('Admin/Packages/Index', [
            'packages' => $packages,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Packages/Form', [
            'package' => null,
            'isEdit' => false,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'price_note' => 'nullable|string|max:255',
            'features' => 'required',
            'is_highlighted' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $features = $this->parseFeatures($request->features);

        Package::create([
            'name' => $validated['name'],
            'price' => $validated['price'] !== null ? (int) $validated['price'] : null,
            'price_note' => $validated['price_note'] ?? null,
            'features' => $features,
            'is_highlighted' => $request->boolean('is_highlighted', false),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        Cache::forget('home_page_data');

        return redirect()->route('admin.packages.index')->with('success', 'Paket harga berhasil ditambahkan.');
    }

    public function edit(Package $package): Response
    {
        return Inertia::render('Admin/Packages/Form', [
            'package' => $package,
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, Package $package): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'price_note' => 'nullable|string|max:255',
            'features' => 'required',
            'is_highlighted' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $features = $this->parseFeatures($request->features);

        $package->update([
            'name' => $validated['name'],
            'price' => $validated['price'] !== null ? (int) $validated['price'] : null,
            'price_note' => $validated['price_note'] ?? null,
            'features' => $features,
            'is_highlighted' => $request->boolean('is_highlighted', false),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        Cache::forget('home_page_data');

        return redirect()->route('admin.packages.index')->with('success', 'Paket harga berhasil diperbarui.');
    }

    public function destroy(Package $package): RedirectResponse
    {
        $package->delete();
        Cache::forget('home_page_data');

        return redirect()->route('admin.packages.index')->with('success', 'Paket harga berhasil dihapus.');
    }

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
