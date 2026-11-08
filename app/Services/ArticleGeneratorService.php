<?php

namespace App\Services;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ArticleGeneratorService
{
    /**
     * Curated category images pool (high-resolution WebP Unsplash images).
     */
    protected static array $categoryImages = [
        'Strategi Bisnis' => [
            'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1507679799987-c73779587ccf?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=1200&auto=format&fit=crop',
        ],
        'SEO & Trafik' => [
            'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1571721795195-a2ca2d3370a9?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1562577309-4932fdd64cd1?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1504868584819-f8e8b4b6d7e3?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1557804506-669a67965ba0?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?q=80&w=1200&auto=format&fit=crop',
        ],
        'Panduan Web' => [
            'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1522542550221-31fd19575a2d?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1487058792275-0ad4aaf24ca7?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1531403009284-440f080d1e12?q=80&w=1200&auto=format&fit=crop',
        ],
        'E-Commerce' => [
            'https://images.unsplash.com/photo-1556742049-0a67e557224f?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1513519245088-0e12902e5a38?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1472851294608-062f824d29cc?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1563013544-824ae1b704d3?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1479064555552-3ef4979f8908?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1556742502-ec7c0e9f34b1?q=80&w=1200&auto=format&fit=crop',
        ],
        'Teknologi & Fitur' => [
            'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1504639725590-34d0984388bd?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1510511459019-5dda7724fd87?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=1200&auto=format&fit=crop',
        ],
        'Edukasi & Sekolah' => [
            'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?q=80&w=1200&auto=format&fit=crop',
        ],
    ];

