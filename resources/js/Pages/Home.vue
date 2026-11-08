<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import PublicLayout from '../Layouts/PublicLayout.vue';
import Hero from '../Components/Public/Hero.vue';
import PartnerMarquee from '../Components/Public/PartnerMarquee.vue';
import ServiceCard, { ServiceItem } from '../Components/Public/ServiceCard.vue';
import WhyUs from '../Components/Public/WhyUs.vue';
import ProjectCard, { ProjectItem } from '../Components/Public/ProjectCard.vue';
import PricingCard, { PackageItem } from '../Components/Public/PricingCard.vue';
import Testimonial, { TestimonialItem } from '../Components/Public/Testimonial.vue';
import FaqItem, { FaqData } from '../Components/Public/FaqItem.vue';
import ArticleSection from '../Components/Public/ArticleSection.vue';
import ContactForm from '../Components/Public/ContactForm.vue';

const props = defineProps<{
    services?: ServiceItem[];
    projects?: ProjectItem[];
    packages?: PackageItem[];
    testimonials?: TestimonialItem[];
    faqs?: FaqData[];
    partners?: any[];
    settings?: Record<string, string>;
}>();

// Default Static Data (Used in Fase 1 and as fallback)
const defaultServices: ServiceItem[] = [
    {
        icon: 'rocket',
        title: 'Landing Page Konversi Tinggi',
        badge: 'Favorit UMKM',
        timeline: '3 - 5 Hari Kerja',
        target: 'UMKM, Produk Tunggal & Promosi Iklan',
        description: 'Halaman promosi satu halaman yang dirancang terarah untuk memikat pembeli dan langsung mengarahkan transaksi ke nomor WhatsApp Anda.',
        features: [
            'Desain responsif mobile-first',
            'Integrasi tombol WhatsApp & formulir leads',
            'Gratis domain (.my.id/.com) & hosting SSD 1 tahun',
        ],
    },
    {
        icon: 'building',
        title: 'Website Company Profile',
        badge: 'Kredibilitas Bisnis',
        timeline: '5 - 10 Hari Kerja',
        target: 'PT, CV, Kantor Advokat, Klinik & Agensi',
        description: 'Pamerkan portofolio, visi misi, legalitas, dan layanan perusahaan Anda dengan desain elegan, cepat, dan profesional.',
        features: [
            'Hingga 5 - 7 halaman terstruktur rapi',
            'Email bisnis resmi (@namaperusahaan.com)',
            'Panel admin mandiri untuk update konten',
        ],
    },
    {
        icon: 'academic',
        title: 'Website Sekolah & Pesantren',
        badge: 'Institusi Pendidikan',
        timeline: '7 - 14 Hari Kerja',
        target: 'SD, SMP, SMA/SMK, Madrasah & Pondok Pesantren',
        description: 'Dilengkapi profil madrasah/sekolah, formulir PPDB online, galeri kegiatan siswa, portal pengumuman, dan berita sekolah.',
        features: [
            'Domain resmi (.sch.id / .ponpes.id)',
            'Modul informasi PPDB online mandiri',
            'Mudah dikelola staf tata usaha (TU)',
        ],
    },
    {
        icon: 'cart',
        title: 'Toko Online (E-Commerce)',
        badge: 'Penjualan Digital',
        timeline: '7 - 14 Hari Kerja',
        target: 'Toko Retail, Fashion & Oleh-Oleh Khas Lampung',
        description: 'Katalog produk modern, hitung ongkir otomatis, dan alur checkout mudah yang langsung tersambung ke WhatsApp atau payment gateway.',
        features: [
            'Katalog produk rapi & pencarian cepat',
            'Hitung estimasi ongkir otomatis se-Indonesia',
            'Manajemen stok dan varian barang',
        ],
    },
    {
        icon: 'code',
        title: 'Sistem Informasi Kustom',
        badge: 'Solusi Khusus',
        timeline: '14 - 30 Hari Kerja',
        target: 'Manajemen Bisnis, Gudang & Operasional Internal',
        description: 'Aplikasi berbasis web sesuai kebutuhan alur kerja unik usaha: sistem absensi, inventaris stok, kasir POS, hingga antrean booking.',
        features: [
            'Struktur database & logika kustom',
            'Multi-role hak akses (Admin, Kasir, Klien)',
            'Export laporan rekapitulasi data PDF / Excel',
        ],
    },
    {
        icon: 'tool',
        title: 'Redesign & Optimasi SEO',
        badge: 'Performa & Kecepatan',
        timeline: '3 - 7 Hari Kerja',
        target: 'Website Usang, Lambat atau Sulit Diakses HP',
        description: 'Perbarui website lama yang lambat atau rusak agar kembali modern, gesit di HP, dan bersaing di halaman pencarian Google.',
        features: [
            'Audit Core Web Vitals & percepatan loading',
            'Pembaruan tampilan UI/UX modern',
            'Perbaikan struktur meta SEO & sitemap',
        ],
    },
];

