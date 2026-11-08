<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface SyncStatGroup {
    active?: number;
    published?: number;
    featured?: number;
    highlighted?: number;
    total: number;
    sample?: any[];
}

interface SyncStats {
    services: SyncStatGroup;
    projects: SyncStatGroup;
    packages: SyncStatGroup;
    testimonials: SyncStatGroup;
    partners?: SyncStatGroup;
    faqs: SyncStatGroup;
    articles: SyncStatGroup;
    leads: { total: number; new: number };
}

const props = defineProps<{
    settings: Record<string, string>;
    syncStats: SyncStats;
}>();

const activeTab = ref<'hero' | 'sections' | 'visibility'>('hero');

const form = useForm({
    // Hero Banner
    hero_badge: props.settings.hero_badge || 'Jasa Pembuatan Website Lampung',
    hero_headline: props.settings.hero_headline || 'Bangun Website Bisnis yang Kredibel, Cepat, & Siap Datangkan Pelanggan.',
    hero_subheadline: props.settings.hero_subheadline || 'Kami merancang landing page, company profile, dan toko online untuk UMKM hingga perusahaan di Lampung. Siap online dalam 3–7 hari, ringan diakses di HP, serta mudah ditemukan calon klien lewat Google.',
    hero_cta_primary_text: props.settings.hero_cta_primary_text || 'Konsultasi Gratis Sekarang',
    hero_cta_primary_link: props.settings.hero_cta_primary_link || '#kontak',
    hero_cta_secondary_text: props.settings.hero_cta_secondary_text || 'Lihat Hasil Portofolio',
    hero_cta_secondary_link: props.settings.hero_cta_secondary_link || '#portofolio',

    // Hero Trust Indicators
    hero_trust_1: props.settings.hero_trust_1 || 'Domain & Cloud Hosting Termasuk',
    hero_trust_2: props.settings.hero_trust_2 || 'Struktur SEO & Kecepatan Dioptimasi',
    hero_trust_3: props.settings.hero_trust_3 || 'Garansi Perbaikan & Dukungan',

    // Hero Showcase Mockup & Badges
    hero_image: null as File | null,
    hero_metric_score: props.settings.hero_metric_score || '100',
    hero_metric_label: props.settings.hero_metric_label || 'PageSpeed Score',
    hero_metric_desc: props.settings.hero_metric_desc || '0.4s Super Kilat',
    hero_mockup_url: props.settings.hero_mockup_url || 'swiftcode.id/preview',
    hero_mockup_badge: props.settings.hero_mockup_badge || 'Laravel 12 • Vue 3 • Tailwind CSS',
    hero_mockup_location: props.settings.hero_mockup_location || 'Bandar Lampung',

    // Why Us Customization
    why_us_problem_title: props.settings.why_us_problem_title || 'Kecepatan Akses Tinggi & Tampilan Mobile Sempurna',
    why_us_problem_desc: props.settings.why_us_problem_desc || 'Pengunjung rata-rata meninggalkan website jika loading lebih dari 3 detik. Swift Code membangun website dengan kompresi modern dan struktur kode yang sangat ringan.',
    why_us_solution_title: props.settings.why_us_solution_title || 'Standar Website Swift Code',
    why_us_solution_desc: props.settings.why_us_solution_desc || 'Skor Lighthouse 90+, navigasi sentuh instan, gambar otomatis terkompresi WebP, dan siap dibuka di jaringan 4G.',
    why_us_card_1_title: props.settings.why_us_card_1_title || 'Optimasi Google & SEO Lokal Lampung',
    why_us_card_1_desc: props.settings.why_us_card_1_desc || 'Dilengkapi Schema.org LocalBusiness, sitemap otomatis, dan kata kunci lokal agar bisnis Anda mudah ditemukan calon pembeli terdekat.',
    why_us_card_1_tag: props.settings.why_us_card_1_tag || 'Ditemukan di Google',
    why_us_card_2_title: props.settings.why_us_card_2_title || 'Konversi Langsung ke WhatsApp',
    why_us_card_2_desc: props.settings.why_us_card_2_desc || 'Setiap tombol pemesanan dan formulir langsung mengarahkan pengunjung ke chat WhatsApp admin Anda dengan format pesan rapi.',
    why_us_card_2_tag: props.settings.why_us_card_2_tag || 'Konversi Instan',
    why_us_card_3_title: props.settings.why_us_card_3_title || 'Dashboard Kelola Konten Praktis',
    why_us_card_3_desc: props.settings.why_us_card_3_desc || 'Ubah teks profil, tambah foto portofolio, atau perbarui kontak bisnis kapan saja dengan mudah tanpa perlu paham koding.',
    why_us_card_3_tag: props.settings.why_us_card_3_tag || 'Mudah Dikelola',
    why_us_card_4_title: props.settings.why_us_card_4_title || 'Garansi & Dukungan Teknis Purna Jual',
    why_us_card_4_desc: props.settings.why_us_card_4_desc || 'Kami tidak lepas tangan setelah serah terima. Anda mendapatkan proteksi SSL, perbaikan error teknis, dan konsultasi lanjutan.',
    why_us_card_4_tag: props.settings.why_us_card_4_tag || 'Pendampingan Penuh',

    // Section Titles & Subtitles
    section_services_title: props.settings.section_services_title || 'Layanan Pembuatan Website Sesuai Kebutuhan',
    section_services_desc: props.settings.section_services_desc || 'Pilih jenis website yang paling pas dengan industri dan skala bisnis Anda saat ini.',
    section_portfolio_title: props.settings.section_portfolio_title || 'Portofolio Proyek Pilihan Kami',
    section_portfolio_desc: props.settings.section_portfolio_desc || 'Lihat bagaimana kami membantu brand lokal dan instansi tampil profesional di ranah online.',
    section_pricing_title: props.settings.section_pricing_title || 'Paket Investasi Pembuatan Website',
    section_pricing_desc: props.settings.section_pricing_desc || 'Tanpa biaya tersembunyi. Semua paket sudah termasuk domain, hosting, dan pendampingan penuh.',
    section_why_us_title: props.settings.section_why_us_title || 'Website Anda Bukan Sekadar Pajangan, Tapi Alat Penjualan Nyata',
    section_why_us_desc: props.settings.section_why_us_desc || 'Calon pelanggan di Lampung kini selalu mengecek kredibilitas bisnis lewat internet sebelum membeli. Website yang lambat dan berantakan membuat mereka langsung beralih ke kompetitor.',
    section_testimonials_title: props.settings.section_testimonials_title || 'Testimoni Klien Swift Code',
    section_testimonials_desc: props.settings.section_testimonials_desc || 'Kepuasan dan kesuksesan digital klien adalah prioritas utama kami.',
    section_faq_title: props.settings.section_faq_title || 'Hal yang Sering Ditanyakan (FAQ)',
    section_faq_desc: props.settings.section_faq_desc || 'Masih ragu atau punya pertanyaan lain? Temukan jawabannya di bawah ini.',

    // Section Visibilities (1 = tampil, 0 = sembunyikan)
    show_partner_marquee: props.settings.show_partner_marquee !== '0' ? '1' : '0',
    show_services: props.settings.show_services !== '0' ? '1' : '0',
    show_portfolio: props.settings.show_portfolio !== '0' ? '1' : '0',
    show_pricing: props.settings.show_pricing !== '0' ? '1' : '0',
    show_why_us: props.settings.show_why_us !== '0' ? '1' : '0',
    show_testimonials: props.settings.show_testimonials !== '0' ? '1' : '0',
    show_faq: props.settings.show_faq !== '0' ? '1' : '0',
    show_articles: props.settings.show_articles !== '0' ? '1' : '0',
    show_contact: props.settings.show_contact !== '0' ? '1' : '0',
});