    /**
     * Permutational topic matrix with templates, variables, and body outlines.
     */
    protected static array $topics = [
        [
            'category' => 'Strategi Bisnis',
            'title_templates' => [
                '{num} Alasan Mengapa {target} di {location} Wajib Memiliki Website Resmi di 2026',
                'Strategi Digital {target}: Cara Meningkatkan Kepercayaan Klien Melalui Website di {location}',
                '{num} Kesalahan Fatal Pengelolaan Identitas Online {target} dan Solusinya',
                'Panduan Praktis Transformasi Digital untuk Pemilik {target} di Wilayah {location}',
                'Mengapa Media Sosial Saja Tidak Cukup untuk Menjamin Keberlangsungan {target}',
            ],
            'summaries' => [
                'Pelajari bagaimana kepemilikan website resmi dengan domain mandiri meningkatkan reputasi, mempermudah lolos tender kemitraan, dan melipatgandakan omzet {target} di {location}.',
                'Ulasan mendalam mengenai urgensi representasi digital permanen untuk {target} guna menarik calon pelanggan potensial tanpa ketergantungan pada perubahan algoritma sosial media.',
                'Kiat taktis membangun kredibilitas korporat, legalitas izin usaha, dan portofolio layanan terverifikasi untuk {target} di kawasan {location}.',
            ],
            'sections' => [
                [
                    'heading' => '1. Kredibilitas Instan di Mata Calon Mitra dan Investor',
                    'content' => 'Saat calon klien di {location} mencari mitra kerja sama atau vendor pengadaan, langkah pertama yang mereka lakukan adalah menelusuri nama perusahaan di internet. Website resmi dengan domain profesional (.co.id atau .com) menjadi bukti sahih bahwa bisnis Anda terdaftar secara legal, memiliki alamat kantor yang jelas, dan beroperasi dengan standar manajemen terpercaya.',
                ],
                [
                    'heading' => '2. Otomasi Penjualan Langsung ke WhatsApp Tim Sales',
                    'content' => 'Website modern dirancang sebagai tenaga pemasar 24 jam nonstop. Melalui struktur Call-to-Action (CTA) yang terarah, pengunjung yang tertarik dengan portofolio atau katalog dapat langsung diarahkan ke nomor WhatsApp resmi dengan template pesan terisi otomatis, menghemat waktu tim penjualan dari menjawab pertanyaan awal yang berulang.',
                ],
                [
                    'heading' => '3. Aset Digital Permanen Tanpa Terpengaruh Algoritma Sosial Media',
                    'content' => 'Banyak pelaku usaha mengeluhkan jangkauan organik akun media sosial yang terus anjlok. Website adalah aset digital milik Anda sendiri seutuhnya (owned media). Anda bebas mengontrol tata letak, konten portofolio, database kontak, serta tidak perlu khawatir terkena suspend atau perubahan kebijakan platform pihak ketiga.',
                ],
                [
                    'heading' => '4. Etalase Portofolio & Ulasan Pelanggan Terpusat',
                    'content' => 'Menampilkan foto-foto proyek sukses, testimoni bertanda tangan, serta sertifikasi keahlian dalam satu wadah yang rapi memberikan keyakinan penuh kepada calon pelanggan baru sebelum mereka menandatangani surat perjanjian kontrak.',
                ],
            ],
        ],
        [
            'category' => 'SEO & Trafik',
            'title_templates' => [
                '{num} Cara Jitu Mendominasi Halaman 1 Google untuk {target} di {location}',
                'Panduan SEO Lokal: Menjangkau Calon Klien Terdekat di {location} Tanpa Biaya Iklan',
                'Mengenal Schema.org LocalBusiness: Rahasia Ranking Tinggi di Pencarian Google {location}',
                'Mengapa Kecepatan Loading Website Berdampak Langsung pada Ranking SEO {target}',
                '{num} Langkah Optimasi Google Business Profile Terintegrasi Website untuk {target}',
            ],
            'summaries' => [
                'Strategi taktis optimasi mesin pencari lokal (Local SEO) agar website {target} Anda muncul di peringkat teratas saat calon pembeli di {location} mencari layanan terkait.',
                'Ketahui teknik integrasi kata kunci wilayah, data terstruktur schema JSON-LD, dan optimasi Core Web Vitals untuk meningkatkan trafik organik berkualitas tinggi.',
                'Panduan langkah demi langkah mendatangkan calon pelanggan lokal yang siap transaksi melalui penargetan kata kunci spesifik di {location}.',
            ],
            'sections' => [
                [
                    'heading' => '1. Riset Kata Kunci Lokal Berbasis Intent Transaksional',
                    'content' => 'Fokuskan kata kunci pada kombinasi layanan dan daerah, misalnya mencari "{target} terbaik di {location}" atau "biaya jasa pembuatan website {location}". Pengunjung yang mengetikkan kata kunci bernuansa lokasi memiliki tingkat konversi beli 3 kali lebih tinggi dibanding pencarian umum.',
                ],
                [
                    'heading' => '2. Penerapan Schema Markup LocalBusiness Terverifikasi',
                    'content' => 'Sertakan data terstruktur JSON-LD di tag head website yang memuat nama bisnis, koordinat latitude/longitude, jam buka, nomor telepon resmi, dan wilayah jangkauan layanan. Hal ini memudahkan Google memverifikasi eksistensi fisik bisnis Anda di peta lokal.',
                ],
                [
                    'heading' => '3. Sinkronisasi Data NAP (Name, Address, Phone) Secara Konsisten',
                    'content' => 'Pastikan penulisan Nama, Alamat, dan Nomor Telepon di website, Google Maps, dan direktori bisnis lokal sama persis tanpa perbedaan singkatan. Konsistensi data NAP adalah faktor penentu bobot otoritas di algoritma Google Maps Pack.',
                ],
                [
                    'heading' => '4. Optimasi Core Web Vitals untuk Perangkat Mobile',
                    'content' => 'Lebih dari 80 persen pencarian lokal dilakukan melalui ponsel pintar. Website yang lulus uji Core Web Vitals (LCP di bawah 2.5 detik, CLS 0, dan FID cepat) akan diprioritaskan Google di halaman pertama hasil pencarian seluler.',
                ],
            ],
        ],
        [
            'category' => 'E-Commerce',
            'title_templates' => [
                'Cara Membangun Toko Online Otomatis WhatsApp untuk Produk {product} di {location}',
                '{num} Keuntungan Toko Online Mandiri Dibanding Hanya Bergantung pada Marketplace',
                'Strategi Meningkatkan Penjualan {product} Hingga Luar {location} Melalui Katalog Web',
                'Panduan Integrasi Ongkir Kurir Otomatis dan Payment Gateway untuk UMKM {location}',
                '{num} Tips Desain Katalog Produk yang Memancing Pembeli Melakukan Checkout Kilat',
            ],
            'summaries' => [
                'Solusi efektif berjualan produk {product} secara mandiri tanpa potongan komisi marketplace, terintegrasi hitung ongkir otomatis, dan checkout mudah ke WhatsApp.',
                'Pelajari cara pelaku UMKM di {location} memperluas pasar nasional dengan platform e-commerce cepat, aman, dan mudah dikelola dari ponsel.',
                'Panduan lengkap membangun ekosistem toko daring untuk brand {product} dengan katalog terstruktur dan variasi produk interaktif.',
            ],
            'sections' => [
                [
                    'heading' => '1. Bebas Potongan Komisi dan Biaya Layanan Marketplace',
                    'content' => 'Berjualan di toko online sendiri berarti margin keuntungan 100 persen menjadi milik Anda. Anda tidak perlu memotong 5 hingga 10 persen pendapatan untuk biaya admin platform perantara.',
                ],
                [
                    'heading' => '2. Membangun Brand Equity dan Hubungan Langsung dengan Pelanggan',
                    'content' => 'Pelanggan yang berbelanja langsung di website Anda akan mengingat nama merek Anda, bukan nama aplikasi marketplace. Anda juga memiliki database nomor WhatsApp dan email pembeli untuk kebutuhan penawaran promo berkala (repeat order).',
                ],
                [
                    'heading' => '3. Kemudahan Checkout Terintegrasi Langsung ke WhatsApp',
                    'content' => 'Bagi pasar konsumen di Indonesia, khususnya di {location}, metode order via WhatsApp tetap menjadi favorit karena memberikan rasa aman dan sentuhan personal saat berkonsultasi mengenai varian warna, ukuran, atau stok ketersediaan.',
                ],
                [
                    'heading' => '4. Katalog Responsif dengan Galeri Foto Multi-Sudut',
                    'content' => 'Tampilkan foto detail produk beresolusi tinggi dalam format WebP ringan yang cepat dimuat bahkan pada sinyal seluler terbatas. Deskripsi spesifikasi yang transparan memangkas keraguan calon pembeli.',
                ],
            ],
        ],
        [
            'category' => 'Panduan Web',
            'title_templates' => [
                '{num} Komponen Biaya Pembuatan Website Profesional di {location} yang Perlu Anda Tahu',
                'Memilih Domain .id vs .com: Mana yang Lebih Menguntungkan untuk Usaha di {location}?',
                'Landing Page vs Multi-Page Company Profile: Panduan Memilih Sesuai Target Bisnis',
                '{num} Fitur Standar yang Wajib Dimiliki Website Modern Tahun 2026',
                'Cara Memilih Jasa Pembuatan Website Terpercaya di {location} Tanpa Takut Kecewa',
            ],
            'summaries' => [
                'Ketahui rincian biaya domain, server hosting SSD, desain antarmuka, hingga sertifikat keamanan SSL agar anggaran pembuatan website Anda efektif dan tepat sasaran.',
                'Panduan komprehensif bagi pemilik usaha di {location} dalam menentukan jenis arsitektur website yang paling sesuai dengan model bisnis yang dijalankan.',
                'Kiat memilih partner agensi web developer profesional dengan portofolio nyata dan jaminan garansi pemeliharaan pasca peluncuran.',
            ],
            'sections' => [
                [
                    'heading' => '1. Transparansi Kepemilikan Domain dan Server',
                    'content' => 'Pastikan domain resmi (.com, .id, atau .co.id) didaftarkan atas nama legalitas Anda sendiri. Hindari vendor yang menahan akses kepemilikan domain karena akan menyulitkan perpanjangan atau migrasi di kemudian hari.',
                ],
                [
                    'heading' => '2. Pemilihan Teknologi Stack Modern Berperforma Tinggi',
                    'content' => 'Website modern dibangun dengan arsitektur bersih seperti Laravel dan Vue.js yang menjamin kecepatan loading instan, keamanan tinggi dari serangan injeksi SQL, serta kemudahan penambahan fitur kustom di masa depan.',
                ],
                [
                    'heading' => '3. Desain Responsif Mobile-First',
                    'content' => 'Pastikan setiap elemen tata letak, tombol navigasi, dan ukuran teks nyaman disentuh menggunakan satu jempol pada layar smartphone. Layout yang rapi di ponsel menjamin pengalaman pengunjung yang menyenangkan.',
                ],
                [
                    'heading' => '4. Layanan Purna Jual dan Garansi Pemeliharaan',
                    'content' => 'Website adalah sistem yang terus berjalan. Memilih pengembang lokal di {location} yang siap memberikan dukungan teknis berkala, backup rutin, dan konsultasi lanjutan merupakan langkah pencegahan masalah jangka panjang.',
                ],
            ],
        ],
        [
            'category' => 'Edukasi & Sekolah',
            'title_templates' => [
                'Pentingnya Portal Web Resmi & Sistem PPDB Online bagi {institution} di {location}',
                '{num} Manfaat Website Sekolah Modern dalam Meningkatkan Minat Calon Siswa Baru',
                'Membangun Reputasi Unggul {institution} Melalui Publikasi Prestasi dan Agenda Digital',
                'Standar Keamanan Data Siswa dan Wali Murid pada Portal Akademik {institution}',
                'Cara Mengelola Pengumuman Kelulusan dan Berita Sekolah Secara Cepat di Web',
            ],
            'summaries' => [
                'Transformasi digital institusi pendidikan di {location}: Mempermudah pendaftaran peserta didik baru (PPDB), menyajikan transparansi kegiatan belajar, dan memperkuat citra kelembagaan.',
                'Ulasan peranan portal akademik sekolah terpadu dalam memfasilitasi komunikasi antara pengelola sekolah, dewan guru, siswa, dan wali murid.',
                'Panduan implementasi website resmi sekolah yang ramah pengguna, aman dari gangguan siber, dan berstandar kementerian pendidikan.',
            ],
            'sections' => [
                [
                    'heading' => '1. Efisiensi Pelaksanaan PPDB Online Tanpa Antrean Fisik',
                    'content' => 'Dengan sistem formulir pendaftaran digital, calon wali murid di {location} dapat mengunggah berkas administrasi seperti Kartu Keluarga, rapor, dan bukti pembayaran secara online dari rumah.',
                ],
                [
                    'heading' => '2. Portal Informasi Resmi Bebas Berita Hoaks',
                    'content' => 'Website sekolah berfungsi sebagai rujukan utama kabar resmi kegiatan belajar mengajar, jadwal ujian semester, libur akademik, serta pengumuman kelulusan terverifikasi.',
                ],
                [
                    'heading' => '3. Etalase Prestasi Guru, Siswa, dan Fasilitas Pembelajaran',
                    'content' => 'Mempublikasikan dokumentasi laboratorium modern, perpustakaan digital, serta piagam kejuaraan akademik maupun non-akademik memberikan kebanggaan bagi alumni dan meyakinkan calon siswa baru.',
                ],
                [
                    'heading' => '4. Perlindungan Data dan Privasi Informasi Siswa',
                    'content' => 'Portal pendidikan wajib dilengkapi sertifikat enkripsi SSL HTTPS dan proteksi hak akses berbasis peran (RBAC) agar data pribadi siswa terlindungi secara aman sesuai regulasi privasi.',
                ],
            ],
        ],
        [
            'category' => 'Teknologi & Fitur',
            'title_templates' => [
                '{num} Penyebab Website Lemot dan Cara Mempercepat Loading Hingga Nilai 95+ di PageSpeed',
                'Mengenal Single Page Application (SPA): Rahasia Navigasi Instan Tanpa Reload Layar',
                'Langkah Proteksi Website dari Serangan Brute Force, Spam, dan Malware Injeksi',
                'Mengapa Backup Otomatis Harian adalah Kewajiban Mutlak untuk Website {target}',
                'Penerapan Notifikasi Webhook Otomatis untuk Notifikasi Transaksi Usaha di {location}',
            ],
            'summaries' => [
                'Pelajari aspek teknis optimasi kompresi gambar WebP, caching server, arsitektur headless modern, dan proteksi firewall untuk menjaga website selalu cepat dan aman.',
                'Panduan teknis bagi pemilik usaha dan admin web dalam mempertahankan performa tinggi serta uptime 99.9% sepanjang tahun.',
                'Kiat mengamankan website dari potensi kerentanan keamanan siber dengan konfigurasi SSL, Content Security Policy, dan sanitasi input data.',
            ],
            'sections' => [
                [
                    'heading' => '1. Kompresi Gambar Modern Format WebP dan Lazy Loading',
                    'content' => 'Gambar berukuran besar adalah penyebab utama 70 persen website lambat dibuka. Menggunakan format gambar generasi terbaru WebP dapat memangkas ukuran berkas hingga 80 persen tanpa mengurangi kualitas visual.',
                ],
                [
                    'heading' => '2. Navigasi Secepat Kilat dengan Arsitektur Inertia & Vue.js',
                    'content' => 'Berbeda dengan website konvensional yang memuat ulang seluruh halaman dari awal setiap klik menu, teknologi modern hanya memperbarui bagian data yang berubah. Hasilnya, transisi antarhalaman terasa secepat aplikasi smartphone.',
                ],
                [
                    'heading' => '3. Proteksi Lapisan Ganda dengan SSL HTTPS dan Firewall',
                    'content' => 'Enkripsi data dua arah antara peramban pengunjung dan server mencegah pencurian data sensitif atau penyusupan skrip berbahaya (cross-site scripting) pada formulir kontak.',
                ],
                [
                    'heading' => '4. Rutinitas Backup Cloud Otomatis Tanpa Henti',
                    'content' => 'Menyimpan salinan berkas kode dan database secara berkala di penyimpanan cloud terpisah menjamin operasional bisnis Anda dapat dipulihkan dalam hitungan menit jika terjadi kendala pada pusat data utama.',
                ],
            ],
        ],
    ];

