<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import PublicLayout from '@/Layouts/PublicLayout.vue';

interface ServiceDetailItem {
    id?: number;
    icon: string;
    title: string;
    badge: string;
    description: string;
    suitableFor: string;
    features: string[];
    waMessage: string;
}

interface Props {
    services?: any[];
    packages?: any[];
    settings?: Record<string, string>;
}

const props = withDefaults(defineProps<Props>(), {
    services: () => [],
    packages: () => [],
    settings: () => ({}),
});

// Comprehensive, rich service catalog for the dedicated services page
const detailedServices: ServiceDetailItem[] = [
    {
        icon: 'rocket',
        title: 'Landing Page Konversi Tinggi',
        badge: 'Favorit UMKM',
        description: 'Halaman promosi satu halaman terarah yang dirancang untuk memikat calon pembeli dan langsung mengarahkan ke nomor WhatsApp Anda.',
        suitableFor: 'UMKM, produk kuliner, event, jasa lokal, iklan FB/TikTok & Google Ads',
        features: [
            'Desain 1 halaman modern & mobile-first',
            'Copywriting persuasif dengan Call to Action jelas',
            'Integrasi tombol WhatsApp otomatis & form leads',
            'Gratis domain (.my.id/.com) & hosting SSD 1 tahun',
            'Loading kilat optimal < 2 detik',
            'Pengerjaan cepat 3 - 5 hari kerja',
        ],
        waMessage: 'Halo Swift Code, saya tertarik untuk membuat Landing Page konversi tinggi.',
    },
    {
        icon: 'building',
        title: 'Website Company Profile',
        badge: 'Kredibilitas Bisnis',
        description: 'Pamerkan portofolio, visi misi, legalitas, tim, dan layanan perusahaan Anda dengan desain elegan dan profesional.',
        suitableFor: 'PT, CV, kantor hukum, klinik, agensi, kontraktor, dan yayasan',
        features: [
            'Hingga 5 - 7 halaman lengkap & terstruktur',
            'Desain eksklusif mencerminkan identitas brand',
            'Email bisnis resmi profesional (@namaperusahaan.com)',
            'Panel admin mandiri untuk update konten kapan saja',
            'Optimasi SEO dasar Google Search Console',
            'Garansi perbaikan & pendampingan 6 bulan',
        ],
        waMessage: 'Halo Swift Code, saya ingin membuat Website Company Profile untuk perusahaan saya.',
    },
    {
        icon: 'academic',
        title: 'Website Sekolah & Pesantren',
        badge: 'Institusi Pendidikan',
        description: 'Portal informasi resmi madrasah, sekolah, atau pondok pesantren terintegrasi info PPDB online dan portal berita kegiatan.',
        suitableFor: 'SD, SMP, SMA/SMK, Madrasah, Pondok Pesantren, & Bimbel',
        features: [
            'Domain resmi institusi (.sch.id / .ponpes.id) gratis',
            'Informasi & alur formulir PPDB online',
            'Galeri foto/video kegiatan siswa & fasilitas',
            'Portal berita, pengumuman & kalender akademik',
            'Sangat mudah dikelola staf tata usaha (TU)',
            'Dukungan panduan video cara pengelolaan',
        ],
        waMessage: 'Halo Swift Code, saya ingin membuat Website Sekolah / Lembaga Pendidikan.',
    },
    {
        icon: 'cart',
        title: 'Toko Online (E-Commerce)',
        badge: 'Katalog & Penjualan',
        description: 'Katalog produk modern, hitung ongkir otomatis, dan alur checkout mudah yang langsung tersambung ke WhatsApp atau payment gateway.',
        suitableFor: 'Toko retail, butik fashion, produsen oleh-oleh, distributor produk',
        features: [
            'Katalog produk rapi dengan filter & pencarian',
            'Hitung estimasi ongkir otomatis ke seluruh Indonesia',
            'Pemesanan checkout via WhatsApp otomatis terstruktur',
            'Manajemen stok produk, varian, dan foto',
            'Tampilan responsif sangat nyaman di HP',
            'Laporan data transaksi & riwayat pesanan',
        ],
        waMessage: 'Halo Swift Code, saya ingin membuat Website Toko Online / E-Commerce.',
    },
    {
        icon: 'code',
        title: 'Sistem Informasi & Web App Kustom',
        badge: 'Solusi Khusus',
        description: 'Aplikasi berbasis web sesuai alur kerja spesifik usaha: sistem absensi, inventaris stok, kasir, booking antrean, hingga portal klien.',
        suitableFor: 'Manajemen operasional, sistem reservasi, dashboard analitik internal',
        features: [
            'Struktur database & logika kustom sesuai kebutuhan',
            'Multi-user role & hak akses berjenjang (Admin, Operator, Klien)',
            'Export data & cetak laporan dalam format PDF / Excel',
            'Infrastruktur server cepat & database terenkripsi',
            'Backup data otomatis berkala',
            'Pelatihan langsung tim operasional sampai mahir',
        ],
        waMessage: 'Halo Swift Code, saya ingin berkonsultasi mengenai pembuatan Sistem Web / Aplikasi Kustom.',
    },
    {
        icon: 'tool',
        title: 'Redesign & Optimasi SEO Website',
        badge: 'Performa & Traffic',
        description: 'Perbarui website lama yang lambat, berantakan, atau rusak agar kembali modern, cepat di HP, dan naik ke halaman satu Google.',
        suitableFor: 'Website lama yang lambat, desain ketinggalan zaman, sepi pengunjung',
        features: [
            'Audit menyeluruh kecepatan & Core Web Vitals',
            'Desain antarmuka (UI/UX) baru yang lebih segar & clean',
            'Perbaikan link rusak & optimasi struktur meta SEO',
            'Migrasi hosting server cepat & perpanjangan domain aman',
            'Peningkatan keamanan SSL & proteksi spam formulir',
            'Garansi performa loading lebih gesit',
        ],
        waMessage: 'Halo Swift Code, saya ingin meredesign dan mengoptimasi website lama saya.',
    },
];