const heroImagePreview = ref<string | null>(props.settings.hero_image || '/images/hero-showcase.png');

const handleHeroImageChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.hero_image = file;
        heroImagePreview.value = URL.createObjectURL(file);
    }
};

const submit = () => {
    form.post('/admin/beranda', {
        headers: {
            'X-HTTP-Method-Override': 'PUT',
        },
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Kelola & Sinkronisasi Halaman Beranda - Panel Admin" />

    <AdminLayout title="Kelola Halaman Beranda">
        <div class="space-y-8">
            <!-- Header bar & Action -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
                        Pusat Kontrol & Sinkronisasi Halaman Beranda
                    </h2>
                    <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-0.5">
                        Kelola konten hero banner, judul setiap section, saklar visibilitas, dan pantau sinkronisasi otomatis dari database.
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <a
                        href="/"
                        target="_blank"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 font-bold text-xs transition-all"
                    >
                        <svg class="w-4 h-4 text-neutral-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        <span>Lihat Beranda Publik</span>
                    </a>
                </div>
            </div>

            <!-- 1. Live Synchronization Overview Banner -->
            <div class="p-6 rounded-3xl bg-neutral-950 text-white border border-neutral-800 shadow-xl space-y-5 relative overflow-hidden">
                <div class="absolute -top-16 -right-16 w-56 h-56 bg-brand-600/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 relative z-10 border-b border-white/10 pb-4">
                    <div class="flex items-center gap-2.5">
                        <span class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse"></span>
                        <h3 class="text-sm font-extrabold text-white tracking-wide uppercase">
                            Status Sinkronisasi Otomatis Database Beranda
                        </h3>
                    </div>
                    <span class="text-xs text-neutral-400 font-mono">
                        Data langsung diperbarui saat CRUD disimpan
                    </span>
                </div>

                <!-- Sync Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3.5 relative z-10">
                    <!-- Layanan -->
                    <div class="p-3.5 rounded-2xl bg-white/5 border border-white/10 flex flex-col justify-between">
                        <div>
                            <p class="text-[10px] text-neutral-400 font-bold uppercase tracking-wider">Layanan</p>
                            <p class="text-xl font-extrabold text-white mt-1">{{ syncStats.services.active }}</p>
                            <p class="text-[10px] text-emerald-400 mt-0.5">Aktif di Beranda</p>
                        </div>
                        <Link
                            href="/admin/services"
                            class="inline-flex items-center gap-1 text-[11px] font-bold text-brand-400 hover:text-brand-300 mt-3 pt-2 border-t border-white/10 transition-colors"
                        >
                            <span>Kelola Layanan</span>
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </Link>
                    </div>

                    <!-- Portofolio -->
                    <div class="p-3.5 rounded-2xl bg-white/5 border border-white/10 flex flex-col justify-between">
                        <div>
                            <p class="text-[10px] text-neutral-400 font-bold uppercase tracking-wider">Portofolio</p>
                            <p class="text-xl font-extrabold text-white mt-1">{{ syncStats.projects.published }}</p>
                            <p class="text-[10px] text-brand-400 mt-0.5">{{ syncStats.projects.featured }} Unggulan</p>
                        </div>
                        <Link
                            href="/admin/projects"
                            class="inline-flex items-center gap-1 text-[11px] font-bold text-brand-400 hover:text-brand-300 mt-3 pt-2 border-t border-white/10 transition-colors"
                        >
                            <span>Kelola Portofolio</span>
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </Link>
                    </div>

                    <!-- Paket Harga -->
                    <div class="p-3.5 rounded-2xl bg-white/5 border border-white/10 flex flex-col justify-between">
                        <div>
                            <p class="text-[10px] text-neutral-400 font-bold uppercase tracking-wider">Paket Harga</p>
                            <p class="text-xl font-extrabold text-white mt-1">{{ syncStats.packages.active }}</p>
                            <p class="text-[10px] text-amber-400 mt-0.5">{{ syncStats.packages.highlighted }} Pilihan Utama</p>
                        </div>
                        <Link
                            href="/admin/packages"
                            class="inline-flex items-center gap-1 text-[11px] font-bold text-brand-400 hover:text-brand-300 mt-3 pt-2 border-t border-white/10 transition-colors"
                        >
                            <span>Kelola Harga</span>
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </Link>
                    </div>

                    <!-- Testimoni -->
                    <div class="p-3.5 rounded-2xl bg-white/5 border border-white/10 flex flex-col justify-between">
                        <div>
                            <p class="text-[10px] text-neutral-400 font-bold uppercase tracking-wider">Testimoni</p>
                            <p class="text-xl font-extrabold text-white mt-1">{{ syncStats.testimonials.published }}</p>
                            <p class="text-[10px] text-neutral-400 mt-0.5">Ulasan Tayang</p>
                        </div>
                        <Link
                            href="/admin/testimonials"
                            class="inline-flex items-center gap-1 text-[11px] font-bold text-brand-400 hover:text-brand-300 mt-3 pt-2 border-t border-white/10 transition-colors"
                        >
                            <span>Kelola Testimoni</span>
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </Link>
                    </div>

                    <!-- FAQ -->
                    <div class="p-3.5 rounded-2xl bg-white/5 border border-white/10 flex flex-col justify-between">
                        <div>
                            <p class="text-[10px] text-neutral-400 font-bold uppercase tracking-wider">FAQ</p>
                            <p class="text-xl font-extrabold text-white mt-1">{{ syncStats.faqs.published }}</p>
                            <p class="text-[10px] text-neutral-400 mt-0.5">Pertanyaan Aktif</p>
                        </div>
                        <Link
                            href="/admin/faqs"
                            class="inline-flex items-center gap-1 text-[11px] font-bold text-brand-400 hover:text-brand-300 mt-3 pt-2 border-t border-white/10 transition-colors"
                        >
                            <span>Kelola FAQ</span>
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </Link>
                    </div>

                    <!-- Artikel -->
                    <div class="p-3.5 rounded-2xl bg-white/5 border border-white/10 flex flex-col justify-between">
                        <div>
                            <p class="text-[10px] text-neutral-400 font-bold uppercase tracking-wider">Artikel</p>
                            <p class="text-xl font-extrabold text-white mt-1">{{ syncStats.articles.published }}</p>
                            <p class="text-[10px] text-neutral-400 mt-0.5">Edukasi & Blog</p>
                        </div>
                        <Link
                            href="/admin/articles"
                            class="inline-flex items-center gap-1 text-[11px] font-bold text-brand-400 hover:text-brand-300 mt-3 pt-2 border-t border-white/10 transition-colors"
                        >
                            <span>Kelola Artikel</span>
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </Link>
                    </div>
                </div>
            </div>

            <!-- 2. Editor Tabs Navigation -->
            <div class="flex items-center gap-2 border-b border-neutral-200 dark:border-neutral-800 pb-2">
                <button
                    type="button"
                    @click="activeTab = 'hero'"
                    :class="[
                        'px-4 py-2.5 rounded-xl text-xs font-bold transition-all inline-flex items-center gap-2',
                        activeTab === 'hero'
                            ? 'bg-brand-600 text-white shadow-xs'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 border border-neutral-200 dark:border-neutral-800',
                    ]"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>1. Hero Banner & Headline</span>
                </button>

                <button
                    type="button"
                    @click="activeTab = 'sections'"
                    :class="[
                        'px-4 py-2.5 rounded-xl text-xs font-bold transition-all inline-flex items-center gap-2',
                        activeTab === 'sections'
                            ? 'bg-brand-600 text-white shadow-xs'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 border border-neutral-200 dark:border-neutral-800',
                    ]"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                    </svg>
                    <span>2. Judul & Narasi Section</span>
                </button>

                <button
                    type="button"
                    @click="activeTab = 'visibility'"
                    :class="[
                        'px-4 py-2.5 rounded-xl text-xs font-bold transition-all inline-flex items-center gap-2',
                        activeTab === 'visibility'
                            ? 'bg-brand-600 text-white shadow-xs'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 border border-neutral-200 dark:border-neutral-800',
                    ]"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span>3. Saklar Visibilitas Section</span>
                </button>
            </div>

            <!-- Form -->
            <form @submit.prevent="submit" class="space-y-6">
                <!-- TAB 1: HERO SECTION -->
                <div v-show="activeTab === 'hero'" class="p-6 sm:p-8 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-6">
                    <div class="border-b border-neutral-100 dark:border-neutral-800 pb-3">
                        <h3 class="text-sm font-extrabold text-neutral-900 dark:text-white">Konten Utama Hero Banner</h3>
                        <p class="text-xs text-neutral-500">Pesan pembuka pertama kali yang dilihat calon klien saat membuka website.</p>
                    </div>

                    <!-- Badge Label -->
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Label Badge Hero
                        </label>
                        <input
                            v-model="form.hero_badge"
                            type="text"
                            placeholder="Contoh: Jasa Pembuatan Website Lampung"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                    </div>

                    <!-- Headline Utama -->
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Headline Utama <span class="text-rose-500">*</span>
                        </label>
                        <textarea
                            v-model="form.hero_headline"
                            rows="2"
                            required
                            placeholder="Judul besar utama di bagian paling atas..."
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none resize-none font-semibold leading-relaxed"
                        ></textarea>
                    </div>

                    <!-- Subheadline -->
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Subheadline / Paragraf Nilai Tambah <span class="text-rose-500">*</span>
                        </label>
                        <textarea
                            v-model="form.hero_subheadline"
                            rows="3"
                            required
                            placeholder="Paragraf penjelasan singkat mengapa harus memilih Swift Code..."
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none resize-none leading-relaxed"
                        ></textarea>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2 border-t border-neutral-100 dark:border-neutral-800">
                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Teks Tombol Utama (Primary CTA)
                            </label>
                            <input
                                v-model="form.hero_cta_primary_text"
                                type="text"
                                placeholder="Konsultasi Gratis Sekarang"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                            <div class="mt-2">
                                <label class="block text-[11px] text-neutral-500 mb-1">Target Link / Anchor (#kontak atau URL)</label>
                                <input
                                    v-model="form.hero_cta_primary_link"
                                    type="text"
                                    placeholder="#kontak"
                                    class="w-full px-4 py-2 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-mono focus:ring-2 focus:ring-brand-500 outline-none"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Teks Tombol Kedua (Secondary CTA)
                            </label>
                            <input
                                v-model="form.hero_cta_secondary_text"
                                type="text"
                                placeholder="Lihat Hasil Portofolio"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                            <div class="mt-2">
                                <label class="block text-[11px] text-neutral-500 mb-1">Target Link / Anchor (#portofolio atau URL)</label>
                                <input
                                    v-model="form.hero_cta_secondary_link"
                                    type="text"
                                    placeholder="#portofolio"
                                    class="w-full px-4 py-2 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-mono focus:ring-2 focus:ring-brand-500 outline-none"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="pt-2 border-t border-neutral-100 dark:border-neutral-800 space-y-3">
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider">
                            3 Poin Kepercayaan (Trust Badges di Bawah CTA)
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <input
                                v-model="form.hero_trust_1"
                                type="text"
                                placeholder="Poin 1: Domain & Hosting Termasuk"
                                class="px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                            <input
                                v-model="form.hero_trust_2"
                                type="text"
                                placeholder="Poin 2: Struktur SEO Dioptimasi"
                                class="px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                            <input
                                v-model="form.hero_trust_3"
                                type="text"
                                placeholder="Poin 3: Garansi Perbaikan Error"
                                class="px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                        </div>
                    </div>

                    <!-- Hero Showcase Image & Mockup Settings -->
                    <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800 space-y-4">
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider">
                            Tampilan Mockup & Gambar Showcase Hero
                        </label>

                        <div class="p-4 rounded-xl border border-neutral-200 dark:border-neutral-800 bg-neutral-50/50 dark:bg-neutral-800/40 space-y-3">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                                <div class="w-32 h-20 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-neutral-900 p-1 flex items-center justify-center shrink-0 overflow-hidden">
                                    <img v-if="heroImagePreview" :src="heroImagePreview" alt="Showcase Hero" class="w-full h-full object-cover rounded-lg" />
                                </div>
                                <div class="flex-1 space-y-1">
                                    <label class="block text-xs font-bold text-neutral-800 dark:text-neutral-200">
                                        Unggah Gambar Showcase Hero (WebP/PNG/JPG)
                                    </label>
                                    <input
                                        type="file"
                                        accept="image/*"
                                        @change="handleHeroImageChange"
                                        class="text-xs text-neutral-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100"
                                    />
                                    <p class="text-[10px] text-neutral-400">Rekomendasi rasio 16:10 atau 4:3 resolusi tajam minimal 800x600px.</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div>
                                <label class="block text-[11px] font-bold text-neutral-600 dark:text-neutral-400 mb-1">Skor PageSpeed</label>
                                <input
                                    v-model="form.hero_metric_score"
                                    type="text"
                                    placeholder="100"
                                    class="w-full px-4 py-2 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-mono outline-none"
                                />
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-neutral-600 dark:text-neutral-400 mb-1">Label Metrik</label>
                                <input
                                    v-model="form.hero_metric_label"
                                    type="text"
                                    placeholder="PageSpeed Score"
                                    class="w-full px-4 py-2 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs outline-none"
                                />
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-neutral-600 dark:text-neutral-400 mb-1">Keterangan Kecepatan</label>
                                <input
                                    v-model="form.hero_metric_desc"
                                    type="text"
                                    placeholder="0.4s Super Kilat"
                                    class="w-full px-4 py-2 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs outline-none"
                                />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div>
                                <label class="block text-[11px] font-bold text-neutral-600 dark:text-neutral-400 mb-1">URL Mockup Browser</label>
                                <input
                                    v-model="form.hero_mockup_url"
                                    type="text"
                                    placeholder="swiftcode.id"
                                    class="w-full px-4 py-2 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-mono outline-none"
                                />
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-neutral-600 dark:text-neutral-400 mb-1">Badge Teknologi (Pojok Kanan)</label>
                                <input
                                    v-model="form.hero_mockup_badge"
                                    type="text"
                                    placeholder="Laravel 12 • Vue 3 • Tailwind CSS"
                                    class="w-full px-4 py-2 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs outline-none"
                                />
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-neutral-600 dark:text-neutral-400 mb-1">Badge Lokasi (Pojok Kiri)</label>
                                <input
                                    v-model="form.hero_mockup_location"
                                    type="text"
                                    placeholder="Bandar Lampung"
                                    class="w-full px-4 py-2 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs outline-none"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 2: SECTION TITLES & SUBTITLES -->
                <div v-show="activeTab === 'sections'" class="p-6 sm:p-8 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-6">
                    <div class="border-b border-neutral-100 dark:border-neutral-800 pb-3">
                        <h3 class="text-sm font-extrabold text-neutral-900 dark:text-white">Judul & Narasi Setiap Section Beranda</h3>
                        <p class="text-xs text-neutral-500">Sesuaikan kata-kata penarik pada judul section agar sesuai dengan strategi pemasaran bisnis.</p>
                    </div>

                    <!-- Layanan Section -->
                    <div class="space-y-3 pb-4 border-b border-neutral-100 dark:border-neutral-800">
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 dark:bg-blue-950 dark:text-blue-300 border border-blue-200 uppercase">
                            Section Layanan & Solusi
                        </span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 mb-1">Judul Section Layanan</label>
                                <input
                                    v-model="form.section_services_title"
                                    type="text"
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none font-semibold"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 mb-1">Deskripsi Ringkas</label>
                                <input
                                    v-model="form.section_services_desc"
                                    type="text"
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Portofolio Section -->
                    <div class="space-y-3 pb-4 border-b border-neutral-100 dark:border-neutral-800">
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-brand-50 text-brand-700 dark:bg-brand-950 dark:text-brand-300 border border-brand-200 uppercase">
                            Section Portofolio Proyek
                        </span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 mb-1">Judul Section Portofolio</label>
                                <input
                                    v-model="form.section_portfolio_title"
                                    type="text"
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none font-semibold"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 mb-1">Deskripsi Ringkas</label>
                                <input
                                    v-model="form.section_portfolio_desc"
                                    type="text"
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Paket Harga Section -->
                    <div class="space-y-3 pb-4 border-b border-neutral-100 dark:border-neutral-800">
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300 border border-emerald-200 uppercase">
                            Section Paket Investasi & Harga
                        </span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 mb-1">Judul Section Harga</label>
                                <input
                                    v-model="form.section_pricing_title"
                                    type="text"
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none font-semibold"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 mb-1">Deskripsi Ringkas</label>
                                <input
                                    v-model="form.section_pricing_desc"
                                    type="text"
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Keunggulan (Why Us) Section -->
                    <div class="space-y-4 pb-4 border-b border-neutral-100 dark:border-neutral-800">
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-purple-50 text-purple-700 dark:bg-purple-950 dark:text-purple-300 border border-purple-200 uppercase">
                            Section Mengapa Memilih Kami (Why Us)
                        </span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 mb-1">Judul Section Keunggulan</label>
                                <input
                                    v-model="form.section_why_us_title"
                                    type="text"
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none font-semibold"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 mb-1">Deskripsi Ringkas</label>
                                <input
                                    v-model="form.section_why_us_desc"
                                    type="text"
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                                />
                            </div>
                        </div>

                        <!-- Kartu Sorotan Komparasi -->
                        <div class="p-4 rounded-xl bg-neutral-50 dark:bg-neutral-800/40 border border-neutral-200 dark:border-neutral-700 space-y-3">
                            <h4 class="text-xs font-bold text-neutral-800 dark:text-neutral-200 uppercase tracking-wider">
                                Kartu Sorotan Utama (Sisi Kiri)
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[11px] font-semibold text-neutral-600 dark:text-neutral-400 mb-1">Judul Masalah / Sorotan</label>
                                    <input
                                        v-model="form.why_us_problem_title"
                                        type="text"
                                        class="w-full px-3 py-2 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-xs"
                                    />
                                </div>
                                <div>
                                    <label class="block text-[11px] font-semibold text-neutral-600 dark:text-neutral-400 mb-1">Deskripsi Masalah</label>
                                    <input
                                        v-model="form.why_us_problem_desc"
                                        type="text"
                                        class="w-full px-3 py-2 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-xs"
                                    />
                                </div>
                                <div>
                                    <label class="block text-[11px] font-semibold text-neutral-600 dark:text-neutral-400 mb-1">Judul Standar Solusi</label>
                                    <input
                                        v-model="form.why_us_solution_title"
                                        type="text"
                                        class="w-full px-3 py-2 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-xs"
                                    />
                                </div>
                                <div>
                                    <label class="block text-[11px] font-semibold text-neutral-600 dark:text-neutral-400 mb-1">Deskripsi Standar Solusi</label>
                                    <input
                                        v-model="form.why_us_solution_desc"
                                        type="text"
                                        class="w-full px-3 py-2 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-xs"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- 4 Kartu Keunggulan Sisi Kanan -->
                        <div class="p-4 rounded-xl bg-neutral-50 dark:bg-neutral-800/40 border border-neutral-200 dark:border-neutral-700 space-y-4">
                            <h4 class="text-xs font-bold text-neutral-800 dark:text-neutral-200 uppercase tracking-wider">
                                4 Kartu Keunggulan Teknis (Sisi Kanan)
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Card 1 -->
                                <div class="p-3 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 space-y-2">
                                    <span class="text-[10px] font-bold text-brand-600">Kartu 1</span>
                                    <input v-model="form.why_us_card_1_tag" type="text" placeholder="Tag: Ditemukan di Google" class="w-full px-2.5 py-1.5 rounded-lg border text-xs" />
                                    <input v-model="form.why_us_card_1_title" type="text" placeholder="Judul Kartu 1" class="w-full px-2.5 py-1.5 rounded-lg border text-xs font-bold" />
                                    <textarea v-model="form.why_us_card_1_desc" rows="2" placeholder="Deskripsi..." class="w-full px-2.5 py-1.5 rounded-lg border text-xs resize-none"></textarea>
                                </div>

                                <!-- Card 2 -->
                                <div class="p-3 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 space-y-2">
                                    <span class="text-[10px] font-bold text-brand-600">Kartu 2</span>
                                    <input v-model="form.why_us_card_2_tag" type="text" placeholder="Tag: Konversi Instan" class="w-full px-2.5 py-1.5 rounded-lg border text-xs" />
                                    <input v-model="form.why_us_card_2_title" type="text" placeholder="Judul Kartu 2" class="w-full px-2.5 py-1.5 rounded-lg border text-xs font-bold" />
                                    <textarea v-model="form.why_us_card_2_desc" rows="2" placeholder="Deskripsi..." class="w-full px-2.5 py-1.5 rounded-lg border text-xs resize-none"></textarea>
                                </div>

                                <!-- Card 3 -->
                                <div class="p-3 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 space-y-2">
                                    <span class="text-[10px] font-bold text-brand-600">Kartu 3</span>
                                    <input v-model="form.why_us_card_3_tag" type="text" placeholder="Tag: Mudah Dikelola" class="w-full px-2.5 py-1.5 rounded-lg border text-xs" />
                                    <input v-model="form.why_us_card_3_title" type="text" placeholder="Judul Kartu 3" class="w-full px-2.5 py-1.5 rounded-lg border text-xs font-bold" />
                                    <textarea v-model="form.why_us_card_3_desc" rows="2" placeholder="Deskripsi..." class="w-full px-2.5 py-1.5 rounded-lg border text-xs resize-none"></textarea>
                                </div>

                                <!-- Card 4 -->
                                <div class="p-3 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 space-y-2">
                                    <span class="text-[10px] font-bold text-brand-600">Kartu 4</span>
                                    <input v-model="form.why_us_card_4_tag" type="text" placeholder="Tag: Pendampingan Penuh" class="w-full px-2.5 py-1.5 rounded-lg border text-xs" />
                                    <input v-model="form.why_us_card_4_title" type="text" placeholder="Judul Kartu 4" class="w-full px-2.5 py-1.5 rounded-lg border text-xs font-bold" />
                                    <textarea v-model="form.why_us_card_4_desc" rows="2" placeholder="Deskripsi..." class="w-full px-2.5 py-1.5 rounded-lg border text-xs resize-none"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimoni Section -->
                    <div class="space-y-3 pb-4 border-b border-neutral-100 dark:border-neutral-800">
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-rose-50 text-rose-700 dark:bg-rose-950 dark:text-rose-300 border border-rose-200 uppercase">
                            Section Testimoni Klien
                        </span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 mb-1">Judul Section Testimoni</label>
                                <input
                                    v-model="form.section_testimonials_title"
                                    type="text"
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none font-semibold"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 mb-1">Deskripsi Ringkas</label>
                                <input
                                    v-model="form.section_testimonials_desc"
                                    type="text"
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Section -->
                    <div class="space-y-3">
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-amber-50 text-amber-700 dark:bg-amber-950 dark:text-amber-300 border border-amber-200 uppercase">
                            Section FAQ (Pertanyaan Umum)
                        </span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 mb-1">Judul Section FAQ</label>
                                <input
                                    v-model="form.section_faq_title"
                                    type="text"
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none font-semibold"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 mb-1">Deskripsi Ringkas</label>
                                <input
                                    v-model="form.section_faq_desc"
                                    type="text"
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 3: VISIBILITY TOGGLES -->
                <div v-show="activeTab === 'visibility'" class="p-6 sm:p-8 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-6">
                    <div class="border-b border-neutral-100 dark:border-neutral-800 pb-3">
                        <h3 class="text-sm font-extrabold text-neutral-900 dark:text-white">Saklar Visibilitas Section di Beranda</h3>
                        <p class="text-xs text-neutral-500">Pilih komponen atau section mana saja yang ingin ditampilkan ke publik.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Marquee -->
                        <div class="p-4 rounded-xl border border-neutral-200 dark:border-neutral-800 flex items-center justify-between">
                            <div class="space-y-1">
                                <p class="text-xs font-bold text-neutral-900 dark:text-white">Banner Mitra & Klien (Marquee)</p>
                                <p class="text-[11px] text-neutral-500">Menampilkan deretan nama mitra yang berjalan di bawah hero.</p>
                                <Link href="/admin/partners" class="inline-block text-[11px] text-brand-600 dark:text-brand-400 font-bold hover:underline">
                                    Kelola Data Mitra ({{ syncStats.partners?.total || 0 }}) →
                                </Link>
                            </div>
                            <label class="cursor-pointer">
                                <input
                                    type="checkbox"
                                    :checked="form.show_partner_marquee === '1'"
                                    @change="form.show_partner_marquee = ($event.target as HTMLInputElement).checked ? '1' : '0'"
                                    class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500"
                                />
                            </label>
                        </div>

                        <!-- Layanan -->
                        <div class="p-4 rounded-xl border border-neutral-200 dark:border-neutral-800 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-neutral-900 dark:text-white">Section Layanan & Solusi</p>
                                <p class="text-[11px] text-neutral-500">Menampilkan katalog kartu layanan website aktif.</p>
                            </div>
                            <label class="cursor-pointer">
                                <input
                                    type="checkbox"
                                    :checked="form.show_services === '1'"
                                    @change="form.show_services = ($event.target as HTMLInputElement).checked ? '1' : '0'"
                                    class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500"
                                />
                            </label>
                        </div>

                        <!-- Portofolio -->
                        <div class="p-4 rounded-xl border border-neutral-200 dark:border-neutral-800 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-neutral-900 dark:text-white">Section Portofolio Proyek</p>
                                <p class="text-[11px] text-neutral-500">Menampilkan showcase hasil karya proyek dengan filter kategori.</p>
                            </div>
                            <label class="cursor-pointer">
                                <input
                                    type="checkbox"
                                    :checked="form.show_portfolio === '1'"
                                    @change="form.show_portfolio = ($event.target as HTMLInputElement).checked ? '1' : '0'"
                                    class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500"
                                />
                            </label>
                        </div>

                        <!-- Paket Harga -->
                        <div class="p-4 rounded-xl border border-neutral-200 dark:border-neutral-800 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-neutral-900 dark:text-white">Section Paket Investasi & Harga</p>
                                <p class="text-[11px] text-neutral-500">Menampilkan tabel kartu harga paket website aktif.</p>
                            </div>
                            <label class="cursor-pointer">
                                <input
                                    type="checkbox"
                                    :checked="form.show_pricing === '1'"
                                    @change="form.show_pricing = ($event.target as HTMLInputElement).checked ? '1' : '0'"
                                    class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500"
                                />
                            </label>
                        </div>

                        <!-- Why Us -->
                        <div class="p-4 rounded-xl border border-neutral-200 dark:border-neutral-800 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-neutral-900 dark:text-white">Section Mengapa Memilih Kami (Why Us)</p>
                                <p class="text-[11px] text-neutral-500">Menampilkan kartu perbandingan nilai jual & keunggulan Swift Code.</p>
                            </div>
                            <label class="cursor-pointer">
                                <input
                                    type="checkbox"
                                    :checked="form.show_why_us === '1'"
                                    @change="form.show_why_us = ($event.target as HTMLInputElement).checked ? '1' : '0'"
                                    class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500"
                                />
                            </label>
                        </div>

                        <!-- Testimoni -->
                        <div class="p-4 rounded-xl border border-neutral-200 dark:border-neutral-800 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-neutral-900 dark:text-white">Section Testimoni Klien</p>
                                <p class="text-[11px] text-neutral-500">Menampilkan ulasan dan rating bintang klien terverifikasi.</p>
                            </div>
                            <label class="cursor-pointer">
                                <input
                                    type="checkbox"
                                    :checked="form.show_testimonials === '1'"
                                    @change="form.show_testimonials = ($event.target as HTMLInputElement).checked ? '1' : '0'"
                                    class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500"
                                />
                            </label>
                        </div>

                        <!-- FAQ -->
                        <div class="p-4 rounded-xl border border-neutral-200 dark:border-neutral-800 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-neutral-900 dark:text-white">Section FAQ (Pertanyaan Umum)</p>
                                <p class="text-[11px] text-neutral-500">Menampilkan akordeon pertanyaan yang sering diajukan calon klien.</p>
                            </div>
                            <label class="cursor-pointer">
                                <input
                                    type="checkbox"
                                    :checked="form.show_faq === '1'"
                                    @change="form.show_faq = ($event.target as HTMLInputElement).checked ? '1' : '0'"
                                    class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500"
                                />
                            </label>
                        </div>

                        <!-- Artikel -->
                        <div class="p-4 rounded-xl border border-neutral-200 dark:border-neutral-800 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-neutral-900 dark:text-white">Section Artikel & Edukasi</p>
                                <p class="text-[11px] text-neutral-500">Menampilkan 3 artikel blog edukasi bisnis terbaru.</p>
                            </div>
                            <label class="cursor-pointer">
                                <input
                                    type="checkbox"
                                    :checked="form.show_articles === '1'"
                                    @change="form.show_articles = ($event.target as HTMLInputElement).checked ? '1' : '0'"
                                    class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500"
                                />
                            </label>
                        </div>

                        <!-- Formulir Kontak -->
                        <div class="p-4 rounded-xl border border-neutral-200 dark:border-neutral-800 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-neutral-900 dark:text-white">Section Formulir Kontak & Pemesanan</p>
                                <p class="text-[11px] text-neutral-500">Menampilkan formulir konsultasi cepat dan info kontak WhatsApp.</p>
                            </div>
                            <label class="cursor-pointer">
                                <input
                                    type="checkbox"
                                    :checked="form.show_contact === '1'"
                                    @change="form.show_contact = ($event.target as HTMLInputElement).checked ? '1' : '0'"
                                    class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500"
                                />
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Action Button Bar -->
                <div class="p-6 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-neutral-500">
                        Perubahan akan langsung diperbarui di beranda publik dan cache disinkronkan otomatis.
                    </p>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md shadow-brand-600/30 disabled:opacity-50 transition-all cursor-pointer"
                    >
                        <svg v-if="form.processing" class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <svg v-else class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ form.processing ? 'Menyimpan Pengaturan...' : 'Simpan Perubahan Beranda' }}</span>
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
