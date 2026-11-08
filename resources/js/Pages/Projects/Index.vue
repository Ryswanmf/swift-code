<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import ProjectCard, { ProjectItem } from '@/Components/Public/ProjectCard.vue';

const props = defineProps<{
    projects: ProjectItem[];
    settings?: Record<string, string>;
}>();

const activeCategory = ref<'all' | 'company' | 'sekolah' | 'toko' | 'sistem'>('all');

const projectList = computed(() => props.projects || []);

const filteredProjects = computed(() => {
    if (activeCategory.value === 'all') {
        return projectList.value;
    }
    return projectList.value.filter((p) => p.category === activeCategory.value);
});

const getCategoryCount = (key: string) => {
    if (key === 'all') return projectList.value.length;
    return projectList.value.filter((p) => p.category === key).length;
};

const categories = [
    { key: 'all', label: 'Semua Proyek' },
    { key: 'company', label: 'Company Profile' },
    { key: 'sekolah', label: 'Sekolah & Institusi' },
    { key: 'toko', label: 'Toko Online' },
    { key: 'sistem', label: 'Sistem Custom' },
] as const;

const page = usePage();
const whatsappNumber = computed(() => {
    const raw = (page.props as any).siteSettings?.whatsapp || props.settings?.whatsapp || '62895325852575';
    return String(raw).replace(/[^0-9]/g, '');
});

const waUrl = computed(() => {
    const text = 'Halo Swift Code Lampung, saya melihat galeri portofolio website Anda dan ingin berkonsultasi mengenai pembuatan website untuk bisnis saya.';
    return `https://wa.me/${whatsappNumber.value}?text=${encodeURIComponent(text)}`;
});
</script>

<template>
    <Head>
        <title>Portofolio Proyek Website Profesional Lampung | Swift Code</title>
        <meta
            name="description"
            content="Kumpulan karya nyata pembuatan website perusahaan, toko online, website sekolah, dan sistem informasi kustom terbaik buatan Swift Code Lampung."
        />
        <meta property="og:title" content="Portofolio Proyek Website Profesional Lampung - Swift Code" />
        <meta
            property="og:description"
            content="Jelajahi hasil karya website modern, mobile-friendly, dan berkecepatan tinggi yang telah kami kembangkan untuk klien di Lampung dan sekitarnya."
        />
    </Head>

    <PublicLayout>
        <!-- 1. Header Banner Section (Signature Brand Red Gradient) -->
        <section class="relative pt-28 pb-12 sm:pt-32 sm:pb-16 bg-gradient-to-r from-brand-800 via-brand-600 to-rose-600 text-white overflow-hidden shadow-inner">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
                <!-- Breadcrumbs -->
                <div class="flex items-center justify-center">
                    <nav class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 border border-white/20 text-xs font-medium text-white/90 backdrop-blur-xs">
                        <Link href="/" class="hover:text-white transition-colors">Beranda</Link>
                        <span>/</span>
                        <span class="text-white font-bold">Portofolio</span>
                    </nav>
                </div>

                <!-- Headline -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white leading-tight">
                    Portofolio Proyek <br class="hidden sm:inline" />
                    <span>Pilihan Kami</span>
                </h1>

                <!-- Subheadline -->
                <p class="text-base sm:text-lg text-white/90 max-w-2xl mx-auto leading-relaxed">
                    Jelajahi berbagai karya website perusahaan, instansi sekolah, toko online, dan sistem kustom yang kami kembangkan dengan teknologi modern dan performa tinggi di Lampung.
                </p>
            </div>
        </section>

        <!-- 2. Main Gallery Section -->
        <section class="py-12 sm:py-16 bg-white min-h-[60vh]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Filter Tabs with Count Badges -->
                <div class="flex flex-wrap items-center justify-center gap-2 mb-10 sm:mb-12">
                    <button
                        v-for="cat in categories"
                        :key="cat.key"
                        type="button"
                        @click="activeCategory = cat.key"
                        :class="[
                            'inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all cursor-pointer',
                            activeCategory === cat.key
                                ? 'bg-brand-600 text-white shadow-md shadow-brand-600/30'
                                : 'bg-neutral-100 text-neutral-700 hover:bg-neutral-200 border border-neutral-200/80',
                        ]"
                    >
                        <span>{{ cat.label }}</span>
                        <span
                            :class="[
                                'px-1.5 py-0.5 rounded-md text-[10px] font-bold',
                                activeCategory === cat.key
                                    ? 'bg-white/20 text-white'
                                    : 'bg-neutral-200 text-neutral-600',
                            ]"
                        >
                            {{ getCategoryCount(cat.key) }}
                        </span>
                    </button>
                </div>

                <!-- 3 Columns Projects Grid -->
                <div
                    v-if="filteredProjects.length > 0"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8"
                >
                    <ProjectCard
                        v-for="project in filteredProjects"
                        :key="project.slug"
                        :project="project"
                    />
                </div>

                <!-- Empty State -->
                <div
                    v-else
                    class="text-center py-16 p-8 rounded-2xl bg-neutral-50 border border-neutral-200 max-w-md mx-auto"
                >
                    <div class="w-12 h-12 mx-auto rounded-full bg-neutral-200 flex items-center justify-center text-neutral-500 mb-3">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <p class="text-base font-bold text-neutral-900">Belum Ada Proyek</p>
                    <p class="text-xs text-neutral-500 mt-1">Belum ada karya yang dipublikasikan pada kategori ini.</p>
                </div>

                <!-- 3. Call to Action Banner -->
                <div class="mt-16 sm:mt-20 p-8 sm:p-12 rounded-3xl bg-gradient-to-r from-brand-800 via-brand-600 to-rose-600 text-white shadow-xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="space-y-2 text-center md:text-left">
                        <h3 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                            Ingin Memiliki Website Seperti Ini?
                        </h3>
                        <p class="text-sm sm:text-base text-white/90 max-w-xl leading-relaxed">
                            Konsultasikan kebutuhan pembuatan website Anda bersama tim Swift Code Lampung. Kami siap wujudkan kehadiran digital terbaik bisnis Anda.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center gap-3 shrink-0">
                        <a
                            :href="waUrl"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="px-6 py-3.5 bg-white text-brand-700 hover:bg-neutral-100 font-bold text-xs sm:text-sm rounded-xl shadow-lg transition-transform hover:scale-105 active:scale-95 text-center whitespace-nowrap"
                        >
                            Konsultasi WhatsApp Gratis
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
