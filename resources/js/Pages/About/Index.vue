<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import PublicLayout from '@/Layouts/PublicLayout.vue';

interface PartnerItem {
    id: number;
    name: string;
    category?: string;
    color?: string;
    icon?: string;
    logo_image?: string;
}

interface TestimonialItem {
    id: number;
    name: string;
    role?: string;
    company?: string;
    quote: string;
    avatar?: string;
    rating?: number;
}

interface ServiceItem {
    id: number;
    title: string;
    badge?: string;
    description: string;
    icon?: string;
}

interface Props {
    partners?: PartnerItem[];
    testimonials?: TestimonialItem[];
    services?: ServiceItem[];
    projectsCount?: number;
    settings?: Record<string, string>;
}

const props = withDefaults(defineProps<Props>(), {
    partners: () => [],
    testimonials: () => [],
    services: () => [],
    projectsCount: 0,
    settings: () => ({}),
});

const page = usePage();
const activeSettings = computed<Record<string, string>>(() => ({
    ...props.settings,
    ...((page.props as any).siteSettings || {}),
}));

const siteName = computed(() => activeSettings.value.site_name || 'Swift Code Lampung');
const whatsappNumber = computed(() => activeSettings.value.whatsapp || '62895325852575');
const emailAddress = computed(() => activeSettings.value.email || 'halo@swiftcode.id');
const officeAddress = computed(() => activeSettings.value.address || 'Bandar Lampung, Lampung, Indonesia');

const cleanWaNumber = computed(() => String(whatsappNumber.value).replace(/[^0-9]/g, ''));
const waConsultUrl = computed(() => {
    const text = `Halo ${siteName.value}, saya membaca halaman Tentang Kami dan ingin berkonsultasi mengenai rencana pembuatan website bisnis saya.`;
    return `https://wa.me/${cleanWaNumber.value}?text=${encodeURIComponent(text)}`;
});

const totalProjectsDisplay = computed(() => {
    const count = props.projectsCount || 0;
    return count > 50 ? `${count}+` : '50+';
});

const coreValues = [
    {
        title: 'Kecepatan Tanpa Kompromi',
        description: 'Kami merancang arsitektur website dengan standar loading di bawah 2 detik. Kecepatan adalah kunci utama untuk menurunkan bounce rate dan meningkatkan konversi penjualan.',
        icon: 'lightning',
    },
    {
        title: 'Kode Bersih & Terstruktur',
        description: 'Dibangun di atas fondasi Laravel 12 dan Vue 3 yang rapi, modular, dan mematuhi standar industri global. Sistem Anda siap dikembangkan lebih jauh kapan saja.',
        icon: 'code',
    },
    {
        title: 'Desain Human-Centric',
        description: 'Setiap tata letak dirancang ramah pengguna (user-friendly) di ponsel pintar. Tampilan elegan, tipografi nyaman dibaca, dan navigasi yang mengarahkan pengunjung ke aksi nyata.',
        icon: 'palette',
    },
    {
        title: 'Transparansi Biaya & Proses',
        description: 'Bebas dari biaya tersembunyi. Setiap rincian fitur, durasi pengerjaan, dan biaya investasi disampaikan terbuka sejak sesi konsultasi awal.',
        icon: 'shield-check',
    },
    {
        title: 'Keamanan Tingkat Enterprise',
        description: 'Dilengkapi proteksi SSL/HTTPS, proteksi form anti-spam, sanitasi input database, dan konfigurasi server yang kokoh guna melindungi integritas data bisnis Anda.',
        icon: 'lock',
    },
    {
        title: 'Dukungan & Garansi Purna Jual',
        description: 'Hubungan kerja kami tidak berhenti saat website diluncurkan. Kami menyediakan garansi pemeliharaan, panduan pengelolaan konten, dan jalur konsultasi teknis yang selalu responsif.',
        icon: 'lifebuoy',
    },
];

