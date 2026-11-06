<?php

use App\Models\Project;
use Inertia\Testing\AssertableInertia as Assert;

test('homepage loads successfully with dynamic data props', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertInertia(fn (Assert $page) => $page
        ->component('Home')
        ->has('services')
        ->has('projects')
        ->has('packages')
        ->has('testimonials')
        ->has('faqs')
        ->has('settings')
    );
});

test('portfolio detail page loads successfully for published project', function () {
    $project = Project::create([
        'title' => 'Sample Test Project',
        'slug' => 'sample-test-project',
        'category' => 'company',
        'summary' => 'Short summary for test',
        'description' => 'Full description for test',
        'client_name' => 'Test Client',
        'live_url' => 'https://example.com',
        'is_featured' => true,
        'is_published' => true,
        'sort_order' => 1,
    ]);

    $response = $this->get('/portofolio/'.$project->slug);

    $response->assertStatus(200);
    $response->assertInertia(fn (Assert $page) => $page
        ->component('Projects/Show')
        ->has('project', fn (Assert $page) => $page
            ->where('slug', $project->slug)
            ->where('title', $project->title)
            ->etc()
        )
        ->has('relatedProjects')
    );
});

test('portfolio detail returns 404 for non-existent slug', function () {
    $response = $this->get('/portofolio/slug-yang-tidak-ada-12345');

    $response->assertStatus(404);
});

test('contact form stores new lead and returns inertia location header', function () {
    $payload = [
        'name' => 'Budi Santoso',
        'phone' => '081234567890',
        'email' => 'budi@example.com',
        'service_type' => 'Landing Page & Promosi',
        'budget' => 'Rp 1.000.000 - Rp 3.000.000',
        'message' => 'Saya ingin membuat landing page untuk toko oleh-oleh khas Lampung.',
        'website_hp' => '', // Clean honeypot
    ];

    $response = $this->withHeaders(['X-Inertia' => 'true'])->post('/kontak', $payload);

    $this->assertDatabaseHas('leads', [
        'name' => 'Budi Santoso',
        'phone' => '081234567890',
        'service_type' => 'Landing Page & Promosi',
        'status' => 'new',
    ]);

    // For Inertia request, Inertia::location sends 409 Conflict with X-Inertia-Location header
    $response->assertStatus(409);
    expect($response->headers->get('X-Inertia-Location'))->toContain('https://wa.me/');
});

test('contact form rejects spam bot when honeypot is filled', function () {
    $payload = [
        'name' => 'Spam Bot',
        'phone' => '0899999999',
        'email' => 'spambot@example.com',
        'service_type' => 'Landing Page',
        'message' => 'Spam link here',
        'website_hp' => 'http://spam-link.com', // Filled honeypot
    ];

    $response = $this->post('/kontak', $payload);

    $response->assertSessionHasErrors(['website_hp']);
    $this->assertDatabaseMissing('leads', [
        'name' => 'Spam Bot',
    ]);
});

test('contact form validates required fields', function () {
    $response = $this->post('/kontak', []);

    $response->assertSessionHasErrors(['name', 'phone', 'service_type', 'message']);
});