const defaultProjects: ProjectItem[] = [
    {
        id: 1,
        title: 'Company Profile CV Dinamika Konstruksi',
        slug: 'cv-dinamika-konstruksi',
        category: 'company',
        summary: 'Website resmi perusahaan konstruksi dan supplier material di Lampung dengan showcase proyek proyek besar.',
        client_name: 'CV Dinamika',
        live_url: 'https://dinamikakonstruksi.com',
        tech_stack: ['Laravel', 'Vue.js', 'Tailwind CSS'],
    },
    {
        id: 2,
        title: 'Portal Akademik MA Darun Najah',
        slug: 'ma-darun-najah',
        category: 'sekolah',
        summary: 'Sistem profil madrasah aliyah terintegrasi informasi pendaftaran santri baru dan portal berita sekolah.',
        client_name: 'Yayasan Darun Najah',
        live_url: 'https://madarunnajah.sch.id',
        tech_stack: ['Laravel', 'Inertia.js', 'MySQL'],
    },
    {
        id: 3,
        title: 'Katalog Souvenir Souvnela Lampung',
        slug: 'souvnela-lampung',
        category: 'toko',
        summary: 'Toko online kerajinan dan oleh-oleh khas Lampung dengan pemesanan langsung WhatsApp terstruktur.',
        client_name: 'Souvnela Craft',
        live_url: 'https://souvnela.id',
        tech_stack: ['Vue 3', 'Tailwind CSS', 'Vite'],
    },
    {
        id: 4,
        title: 'Sistem Manajemen Tour & Travel Nirwana',
        slug: 'nirwana-tour-travel',
        category: 'sistem',
        summary: 'Aplikasi reservasi paket wisata Lampung & Pulau Pahawang dengan manajemen jadwal dan kuota keberangkatan.',
        client_name: 'Nirwana Tour',
        live_url: 'https://nirwanatour.com',
        tech_stack: ['Laravel', 'Vue.js', 'MySQL'],
    },
    {
        id: 5,
        title: 'Website Profil Klinik Pratama Medika Bunda',
        slug: 'klinik-medika-bunda',
        category: 'company',
        summary: 'Website profil fasilitas kesehatan dengan jadwal dokter spesialis dan pendaftaran konsultasi online.',
        client_name: 'Klinik Pratama Medika Bunda',
        live_url: 'https://medikabunda.co.id',
        tech_stack: ['Laravel 12', 'Vue 3', 'Tailwind CSS'],
    },
    {
        id: 6,
        title: 'Sistem Penerimaan Santri Baru Pondok IT',
        slug: 'psb-pondok-it-lampung',
        category: 'sekolah',
        summary: 'Portal pendaftaran santri baru berbasis web dengan tes seleksi online dan verifikasi berkas digital.',
        client_name: 'Pondok IT Lampung',
        live_url: 'https://psb.pondokit.id',
        tech_stack: ['Vue 3', 'Inertia.js', 'MySQL'],
    },
    {
        id: 7,
        title: 'E-Commerce Kopi Robusta Lampung Craft',
        slug: 'kopi-robusta-lampung-craft',
        category: 'toko',
        summary: 'Platform pemesanan biji kopi sangrai premium dengan perhitungan ongkir otomatis ke seluruh Indonesia.',
        client_name: 'Lampung Coffee Roastery',
        live_url: 'https://lampungroastery.com',
        tech_stack: ['Laravel', 'Vue 3', 'Tailwind CSS'],
    },
    {
        id: 8,
        title: 'Sistem Logistik Distribusi Sinar Agro',
        slug: 'sistem-distribusi-sinar-agro',
        category: 'sistem',
        summary: 'Dashboard pemantauan armada angkutan hasil bumi Lampung dengan pelacakan status pengiriman real-time.',
        client_name: 'PT Sinar Agro Lampung',
        live_url: 'https://logistik.sinaragro.com',
        tech_stack: ['Laravel 12', 'Vue 3', 'PostgreSQL'],
    },
];

