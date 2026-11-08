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
                'badge' => 'Favorit UMKM',
                'suitable_for' => 'UMKM, produk kuliner, event, jasa lokal, iklan FB/TikTok & Google Ads',
                'description' => 'Halaman promosi satu halaman terarah yang dirancang untuk memikat calon pembeli dan langsung mengarahkan transaksi ke nomor WhatsApp Anda.',
                'features' => [
                    'Desain 1 halaman modern & mobile-first',
                    'Copywriting persuasif dengan Call to Action jelas',
                    'Integrasi tombol WhatsApp otomatis & form leads',
                    'Gratis domain (.my.id/.com) & hosting SSD 1 tahun',
                    'Loading kilat optimal < 2 detik',
                    'Pengerjaan cepat 3 - 5 hari kerja',
                ],
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'icon' => 'building',
                'title' => 'Website Company Profile',
                'badge' => 'Kredibilitas Bisnis',
                'suitable_for' => 'PT, CV, kantor hukum, klinik, agensi, kontraktor, dan yayasan',
                'description' => 'Pamerkan portofolio, visi misi, legalitas, tim, dan layanan perusahaan Anda dengan desain elegan, cepat, dan profesional.',
                'features' => [
                    'Hingga 5 - 7 halaman lengkap & terstruktur rapi',
                    'Desain eksklusif mencerminkan identitas brand',
                    'Email bisnis resmi profesional (@namaperusahaan.com)',
                    'Panel admin mandiri untuk update konten kapan saja',
                    'Optimasi SEO dasar Google Search Console',
                    'Garansi perbaikan & pendampingan 6 bulan',
                ],
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'icon' => 'academic',
                'title' => 'Website Sekolah & Pesantren',
                'badge' => 'Institusi Pendidikan',
                'suitable_for' => 'SD, SMP, SMA/SMK, Madrasah, Pondok Pesantren, & Bimbel',
                'description' => 'Portal informasi resmi madrasah, sekolah, atau pondok pesantren terintegrasi info PPDB online dan portal berita kegiatan.',
                'features' => [
                    'Domain resmi institusi (.sch.id / .ponpes.id) gratis 1 tahun',
                    'Informasi & alur formulir PPDB online',
                    'Galeri foto/video kegiatan siswa & fasilitas',
                    'Portal berita, pengumuman & kalender akademik',
                    'Sangat mudah dikelola staf tata usaha (TU)',
                    'Dukungan panduan video cara pengelolaan konten',
                ],
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'icon' => 'cart',
                'title' => 'Toko Online (E-Commerce)',
                'badge' => 'Penjualan Digital',
                'suitable_for' => 'Toko retail, butik fashion, oleh-oleh khas Lampung, distributor',
                'description' => 'Platform katalog produk modern, hitung ongkir otomatis se-Indonesia, dan alur checkout mudah yang langsung tersambung ke WhatsApp atau payment gateway.',
                'features' => [
                    'Katalog produk terstruktur rapi & pencarian kilat',
                    'Kalkulator hitung ongkir otomatis (JNE, J&T, SiCepat, POS)',
                    'Pemesanan checkout instan via WhatsApp terformat',
                    'Manajemen stok, varian warna/ukuran, dan promo diskon',
                    'Panel admin laporan penjualan & riwayat transaksi',
                    'Desain responsif ringan diakses dari browser HP',
                ],
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'icon' => 'code',
                'title' => 'Sistem Informasi Kustom',
                'badge' => 'Solusi Khusus',
                'suitable_for' => 'Perusahaan logistik, klinik, pergudangan, sistem booking, reservasi',
                'description' => 'Aplikasi berbasis web sesuai kebutuhan alur kerja unik usaha Anda: sistem absensi, inventaris stok, kasir POS, hingga antrean booking.',
                'features' => [
                    'Arsitektur database & logika bisnis dirancang khusus',
                    'Multi-role hak akses berjenjang (Admin, Staff, Klien)',
                    'Export laporan rekapitulasi data format PDF & Excel',
                    'Otomatisasi alur kerja manual menjadi terkomputerisasi',
                    'Infrastruktur VPS server stabil dengan backup rutin',
                    'Pelatihan teknis tatap muka & garansi maintenance',
                ],
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'icon' => 'tool',
                'title' => 'Redesign & Optimasi SEO',
                'badge' => 'Performa & Kecepatan',
                'suitable_for' => 'Website lama yang lambat, tampilan usang, atau sulit diakses dari HP',
                'description' => 'Perbarui website lama Anda yang lambat atau rusak agar kembali modern, gesit di HP, dan bersaing di halaman utama Google.',
                'features' => [
                    'Audit Core Web Vitals & percepatan loading drastis',
                    'Pembaruan tampilan UI/UX modern dan fresh',
                    'Perbaikan link rusak & optimasi struktur meta SEO',
                    'Migrasi hosting server cepat & perpanjangan domain aman',
                    'Peningkatan keamanan SSL & proteksi spam formulir',
                    'Garansi performa loading lebih gesit',
                ],
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
