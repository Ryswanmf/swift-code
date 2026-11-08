<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class SettingController extends Controller
{
    /**
     * Show the website settings page.
     */
    public function edit(): Response
    {
        return Inertia::render('Admin/Settings', [
            'settings' => Setting::getAllAsKeyMap(),
        ]);
    }

    /**
     * Update website settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'whatsapp' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'opening_hours' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'google_analytics_id' => 'nullable|string|max:50',
            'google_tag_manager_id' => 'nullable|string|max:50',
            'meta_pixel_id' => 'nullable|string|max:50',
            'site_logo' => 'nullable',
            'site_favicon' => 'nullable',
        ]);

        foreach ($validated as $key => $value) {
            if ($key !== 'site_logo' && $key !== 'site_favicon') {
                Setting::set($key, $value);
            }
        }

        if ($request->hasFile('site_logo')) {
            $logoPath = ImageUploadService::uploadAsWebp($request->file('site_logo'), 'settings');
            Setting::set('site_logo', $logoPath);
        }

        if ($request->hasFile('site_favicon')) {
            $faviconPath = ImageUploadService::uploadAsWebp($request->file('site_favicon'), 'settings');
            Setting::set('site_favicon', $faviconPath);
        }

        Cache::forget('home_page_data');
        Cache::forget('all_settings_map');

        return redirect()->back()->with('success', 'Pengaturan situs berhasil disimpan.');
    }
}
