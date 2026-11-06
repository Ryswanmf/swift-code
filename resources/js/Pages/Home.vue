<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import PublicLayout from '../Layouts/PublicLayout.vue';
import Hero from '../Components/Public/Hero.vue';
import ServiceCard, { ServiceItem } from '../Components/Public/ServiceCard.vue';
import WhyUs from '../Components/Public/WhyUs.vue';
import ProjectCard, { ProjectItem } from '../Components/Public/ProjectCard.vue';
import PricingCard, { PackageItem } from '../Components/Public/PricingCard.vue';
import Workflow from '../Components/Public/Workflow.vue';
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
    settings?: Record<string, string>;
}>();

// Default Static Data (Used in Fase 1 and as fallback)
const defaultServices: ServiceItem[] = [
    {
        icon: '🚀',
        title: 'Landing Page Konversi Tinggi',
        description: 'Halaman promosi satu halaman yang dirancang khusus untuk memikat pembeli dan langsung mengarahkan ke nomor WhatsApp Anda.',
        badge: 'Favorit UMKM',
    },
    {
        icon: '🏢',
        title: 'Website Company Profile',
        description: 'Pamerkan portofolio, visi misi, legalitas, dan layanan perusahaan Anda dengan desain elegan dan profesional.',
        badge: 'Kredibilitas',
    },
    {
        icon: '🎓',
        title: 'Website Sekolah & Pesantren',
        description: 'Dilengkapi profil madrasah/sekolah, PPDB online, galeri kegiatan siswa, berita, dan integrasi pengumuman.',
        badge: 'Institusi',
    },
    {
        icon: '🛍️',
        title: 'Toko Online (E-Commerce)',
        description: 'Katalog produk modern, hitung ongkir otomatis, checkout via WhatsApp / payment gateway yang mudah dikelola.',
        badge: 'Penjualan',
    },
    {
        icon: '⚡',
        title: 'Sistem Informasi Kustom',
        description: 'Aplikasi berbasis web sesuai kebutuhan spesifik usaha: sistem absensi, inventaris kasir, booking antrean, dll.',
        badge: 'Custom',
    },
    {
        icon: '🛠️',
        title: 'Redesign & Optimasi SEO',
        description: 'Perbarui website lama Anda yang lambat atau rusak agar kembali modern, cepat diakses HP, dan naik ke halaman 1 Google.',
        badge: 'Performa',
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
        question: 'Berapa lama proses pengerjaan website?',
        answer: 'Untuk paket landing page berkisar 3-5 hari kerja. Website company profile atau sekolah membutuhkan 7-14 hari kerja tergantung kesiapan konten teks dan foto dari Anda.',
    },
    {
        question: 'Apakah saya bisa update teks dan foto sendiri setelah website jadi?',
        answer: 'Tentu saja! Kami menyediakan panel admin yang sangat mudah dipelajari bahkan bagi yang belum pernah menyentuh website sebelumnya. Kami juga menyediakan video panduan.',
    },
    {
        question: 'Apakah sudah termasuk domain dan hosting?',
        answer: 'Ya, seluruh paket pembuatan website di Swift Code Lampung sudah termasuk biaya domain dan hosting berkecepatan tinggi gratis selama 1 tahun pertama.',
    },
    {
        question: 'Bagaimana sistem pembayaran di Swift Code?',
        answer: 'Kami menerapkan sistem aman dengan DP (Down Payment) sebesar 50% di awal sebelum pengerjaan, dan sisa pelunasan 50% dibayarkan setelah website selesai diuji dan siap online.',
    },
    {
        question: 'Apakah website saya akan muncul di Google?',
        answer: 'Semua website kami dirancang ramah SEO dengan meta tags, sitemap otomatis, dan didaftarkan ke Google Search Console agar mudah diindeks oleh mesin pencari Google.',
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

// Structured Data Schema.org LocalBusiness
const localBusinessSchema = computed(() =>
    JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'ProfessionalService',
        name: props.settings?.site_name || 'Swift Code Lampung',
        description:
            props.settings?.meta_description ||
            'Jasa pembuatan website profesional, landing page, company profile, website sekolah, dan sistem kustom di Lampung.',
        telephone: props.settings?.whatsapp ? `+${props.settings.whatsapp}` : '+62895325852575',
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
        sameAs: [props.settings?.instagram || 'https://instagram.com/swiftcode.lpg'],
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
        <Hero />

        <!-- 2. Services Section -->
        <section id="layanan" class="py-20 lg:py-28 bg-white dark:bg-neutral-950 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                    <span class="text-xs sm:text-sm font-bold tracking-widest uppercase text-brand-600 dark:text-brand-400">
                        Solusi Digital Lengkap
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
                        Layanan Pembuatan Website <span class="text-brand-600">Sesuai Kebutuhan</span>
                    </h2>
                    <p class="text-base text-neutral-600 dark:text-neutral-400">
                        Pilih jenis website yang paling pas dengan industri dan skala bisnis Anda saat ini.
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

        <!-- 3. Why Choose Us Section -->
        <WhyUs />

        <!-- 4. Portfolio Section -->
        <section id="portofolio" class="py-20 lg:py-28 bg-white dark:bg-neutral-950 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-12 space-y-4">
                    <span class="text-xs sm:text-sm font-bold tracking-widest uppercase text-brand-600 dark:text-brand-400">
                        Karya & Bukti Nyata
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
                        Portofolio Proyek <span class="text-brand-600">Pilihan Kami</span>
                    </h2>
                    <p class="text-base text-neutral-600 dark:text-neutral-400">
                        Lihat bagaimana kami membantu brand lokal dan instansi tampil profesional di ranah online.
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
                                ? 'bg-brand-600 text-white shadow-md'
                                : 'bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-200 dark:hover:bg-neutral-700',
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
                                ? 'bg-brand-600 text-white shadow-md'
                                : 'bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-200 dark:hover:bg-neutral-700',
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
                                ? 'bg-brand-600 text-white shadow-md'
                                : 'bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-200 dark:hover:bg-neutral-700',
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
                                ? 'bg-brand-600 text-white shadow-md'
                                : 'bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-200 dark:hover:bg-neutral-700',
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
                                ? 'bg-brand-600 text-white shadow-md'
                                : 'bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-200 dark:hover:bg-neutral-700',
                        ]"
                    >
                        Sistem Custom
                    </button>
                </div>

                <!-- Projects Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                    <ProjectCard
                        v-for="project in filteredProjects"
                        :key="project.slug"
                        :project="project"
                    />
                </div>
            </div>
        </section>

        <!-- 5. Pricing Section -->
        <section id="harga" class="py-20 lg:py-28 bg-neutral-50/70 dark:bg-neutral-900/40 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                    <span class="text-xs sm:text-sm font-bold tracking-widest uppercase text-brand-600 dark:text-brand-400">
                        Harga Transparan & Masuk Akal
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
                        Paket Investasi <span class="text-brand-600">Pembuatan Website</span>
                    </h2>
                    <p class="text-base text-neutral-600 dark:text-neutral-400">
                        Tanpa biaya tersembunyi. Semua paket sudah termasuk domain, hosting, dan pendampingan penuh.
                    </p>
                </div>

                <!-- Pricing Cards Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                    <PricingCard
                        v-for="pkg in packagesList"
                        :key="pkg.name"
                        :pkg="pkg"
                    />
                </div>
            </div>
        </section>

        <!-- 6. Workflow Section -->
        <Workflow />

        <!-- 7. Testimonials Section -->
        <section class="py-20 lg:py-28 bg-neutral-50/70 dark:bg-neutral-900/40 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                    <span class="text-xs sm:text-sm font-bold tracking-widest uppercase text-brand-600 dark:text-brand-400">
                        Kata Mereka Tentang Kami
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
                        Testimoni <span class="text-brand-600">Klien Swift Code</span>
                    </h2>
                    <p class="text-base text-neutral-600 dark:text-neutral-400">
                        Kepuasan dan kesuksesan digital klien adalah prioritas utama kami.
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

        <!-- 8. FAQ Section -->
        <section id="faq" class="py-20 lg:py-28 bg-white dark:bg-neutral-950 relative">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="text-center mb-16 space-y-4">
                    <span class="text-xs sm:text-sm font-bold tracking-widest uppercase text-brand-600 dark:text-brand-400">
                        Pertanyaan Umum
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
                        Hal yang Sering Ditanyakan (FAQ)
                    </h2>
                    <p class="text-base text-neutral-600 dark:text-neutral-400">
                        Masih ragu atau punya pertanyaan lain? Temukan jawabannya di bawah ini.
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
        <ArticleSection />

        <!-- 10. Contact Form Section -->
        <ContactForm />
    </PublicLayout>
</template>
