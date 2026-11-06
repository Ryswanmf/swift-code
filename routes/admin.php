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

// Leads Management
Route::get('leads', [LeadController::class, 'index'])->name('leads.index');
Route::get('leads/{lead}', [LeadController::class, 'show'])->name('leads.show');
Route::put('leads/{lead}', [LeadController::class, 'update'])->name('leads.update');
Route::delete('leads/{lead}', [LeadController::class, 'destroy'])->name('leads.destroy');

// Settings
Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
