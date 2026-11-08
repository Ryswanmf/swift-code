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
