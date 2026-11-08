<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Inertia\Inertia;
use Inertia\Response;

class AboutController extends Controller
{
    /**
     * Display the public about us page.
     */
    public function index(): Response
    {
        return Inertia::render('About/Index', [
            'settings' => Setting::getAllAsKeyMap(),
        ]);
    }
}
