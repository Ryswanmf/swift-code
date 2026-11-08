<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => '5 Alasan Bisnis di Lampung Wajib Punya Website Resmi di 2026',
                'slug' => 'alasan-bisnis-lampung-wajib-punya-website',
                'summary' => 'Meningkatkan kredibilitas saat negosiasi proyek atau tender, mudah ditemukan lewat Google Lampung, serta otomasi penjualan langsung ke WhatsApp.',
                'category' => 'Strategi Bisnis',
                'read_time' => '5 menit baca',
                'author' => 'Tim Swift Code',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=800&auto=format&fit=crop',
                'content' => "Di era serba digital tahun 2026, website bukan lagi sekadar pelengkap kartu nama, melainkan fondasi utama reputasi bisnis di Lampung.\n\nBerikut adalah 5 alasan utama mengapa bisnis Anda di Lampung wajib memiliki website resmi:\n\n1. Kredibilitas Instan Saat Mengikuti Tender & Kerjasama Kemitraan\nCalon mitra besar maupun instansi pemerintah di Lampung selalu memeriksa legalitas dan profil perusahaan secara online sebelum menjalin kontrak kerja sama. Website resmi dengan domain .co.id atau .com memberikan sinyal bahwa bisnis Anda beroperasi secara legal dan profesional.\n\n2. Ditemukan Pelanggan Lokal Lewat Google Search\nSetiap hari ribuan pencarian lokal diketik di Google, seperti 'supplier material Bandar Lampung' atau 'jasa katering terbaik Lampung'. Dengan website yang teroptimasi SEO, bisnis Anda dapat muncul di halaman 1 Google dan menjaring pelanggan baru tanpa perlu terus-menerus membayar biaya iklan.\n\n3. Otomasi Penjualan & Chat WhatsApp Terarah\nWebsite yang baik memandu calon pelanggan memahami produk dan layanan Anda secara menyeluruh, lalu mengarahkan mereka langsung ke nomor WhatsApp dengan template pesan otomatis. Ini menghemat waktu tim penjualan Anda dari menjawab pertanyaan berulang.\n\n4. Portofolio & Ulasan Pelanggan Terpusat\nInstagram dan media sosial lainnya seringkali menenggelamkan ulasan lama di antara tumpukan postingan baru. Website menyediakan etalase permanen untuk memamerkan proyek terbaik dan testimonial pelanggan yang meyakinkan.\n\n5. Bebas dari Ketergantungan Algoritma Media Sosial\nAlgoritma media sosial terus berubah dan jangkauan organik akun bisnis sering menurun. Website adalah aset digital milik Anda sendiri seutuhnya, di mana Anda memiliki kendali penuh atas tampilan, konten, dan data pengunjung.",
                'is_published' => true,
                'published_at' => now()->subDays(2),
                'sort_order' => 1,
            ],
            [
                'title' => 'Landing Page vs Company Profile: Mana yang Tepat untuk Usaha Anda?',
                'slug' => 'landing-page-vs-company-profile',
                'summary' => 'Ketahui perbedaan mendasar fokus konversi iklan satu produk dibanding profil kredibilitas institusi agar anggaran pembuatan website Anda efektif.',
                'category' => 'Panduan Web',
                'read_time' => '4 menit baca',
                'author' => 'Tim Swift Code',
                'image' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?q=80&w=800&auto=format&fit=crop',
                'content' => "Banyak pemilik usaha yang bingung saat pertama kali ingin memesan website: apakah harus membuat Landing Page atau Website Company Profile?\n\nKeduanya memiliki tujuan, struktur, dan hasil yang berbeda secara signifikan:\n\n1. Karakteristik Landing Page (Satu Halaman Fokus Konversi)\nLanding page dirancang untuk satu tujuan spesifik (Call to Action tunggal): misalnya mengumpulkan leads pendaftaran, menjual satu jenis produk unggulan, atau mendaftarkan peserta seminar. Tidak ada menu navigasi rumit yang mengalihkan perhatian pengunjung. Cocok dipadukan dengan iklan Google Ads, TikTok Ads, atau FB Ads.\n\n2. Karakteristik Company Profile (Multi-Halaman Kredibilitas)\nCompany profile terdiri dari beberapa halaman terstruktur: Beranda, Tentang Kami, Visi Misi, Layanan/Produk, Galeri Proyek, dan Kontak. Tujuannya adalah membangun reputasi korporat jangka panjang, menampilkan legalitas usaha, serta profil manajemen perusahaan.\n\nKesimpulan Rekomendasi:\nJika tujuan utama Anda adalah langsung menjual satu penawaran promosi kilat, pilihlah Landing Page. Namun jika Anda membutuhkan representasi resmi lembaga, perusahaan kontraktor, sekolah, atau klinik di Lampung, Company Profile adalah investasi yang tepat.",
                'is_published' => true,
                'published_at' => now()->subDays(4),
                'sort_order' => 2,
            ],
            [
                'title' => 'Cara Efektif Mendominasi Pencarian Google Lokal di Daerah Lampung',
                'slug' => 'cara-mendominasi-google-lokal-lampung',
                'summary' => 'Strategi SEO lokal, optimasi kata kunci jasa pembuatan website, integrasi Google Business Profile, dan kecepatan loading agar calon klien menemukan bisnis Anda.',
                'category' => 'SEO & Trafik',
                'read_time' => '6 menit baca',
                'author' => 'Tim Swift Code',
                'image' => 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?q=80&w=800&auto=format&fit=crop',
                'content' => "Memiliki website saja tidak cukup jika tidak ada yang menemukannya. Bagi pelaku usaha di Lampung, optimasi SEO Lokal (Local SEO) adalah senjata paling ampuh untuk mendominasi pasar.\n\nBerikut langkah taktis mendominasi pencarian Google Lokal:\n\n1. Targetkan Kata Kunci Berbasis Kota/Wilayah\nGunakan struktur judul halaman yang menyertakan lokasi strategis, misalnya 'Jasa Pembuatan Website Lampung' atau 'Sewa Mobil Bandar Lampung Murah'. Ini membantu Google mengaitkan website Anda dengan pengguna di lokasi geografis terkait.\n\n2. Terapkan Data Terstruktur Schema.org LocalBusiness\nSertakan markup schema JSON-LD di dalam kode website yang memuat alamat kantor, koordinat GPS (latitude & longitude), jam operasional, dan nomor kontak resmi. Mesin pencari Google akan menampilkan rich snippet bisnis Anda secara akurat.\n\n3. Sinkronkan dengan Google Profil Bisnis (Google Maps)\nPastikan Nama, Alamat, dan Nomor Telepon (NAP - Name, Address, Phone) di website sama persis dengan yang terdaftar di Google Maps. Cantumkan tautan peta dan ulasan bintang lima dari pelanggan setia.\n\n4. Pastikan Kecepatan Akses Mobile di Bawah 2 Detik\nSebagian besar pencarian lokal dilakukan melalui smartphone dengan koneksi seluler. Website yang lambat dibuka akan langsung ditinggalkan pengunjung dan dinilai buruk oleh algoritma Core Web Vitals Google.",
                'is_published' => true,
                'published_at' => now()->subDays(7),
                'sort_order' => 3,
            ],
            [
                'title' => 'Berapa Biaya Sebenarnya Pembuatan Website Profesional di Lampung?',
                'slug' => 'biaya-pembuatan-website-di-lampung',
                'summary' => 'Rincian transparan biaya domain, server hosting SSD, desain antarmuka, hingga sertifikat SSL agar Anda tidak terjebak biaya tersembunyi.',
                'category' => 'Biaya & Anggaran',
                'read_time' => '5 menit baca',
                'author' => 'Tim Swift Code',
                'image' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=800&auto=format&fit=crop',
                'content' => "Harga jasa pembuatan website di pasar seringkali bervariasi dari ratusan ribu hingga puluhan juta rupiah. Memahami komponen biayanya membantu Anda memilih penyedia jasa yang benar-benar berkualitas tanpa jebakan biaya tersembunyi.\n\nKomponen biaya utama yang wajar dalam proyek website profesional:\n\n1. Sewa Domain Resmi Tahunan (.com / .id / .sch.id)\nBiaya pendaftaran domain resmi berkisar Rp 150.000 - Rp 300.000 per tahun. Pastikan domain didaftarkan atas nama kepemilikan Anda sendiri, bukan ditahan oleh pihak agensi.\n\n2. Server Hosting SSD Cepat & Andal\nHosting gratisan atau murahan sering mengalami downtime saat diakses bersamaan. Server cloud SSD dengan uptime 99.9% dan sertifikat SSL aktif membutuhkan biaya sewa sekitar Rp 350.000 - Rp 700.000 per tahun.\n\n3. Desain UI/UX & Koding Antarmuka\nBiaya pengembangan profesional mencakup penyusunan tata letak yang ramah mobile, copywriting persuasif, integrasi tombol WhatsApp, panel admin untuk kelola artikel, dan pengujian bebas eror di semua jenis browser.\n\nDi Swift Code Lampung, paket siap pakai kami mulai dari Rp 950.000 untuk Landing Page dan Rp 2.450.000 untuk Company Profile lengkap tanpa ada biaya tersembunyi di kemudian hari.",
                'is_published' => true,
                'published_at' => now()->subDays(10),
                'sort_order' => 4,
            ],
            [
                'title' => 'Panduan Lengkap PPDB Online untuk Sekolah & Madrasah di Lampung',
                'slug' => 'panduan-ppdb-online-sekolah-madrasah',
                'summary' => 'Bagaimana madrasah dan pondok pesantren mengelola pendaftaran santri/siswa baru tanpa antrean panjang formulir kertas.',
                'category' => 'Institusi & Sekolah',
                'read_time' => '4 menit baca',
                'author' => 'Tim Swift Code',
                'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=800&auto=format&fit=crop',
                'content' => "Setiap musim tahun ajaran baru, panitia penerimaan santri atau peserta didik baru (PPDB) di madrasah dan sekolah swasta Lampung sering kewalahan menangani formulir kertas dan berkas fisik calon wali murid.\n\nTransformasi digital PPDB membawa banyak keuntungan praktis:\n\n1. Formulir Online yang Bisa Diisi dari Smartphone Wali Murid\nCalon orang tua siswa tidak perlu repot datang ke madrasah hanya untuk mengambil dan mengembalikan formulir fisik. Formulir online responsif memungkinkan pengisian biodata dan upload kartu keluarga kapan saja.\n\n2. Notifikasi WhatsApp Otomatis ke Nomor Orang Tua\nBegitu formulir berhasil dikirim, sistem dapat langsung mengirimkan bukti nomor pendaftaran dan panduan ujian seleksi ke nomor WhatsApp wali murid secara otomatis.\n\n3. Rekap Data Terpusat dan Siap Cetak Excel / PDF\nPanitia PPDB dapat memantau kuota pendaftar secara real-time, menyaring kelengkapan berkas, dan mengunduh laporan rekapitulasi data pendaftar hanya dalam sekali klik.\n\nSwift Code Lampung telah berpengalaman membangun portal akademik dan sistem PPDB untuk berbagai institusi pendidikan Islam dan swasta di Lampung.",
                'is_published' => true,
                'published_at' => now()->subDays(15),
                'sort_order' => 5,
            ],
            [
                'title' => 'Toko Online Berbasis WhatsApp: Solusi Praktis UMKM Kuliner & Kerajinan',
                'slug' => 'toko-online-whatsapp-umkm-lampung',
                'summary' => 'Mengapa pembeli Indonesia lebih suka checkout langsung ke WhatsApp dibanding keranjang rumit, dan bagaimana cara menerapkannya.',
                'category' => 'E-Commerce',
                'read_time' => '5 menit baca',
                'author' => 'Tim Swift Code',
                'image' => 'https://images.unsplash.com/photo-1556742049-0a67c5574f73?q=80&w=800&auto=format&fit=crop',
                'content' => "Bagi pelaku UMKM kuliner khas Lampung (seperti keripik pisang, kopi robusta, atau kain tapis), sistem e-commerce raksasa yang mewajibkan pembeli membuat akun dan password seringkali justru membatalkan niat belanja calon pembeli.\n\nFormat Toko Online Checkout WhatsApp menjadi solusi paling diminati karena:\n\n1. Alur Pemesanan Cepat Tanpa Ribet Registrasi Akun\nPengunjung cukup memilih varian produk, menentukan jumlah pesanan, mengisi alamat pengiriman singkat, lalu menekan tombol 'Pesan via WhatsApp'.\n\n2. Format Pesan WhatsApp Rapi & Terstruktur\nPesan yang masuk ke WhatsApp admin penjualan sudah otomatis memuat rincian nama produk, varian rasa/ukuran, total harga belanja, serta alamat tujuan lengkap. Admin tinggal mengonfirmasi nomor rekening pembayaran.\n\n3. Sentuhan Layanan Personal yang Membangun Kepercayaan\nMasyarakat Indonesia sangat menghargai keramahan interaksi langsung. Melalui WhatsApp, admin dapat merekomendasikan produk pelengkap (cross-selling) dan membina hubungan hangat dengan pelanggan setia.",
                'is_published' => true,
                'published_at' => now()->subDays(20),
                'sort_order' => 6,
            ],
            [
                'title' => 'Pentingnya Sertifikat SSL dan Backup Otomatis untuk Website Bisnis',
                'slug' => 'keamanan-website-ssl-dan-backup-otomatis',
                'summary' => 'Hindari peringatan bahaya di browser pengunjung dan amankan data pelanggan Anda dari potensi kehilangan data berharga.',
                'category' => 'Panduan Web',
                'read_time' => '4 menit baca',
                'author' => 'Tim Swift Code',
                'image' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=800&auto=format&fit=crop',
                'content' => "Keamanan website adalah aspek krusial yang sering diabaikan pemilik bisnis sampai masalah kebocoran data atau peretasan terjadi.\n\nSertifikat SSL (HTTPS) dan backup data rutin adalah dua lapisan proteksi fundamental:\n\n1. Ikon Gembok SSL Menjamin Kepercayaan Pelanggan\nGoogle Chrome dan browser modern lainnya menandai website tanpa SSL sebagai 'Not Secure'. Hal ini langsung menurunkan rasa percaya calon klien sebelum mereka membaca isi penawaran Anda.\n\n2. Perlindungan dari Kerusakan Data & Ransomware\nDengan sistem backup otomatis harian atau mingguan ke server cloud terpisah, Anda dapat memulihkan seluruh data dan tampilan website hanya dalam beberapa menit jika terjadi kesalahan teknis atau insiden peretasan.",
                'is_published' => true,
                'published_at' => now()->subDays(25),
                'sort_order' => 7,
            ],
            [
                'title' => 'Mengapa Kecepatan Website di Bawah 2 Detik Berdampak Langsung pada Penjualan',
                'slug' => 'kecepatan-website-meningkatkan-penjualan-online',
                'summary' => 'Riset membuktikan setiap detik keterlambatan loading memangkas konversi penjualan hingga 7%. Simak cara optimasi performanya.',
                'category' => 'Strategi Bisnis',
                'read_time' => '5 menit baca',
                'author' => 'Tim Swift Code',
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=800&auto=format&fit=crop',
                'content' => "Di era serba instan, pengguna smartphone tidak memiliki kesabaran untuk menunggu website yang memuat lebih dari 3 detik.\n\nFakta empiris seputar kecepatan akses website:\n\n1. Peningkatan Tingkat Konversi (Conversion Rate)\nWebsite yang responsif dan membuka halaman dalam 1 hingga 2 detik memiliki tingkat konversi penjualan hingga 3 kali lipat lebih tinggi dibandingkan website yang berat dan lambat.\n\n2. Nilai Prioritas di Algoritma Google Core Web Vitals\nGoogle secara resmi menjadikan kecepatan interaksi halaman (LCP, FID, CLS) sebagai faktor penentu peringkat halaman pertama. Website yang cepat otomatis mendapatkan peringkat pencarian yang lebih unggul.",
                'is_published' => true,
                'published_at' => now()->subDays(30),
                'sort_order' => 8,
            ],
        ];

        foreach ($articles as $item) {
            Article::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }
    }
}