const workSteps = [
    {
        step: '01',
        title: 'Konsultasi & Pemetaan Kebutuhan',
        description: 'Kami mendengarkan target bisnis, menganalisis kompetitor, serta menyusun struktur menu dan estimasi anggaran yang paling tepat secara gratis.',
    },
    {
        step: '02',
        title: 'Perancangan Antarmuka (UI/UX)',
        description: 'Menyusun tata letak visual modern yang selaras dengan identitas brand Anda, memastikan alur konversi calon pembeli berjalan mulus.',
    },
    {
        step: '03',
        title: 'Pengembangan Kode & Integrasi',
        description: 'Menerapkan kode bersih berstandar tinggi, mengintegrasikan fitur WhatsApp otomatis, konfigurasi database, dan panel admin mandiri yang mudah digunakan.',
    },
    {
        step: '04',
        title: 'Uji Mutu, Pelatihan & Peluncuran',
        description: 'Pengujian kecepatan akses, uji kompatibilitas di berbagai perangkat ponsel, sesi panduan pengelolaan mandiri, dan penyerahan akun resmi.',
    },
];

const techStack = [
    { name: 'Laravel 12', role: 'Backend Framework Enterprise', badge: 'Keamanan & Keandalan' },
    { name: 'Vue.js 3', role: 'Frontend Modern Reaktif', badge: 'Interaksi Cepat' },
    { name: 'Inertia.js', role: 'Arsitektur Modern Monolith', badge: 'Tanpa Reload Kaku' },
    { name: 'Tailwind CSS', role: 'Styling Presisi & Responsif', badge: 'Ringan & Konsisten' },
    { name: 'TypeScript', role: 'Integritas Tipe Data', badge: 'Kode Bebas Bug' },
    { name: 'MySQL / Redis', role: 'Penyimpanan & Caching Performa', badge: 'Kecepatan Query' },
    { name: 'Vite', role: 'Next-Gen Frontend Tooling', badge: 'Kompilasi Kilat' },
    { name: 'Cloudflare & SSL', role: 'CDN & Proteksi Jaringan', badge: 'Aman 24/7' },
];
</script>

