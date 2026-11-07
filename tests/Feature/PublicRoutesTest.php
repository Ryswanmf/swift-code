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

test('services index page loads successfully', function () {
    $response = $this->get('/layanan');

    $response->assertStatus(200);
    $response->assertInertia(fn (Assert $page) => $page
        ->component('Services/Index')
        ->has('services')
        ->has('packages')
        ->has('settings')
    );
});

test('pricing index page loads successfully', function () {
    $response = $this->get('/harga');

    $response->assertStatus(200);
    $response->assertInertia(fn (Assert $page) => $page
        ->component('Pricing/Index')
        ->has('packages')
        ->has('faqs')
        ->has('settings')
    );
});

test('articles index page loads successfully', function () {
    $response = $this->get('/artikel');

    $response->assertStatus(200);
    $response->assertInertia(fn (Assert $page) => $page
        ->component('Articles/Index')
        ->has('articles')
        ->has('settings')
    );
});

test('contact page loads successfully', function () {
    $response = $this->get('/kontak');

    $response->assertStatus(200);
    $response->assertInertia(fn (Assert $page) => $page
        ->component('Contact/Index')
        ->has('settings')
    );
});

test('article detail page loads successfully for existing slug', function () {
    $response = $this->get('/artikel/alasan-bisnis-lampung-wajib-punya-website');

    $response->assertStatus(200);
    $response->assertInertia(fn (Assert $page) => $page
        ->component('Articles/Show')
        ->has('article')
        ->has('relatedArticles')
    );
});

test('article detail returns 404 for non-existent slug', function () {
    $response = $this->get('/artikel/slug-yang-tidak-ada-9999');

    $response->assertStatus(404);
});

test('portfolio index page loads successfully with published projects', function () {
    Project::create([
        'title' => 'Archive Test Project',
        'slug' => 'archive-test-project',
        'category' => 'company',
        'summary' => 'Summary for archive test',
        'is_published' => true,
        'sort_order' => 1,
    ]);

    $response = $this->get('/portofolio');

    $response->assertStatus(200);
    $response->assertInertia(fn (Assert $page) => $page
        ->component('Projects/Index')
        ->has('projects')
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

test('sitemap xml endpoint returns valid xml with published projects', function () {
    $project = Project::create([
        'title' => 'Sitemap Test Project',
        'slug' => 'sitemap-test-project',
        'category' => 'company',
        'summary' => 'Summary for sitemap test',
        'is_published' => true,
        'sort_order' => 1,
    ]);

    $response = $this->get('/sitemap.xml');

    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'application/xml');
    expect($response->getContent())->toContain('sitemap-test-project');
    expect($response->getContent())->toContain('<urlset');
});
