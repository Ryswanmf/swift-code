<?php

use App\Models\Lead;
use App\Models\Project;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

beforeEach(function () {
    $this->admin = User::factory()->create([
        'name' => 'Admin Test',
        'email' => 'admin_test@swiftcode.id',
        'role' => 'admin',
    ]);
});

test('unauthenticated users cannot access admin panel', function () {
    $response = $this->get('/admin');

    $response->assertRedirect('/login');
});

test('authenticated admin can view admin dashboard', function () {
    $response = $this->actingAs($this->admin)->get('/admin');

    $response->assertStatus(200);
    $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Dashboard')
        ->has('stats')
        ->has('recentLeads')
        ->has('recentProjects')
    );
});

test('admin can create and store a new project', function () {
    $payload = [
        'title' => 'Proyek Baru Admin',
        'slug' => 'proyek-baru-admin',
        'category' => 'company',
        'summary' => 'Ringkasan singkat untuk tes admin',
        'description' => 'Deskripsi panjang proyek',
        'client_name' => 'PT Maju Bersama',
        'is_featured' => true,
        'is_published' => true,
        'sort_order' => 1,
    ];

    $response = $this->actingAs($this->admin)->post('/admin/projects', $payload);

    $response->assertRedirect(route('admin.projects.index'));
    $this->assertDatabaseHas('projects', [
        'title' => 'Proyek Baru Admin',
        'slug' => 'proyek-baru-admin',
    ]);
});

test('admin can update an existing project', function () {
    $project = Project::create([
        'title' => 'Proyek Awal',
        'slug' => 'proyek-awal',
        'category' => 'sekolah',
        'summary' => 'Ringkasan awal',
        'is_published' => true,
        'sort_order' => 1,
    ]);

    $response = $this->actingAs($this->admin)->put("/admin/projects/{$project->id}", [
        'title' => 'Proyek Diedit',
        'slug' => 'proyek-diedit',
        'category' => 'sekolah',
        'summary' => 'Ringkasan yang sudah diedit',
        'is_published' => true,
        'sort_order' => 2,
    ]);

    $response->assertRedirect(route('admin.projects.index'));
    $this->assertDatabaseHas('projects', [
        'id' => $project->id,
        'title' => 'Proyek Diedit',
        'slug' => 'proyek-diedit',
    ]);
});

test('admin can delete a project', function () {
    $project = Project::create([
        'title' => 'Proyek Hapus',
        'slug' => 'proyek-hapus',
        'category' => 'toko',
        'summary' => 'Ringkasan',
        'is_published' => true,
        'sort_order' => 1,
    ]);

    $response = $this->actingAs($this->admin)->delete("/admin/projects/{$project->id}");

    $response->assertRedirect(route('admin.projects.index'));
    $this->assertDatabaseMissing('projects', [
        'id' => $project->id,
    ]);
});