const standardFeatures = [
    {
        title: 'Domain & Cloud Hosting 1 Tahun',
        desc: 'Gratis domain pilihan (.com / .my.id / .sch.id) dan hosting SSD berkapasitas optimal dengan uptime 99.9%.',
        icon: 'server',
    },
    {
        title: '100% Mobile Responsive',
        desc: 'Tampilan website otomatis menyesuaikan sempurna di semua perangkat: HP Android/iOS, tablet, dan laptop.',
        icon: 'mobile',
    },
    {
        title: 'Optimasi SEO & Schema Local',
        desc: 'Struktur kode ramah mesin pencari, meta tag lengkap, sitemap XML, dan terdaftar di Google Search Console.',
        icon: 'search',
    },
    {
        title: 'Tombol Chat WhatsApp Instan',
        desc: 'Memudahkan pengunjung langsung berkomunikasi dengan customer service Anda melalui template pesan siap kirim.',
        icon: 'chat',
    },
    {
        title: 'Panel Admin Mandiri (CMS)',
        desc: 'Kemudahan memperbarui teks, foto portofolio, produk, maupun artikel kapan saja tanpa perlu keahlian coding.',
        icon: 'cog',
    },
    {
        title: 'Garansi Teknis & Pendampingan',
        desc: 'Bebas biaya konsultasi dan perbaikan jika terjadi kendala teknis pasca website online, agar operasional lancar.',
        icon: 'shield',
    },
];

const page = usePage();
const whatsappNumber = computed(() => {
    const raw = (page.props as any).siteSettings?.whatsapp || props.settings?.whatsapp || '62895325852575';
    return String(raw).replace(/[^0-9]/g, '');
});

const buildWaUrl = (message: string) => {
    return `https://wa.me/${whatsappNumber.value}?text=${encodeURIComponent(message)}`;
};
</script>