const defaultPackages: PackageItem[] = [
    {
        name: 'Paket Basic (Landing Page)',
        price: 950000,
        price_note: 'Mulai dari • Cocok untuk promosi produk & UMKM',
        features: [
            '1 Halaman Landing Page responsif',
            'Desain modern & mobile-first',
            'Tombol WhatsApp & formulir kontak',
            'Domain .my.id / .com gratis 1 tahun',
            'Hosting kilat SSD 1 tahun',
            'Sertifikat keamanan SSL aktif',
            'Pengerjaan 3 - 5 hari kerja',
        ],
        is_highlighted: false,
    },
    {
        name: 'Paket Business (Company Profile)',
        price: 2450000,
        price_note: 'Mulai dari • Paling diminati perusahaan & sekolah',
        features: [
            'Hingga 5-7 Halaman (Home, Profil, Layanan, Galeri, Kontak)',
            'Panel Admin kelola konten & artikel',
            'Optimasi SEO dasar Google Search',
            'Domain .com / .sch.id gratis 1 tahun',
            'Hosting cepat kapasitas tinggi 1 tahun',
            'Email bisnis profesional (nama@perusahaan.com)',
            'Pengerjaan 5 - 10 hari kerja',
            'Garansi support 6 bulan penuh',
        ],
        is_highlighted: true,
    },
    {
        name: 'Paket Custom / Sistem Web',
        price: null,
        price_note: 'Sesuai spesifikasi • Toko online & sistem khusus',
        features: [
            'Struktur database & fungsionalitas kustom',
            'Integrasi Payment Gateway / Ekspedisi Ongkir',
            'Hak akses multi-role (Admin, Kasir, Klien)',
            'Laporan data & export PDF/Excel',
            'Infrastruktur VPS / Server khusus',
            'Pelatihan langsung tim operasional',
            'Maintenance & pemeliharaan teratur',
        ],
        is_highlighted: false,
    },
];

const defaultTestimonials: TestimonialItem[] = [
    {
        name: 'Bambang Irawan',
        role: 'Direktur Operasional',
        company: 'CV Dinamika Konstruksi Lampung',
        quote: 'Setelah dibuatkan website oleh Swift Code, klien tender kami lebih percaya. Tampilannya rapi, cepat dibuka, dan pelayanannya sangat sabar membantu.',
        rating: 5,
    },
    {
        name: 'Ustadz Ahmad Fauzi',
        role: 'Kepala Madrasah',
        company: 'MA Darun Najah',
        quote: 'Pendaftaran PPDB tahun ini naik signifikan karena calon wali murid bisa lihat profil sekolah dan formulir langsung dari HP. Sangat direkomendasikan!',
        rating: 5,
    },
    {
        name: 'Dian Permatasari',
        role: 'Owner',
        company: 'Souvnela Craft Lampung',
        quote: 'Suka banget sama desainnya yang clean dan elegan. Sekarang kalau ada pembeli tanya katalog tinggal kasih link website. Pesanan masuk rapi ke WhatsApp.',
        rating: 5,
    },
];

