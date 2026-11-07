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
            [
                'title' => 'Website Profil Klinik Pratama Medika Bunda',
                'slug' => 'klinik-medika-bunda',
                'category' => 'company',
                'summary' => 'Website profil fasilitas kesehatan dengan jadwal dokter spesialis dan pendaftaran konsultasi online.',
                'description' => 'Klinik Medika Bunda Lampung menyediakan layanan kesehatan umum, gigi, dan kebidanan. Website ini menghadirkan jadwal praktek dokter, artikel edukasi kesehatan, dan fitur reservasi janji temu pasien.',
                'client_name' => 'Klinik Pratama Medika Bunda',
                'live_url' => 'https://medikabunda.co.id',
                'cover_image' => null,
                'gallery' => [
                    'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?q=80&w=1200&auto=format&fit=crop',
                ],
                'tech_stack' => ['Laravel 12', 'Vue 3', 'Tailwind CSS'],
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Sistem Penerimaan Santri Baru Pondok IT',
                'slug' => 'psb-pondok-it-lampung',
                'category' => 'sekolah',
                'summary' => 'Portal pendaftaran santri baru berbasis web dengan tes seleksi online dan verifikasi berkas digital.',
                'description' => 'Sistem PPDB / PSB online untuk mempermudah pendaftaran santri baru secara digital, pengunggahan dokumen kelulusan, dan pengumuman hasil seleksi masuk otomatis.',
                'client_name' => 'Pondok IT Lampung',
                'live_url' => 'https://psb.pondokit.id',
                'cover_image' => null,
                'gallery' => [
                    'https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=1200&auto=format&fit=crop',
                ],
                'tech_stack' => ['Vue 3', 'Inertia.js', 'MySQL'],
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => 6,
            ],
            [
                'title' => 'E-Commerce Kopi Robusta Lampung Craft',
                'slug' => 'kopi-robusta-lampung-craft',
                'category' => 'toko',
                'summary' => 'Platform pemesanan biji kopi sangrai premium dengan perhitungan ongkir otomatis ke seluruh Indonesia.',
                'description' => 'Toko online untuk memasarkan kopi robusta petik merah asli Lampung Barat ke skala nasional dan ekspor, dilengkapi keranjang belanja instan dan direct checkout.',
                'client_name' => 'Lampung Coffee Roastery',
                'live_url' => 'https://lampungroastery.com',
                'cover_image' => null,
                'gallery' => [
                    'https://images.unsplash.com/photo-1498804103079-a6351b050096?q=80&w=1200&auto=format&fit=crop',
                ],
                'tech_stack' => ['Laravel', 'Vue 3', 'Tailwind CSS'],
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 7,
            ],
            [
                'title' => 'Sistem Logistik Distribusi Sinar Agro',
                'slug' => 'sistem-distribusi-sinar-agro',
                'category' => 'sistem',
                'summary' => 'Dashboard pemantauan armada angkutan hasil bumi Lampung dengan pelacakan status pengiriman real-time.',
                'description' => 'Aplikasi internal berbasis web untuk manajemen armada ekspedisi, surat jalan digital, laporan tonase harian komoditas pertanian dan perkebunan Lampung.',
                'client_name' => 'PT Sinar Agro Lampung',
                'live_url' => 'https://logistik.sinaragro.com',
                'cover_image' => null,
                'gallery' => [
                    'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=1200&auto=format&fit=crop',
                ],
                'tech_stack' => ['Laravel 12', 'Vue 3', 'PostgreSQL'],
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => 8,
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