    /**
     * Variable replacement options.
     */
    protected static array $targets = [
        'Bisnis & Perusahaan',
        'Kontraktor & Konstruksi',
        'Klinik & Fasilitas Kesehatan',
        'Jasa Pengiriman & Logistik',
        'Restoran & Kuliner Khas',
        'Supplier Material Bangunan',
        'Jasa Konsultan & Legalitas',
        'Hotel & Biro Perjalanan Wisata',
        'Toko Grosir & Ritel Modern',
        'Studio Arsitek & Desain Interior',
    ];

    protected static array $locations = [
        'Lampung',
        'Bandar Lampung',
        'Metro Lampung',
        'Pringsewu',
        'Lampung Selatan',
        'Lampung Tengah',
        'Pesawaran',
        'Lampung Timur',
        'Tulang Bawang',
        'Lampung Barat',
    ];

    protected static array $products = [
        'Kopi Robusta & Keripik Pisang',
        'Kain Tapis & Kerajinan Khas',
        'Oleh-Oleh & Kuliner Nusantara',
        'Fashion & Busana Muslim',
        'Furnitur & Kerajinan Kayu',
        'Produk Herbal & Madu Alami',
        'Sparepart & Aksesoris Otomotif',
    ];

    protected static array $institutions = [
        'Sekolah Menengah Atas (SMA/SMK)',
        'Madrasah Aliyah & Tsanawiyah',
        'Pondok Pesantren Modern',
        'Lembaga Pelatihan Kerja (LPK)',
        'Yayasan Pendidikan Terpadu',
    ];