const defaultFaqs: FaqData[] = [
    {
        question: 'Apakah biaya pembuatan sudah termasuk domain dan cloud hosting?',
        answer: 'Ya, seluruh paket pembuatan website di Swift Code sudah mencakup nama domain pilihan (.com, .my.id, atau .sch.id) serta cloud hosting SSD berkecepatan tinggi gratis selama 1 tahun pertama tanpa biaya tersembunyi.',
    },
    {
        question: 'Berapa lama estimasi proses pengerjaan website hingga online?',
        answer: 'Untuk paket Landing Page membutuhkan 3 - 5 hari kerja. Website Company Profile dan Sekolah rata-rata 5 - 10 hari kerja. Sementara sistem kustom atau toko online berkisar 14 - 30 hari kerja tergantung kompleksitas fitur dan kesiapan materi konten Anda.',
    },
    {
        question: 'Bagaimana sistem pembayaran di Swift Code Lampung?',
        answer: 'Kami menerapkan skema pembayaran transparan: uang muka (DP) 50% di awal saat kesepakatan proyek disetujui, dan sisa pelunasan 50% dibayarkan setelah seluruh proses uji fungsi selesai dan website siap dipublikasikan.',
    },
    {
        question: 'Apakah saya bisa mengelola teks, produk, dan foto sendiri?',
        answer: 'Tentu saja. Kami menyediakan panel admin (CMS) mandiri yang intuitif dan mudah dipelajari bahkan bagi pemula tanpa latar belakang pemrograman. Kami juga melampirkan video panduan singkat serta sesi konsultasi.',
    },
    {
        question: 'Apakah bisa konsultasi atau bertemu langsung (tatap muka) di Lampung?',
        answer: 'Sangat bisa. Untuk klien di area Bandar Lampung dan sekitarnya (seperti Natar, Gedong Tataan, Jati Agung), tim kami siap berdiskusi langsung ke kantor atau lokasi usaha Anda untuk membahas kebutuhan proyek.',
    },
    {
        question: 'Apakah website kami otomatis terdaftar dan bisa ditemukan di Google?',
        answer: 'Semua website kami dirancang ramah SEO dengan meta tags lengkap, sitemap otomatis, pengujian loading kilat, dan didaftarkan langsung ke Google Search Console agar halaman Anda dapat segera terindeks secara optimal.',
    },
];

// Active items (fallback to default if props empty)
const servicesList = computed(() => (props.services && props.services.length > 0 ? props.services : defaultServices));
const projectsList = computed(() => (props.projects && props.projects.length > 0 ? props.projects : defaultProjects));
const packagesList = computed(() => (props.packages && props.packages.length > 0 ? props.packages : defaultPackages));
const testimonialsList = computed(() => (props.testimonials && props.testimonials.length > 0 ? props.testimonials : defaultTestimonials));
const faqsList = computed(() => (props.faqs && props.faqs.length > 0 ? props.faqs : defaultFaqs));

// Category Filter state for projects
const activeCategory = ref('all');
const filteredProjects = computed(() => {
    if (activeCategory.value === 'all') return projectsList.value;
    return projectsList.value.filter((p) => p.category === activeCategory.value);
});
const displayedHomeProjects = computed(() => filteredProjects.value.slice(0, 6));
const hasMoreProjects = computed(() => filteredProjects.value.length > 6 || projectsList.value.length > 6);

// Global settings fallback from Inertia siteSettings
const page = usePage();
const activeSettings = computed<Record<string, string>>(() => ({
    ...props.settings,
    ...((page.props as any).siteSettings || {}),
}));

