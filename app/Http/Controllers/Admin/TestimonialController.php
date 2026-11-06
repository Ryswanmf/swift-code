<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class TestimonialController extends Controller
{
    public function index(): Response
    {
        $testimonials = Testimonial::query()->orderBy('sort_order')->latest('id')->get();

        return Inertia::render('Admin/Testimonials/Index', [
            'testimonials' => $testimonials,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Testimonials/Form', [
            'testimonial' => null,
            'isEdit' => false,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'quote' => 'required|string',
            'avatar_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar_file')) {
            $avatarPath = ImageUploadService::uploadAsWebp($request->file('avatar_file'), 'testimonials');
        }

        Testimonial::create([
            'name' => $validated['name'],
            'role' => $validated['role'] ?? null,
            'company' => $validated['company'] ?? null,
            'quote' => $validated['quote'],
            'avatar' => $avatarPath,
            'rating' => (int) $validated['rating'],
            'is_published' => $request->boolean('is_published', true),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        Cache::forget('home_page_data');

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial): Response
    {
        return Inertia::render('Admin/Testimonials/Form', [
            'testimonial' => $testimonial,
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'quote' => 'required|string',
            'avatar_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $avatarPath = $testimonial->avatar;
        if ($request->hasFile('avatar_file')) {
            $avatarPath = ImageUploadService::uploadAsWebp($request->file('avatar_file'), 'testimonials');
        }

        $testimonial->update([
            'name' => $validated['name'],
            'role' => $validated['role'] ?? null,
            'company' => $validated['company'] ?? null,
            'quote' => $validated['quote'],
            'avatar' => $avatarPath,
            'rating' => (int) $validated['rating'],
            'is_published' => $request->boolean('is_published', true),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        Cache::forget('home_page_data');

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();
        Cache::forget('home_page_data');

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