    protected static array $numbers = ['5', '6', '7', '8', '10'];

    /**
     * Generate bulk articles scheduled into the database.
     *
     * @param array $options
     * @return array Summary of generated articles count and schedule range
     */
    public static function generate(array $options = []): array
    {
        $count = max(1, min(1000, (int) ($options['count'] ?? 10)));
        $categoryFilter = $options['category'] ?? 'all';
        $frequency = $options['frequency'] ?? '1_daily';
        $startDateInput = $options['start_date'] ?? null;
        $author = ! empty($options['author']) ? trim($options['author']) : 'Tim Swift Code Lampung';

        $startDate = $startDateInput ? Carbon::parse($startDateInput)->startOfDay()->addHours(9) : Carbon::tomorrow()->addHours(9);

        // Filter topic pool if category selected
        $availableTopics = self::$topics;
        if ($categoryFilter !== 'all') {
            $matched = array_values(array_filter(self::$topics, fn ($t) => $t['category'] === $categoryFilter));
            if (! empty($matched)) {
                $availableTopics = $matched;
            }
        }

        $articlesBatch = [];
        $now = now();
        $targetCount = count(self::$targets);
        $locationCount = count(self::$locations);
        $productCount = count(self::$products);
        $institutionCount = count(self::$institutions);
        $numberCount = count(self::$numbers);
        $topicsCount = count($availableTopics);

        for ($i = 0; $i < $count; $i++) {
            $topic = $availableTopics[$i % $topicsCount];
            $category = $topic['category'];

            $target = self::$targets[($i * 3 + 1) % $targetCount];
            $location = self::$locations[($i * 2 + 3) % $locationCount];
            $product = self::$products[($i * 4 + 2) % $productCount];
            $institution = self::$institutions[($i * 5 + 1) % $institutionCount];
            $num = self::$numbers[$i % $numberCount];

            // Pick title template
            $titleTemplates = $topic['title_templates'];
            $rawTitle = $titleTemplates[($i + (int) ($i / $topicsCount)) % count($titleTemplates)];

            $title = str_replace(
                ['{num}', '{target}', '{location}', '{product}', '{institution}'],
                [$num, $target, $location, $product, $institution],
                $rawTitle
            );

            // Pick summary template
            $summaries = $topic['summaries'];
            $rawSummary = $summaries[($i + 1) % count($summaries)];
            $summary = str_replace(
                ['{num}', '{target}', '{location}', '{product}', '{institution}'],
                [$num, $target, $location, $product, $institution],
                $rawSummary
            );

            // Build rich content
            $content = self::buildContent($topic, $title, $summary, $target, $location, $product, $institution);

            // Word count and read time
            $wordCount = str_word_count(strip_tags($content));
            $readMinutes = max(3, (int) ceil($wordCount / 180));
            $readTime = "{$readMinutes} menit baca";

            // Pick image
            $imagePool = self::$categoryImages[$category] ?? self::$categoryImages['Strategi Bisnis'];
            $image = $imagePool[$i % count($imagePool)];

            // Unique slug with collision-safe randomized alphanumeric token
            $baseSlug = Str::slug($title);
            $hashToken = Str::lower(Str::random(6));
            $slug = "{$baseSlug}-{$hashToken}";

            // Calculate scheduled publishing timestamp
            $scheduledTime = self::calculatePublishTime($startDate, $i, $frequency);

            $articlesBatch[] = [
                'title' => $title,
                'slug' => $slug,
                'category' => $category,
                'summary' => Str::limit($summary, 490),
                'content' => $content,
                'author' => $author,
                'read_time' => $readTime,
                'image' => $image,
                'is_published' => true,
                'published_at' => $scheduledTime,
                'sort_order' => $i + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Insert in memory-safe database chunks
        $chunks = array_chunk($articlesBatch, 100);
        foreach ($chunks as $chunk) {
            Article::insert($chunk);
        }

        $firstArticle = reset($articlesBatch);
        $lastArticle = end($articlesBatch);

        return [
            'count' => $count,
            'first_date' => $firstArticle['published_at']->format('d M Y, H:i'),
            'last_date' => $lastArticle['published_at']->format('d M Y, H:i'),
        ];
    }

    /**
     * Calculate published_at timestamp based on scheduling frequency.
     */
    protected static function calculatePublishTime(Carbon $startDate, int $index, string $frequency): Carbon
    {
        $date = $startDate->copy();

        return match ($frequency) {
            'instant' => now()->addMinutes($index * 2),
            '2_daily' => $date->addDays((int) floor($index / 2))->setTime($index % 2 === 0 ? 9 : 16, 0, 0),
            'every_2_days' => $date->addDays($index * 2)->setTime(9, 0, 0),
            'every_3_days' => $date->addDays($index * 3)->setTime(9, 0, 0),
            'weekly' => $date->addWeeks($index)->setTime(9, 0, 0),
            default => $date->addDays($index)->setTime(9, 0, 0), // '1_daily'
        };
    }

    /**
     * Build full content with introduction, structured subsections, checklist, and CTA.
     */
    protected static function buildContent(
        array $topic,
        string $title,
        string $summary,
        string $target,
        string $location,
        string $product,
        string $institution
    ): string {
        $paragraphs = [];

        // Intro
        $paragraphs[] = "Di tengah akselerasi ekonomi digital tahun 2026, memiliki kehadiran online yang solid bukan lagi sekadar pilihan pelengkap, melainkan fondasi utama bagi kelangsungan {$target} di {$location}. {$summary}";
        $paragraphs[] = "Banyak pengusaha dan pengelola lembaga yang masih menganggap promosi di media sosial sudah cukup. Namun, fakta di lapangan menunjukkan bahwa calon konsumen maupun klien korporat dengan anggaran belanja besar selalu melakukan verifikasi kredibilitas melalui mesin pencari Google sebelum memutuskan transaksi.";

        // Subsections
        foreach ($topic['sections'] as $sec) {
            $subHeading = $sec['heading'];
            $subContent = str_replace(
                ['{target}', '{location}', '{product}', '{institution}'],
                [$target, $location, $product, $institution],
                $sec['content']
            );

            $paragraphs[] = "## {$subHeading}\n\n{$subContent}";
        }

        // Actionable Checklist
        $paragraphs[] = "## Rekomendasi Langkah Konkret untuk Pengelola {$target}\n\n" .
            "Agar implementasi website Anda di {$location} membuahkan hasil maksimal dan memberikan imbal hasil investasi (ROI) nyata, pastikan memperhatikan daftar periksa penting berikut:\n\n" .
            "- **Kecepatan Akses Mobile**: Pengunjung akan langsung menutup tab jika website memerlukan waktu lebih dari 3 detik untuk terbuka.\n" .
            "- **Copywriting Ramah Pelanggan**: Gunakan kalimat lugas yang langsung menjawab permasalahan dan kebutuhan utama calon pembeli.\n" .
            "- **Sertifikat Keamanan SSL**: Ikon gembok hijau pada browser meyakinkan pengunjung bahwa data kontak dan pesan mereka terenkripsi aman.\n" .
            "- **Optimasi Google Maps**: Hubungkan halaman kontak dengan titik lokasi kantor resmi di Google Profil Bisnis untuk memudahkan navigasi langsung.\n" .
            "- **Integrasi WhatsApp Interaktif**: Sediakan tombol pesanan cepat yang langsung tersambung ke customer service dengan template pesan siap kirim.";

        // Conclusion & Consultation Note
        $paragraphs[] = "## Kesimpulan\n\n" .
            "Transformasi digital bukan tentang teknologi yang rumit, melainkan tentang bagaimana mempermudah calon pelanggan menemukan, mempercayai, dan memesan layanan Anda dengan nyaman. Menunda kepemilikan website resmi hanya akan memberikan peluang emas bagi kompetitor Anda di {$location} untuk merebut pangsa pasar lebih dulu.\n\n" .
            "Ingin membangun website profesional dengan desain elegan, loading super cepat, dan siap mendominasi pencarian Google? Tim pengembang Swift Code Lampung siap membantu merancang solusi website terbaik yang disesuaikan dengan anggaran dan kebutuhan spesifik usaha Anda. Hubungi kami melalui WhatsApp resmi untuk konsultasi gratis hari ini.";

        return implode("\n\n", $paragraphs);
    }
}
