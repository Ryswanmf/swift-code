<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class PartnerController extends Controller
{
    /**
     * Display a listing of partners.
     */
    public function index(Request $request): Response
    {
        $status = $request->input('status', 'all');
        $search = $request->input('search');

        $counts = [
            'all' => Partner::count(),
            'active' => Partner::where('is_active', true)->count(),
            'inactive' => Partner::where('is_active', false)->count(),
        ];

        $query = Partner::query()->orderBy('sort_order')->latest('id');

        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $partners = $query->paginate(15)->withQueryString();

        return Inertia::render('Admin/Partners/Index', [
            'partners' => $partners,
            'filters' => [
                'status' => $status,
                'search' => $search,
            ],
            'counts' => $counts,
        ]);
    }

    /**
     * Show the form for creating a new partner.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Partners/Form', [
            'partner' => null,
            'isEdit' => false,
        ]);
    }

    /**
     * Store a newly created partner in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:100',
            'icon' => 'nullable|string|max:50',
            'logo_image' => 'nullable',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo_image')) {
            $logoPath = ImageUploadService::uploadAsWebp($request->file('logo_image'), 'partners');
        } elseif ($request->filled('logo_image') && is_string($request->input('logo_image'))) {
            $logoPath = $request->input('logo_image');
        }

        Partner::create([
            'name' => $validated['name'],
            'category' => $validated['category'] ?? null,
            'color' => $validated['color'] ?? 'from-brand-600 to-rose-600',
            'icon' => $validated['icon'] ?? 'building',
            'logo_image' => $logoPath,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        Cache::forget('home_page_data');

        return redirect()->route('admin.partners.index')->with('success', 'Mitra berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified partner.
     */
    public function edit(Partner $partner): Response
    {
        return Inertia::render('Admin/Partners/Form', [
            'partner' => $partner,
            'isEdit' => true,
        ]);
    }

    /**
     * Update the specified partner in storage.
     */
    public function update(Request $request, Partner $partner): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:100',
            'icon' => 'nullable|string|max:50',
            'logo_image' => 'nullable',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $logoPath = $partner->logo_image;
        if ($request->hasFile('logo_image')) {
            $logoPath = ImageUploadService::uploadAsWebp($request->file('logo_image'), 'partners');
        } elseif ($request->filled('logo_image') && is_string($request->input('logo_image'))) {
            $logoPath = $request->input('logo_image');
        }

        $partner->update([
            'name' => $validated['name'],
            'category' => $validated['category'] ?? null,
            'color' => $validated['color'] ?? 'from-brand-600 to-rose-600',
            'icon' => $validated['icon'] ?? 'building',
            'logo_image' => $logoPath,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        Cache::forget('home_page_data');

        return redirect()->route('admin.partners.index')->with('success', 'Data mitra berhasil diperbarui.');
    }

    /**
     * Remove the specified partner from storage.
     */
    public function destroy(Partner $partner): RedirectResponse
    {
        $partner->delete();

        Cache::forget('home_page_data');

        return redirect()->route('admin.partners.index')->with('success', 'Mitra berhasil dihapus.');
    }
}