const cleanWaNumber = computed(() => {
    const raw = activeSettings.value.whatsapp || '62895325852575';
    return String(raw).replace(/[^0-9]/g, '');
});

const buildPackageWaUrl = (pkgName: string) => {
    const text = `Halo Swift Code Lampung, saya ingin berkonsultasi dan memesan *${pkgName}* untuk bisnis saya.`;
    return `https://wa.me/${cleanWaNumber.value}?text=${encodeURIComponent(text)}`;
};

// Structured Data Schema.org LocalBusiness
const localBusinessSchema = computed(() =>
    JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'ProfessionalService',
        name: activeSettings.value.site_name || 'Swift Code Lampung',
        description:
            activeSettings.value.meta_description ||
            'Jasa pembuatan website profesional, landing page, company profile, website sekolah, dan sistem kustom di Lampung.',
        telephone: activeSettings.value.whatsapp ? `+${cleanWaNumber.value}` : '+62895325852575',
        priceRange: 'Rp 950.000 - Rp 5.000.000+',
        address: {
            '@type': 'PostalAddress',
            streetAddress: 'Bandar Lampung',
            addressLocality: 'Bandar Lampung',
            addressRegion: 'Lampung',
            postalCode: '35141',
            addressCountry: 'ID',
        },
        geo: {
            '@type': 'GeoCoordinates',
            latitude: -5.39714,
            longitude: 105.266792,
        },
        openingHoursSpecification: {
            '@type': 'OpeningHoursSpecification',
            dayOfWeek: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            opens: '08:00',
            closes: '21:00',
        },
        sameAs: [activeSettings.value.instagram || 'https://instagram.com/swiftcode.lpg'],
    })
);
</script>

