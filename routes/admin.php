<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// CRUD Resources
Route::resource('projects', ProjectController::class);
Route::resource('services', ServiceController::class);
Route::resource('packages', PackageController::class);
Route::resource('testimonials', TestimonialController::class);
Route::resource('faqs', FaqController::class);

// CRUD Kontak / Leads Management
Route::resource('leads', LeadController::class);
Route::resource('kontak', LeadController::class);

// Settings
Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