test('admin can perform full CRUD on portfolio projects with templates, filters, and aliases', function () {
    // 1. Render Index and check props
    $indexResponse = $this->actingAs($this->admin)->get('/admin/projects');
    $indexResponse->assertStatus(200);
    $indexResponse->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Projects/Index')
        ->has('projects')
        ->has('filters')
        ->has('counts')
    );

    // 2. Test alias routes
    $aliasPorto1 = $this->actingAs($this->admin)->get('/admin/portofolio');
    $aliasPorto1->assertStatus(200);

    $aliasPorto2 = $this->actingAs($this->admin)->get('/admin/portfolio');
    $aliasPorto2->assertStatus(200);

    // 3. Render Create Page
    $createResponse = $this->actingAs($this->admin)->get('/admin/projects/create');
    $createResponse->assertStatus(200);

    // 4. Store Project with Tech Stack
    $storeResponse = $this->actingAs($this->admin)->post('/admin/projects', [
        'title' => 'Portal Berita & Informasi Lampung Gemilang',
        'category' => 'company',
        'client_name' => 'PT Lampung Gemilang Media',
        'live_url' => 'https://lampunggemilang.co.id',
        'summary' => 'Website portal media berita daerah Lampung dengan performa kilat dan arsitektur modern.',
        'description' => 'Membangun platform portal berita dengan ribuan pembaca harian, integrasi iklan ads, dan Google News sitemap.',
        'tech_stack' => 'Laravel, Vue.js, Inertia.js, Tailwind CSS, MySQL',
        'is_featured' => true,
        'is_published' => true,
        'sort_order' => 1,
    ]);

    $storeResponse->assertRedirect(route('admin.projects.index'));
    $this->assertDatabaseHas('projects', [
        'title' => 'Portal Berita & Informasi Lampung Gemilang',
        'category' => 'company',
        'client_name' => 'PT Lampung Gemilang Media',
        'is_featured' => true,
        'is_published' => true,
    ]);

    $created = Project::where('title', 'Portal Berita & Informasi Lampung Gemilang')->first();
    expect($created)->not->toBeNull();
    expect($created->tech_stack)->toBeArray();
    expect(count($created->tech_stack))->toBe(5);

    // 5. Show route redirects to edit
    $showResponse = $this->actingAs($this->admin)->get("/admin/projects/{$created->id}");
    $showResponse->assertRedirect(route('admin.projects.edit', $created));

    // 6. Render Edit Page
    $editResponse = $this->actingAs($this->admin)->get("/admin/projects/{$created->id}/edit");
    $editResponse->assertStatus(200);

    // 7. Update Project
    $updateResponse = $this->actingAs($this->admin)->put("/admin/projects/{$created->id}", [
        'title' => 'Portal Berita & Informasi Lampung Gemilang Terkini',
        'category' => 'sistem',
        'client_name' => 'PT Lampung Gemilang Media Grup',
        'live_url' => 'https://lampunggemilang.co.id',
        'summary' => 'Pembaruan ringkasan portal berita dengan caching canggih.',
        'description' => 'Studi kasus optimasi query database dan integrasi CDN.',
        'tech_stack' => 'Laravel, Vue.js, Tailwind CSS, Redis',
        'is_featured' => false,
        'is_published' => true,
        'sort_order' => 5,
    ]);

    $updateResponse->assertRedirect(route('admin.projects.index'));
    $this->assertDatabaseHas('projects', [
        'id' => $created->id,
        'title' => 'Portal Berita & Informasi Lampung Gemilang Terkini',
        'category' => 'sistem',
        'is_featured' => false,
        'sort_order' => 5,
    ]);

    // 8. Filter verification
    $filterStatus = $this->actingAs($this->admin)->get('/admin/projects?status=published&category=sistem');
    $filterStatus->assertStatus(200);

    // 9. Delete Project
    $deleteResponse = $this->actingAs($this->admin)->delete("/admin/projects/{$created->id}");
    $deleteResponse->assertRedirect(route('admin.projects.index'));
    $this->assertDatabaseMissing('projects', [
        'id' => $created->id,
    ]);
});

test('admin can view leads index and update lead status', function () {
    $lead = Lead::create([
        'name' => 'Calon Klien Tes',
        'phone' => '081299998888',
        'service_type' => 'Landing Page',
        'message' => 'Tolong buatkan website',
        'status' => 'new',
    ]);

    $response = $this->actingAs($this->admin)->get('/admin/leads');
    $response->assertStatus(200);

    $updateResponse = $this->actingAs($this->admin)->put("/admin/leads/{$lead->id}", [
        'status' => 'contacted',
        'notes' => 'Sudah ditelepon dan sepakat meeting besok.',
    ]);

    $updateResponse->assertRedirect();
    $this->assertDatabaseHas('leads', [
        'id' => $lead->id,
        'status' => 'contacted',
        'notes' => 'Sudah ditelepon dan sepakat meeting besok.',
    ]);
});