<template>
    <Head>
        <title>Layanan Pembuatan Website Profesional Lampung | Swift Code</title>
        <meta
            name="description"
            content="Daftar lengkap layanan pembuatan website di Lampung oleh Swift Code: Landing Page, Company Profile, Website Sekolah, Toko Online, Sistem Kustom, dan Optimasi SEO."
        />
        <meta property="og:title" content="Layanan Pembuatan Website Profesional Lampung - Swift Code" />
        <meta
            property="og:description"
            content="Solusi digital terpercaya di Lampung. Website cepat, mobile-friendly, desain modern, dan siap meningkatkan omzet bisnis Anda."
        />
    </Head>

    <PublicLayout>
        <!-- 1. Header Hero Section (Signature Brand Red Gradient) -->
        <section class="relative pt-28 pb-12 sm:pt-32 sm:pb-16 bg-gradient-to-r from-brand-800 via-brand-600 to-rose-600 text-white overflow-hidden shadow-inner">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
                <!-- Breadcrumbs -->
                <div class="flex items-center justify-center">
                    <nav class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 border border-white/20 text-xs font-medium text-white/90 backdrop-blur-xs">
                        <Link href="/" class="hover:text-white transition-colors">Beranda</Link>
                        <span>/</span>
                        <span class="text-white font-bold">Layanan</span>
                    </nav>
                </div>

                <!-- Headline -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white leading-tight">
                    Layanan Pembuatan Website <br class="hidden sm:inline" />
                    <span>Sesuai Kebutuhan Bisnis Anda</span>
                </h1>

                <!-- Subheadline -->
                <p class="text-base sm:text-lg text-white/90 max-w-2xl mx-auto leading-relaxed">
                    Kami menghadirkan solusi pembuatan website modern di Lampung yang dirancang khusus untuk meningkatkan kredibilitas, kecepatan, dan omzet bisnis Anda.
                </p>
            </div>
        </section>

        <!-- 2. Katalog Layanan Lengkap (Rich Cards Grid) -->
        <section id="katalog-layanan" class="py-12 sm:py-16 bg-white relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-12 space-y-2">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">
                        Pilihan Solusi Website untuk Segala Kebutuhan
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-600">
                        Sesuaikan jenis website dengan model bisnis dan target pasar yang ingin Anda tuju.
                    </p>
                </div>

                <!-- Grid of Rich Services -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    <div
                        v-for="srv in detailedServices"
                        :key="srv.title"
                        class="group p-6 sm:p-7 rounded-2xl bg-white border border-neutral-200 shadow-xs hover:shadow-xl hover:border-brand-500/40 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between"
                    >
                        <div>
                            <!-- Header: Icon & Badge -->
                            <div class="flex items-center justify-between gap-3 mb-4">
                                <div class="w-12 h-12 rounded-xl bg-brand-50 border border-brand-200/80 text-brand-600 flex items-center justify-center shrink-0 group-hover:scale-110 group-hover:bg-brand-600 group-hover:text-white transition-all duration-300">
                                    <!-- Rocket -->
                                    <svg v-if="srv.icon === 'rocket'" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    <!-- Building -->
                                    <svg v-else-if="srv.icon === 'building'" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <!-- Academic -->
                                    <svg v-else-if="srv.icon === 'academic'" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5" />
                                    </svg>
                                    <!-- Cart -->
                                    <svg v-else-if="srv.icon === 'cart'" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    <!-- Code -->
                                    <svg v-else-if="srv.icon === 'code'" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                    </svg>
                                    <!-- Tool -->
                                    <svg v-else-if="srv.icon === 'tool'" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <svg v-else class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>

                                <span class="text-[11px] font-bold tracking-wider uppercase px-2.5 py-1 rounded-full bg-brand-50 text-brand-700 border border-brand-200/70">
                                    {{ srv.badge }}
                                </span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-bold text-neutral-900 mb-2 group-hover:text-brand-600 transition-colors">
                                {{ srv.title }}
                            </h3>

                            <!-- Description -->
                            <p class="text-xs sm:text-sm text-neutral-600 leading-relaxed mb-4">
                                {{ srv.description }}
                            </p>

                            <!-- Suitable For Tag -->
                            <div class="mb-5 p-2.5 rounded-lg bg-neutral-50 border border-neutral-100 text-neutral-600 text-[11px]">
                                <span class="font-bold text-neutral-800">Cocok untuk:</span> {{ srv.suitableFor }}
                            </div>

                            <!-- Features List -->
                            <div class="space-y-2 mb-6">
                                <p class="text-[11px] font-bold text-neutral-900 uppercase tracking-wider">
                                    Fitur Unggulan:
                                </p>
                                <ul class="space-y-1.5">
                                    <li
                                        v-for="(feat, fIdx) in srv.features"
                                        :key="fIdx"
                                        class="flex items-start gap-2 text-xs text-neutral-600"
                                    >
                                        <svg class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>{{ feat }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Card Action -->
                        <div class="pt-4 border-t border-neutral-100">
                            <a
                                :href="buildWaUrl(srv.waMessage)"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-full py-2.5 px-3.5 rounded-xl font-bold text-xs text-center bg-brand-600 hover:bg-brand-700 text-white shadow-xs transition-all duration-200 flex items-center justify-center gap-1.5"
                            >
                                <span>Konsultasikan via WhatsApp</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Standard Fasilitas di Setiap Layanan -->
        <section id="fasilitas" class="py-12 sm:py-16 bg-neutral-50/70 border-t border-neutral-200/80 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-12 space-y-2">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">
                        Standar Kualitas di <span class="text-brand-600">Setiap Proyek</span>
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-600">
                        Setiap website yang dikembangkan oleh Swift Code Lampung sudah mencakup fitur-fitur penting berikut tanpa biaya tambahan.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                    <div
                        v-for="feat in standardFeatures"
                        :key="feat.title"
                        class="p-5 sm:p-6 rounded-2xl bg-white border border-neutral-200/80 shadow-xs hover:shadow-md transition-all"
                    >
                        <div class="w-10 h-10 rounded-xl bg-brand-50 border border-brand-200/60 text-brand-600 flex items-center justify-center mb-3.5 font-bold">
                            <!-- Server -->
                            <svg v-if="feat.icon === 'server'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                            </svg>
                            <!-- Mobile -->
                            <svg v-else-if="feat.icon === 'mobile'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <!-- Search -->
                            <svg v-else-if="feat.icon === 'search'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <!-- Chat -->
                            <svg v-else-if="feat.icon === 'chat'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <!-- Cog -->
                            <svg v-else-if="feat.icon === 'cog'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <!-- Shield -->
                            <svg v-else class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-sm sm:text-base font-bold text-neutral-900 mb-1.5">
                            {{ feat.title }}
                        </h3>
                        <p class="text-xs text-neutral-600 leading-relaxed">
                            {{ feat.desc }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. CTA Red Gradient Banner -->
        <section class="py-10 sm:py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-r from-brand-800 via-brand-600 to-rose-600 text-white shadow-xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="space-y-2 text-center md:text-left">
                        <h3 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                            Masih Bingung Menentukan Pilihan?
                        </h3>
                        <p class="text-sm sm:text-base text-white/90 max-w-xl leading-relaxed">
                            Diskusikan ide dan anggaran bisnis Anda bersama tim pengembang Swift Code Lampung. Konsultasi 100% gratis tanpa komitmen.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center gap-3 shrink-0">
                        <a
                            :href="buildWaUrl('Halo Swift Code, saya ingin berkonsultasi mengenai rekomendasi website yang paling cocok untuk bisnis saya.')"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="px-6 py-3.5 bg-white text-brand-700 hover:bg-neutral-100 font-bold text-xs sm:text-sm rounded-xl shadow-lg transition-transform hover:scale-105 active:scale-95 text-center whitespace-nowrap"
                        >
                            Chat WhatsApp Gratis
                        </a>
                        <Link
                            href="/#kontak"
                            class="px-6 py-3.5 bg-white/15 hover:bg-white/25 border border-white/25 text-white font-bold text-xs sm:text-sm rounded-xl transition-colors text-center whitespace-nowrap"
                        >
                            Isi Formulir Pesanan
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>