<template>
    <Head>
        <title>{{ settings?.meta_title || 'Jasa Pembuatan Website Profesional Lampung | Swift Code' }}</title>
        <meta
            name="description"
            :content="settings?.meta_description || 'Swift Code Lampung melayani jasa pembuatan website landing page, company profile, website sekolah, toko online, dan sistem custom yang cepat, elegan, dan terjangkau.'"
        />
        <link rel="canonical" href="/" />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:title" :content="settings?.meta_title || 'Jasa Pembuatan Website Profesional Lampung - Swift Code'" />
        <meta
            property="og:description"
            :content="settings?.meta_description || 'Bantu UMKM dan bisnis di Lampung go-digital dengan website modern berkecepatan tinggi dan siap menghasilkan calon klien.'"
        />
        <meta property="og:locale" content="id_ID" />
        <meta property="og:site_name" content="Swift Code Lampung" />

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" :content="settings?.meta_title || 'Jasa Pembuatan Website Profesional Lampung - Swift Code'" />
        <meta
            name="twitter:description"
            :content="settings?.meta_description || 'Bantu UMKM dan bisnis di Lampung go-digital dengan website modern berkecepatan tinggi.'"
        />

        <!-- Structured Data JSON-LD Schema.org -->
        <component :is="'script'" type="application/ld+json" v-html="localBusinessSchema" />
    </Head>

    <PublicLayout>
        <!-- 1. Hero Section -->
        <Hero :settings="settings" />

        <!-- Partner & Client Marquee Section -->
        <PartnerMarquee v-if="settings?.show_partner_marquee !== '0'" :partners="partners" />

        <!-- 2. Services Section -->
        <section v-if="settings?.show_services !== '0'" id="layanan" class="pt-12 sm:pt-16 pb-14 sm:pb-16 bg-white dark:bg-neutral-950 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center max-w-5xl mx-auto mb-12 space-y-3">
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-neutral-900 dark:text-white tracking-tight sm:whitespace-nowrap">
                        {{ settings?.section_services_title || 'Layanan Pembuatan Website Sesuai Kebutuhan' }}
                    </h2>
                    <p class="text-base text-neutral-600 dark:text-neutral-400 max-w-2xl mx-auto">
                        {{ settings?.section_services_desc || 'Pilih jenis website yang paling pas dengan industri dan skala bisnis Anda saat ini.' }}
                    </p>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <ServiceCard
                        v-for="srv in servicesList"
                        :key="srv.title"
                        :service="srv"
                    />
                </div>
            </div>
        </section>

        <!-- 3. Portfolio Section (Placed right after Services) -->
        <section v-if="settings?.show_portfolio !== '0'" id="portofolio" class="pt-12 sm:pt-16 pb-20 lg:pb-28 bg-gradient-to-r from-brand-800 via-brand-600 to-rose-600 text-white relative overflow-hidden shadow-inner">
            <!-- Background Ambient Accents -->
            <div class="pointer-events-none absolute -top-24 -left-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-24 -right-24 w-96 h-96 bg-black/20 rounded-full blur-3xl"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-12 space-y-3">
                    <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight drop-shadow-xs">
                        {{ settings?.section_portfolio_title || 'Portofolio Proyek Pilihan Kami' }}
                    </h2>
                    <p class="text-base text-white/90 leading-relaxed">
                        {{ settings?.section_portfolio_desc || 'Lihat bagaimana kami membantu brand lokal dan instansi tampil profesional di ranah online.' }}
                    </p>
                </div>

                <!-- Filter Tabs -->
                <div class="flex flex-wrap items-center justify-center gap-2 mb-12">
                    <button
                        type="button"
                        @click="activeCategory = 'all'"
                        :class="[
                            'px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all',
                            activeCategory === 'all'
                                ? 'bg-white text-brand-700 font-bold shadow-lg scale-102'
                                : 'bg-white/15 hover:bg-white/25 text-white border border-white/20 backdrop-blur-xs',
                        ]"
                    >
                        Semua Proyek
                    </button>
                    <button
                        type="button"
                        @click="activeCategory = 'company'"
                        :class="[
                            'px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all',
                            activeCategory === 'company'
                                ? 'bg-white text-brand-700 font-bold shadow-lg scale-102'
                                : 'bg-white/15 hover:bg-white/25 text-white border border-white/20 backdrop-blur-xs',
                        ]"
                    >
                        Company Profile
                    </button>
                    <button
                        type="button"
                        @click="activeCategory = 'sekolah'"
                        :class="[
                            'px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all',
                            activeCategory === 'sekolah'
                                ? 'bg-white text-brand-700 font-bold shadow-lg scale-102'
                                : 'bg-white/15 hover:bg-white/25 text-white border border-white/20 backdrop-blur-xs',
                        ]"
                    >
                        Sekolah / Lembaga
                    </button>
                    <button
                        type="button"
                        @click="activeCategory = 'toko'"
                        :class="[
                            'px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all',
                            activeCategory === 'toko'
                                ? 'bg-white text-brand-700 font-bold shadow-lg scale-102'
                                : 'bg-white/15 hover:bg-white/25 text-white border border-white/20 backdrop-blur-xs',
                        ]"
                    >
                        Toko Online
                    </button>
                    <button
                        type="button"
                        @click="activeCategory = 'sistem'"
                        :class="[
                            'px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all',
                            activeCategory === 'sistem'
                                ? 'bg-white text-brand-700 font-bold shadow-lg scale-102'
                                : 'bg-white/15 hover:bg-white/25 text-white border border-white/20 backdrop-blur-xs',
                        ]"
                    >
                        Sistem Custom
                    </button>
                </div>

                <!-- Projects Grid (3 Kolom per Baris) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    <ProjectCard
                        v-for="project in displayedHomeProjects"
                        :key="project.slug"
                        :project="project"
                    />
                </div>

                <!-- Tombol Lihat Portofolio Lainnya (Jika melebihi kuota 6) -->
                <div v-if="hasMoreProjects" class="mt-12 sm:mt-14 text-center">
                    <Link
                        href="/portofolio"
                        class="inline-flex items-center justify-center gap-2.5 px-8 py-3.5 rounded-xl text-sm font-bold text-brand-700 bg-white hover:bg-neutral-100 shadow-xl shadow-black/20 hover:shadow-black/30 transition-all duration-300 hover:scale-105 active:scale-95 group"
                    >
                        <span>Lihat Portofolio Lainnya</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </Link>
                </div>
            </div>
        </section>

        <!-- 4. Pricing Section (Placed right after Portfolio) -->
        <section v-if="settings?.show_pricing !== '0'" id="harga" class="pt-12 sm:pt-14 pb-12 sm:pb-16 bg-neutral-50/70 dark:bg-neutral-900/40 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-14 space-y-3">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
                        {{ settings?.section_pricing_title || 'Paket Investasi Pembuatan Website' }}
                    </h2>
                    <p class="text-base text-neutral-600 dark:text-neutral-400">
                        {{ settings?.section_pricing_desc || 'Tanpa biaya tersembunyi. Semua paket sudah termasuk domain, hosting, dan pendampingan penuh.' }}
                    </p>
                </div>

                <!-- Pricing Cards Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                    <PricingCard
                        v-for="pkg in packagesList"
                        :key="pkg.name"
                        :pkg="pkg"
                        :action-href="buildPackageWaUrl(pkg.name)"
                        action-text="Pesan Paket Ini via WhatsApp"
                        :is-external="true"
                    />
                </div>
            </div>
        </section>

        <!-- 5. Why Choose Us Section -->
        <WhyUs v-if="settings?.show_why_us !== '0'" :settings="settings" />

        <!-- 6. Testimonials Section -->
        <section v-if="settings?.show_testimonials !== '0'" id="testimoni" class="pt-12 sm:pt-14 pb-20 lg:pb-28 bg-gradient-to-r from-brand-800 via-brand-600 to-rose-600 text-white relative overflow-hidden shadow-inner">
            <!-- Background Ambient Accents -->
            <div class="pointer-events-none absolute -top-24 -right-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-24 -left-24 w-96 h-96 bg-black/20 rounded-full blur-3xl"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-14 space-y-3">
                    <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight drop-shadow-xs">
                        {{ settings?.section_testimonials_title || 'Testimoni Klien Swift Code' }}
                    </h2>
                    <p class="text-base text-white/90 leading-relaxed">
                        {{ settings?.section_testimonials_desc || 'Kepuasan dan kesuksesan digital klien adalah prioritas utama kami.' }}
                    </p>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <Testimonial
                        v-for="t in testimonialsList"
                        :key="t.name"
                        :testimonial="t"
                    />
                </div>
            </div>
        </section>

        <!-- 7. FAQ Section -->
        <section v-if="settings?.show_faq !== '0'" id="faq" class="pt-12 sm:pt-14 pb-20 lg:pb-28 bg-white dark:bg-neutral-950 relative">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="text-center mb-12 sm:mb-14 space-y-3">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
                        {{ settings?.section_faq_title || 'Hal yang Sering Ditanyakan (FAQ)' }}
                    </h2>
                    <p class="text-base text-neutral-600 dark:text-neutral-400">
                        {{ settings?.section_faq_desc || 'Masih ragu atau punya pertanyaan lain? Temukan jawabannya di bawah ini.' }}
                    </p>
                </div>

                <!-- Accordions -->
                <div class="space-y-4">
                    <FaqItem
                        v-for="(faq, fIdx) in faqsList"
                        :key="faq.question"
                        :faq="faq"
                        :isOpenDefault="fIdx === 0"
                    />
                </div>
            </div>
        </section>

        <!-- 9. Artikel & Wawasan Edukasi Section -->
        <ArticleSection v-if="settings?.show_articles !== '0'" />

        <!-- 10. Contact Form Section -->
        <ContactForm v-if="settings?.show_contact !== '0'" />
    </PublicLayout>
</template>