test('admin can update site settings', function () {
    $response = $this->actingAs($this->admin)->put('/admin/settings', [
        'site_name' => 'Swift Code Lampung Official',
        'tagline' => 'Jasa Website Nomor 1 di Lampung',
        'whatsapp' => '62895325852575',
        'email' => 'halo@swiftcode.id',
        'address' => 'Bandar Lampung',
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('settings', [
        'key' => 'site_name',
        'value' => 'Swift Code Lampung Official',
    ]);
});

test('admin can perform full CRUD on contact leads including create and full edit', function () {
    // 1. Render Create Page
    $createResponse = $this->actingAs($this->admin)->get('/admin/leads/create');
    $createResponse->assertStatus(200);

    // 2. Store New Contact Lead
    $storeResponse = $this->actingAs($this->admin)->post('/admin/leads', [
        'name' => 'Budi Santoso - Toko Berkah',
        'phone' => '089512345678',
        'email' => 'budi@tokoberkah.com',
        'service_type' => 'Toko Online (E-Commerce)',
        'budget' => 'Rp 3.000.000 - Rp 5.000.000',
        'message' => 'Ingin buat toko online kerajinan khas Lampung',
        'status' => 'new',
        'notes' => 'Hubungi via WA jam 2 siang.',
    ]);

    $storeResponse->assertRedirect(route('admin.leads.index'));
    $this->assertDatabaseHas('leads', [
        'name' => 'Budi Santoso - Toko Berkah',
        'phone' => '089512345678',
        'service_type' => 'Toko Online (E-Commerce)',
    ]);

    $createdLead = Lead::where('name', 'Budi Santoso - Toko Berkah')->first();
    expect($createdLead)->not->toBeNull();

    // 3. Render Edit Page
    $editResponse = $this->actingAs($this->admin)->get("/admin/leads/{$createdLead->id}/edit");
    $editResponse->assertStatus(200);

    // 4. Update Full Contact Details
    $updateResponse = $this->actingAs($this->admin)->put("/admin/leads/{$createdLead->id}", [
        'name' => 'Budi Santoso - Toko Berkah Sentosa',
        'phone' => '089512349999',
        'email' => 'budi.sentosa@tokoberkah.com',
        'service_type' => 'Toko Online (E-Commerce)',
        'budget' => 'Di atas Rp 5.000.000',
        'message' => 'Ingin buat toko online dengan fitur payment gateway dan ekspedisi',
        'status' => 'deal',
        'notes' => 'Closing paket custom. DP 50% diterima.',
    ]);

    $updateResponse->assertRedirect(route('admin.leads.index'));
    $this->assertDatabaseHas('leads', [
        'id' => $createdLead->id,
        'name' => 'Budi Santoso - Toko Berkah Sentosa',
        'phone' => '089512349999',
        'status' => 'deal',
    ]);

    // 5. Test alias route /admin/kontak
    $aliasResponse = $this->actingAs($this->admin)->get('/admin/kontak');
    $aliasResponse->assertStatus(200);

    // 6. Delete Lead
    $deleteResponse = $this->actingAs($this->admin)->delete("/admin/leads/{$createdLead->id}");
    $deleteResponse->assertRedirect(route('admin.leads.index'));
    $this->assertDatabaseMissing('leads', [
        'id' => $createdLead->id,
    ]);
});

test('admin can perform full CRUD on articles', function () {
    // 1. Render Articles Index
    $indexResponse = $this->actingAs($this->admin)->get('/admin/articles');
    $indexResponse->assertStatus(200);

    // 2. Render Create Page
    $createResponse = $this->actingAs($this->admin)->get('/admin/articles/create');
    $createResponse->assertStatus(200);

    // 3. Store New Article
    $storeResponse = $this->actingAs($this->admin)->post('/admin/articles', [
        'title' => 'Panduan Memilih Hosting Cepat untuk Website Lampung',
        'category' => 'Panduan Web',
        'summary' => 'Tips memilih server hosting dengan latensi rendah di Indonesia agar website memuat instan.',
        'content' => 'Server hosting adalah rumah bagi seluruh file website Anda. Memilih penyedia hosting dengan server lokal Indonesia sangat penting agar waktu muat diakses dari Lampung di bawah 1 detik.',
        'author' => 'Tim Swift Code',
        'is_published' => true,
    ]);

    $storeResponse->assertRedirect(route('admin.articles.index'));
    $this->assertDatabaseHas('articles', [
        'title' => 'Panduan Memilih Hosting Cepat untuk Website Lampung',
        'slug' => 'panduan-memilih-hosting-cepat-untuk-website-lampung',
        'category' => 'Panduan Web',
        'is_published' => true,
    ]);

    $createdArticle = \App\Models\Article::where('slug', 'panduan-memilih-hosting-cepat-untuk-website-lampung')->first();
    expect($createdArticle)->not->toBeNull();

    // 4. Render Edit Page
    $editResponse = $this->actingAs($this->admin)->get("/admin/articles/{$createdArticle->id}/edit");
    $editResponse->assertStatus(200);

    // 5. Update Article
    $updateResponse = $this->actingAs($this->admin)->put("/admin/articles/{$createdArticle->id}", [
        'title' => 'Panduan Memilih Hosting Cloud SSD Cepat Lampung 2026',
        'category' => 'Panduan Web',
        'summary' => 'Tips teruji memilih cloud SSD untuk performa maksimal website bisnis.',
        'content' => 'Pembaruan panduan lengkap memilih hosting cloud dengan keamanan SSL dan backup harian.',
        'author' => 'Tim Swift Code Official',
        'is_published' => true,
    ]);

    $updateResponse->assertRedirect(route('admin.articles.index'));
    $this->assertDatabaseHas('articles', [
        'id' => $createdArticle->id,
        'title' => 'Panduan Memilih Hosting Cloud SSD Cepat Lampung 2026',
        'author' => 'Tim Swift Code Official',
    ]);

    // 6. Test alias route /admin/artikel
    $aliasResponse = $this->actingAs($this->admin)->get('/admin/artikel');
    $aliasResponse->assertStatus(200);

    // 7. Delete Article
    $deleteResponse = $this->actingAs($this->admin)->delete("/admin/articles/{$createdArticle->id}");
    $deleteResponse->assertRedirect(route('admin.articles.index'));
    $this->assertDatabaseMissing('articles', [
        'id' => $createdArticle->id,
    ]);
});

test('admin can perform full CRUD on packages including templates and aliases', function () {
    // 1. Render Packages Index
    $indexResponse = $this->actingAs($this->admin)->get('/admin/packages');
    $indexResponse->assertStatus(200);

    // 2. Render Create Page
    $createResponse = $this->actingAs($this->admin)->get('/admin/packages/create');
    $createResponse->assertStatus(200);

    // 3. Store New Package
    $storeResponse = $this->actingAs($this->admin)->post('/admin/packages', [
        'name' => 'Paket Web Profil UMKM Kilat',
        'price' => 1250000,
        'price_note' => 'Termasuk hosting 1 tahun & domain .my.id',
        'features' => [
            '1 Halaman Responsif Mobile-First',
            'Desain Modern Tailwind',
            'Integrasi WhatsApp Langsung',
            'Gratis SSL & Setup Domain',
        ],
        'is_highlighted' => true,
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $storeResponse->assertRedirect(route('admin.packages.index'));
    $this->assertDatabaseHas('packages', [
        'name' => 'Paket Web Profil UMKM Kilat',
        'price' => 1250000,
        'is_highlighted' => true,
        'is_active' => true,
    ]);

    $createdPackage = \App\Models\Package::where('name', 'Paket Web Profil UMKM Kilat')->first();
    expect($createdPackage)->not->toBeNull();
    expect($createdPackage->features)->toBeArray();
    expect(count($createdPackage->features))->toBe(4);

    // 4. Render Edit Page
    $editResponse = $this->actingAs($this->admin)->get("/admin/packages/{$createdPackage->id}/edit");
    $editResponse->assertStatus(200);

    // 5. Update Package
    $updateResponse = $this->actingAs($this->admin)->put("/admin/packages/{$createdPackage->id}", [
        'name' => 'Paket Web Profil UMKM Super Kilat',
        'price' => 1450000,
        'price_note' => 'Termasuk hosting Cloud SSD 1 tahun & domain .com',
        'features' => [
            '1-3 Halaman Responsif Mobile-First',
            'Desain Modern Tailwind Custom',
            'Integrasi WhatsApp & Email Form',
            'Gratis SSL & Setup Domain .COM',
            'Garansi Bug & Pemeliharaan 30 Hari',
        ],
        'is_highlighted' => false,
        'sort_order' => 2,
        'is_active' => true,
    ]);

    $updateResponse->assertRedirect(route('admin.packages.index'));
    $this->assertDatabaseHas('packages', [
        'id' => $createdPackage->id,
        'name' => 'Paket Web Profil UMKM Super Kilat',
        'price' => 1450000,
        'is_highlighted' => false,
    ]);

    // 6. Test alias routes
    $aliasPaket = $this->actingAs($this->admin)->get('/admin/paket');
    $aliasPaket->assertStatus(200);

    $aliasPaketHarga = $this->actingAs($this->admin)->get('/admin/paket-harga');
    $aliasPaketHarga->assertStatus(200);

    // 7. Delete Package
    $deleteResponse = $this->actingAs($this->admin)->delete("/admin/packages/{$createdPackage->id}");
    $deleteResponse->assertRedirect(route('admin.packages.index'));
    $this->assertDatabaseMissing('packages', [
        'id' => $createdPackage->id,
    ]);
});

test('admin can perform full CRUD on services including templates and aliases', function () {
    // 1. Render Services Index
    $indexResponse = $this->actingAs($this->admin)->get('/admin/services');
    $indexResponse->assertStatus(200);
    $indexResponse->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Services/Index')
        ->has('services')
        ->has('filters')
        ->has('counts')
    );

    // 2. Test alias route /admin/layanan
    $aliasResponse = $this->actingAs($this->admin)->get('/admin/layanan');
    $aliasResponse->assertStatus(200);

    // 3. Render Create Page
    $createResponse = $this->actingAs($this->admin)->get('/admin/services/create');
    $createResponse->assertStatus(200);

    // 4. Store New Service
    $storeResponse = $this->actingAs($this->admin)->post('/admin/services', [
        'icon' => 'building',
        'title' => 'Website Profil Bisnis & Korporat Eksklusif',
        'description' => 'Desain website eksklusif untuk perusahaan dan instansi dengan tampilan elegan, cepat, dan teroptimasi SEO lokal Lampung.',
        'badge' => 'Paling Populer',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $storeResponse->assertRedirect(route('admin.services.index'));
    $this->assertDatabaseHas('services', [
        'title' => 'Website Profil Bisnis & Korporat Eksklusif',
        'icon' => 'building',
        'badge' => 'Paling Populer',
        'is_active' => true,
    ]);

    $createdService = \App\Models\Service::where('title', 'Website Profil Bisnis & Korporat Eksklusif')->first();
    expect($createdService)->not->toBeNull();

    // 5. Show route redirects to edit
    $showResponse = $this->actingAs($this->admin)->get("/admin/services/{$createdService->id}");
    $showResponse->assertRedirect(route('admin.services.edit', $createdService));

    // 6. Render Edit Page
    $editResponse = $this->actingAs($this->admin)->get("/admin/services/{$createdService->id}/edit");
    $editResponse->assertStatus(200);

    // 7. Update Service
    $updateResponse = $this->actingAs($this->admin)->put("/admin/services/{$createdService->id}", [
        'icon' => 'rocket',
        'title' => 'Website Profil Bisnis & Korporat Modern 2026',
        'description' => 'Desain website eksklusif terintegrasi CRM dan katalog produk digital.',
        'badge' => 'Pilihan Utama',
        'sort_order' => 2,
        'is_active' => true,
    ]);

    $updateResponse->assertRedirect(route('admin.services.index'));
    $this->assertDatabaseHas('services', [
        'id' => $createdService->id,
        'title' => 'Website Profil Bisnis & Korporat Modern 2026',
        'icon' => 'rocket',
        'badge' => 'Pilihan Utama',
    ]);

    // 8. Filter test
    $filterResponse = $this->actingAs($this->admin)->get('/admin/services?status=active&search=Modern');
    $filterResponse->assertStatus(200);

    // 9. Delete Service
    $deleteResponse = $this->actingAs($this->admin)->delete("/admin/services/{$createdService->id}");
    $deleteResponse->assertRedirect(route('admin.services.index'));
    $this->assertDatabaseMissing('services', [
        'id' => $createdService->id,
    ]);
});