<template>
    <Head>
        <title>Tentang Kami - Agensi Pembuatan Website & Sistem Digital Lampung | Swift Code</title>
        <meta
            name="description"
            content="Mengenal Swift Code Lampung, agensi teknologi pengembang website modern, landing page, toko online, dan sistem digital dengan kecepatan loading tinggi dan kode bersih."
        />
        <meta property="og:title" content="Tentang Kami - Swift Code Lampung" />
        <meta
            property="og:description"
            content="Profil, visi, misi, dan nilai integritas Swift Code Lampung dalam menghadirkan solusi website profesional dan berkinerja tinggi bagi bisnis Anda."
        />
    </Head>

    <PublicLayout>
        <!-- 1. Header Banner Section (Signature Brand Red Gradient) -->
        <section class="relative pt-28 pb-14 sm:pt-32 sm:pb-18 bg-gradient-to-r from-brand-800 via-brand-600 to-rose-600 text-white overflow-hidden shadow-inner">
            <!-- Subtle background ambient pattern -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none"></div>

            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
                <!-- Breadcrumbs -->
                <div class="flex items-center justify-center">
                    <nav class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 border border-white/20 text-xs font-medium text-white/90 backdrop-blur-xs">
                        <Link href="/" class="hover:text-white transition-colors">Beranda</Link>
                        <span>/</span>
                        <span class="text-white font-bold">Tentang Kami</span>
                    </nav>
                </div>

                <!-- Badge -->
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/20 border border-white/20 text-xs font-semibold tracking-wide uppercase text-white/95">
                    <span>Profil & Filosofi Agensi</span>
                </div>

                <!-- Heading -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight max-w-4xl mx-auto">
                    Membangun Solusi Web Berperforma Tinggi & Berkelas untuk Pertumbuhan Bisnis Nyata
                </h1>

                <!-- Subheading -->
                <p class="text-base sm:text-lg text-white/90 max-w-2xl mx-auto font-normal leading-relaxed">
                    Kami memadukan arsitektur kode modern kelas dunia dengan desain antarmuka yang elegan untuk membantu UMKM, institusi pendidikan, dan korporat melesat di era digital.
                </p>
            </div>
        </section>

        <!-- 2. Quick Highlight Metrics Section -->
        <section class="relative -mt-8 z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 bg-white rounded-2xl shadow-xl shadow-neutral-900/5 border border-neutral-200/80 p-6 sm:p-8">
                <div class="text-center space-y-1 sm:border-r border-neutral-100 last:border-r-0">
                    <p class="text-3xl sm:text-4xl font-extrabold text-brand-600 tracking-tight font-mono">{{ totalProjectsDisplay }}</p>
                    <p class="text-xs sm:text-sm font-semibold text-neutral-800">Proyek Terselesaikan</p>
                    <p class="text-[11px] text-neutral-500 hidden sm:block">UMKM, Sekolah, & Perusahaan</p>
                </div>
                <div class="text-center space-y-1 sm:border-r border-neutral-100 last:border-r-0">
                    <p class="text-3xl sm:text-4xl font-extrabold text-neutral-900 tracking-tight font-mono">99.8%</p>
                    <p class="text-xs sm:text-sm font-semibold text-neutral-800">Tingkat Kepuasan</p>
                    <p class="text-[11px] text-neutral-500 hidden sm:block">Ulasan Klien Positif</p>
                </div>
                <div class="text-center space-y-1 sm:border-r border-neutral-100 last:border-r-0">
                    <p class="text-3xl sm:text-4xl font-extrabold text-neutral-900 tracking-tight font-mono">5+ Thn</p>
                    <p class="text-xs sm:text-sm font-semibold text-neutral-800">Pengalaman Industri</p>
                    <p class="text-[11px] text-neutral-500 hidden sm:block">Pengembangan Perangkat Lunak</p>
                </div>
                <div class="text-center space-y-1">
                    <p class="text-3xl sm:text-4xl font-extrabold text-emerald-600 tracking-tight font-mono">&lt; 1 Detik</p>
                    <p class="text-xs sm:text-sm font-semibold text-neutral-800">Rata-rata Loading</p>
                    <p class="text-[11px] text-neutral-500 hidden sm:block">Optimasi Skor PageSpeed</p>
                </div>
            </div>
        </section>

        <!-- 3. The Story Behind Swift Code -->
        <section class="py-16 sm:py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                    <!-- Left: Meaning & Card Showcase -->
                    <div class="lg:col-span-5 space-y-6">
                        <div class="bg-gradient-to-br from-neutral-950 via-neutral-900 to-neutral-900 text-white rounded-3xl p-8 shadow-2xl border border-neutral-800 relative overflow-hidden">
                            <div class="absolute -right-12 -top-12 w-48 h-48 bg-brand-600/20 rounded-full blur-3xl pointer-events-none"></div>

                            <div class="space-y-6 relative z-10">
                                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-500/10 border border-brand-500/20 text-brand-400 text-xs font-semibold">
                                    <span>Arti Nama & Identitas</span>
                                </div>

                                <h2 class="text-2xl font-bold tracking-tight">
                                    Mengapa Kami Bernama <span class="text-brand-500">Swift Code</span>?
                                </h2>

                                <div class="space-y-4 pt-2">
                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-brand-500/20 text-brand-400 flex items-center justify-center shrink-0 font-bold font-mono text-sm border border-brand-500/30">
                                            01
                                        </div>
                                        <div>
                                            <h3 class="text-base font-semibold text-white">Swift (Cepat & Gesit)</h3>
                                            <p class="text-xs sm:text-sm text-neutral-300 mt-1 leading-relaxed">
                                                Mencerminkan kecepatan pemuatan halaman website di bawah 2 detik serta proses pengerjaan proyek yang gesit, terukur, dan tepat waktu.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center shrink-0 font-bold font-mono text-sm border border-rose-500/30">
                                            02
                                        </div>
                                        <div>
                                            <h3 class="text-base font-semibold text-white">Code (Kode Berkualitas)</h3>
                                            <p class="text-xs sm:text-sm text-neutral-300 mt-1 leading-relaxed">
                                                Mencerminkan pondasi rekayasa perangkat lunak yang bersih, berstruktur rapi, minim beban dependensi, dan mudah dirawat untuk jangka panjang.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-4 border-t border-neutral-800 flex items-center justify-between text-xs text-neutral-400">
                                    <span>Berpusat di Bandar Lampung</span>
                                    <span class="text-brand-400 font-semibold font-mono">Standar Kode Nasional</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Narrative & Philosophy -->
                    <div class="lg:col-span-7 space-y-6">
                        <div class="space-y-2">
                            <span class="text-xs font-bold text-brand-600 tracking-wider uppercase">Latar Belakang & Kisah Kami</span>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight leading-tight">
                                Membawa Standar Teknologi Kelas Dunia ke Ranah Bisnis Lokal
                            </h2>
                        </div>

                        <p class="text-neutral-600 text-sm sm:text-base leading-relaxed">
                            Swift Code bermula dari kepedulian terhadap banyaknya pelaku usaha, lembaga pendidikan, dan instansi di Lampung yang kesulitan menjangkau pasar lebih luas akibat website yang lambat, berantakan di layar ponsel, atau sulit diperbarui kontennya.
                        </p>

                        <p class="text-neutral-600 text-sm sm:text-base leading-relaxed">
                            Kami percaya bahwa memiliki website profesional tidak harus rumit, berbelit-belit, atau membebani anggaran usaha. Dengan memadukan teknologi modern seperti framework Laravel, Vue.js, dan optimasi performa server, kami mewujudkan sistem digital yang tangguh sekaligus ramah bagi pengguna awam.
                        </p>

                        <div class="pt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="p-4 rounded-xl bg-neutral-50 border border-neutral-200/80 space-y-1">
                                <h3 class="text-sm font-bold text-neutral-900">Bukan Sekadar Desain</h3>
                                <p class="text-xs text-neutral-600 leading-relaxed">
                                    Kami mendesain dengan pola pikir konversi penjualan: tombol kontak yang jelas, alur membaca yang terarah, dan kecepatan buka kilat.
                                </p>
                            </div>
                            <div class="p-4 rounded-xl bg-neutral-50 border border-neutral-200/80 space-y-1">
                                <h3 class="text-sm font-bold text-neutral-900">Mandiri Tanpa Ketergantungan</h3>
                                <p class="text-xs text-neutral-600 leading-relaxed">
                                    Setiap klien dibekali panel admin mandiri dan kepemilikan penuh atas domain dan data bisnis tanpa biaya sewa tersembunyi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Vision & Mission Section -->
        <section class="py-16 sm:py-20 bg-neutral-50 border-y border-neutral-200/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                <div class="text-center max-w-2xl mx-auto space-y-2">
                    <span class="text-xs font-bold text-brand-600 tracking-wider uppercase">Pijakan Arah</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">
                        Visi & Misi Swift Code
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-600">
                        Prinsip utama yang memandu setiap baris kode dan keputusan desain yang kami buat.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Vision Card -->
                    <div class="bg-white rounded-2xl p-8 border border-neutral-200/90 shadow-sm space-y-5 flex flex-col justify-between">
                        <div class="space-y-4">
                            <div class="w-12 h-12 rounded-xl bg-brand-50 border border-brand-100 text-brand-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>

                            <h3 class="text-xl font-bold text-neutral-900">Visi Kami</h3>

                            <p class="text-sm sm:text-base text-neutral-600 leading-relaxed">
                                Menjadi agensi solusi digital dan pengembangan website terdepan di Indonesia yang dipercaya karena kecepatan eksekusi, estetika elegan, dan kehandalan teknis, serta memberdayakan bisnis lokal untuk bersaing secara tangguh di pasar nasional maupun global.
                            </p>
                        </div>

                        <div class="pt-4 border-t border-neutral-100 flex items-center gap-2 text-xs font-semibold text-brand-600">
                            <span>Fokus Hasil & Pertumbuhan Nyata</span>
                        </div>
                    </div>

                    <!-- Mission Card -->
                    <div class="bg-white rounded-2xl p-8 border border-neutral-200/90 shadow-sm space-y-5 flex flex-col justify-between">
                        <div class="space-y-4">
                            <div class="w-12 h-12 rounded-xl bg-rose-50 border border-rose-100 text-rose-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>

                            <h3 class="text-xl font-bold text-neutral-900">Misi Kami</h3>

                            <ul class="space-y-3 text-xs sm:text-sm text-neutral-600">
                                <li class="flex items-start gap-2.5">
                                    <span class="w-5 h-5 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 font-bold text-[11px] mt-0.5">1</span>
                                    <span>Menghadirkan website cepat, aman, dan mobile-first dengan standar arsitektur perangkat lunak modern.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="w-5 h-5 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 font-bold text-[11px] mt-0.5">2</span>
                                    <span>Memberikan transparansi estimasi biaya dan edukasi digital yang jujur tanpa istilah teknis yang membingungkan.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="w-5 h-5 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 font-bold text-[11px] mt-0.5">3</span>
                                    <span>Mendampingi perjalanan digital klien melalui layanan purna jual dan dukungan teknis yang tulus dan berkelanjutan.</span>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-4 border-t border-neutral-100 flex items-center gap-2 text-xs font-semibold text-rose-600">
                            <span>Komitmen Kualitas Tanpa Kompromi</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. Core Values Section -->
        <section class="py-16 sm:py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                <div class="text-center max-w-2xl mx-auto space-y-2">
                    <span class="text-xs font-bold text-brand-600 tracking-wider uppercase">Nilai Integritas</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">
                        Prinsip yang Selalu Kami Pegang Teguh
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-600">
                        Standar etika dan kualitas kerja di balik setiap proyek yang kami tangani.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div
                        v-for="(val, idx) in coreValues"
                        :key="idx"
                        class="p-6 rounded-2xl bg-neutral-50 hover:bg-white border border-neutral-200/80 hover:border-brand-200 hover:shadow-lg hover:shadow-brand-600/5 transition-all duration-300 space-y-3"
                    >
                        <div class="w-10 h-10 rounded-xl bg-brand-100 text-brand-700 flex items-center justify-center font-bold text-sm">
                            0{{ idx + 1 }}
                        </div>
                        <h3 class="text-base font-bold text-neutral-900">{{ val.title }}</h3>
                        <p class="text-xs sm:text-sm text-neutral-600 leading-relaxed">{{ val.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. Modern Tech Stack Ecosystem -->
        <section class="py-16 sm:py-20 bg-neutral-900 text-white relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 relative z-10">
                <div class="text-center max-w-2xl mx-auto space-y-2">
                    <span class="text-xs font-bold text-brand-400 tracking-wider uppercase">Arsitektur & Alat Bantu</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                        Ekosistem Teknologi Terkini yang Kami Gunakan
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-400">
                        Kami memilih teknologi yang telah teruji kestabilannya di level industri untuk memastikan website Anda cepat, tangguh, dan aman.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                    <div
                        v-for="(tech, idx) in techStack"
                        :key="idx"
                        class="p-5 rounded-2xl bg-neutral-950/80 border border-neutral-800 hover:border-neutral-700 transition-colors space-y-2"
                    >
                        <div class="flex items-center justify-between">
                            <span class="text-base font-bold text-white font-mono">{{ tech.name }}</span>
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-brand-500/20 text-brand-300 border border-brand-500/30">
                                {{ tech.badge }}
                            </span>
                        </div>
                        <p class="text-xs text-neutral-400 leading-relaxed">{{ tech.role }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 7. Our 4-Step Collaborative Workflow -->
        <section class="py-16 sm:py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                <div class="text-center max-w-2xl mx-auto space-y-2">
                    <span class="text-xs font-bold text-brand-600 tracking-wider uppercase">Metodologi Kerja</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">
                        Alur Transparan dari Ide Hingga Website Siap Online
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-600">
                        Proses terstruktur yang kami jalankan bersama setiap klien untuk memastikan hasil yang memuaskan dan tepat jadwal.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div
                        v-for="(step, idx) in workSteps"
                        :key="idx"
                        class="relative p-6 rounded-2xl bg-neutral-50 border border-neutral-200/80 space-y-3"
                    >
                        <div class="text-3xl font-extrabold text-brand-600 font-mono tracking-tight">{{ step.step }}</div>
                        <h3 class="text-base font-bold text-neutral-900">{{ step.title }}</h3>
                        <p class="text-xs sm:text-sm text-neutral-600 leading-relaxed">{{ step.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 8. Testimonials Highlight (If Any) -->
        <section v-if="testimonials && testimonials.length > 0" class="py-16 sm:py-20 bg-neutral-50 border-t border-neutral-200/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
                <div class="text-center max-w-2xl mx-auto space-y-2">
                    <span class="text-xs font-bold text-brand-600 tracking-wider uppercase">Kepercayaan Nyata</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">
                        Apa Kata Klien Tentang Swift Code
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div
                        v-for="t in testimonials"
                        :key="t.id"
                        class="bg-white p-6 rounded-2xl border border-neutral-200/80 shadow-xs space-y-4 flex flex-col justify-between"
                    >
                        <p class="text-xs sm:text-sm text-neutral-700 leading-relaxed italic">
                            "{{ t.quote }}"
                        </p>
                        <div class="flex items-center gap-3 pt-3 border-t border-neutral-100">
                            <img
                                v-if="t.avatar"
                                :src="t.avatar"
                                :alt="t.name"
                                class="w-10 h-10 rounded-full object-cover border border-neutral-200"
                                loading="lazy"
                                decoding="async"
                            />
                            <div v-else class="w-10 h-10 rounded-full bg-brand-100 text-brand-700 font-bold flex items-center justify-center text-xs">
                                {{ t.name.charAt(0) }}
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-neutral-900">{{ t.name }}</h4>
                                <p class="text-[11px] text-neutral-500">{{ t.role }} {{ t.company ? `• ${t.company}` : '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 9. Partner / Client Marquee Showcase (If Any) -->
        <section v-if="partners && partners.length > 0" class="py-12 bg-white border-t border-neutral-200/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
                <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">
                    Mitra & Klien yang Mempercayakan Solusi Web Bersama Kami
                </p>
                <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10">
                    <div
                        v-for="partner in partners"
                        :key="partner.id"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl bg-neutral-50 border border-neutral-200/60 text-neutral-700 text-xs sm:text-sm font-medium"
                    >
                        <img
                            v-if="partner.logo_image"
                            :src="partner.logo_image"
                            :alt="partner.name"
                            class="h-6 w-auto object-contain"
                            loading="lazy"
                            decoding="async"
                        />
                        <span>{{ partner.name }}</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- 10. Call To Action (CTA) Section -->
        <section class="py-16 sm:py-24 bg-gradient-to-r from-brand-900 via-brand-700 to-rose-700 text-white text-center relative overflow-hidden">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 relative z-10">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 border border-white/20 text-xs font-semibold tracking-wide uppercase text-white">
                    <span>Mulai Diskusi Tanpa Komitmen</span>
                </span>

                <h2 class="text-2xl sm:text-4xl font-extrabold tracking-tight leading-tight">
                    Siap Membangun Website Impian Bisnis Anda Bersama Tim Swift Code?
                </h2>

                <p class="text-sm sm:text-base text-white/90 max-w-2xl mx-auto leading-relaxed">
                    Konsultasikan kebutuhan Anda sekarang. Tim kami siap memberikan gambaran struktur website, estimasi biaya transparan, serta solusi terbaik secara gratis.
                </p>

                <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4">
                    <a
                        :href="waConsultUrl"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white text-brand-700 hover:bg-neutral-100 font-bold text-sm shadow-xl transition-all duration-200 hover:-translate-y-0.5"
                    >
                        <svg class="w-4 h-4 fill-current text-emerald-600" viewBox="0 0 24 24">
                            <path d="M12.031 2C6.495 2 2 6.494 2 12.031c0 1.84.498 3.567 1.365 5.064L2 22l5.053-1.326a9.98 9.98 0 004.978 1.357h.005c5.534 0 10.029-4.494 10.029-10.031A10.015 10.015 0 0012.031 2zm0 18.232c-1.57 0-3.102-.42-4.437-1.213l-.318-.189-3.298.865.881-3.214-.207-.33a8.212 8.212 0 01-1.258-4.321c0-4.542 3.696-8.237 8.243-8.237 2.203 0 4.273.858 5.829 2.416a8.196 8.196 0 012.412 5.825c0 4.544-3.696 8.239-8.245 8.239zm4.518-6.177c-.248-.124-1.465-.723-1.692-.806-.228-.083-.394-.124-.56.124-.166.248-.642.806-.787.972-.145.166-.29.186-.538.062-.248-.124-1.047-.386-1.995-1.231-.738-.658-1.236-1.472-1.381-1.72-.145-.248-.016-.382.108-.506.112-.111.248-.29.373-.435.124-.145.166-.248.248-.415.083-.166.042-.311-.021-.435-.062-.124-.56-1.35-.767-1.849-.202-.486-.407-.42-.56-.428l-.477-.008c-.166 0-.435.062-.663.311-.228.248-.871.851-.871 2.075s.892 2.406 1.016 2.572c.124.166 1.755 2.68 4.252 3.758.594.257 1.058.41 1.42.525.597.19 1.14.163 1.57.099.479-.071 1.465-.6 1.672-1.179.207-.58.207-1.077.145-1.179-.062-.102-.228-.166-.476-.29z"/>
                        </svg>
                        <span>Konsultasi Gratis via WhatsApp</span>
                    </a>

                    <Link
                        href="/portofolio"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/25 text-white font-semibold text-sm transition-all duration-200"
                    >
                        <span>Lihat Portofolio Proyek</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </Link>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>
