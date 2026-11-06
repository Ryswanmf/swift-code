<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Company Profile CV Dinamika Konstruksi',
                'slug' => 'cv-dinamika-konstruksi',
                'category' => 'company',
                'summary' => 'Website resmi perusahaan konstruksi dan supplier material di Lampung dengan showcase proyek-proyek besar.',
                'description' => 'CV Dinamika Konstruksi adalah kontraktor terkemuka di Lampung yang menangani proyek sipil dan infrastruktur. Website ini dirancang dengan tema industrial modern yang menonjolkan kredibilitas, legalitas izin usaha, portofolio proyek terverifikasi, serta formulir pengajuan penawaran tender langsung.',
                'client_name' => 'CV Dinamika Konstruksi',
                'live_url' => 'https://dinamikakonstruksi.com',
                'cover_image' => null,
                'gallery' => [
                    'https://images.unsplash.com/photo-1541888946425-d0fbb186156f?q=80&w=1200&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1503387762-592deb58ef4e?q=80&w=1200&auto=format&fit=crop',
                ],
                'tech_stack' => ['Laravel 12', 'Vue.js 3', 'Tailwind CSS', 'MySQL'],
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Portal Akademik MA Darun Najah',
                'slug' => 'ma-darun-najah',
                'category' => 'sekolah',
                'summary' => 'Sistem profil madrasah aliyah terintegrasi informasi pendaftaran santri baru dan portal berita sekolah.',
                'description' => 'Website institusi pendidikan terpadu untuk MA Darun Najah Lampung. Memfasilitasi pendaftaran peserta didik baru (PPDB online), pengumuman kelulusan, kalender akademik, galeri kegiatan ekstrakurikuler, dan profil lengkap tenaga pengajar.',
                'client_name' => 'Yayasan Pendidikan Darun Najah',
                'live_url' => 'https://madarunnajah.sch.id',
                'cover_image' => null,
                'gallery' => [
                    'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1200&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=1200&auto=format&fit=crop',
                ],
                'tech_stack' => ['Laravel', 'Inertia.js', 'Vue 3', 'Tailwind CSS'],
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Katalog Souvenir Souvnela Lampung',
                'slug' => 'souvnela-lampung',
                'category' => 'toko',
                'summary' => 'Toko online kerajinan dan oleh-oleh khas Lampung dengan pemesanan langsung WhatsApp terstruktur.',
                'description' => 'Souvnela adalah UMKM produsen kerajinan khas Lampung berupa tapis, cinderamata kayu, dan souvenir acara. Website ini memudahkan pembeli memilih variasi produk, melihat spesifikasi bahan, dan melakukan checkout pemesanan otomatis ke WhatsApp admin.',
                'client_name' => 'Souvnela Craft & Gift',
                'live_url' => 'https://souvnela.id',
                'cover_image' => null,
                'gallery' => [
                    'https://images.unsplash.com/photo-1513519245088-0e12902e5a38?q=80&w=1200&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1472851294608-062f824d29cc?q=80&w=1200&auto=format&fit=crop',
                ],
                'tech_stack' => ['Vue 3', 'Tailwind CSS', 'Vite', 'Pinia'],
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Sistem Reservasi Wisata Nirwana Tour',
                'slug' => 'nirwana-tour-travel',
                'category' => 'sistem',
                'summary' => 'Aplikasi reservasi paket wisata Lampung & Pulau Pahawang dengan manajemen kuota dan jadwal keberangkatan.',
                'description' => 'Sistem manajemen booking paket tour open trip & private trip Pahawang, Kiluan, dan Krakatau. Dilengkapi kalender ketersediaan kuota real-time, invoice digital otomatis, dan konfirmasi pembayaran via WhatsApp bot.',
                'client_name' => 'Nirwana Tour & Travel Lampung',
                'live_url' => 'https://nirwanatour.com',
                'cover_image' => null,
                'gallery' => [
                    'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=1200&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?q=80&w=1200&auto=format&fit=crop',
                ],
                'tech_stack' => ['Laravel 12', 'Vue.js', 'Inertia.js', 'MySQL'],
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($projects as $proj) {
            Project::updateOrCreate(
                ['slug' => $proj['slug']],
                $proj
            );
        }
    }
}
