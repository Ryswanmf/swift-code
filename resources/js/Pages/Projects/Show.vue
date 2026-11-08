<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import PublicLayout from '../../Layouts/PublicLayout.vue';
import ProjectCard, { ProjectItem } from '../../Components/Public/ProjectCard.vue';

export interface FullProject extends ProjectItem {
    description?: string;
    gallery?: string[];
    created_at?: string;
}

const props = defineProps<{
    project: FullProject;
    relatedProjects?: ProjectItem[];
    settings?: Record<string, string>;
}>();

const categoryLabels: Record<string, string> = {
    company: 'Company Profile',
    sekolah: 'Sekolah & Institusi',
    toko: 'Toko Online',
    sistem: 'Sistem Custom',
};

const page = usePage();
const consultationWaUrl = computed(() => {
    const wa = (page.props as any).siteSettings?.whatsapp || props.settings?.whatsapp || '62895325852575';
    const cleanWa = String(wa).replace(/[^0-9]/g, '');
    const text = `Halo Swift Code Lampung, saya melihat portofolio *${props.project.title}* dan ingin membuat website serupa untuk bisnis saya.`;
    return `https://wa.me/${cleanWa}?text=${encodeURIComponent(text)}`;
});
const projectSchema = computed(() =>
    JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'CreativeWork',
        name: props.project.title,
        description: props.project.summary,
        creator: {
            '@type': 'Organization',
            name: 'Swift Code Lampung',
        },
        image: props.project.cover_image || undefined,
    })
);
</script>

