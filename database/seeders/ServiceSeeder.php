<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'icon' => 'rocket',
                'title' => 'Landing Page Konversi Tinggi',
                'description' => 'Halaman promosi satu halaman yang dirancang khusus untuk memikat pembeli dan langsung mengarahkan ke nomor WhatsApp Anda.',
                'badge' => 'Favorit UMKM',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'icon' => 'building',
                'title' => 'Website Company Profile',
                'description' => 'Pamerkan portofolio, visi misi, legalitas, dan layanan perusahaan Anda dengan desain elegan dan profesional.',
                'badge' => 'Kredibilitas',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'icon' => 'academic',
                'title' => 'Website Sekolah & Pesantren',
                'description' => 'Dilengkapi profil madrasah/sekolah, PPDB online, galeri kegiatan siswa, berita, dan integrasi pengumuman.',
                'badge' => 'Institusi',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'icon' => 'cart',
                'title' => 'Toko Online (E-Commerce)',
                'description' => 'Katalog produk modern, hitung ongkir otomatis, checkout via WhatsApp / payment gateway yang mudah dikelola.',
                'badge' => 'Penjualan',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'icon' => 'code',
                'title' => 'Sistem Informasi Kustom',
                'description' => 'Aplikasi berbasis web sesuai kebutuhan spesifik usaha: sistem absensi, inventaris kasir, booking antrean, dll.',
                'badge' => 'Custom',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'icon' => 'tool',
                'title' => 'Redesign & Optimasi SEO',
                'description' => 'Perbarui website lama Anda yang lambat atau rusak agar kembali modern, cepat diakses HP, dan naik ke halaman 1 Google.',
                'badge' => 'Performa',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($services as $srv) {
            Service::updateOrCreate(
                ['title' => $srv['title']],
                $srv
            );
        }
    }
}
