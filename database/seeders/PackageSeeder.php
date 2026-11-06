<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Paket Basic (Landing Page)',
                'price' => 950000,
                'price_note' => 'Mulai dari • Cocok untuk promosi produk & UMKM',
                'features' => [
                    '1 Halaman Landing Page responsif',
                    'Desain modern & mobile-first',
                    'Tombol WhatsApp & formulir kontak',
                    'Domain .my.id / .com gratis 1 tahun',
                    'Hosting kilat SSD 1 tahun',
                    'Sertifikat keamanan SSL aktif',
                    'Pengerjaan 3 - 5 hari kerja',
                ],
                'is_highlighted' => false,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Paket Business (Company Profile)',
                'price' => 2450000,
                'price_note' => 'Mulai dari • Paling diminati perusahaan & sekolah',
                'features' => [
                    'Hingga 5-7 Halaman (Home, Profil, Layanan, Galeri, Kontak)',
                    'Panel Admin kelola konten & artikel',
                    'Optimasi SEO dasar Google Search',
                    'Domain .com / .sch.id gratis 1 tahun',
                    'Hosting cepat kapasitas tinggi 1 tahun',
                    'Email bisnis profesional (nama@perusahaan.com)',
                    'Pengerjaan 5 - 10 hari kerja',
                    'Garansi support 6 bulan penuh',
                ],
                'is_highlighted' => true,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Paket Custom / Sistem Web',
                'price' => null,
                'price_note' => 'Sesuai spesifikasi • Toko online & sistem khusus',
                'features' => [
                    'Struktur database & fungsionalitas kustom',
                    'Integrasi Payment Gateway / Ekspedisi Ongkir',
                    'Hak akses multi-role (Admin, Kasir, Klien)',
                    'Laporan data & export PDF/Excel',
                    'Infrastruktur VPS / Server khusus',
                    'Pelatihan langsung tim operasional',
                    'Maintenance & pemeliharaan teratur',
                ],
                'is_highlighted' => false,
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($packages as $pkg) {
            Package::updateOrCreate(
                ['name' => $pkg['name']],
                $pkg
            );
        }
    }
}