<template>
    <Head>
        <title>{{ project.title }} - Portofolio Swift Code Lampung</title>
        <meta name="description" :content="project.summary" />
        <link rel="canonical" :href="`/portofolio/${project.slug}`" />

        <!-- Open Graph -->
        <meta property="og:type" content="article" />
        <meta property="og:title" :content="`${project.title} | Swift Code Lampung`" />
        <meta property="og:description" :content="project.summary" />
        <meta v-if="project.cover_image" property="og:image" :content="project.cover_image" />
        <meta property="og:site_name" content="Swift Code Lampung" />
        <meta property="og:locale" content="id_ID" />

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" :content="`${project.title} | Swift Code Lampung`" />
        <meta name="twitter:description" :content="project.summary" />
        <meta v-if="project.cover_image" name="twitter:image" :content="project.cover_image" />

        <!-- Structured Data -->
        <component :is="'script'" type="application/ld+json" v-html="projectSchema" />
    </Head>

    <PublicLayout>
        <article class="pt-28 pb-20 lg:pt-36 lg:pb-28">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Breadcrumb -->
                <nav class="flex items-center gap-2 text-xs text-neutral-500 mb-8">
                    <Link href="/" class="hover:text-brand-600 transition-colors">Beranda</Link>
                    <span>/</span>
                    <Link href="/portofolio" class="hover:text-brand-600 transition-colors">Portofolio</Link>
                    <span>/</span>
                    <span class="text-neutral-900 font-medium truncate max-w-xs">{{ project.title }}</span>
                </nav>

                <!-- Header Info -->
                <div class="space-y-4 mb-10">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="px-3 py-1 text-xs font-bold rounded-lg bg-brand-50 text-brand-700 border border-brand-200/60 uppercase tracking-wide">
                            {{ categoryLabels[project.category] || project.category }}
                        </span>
                        <span v-if="project.client_name" class="text-xs font-medium text-neutral-500">
                            Klien: <strong class="text-neutral-800">{{ project.client_name }}</strong>
                        </span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-neutral-900 tracking-tight leading-tight">
                        {{ project.title }}
                    </h1>

                    <p class="text-base sm:text-lg text-neutral-600 max-w-3xl leading-relaxed">
                        {{ project.summary }}
                    </p>

                    <!-- Actions -->
                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a
                            v-if="project.live_url"
                            :href="project.live_url"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-6 py-3 text-sm font-bold text-white bg-brand-600 hover:bg-brand-700 active:bg-brand-800 rounded-xl shadow-md shadow-brand-600/25 transition-all duration-200"
                        >
                            <span>Kunjungi Website Live</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>

                        <a
                            :href="consultationWaUrl"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-neutral-800 bg-neutral-100 hover:bg-neutral-200 rounded-xl transition-colors"
                        >
                            <span>Pesan Website Seperti Ini</span>
                        </a>
                    </div>
                </div>

                <!-- Main Project Image / Showcase -->
                <div class="mb-12 rounded-3xl overflow-hidden border border-neutral-200 bg-neutral-100 shadow-xl">
                    <img
                        v-if="project.cover_image"
                        :src="project.cover_image"
                        :alt="project.title"
                        class="w-full aspect-[16/9] object-cover object-top"
                    />
                    <div
                        v-else
                        class="w-full aspect-[16/9] flex flex-col items-center justify-center p-8 bg-gradient-to-br from-neutral-800 to-neutral-950 text-neutral-300"
                    >
                        <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center text-white mb-3">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-base font-bold text-white">{{ project.title }}</p>
                        <p class="text-xs text-neutral-400 mt-1">Showcase Portofolio Resmi Swift Code Lampung</p>
                    </div>
                </div>

                <!-- Two columns: Project Story & Specs sidebar -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                    <!-- Left: Description and Gallery -->
                    <div class="lg:col-span-8 space-y-8">
                        <div>
                            <h2 class="text-xl font-bold text-neutral-900 mb-4">
                                Gambaran & Solusi Proyek
                            </h2>
                            <div class="prose max-w-none text-neutral-700 leading-relaxed space-y-4 text-base">
                                <p>{{ project.description || project.summary }}</p>
                            </div>
                        </div>

                        <!-- Gallery Photos if any -->
                        <div v-if="project.gallery && project.gallery.length > 0" class="pt-4 space-y-4">
                            <h3 class="text-lg font-bold text-neutral-900">
                                Galeri Tampilan Halaman
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div
                                    v-for="(img, idx) in project.gallery"
                                    :key="idx"
                                    class="rounded-2xl overflow-hidden border border-neutral-200 shadow-sm aspect-video bg-neutral-100"
                                >
                                    <img
                                        :src="img"
                                        :alt="`${project.title} - Galeri ${idx + 1}`"
                                        loading="lazy"
                                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Sidebar: Project Meta Details -->
                    <div class="lg:col-span-4 space-y-6">
                        <div class="p-6 rounded-2xl bg-neutral-50 border border-neutral-200/90 space-y-5">
                            <h3 class="text-sm font-bold text-neutral-900 uppercase tracking-wider">
                                Informasi Proyek
                            </h3>

                            <div class="space-y-4 text-sm divide-y divide-neutral-200/60">
                                <div class="pt-2 flex justify-between items-center">
                                    <span class="text-neutral-500">Kategori</span>
                                    <span class="font-semibold text-neutral-900">
                                        {{ categoryLabels[project.category] || project.category }}
                                    </span>
                                </div>

                                <div v-if="project.client_name" class="pt-3 flex justify-between items-center">
                                    <span class="text-neutral-500">Klien</span>
                                    <span class="font-semibold text-neutral-900">
                                        {{ project.client_name }}
                                    </span>
                                </div>

                                <div class="pt-3">
                                    <span class="block text-neutral-500 mb-2">Teknologi Digunakan</span>
                                    <div class="flex flex-wrap gap-1.5">
                                        <span
                                            v-for="tech in project.tech_stack || ['Laravel', 'Vue.js', 'Tailwind CSS']"
                                            :key="tech"
                                            class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-white text-neutral-800 border border-neutral-200"
                                        >
                                            {{ tech }}
                                        </span>
                                    </div>
                                </div>

                                <div class="pt-3 flex justify-between items-center">
                                    <span class="text-neutral-500">Garansi & Support</span>
                                    <span class="font-semibold text-emerald-600">Aktif</span>
                                </div>
                            </div>

                            <!-- CTA in sidebar -->
                            <div class="pt-4 border-t border-neutral-200">
                                <a
                                    :href="consultationWaUrl"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="w-full py-3 px-4 rounded-xl font-bold text-center text-xs text-white bg-brand-600 hover:bg-brand-700 active:bg-brand-800 block shadow-md transition-all"
                                >
                                    Konsultasi Proyek Serupa
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Projects Section -->
                <div v-if="relatedProjects && relatedProjects.length > 0" class="mt-20 pt-16 border-t border-neutral-200">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <span class="text-xs font-bold text-brand-600 uppercase tracking-widest">Karya Lainnya</span>
                            <h2 class="text-2xl font-extrabold text-neutral-900 mt-1">
                                Portofolio Terkait
                            </h2>
                        </div>
                        <Link href="/portofolio" class="text-xs font-bold text-brand-600 hover:text-brand-700">
                            Lihat Semua →
                        </Link>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <ProjectCard
                            v-for="rel in relatedProjects"
                            :key="rel.slug"
                            :project="rel"
                        />
                    </div>
                </div>
            </div>
        </article>
    </PublicLayout>
</template>
