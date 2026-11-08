<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::post('cache/clear', [DashboardController::class, 'clearCache'])->name('cache.clear');

// Articles Bulk Generator & Bulk Delete
Route::post('articles/bulk-generate', [ArticleController::class, 'bulkGenerate'])->name('articles.bulk-generate');
Route::post('articles/bulk-delete-scheduled', [ArticleController::class, 'bulkDeleteScheduled'])->name('articles.bulk-delete-scheduled');

// CRUD Resources
Route::resource('articles', ArticleController::class);
Route::resource('artikel', ArticleController::class);
Route::resource('projects', ProjectController::class);
Route::resource('portofolio', ProjectController::class);
Route::resource('portfolio', ProjectController::class);
Route::resource('services', ServiceController::class);
Route::resource('layanan', ServiceController::class);
Route::resource('packages', PackageController::class);
Route::resource('paket', PackageController::class);
Route::resource('paket-harga', PackageController::class);
Route::resource('testimonials', TestimonialController::class);
Route::resource('faqs', FaqController::class);
Route::resource('partners', PartnerController::class);
Route::resource('mitra', PartnerController::class);

// CRUD Kontak / Leads Management
Route::resource('leads', LeadController::class);
Route::resource('kontak', LeadController::class);

// Settings
Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

// Homepage / Beranda Management & Synchronizations
Route::get('beranda', [HomePageController::class, 'edit'])->name('home.edit');
Route::put('beranda', [HomePageController::class, 'update'])->name('home.update');
Route::get('homepage', [HomePageController::class, 'edit']);
Route::put('homepage', [HomePageController::class, 'update']);
Route::get('home-page', [HomePageController::class, 'edit']);
Route::put('home-page', [HomePageController::class, 'update']);
