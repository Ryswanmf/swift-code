<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

export interface ProjectItem {
    id?: number;
    title: string;
    slug: string;
    category: string;
    summary: string;
    client_name?: string;
    live_url?: string;
    cover_image?: string;
    tech_stack?: string[];
}

defineProps<{
    project: ProjectItem;
}>();

const categoryLabels: Record<string, string> = {
    company: 'Company Profile',
    sekolah: 'Sekolah & Institusi',
    toko: 'Toko Online',
    sistem: 'Sistem Custom',
};
</script>

<template>
    <div
        class="group rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 overflow-hidden shadow-xs hover:shadow-xl hover:border-brand-500/40 transition-all duration-300 hover:-translate-y-1 flex flex-col justify-between"
    >
        <div>
            <!-- Browser Mockup Chrome Header -->
            <div class="px-3.5 py-2 bg-neutral-100 dark:bg-neutral-950/80 border-b border-neutral-200/80 dark:border-neutral-800 flex items-center justify-between">
                <div class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-neutral-300 dark:bg-neutral-700"></span>
                    <span class="w-2 h-2 rounded-full bg-neutral-300 dark:bg-neutral-700"></span>
                    <span class="w-2 h-2 rounded-full bg-neutral-300 dark:bg-neutral-700"></span>
                </div>
                <span class="text-[10px] font-mono text-neutral-400 dark:text-neutral-500 truncate max-w-[160px]">
                    {{ project.live_url ? project.live_url.replace('https://', '') : `${project.slug}.id` }}
                </span>
                <span class="px-1.5 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider bg-white dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">
                    {{ categoryLabels[project.category] || project.category }}
                </span>
            </div>

            <!-- Cover Image Container -->
            <div class="relative aspect-video w-full overflow-hidden bg-neutral-100 dark:bg-neutral-950">
                <img
                    v-if="project.cover_image"
                    :src="project.cover_image"
                    :alt="project.title"
                    loading="lazy"
                    class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105"
                />
                <!-- Fallback Crisp Preview when image is loading / empty -->
                <div
                    v-else
                    class="w-full h-full flex flex-col items-center justify-center p-6 bg-gradient-to-br from-neutral-900 to-black text-neutral-300 group-hover:from-brand-950/80 group-hover:to-black transition-colors"
                >
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-brand-400 mb-2 ring-1 ring-white/10">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-white text-center">{{ project.title }}</span>
                    <span class="text-[10px] text-neutral-400 mt-1">Studi Kasus Swift Code Lampung</span>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-6">
                <!-- Client Meta -->
                <div v-if="project.client_name" class="text-xs font-semibold text-brand-600 dark:text-brand-400 mb-1 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span>
                    <span>Klien: {{ project.client_name }}</span>
                </div>

                <!-- Title -->
                <h3 class="text-lg font-extrabold text-neutral-900 dark:text-white group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors line-clamp-1">
                    {{ project.title }}
                </h3>

                <!-- Summary -->
                <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-400 mt-2 line-clamp-2 leading-relaxed">
                    {{ project.summary }}
                </p>

                <!-- Tech Stack tags -->
                <div v-if="project.tech_stack && project.tech_stack.length > 0" class="flex flex-wrap gap-1.5 mt-4">
                    <span
                        v-for="tech in project.tech_stack"
                        :key="tech"
                        class="px-2 py-0.5 text-[10px] font-mono rounded bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200/80 dark:border-neutral-700/80"
                    >
                        {{ tech }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Card Footer -->
        <div class="px-6 pb-5 pt-3 flex items-center justify-between border-t border-neutral-100 dark:border-neutral-800 mt-2">
            <Link
                :href="`/portofolio/${project.slug}`"
                class="inline-flex items-center gap-1.5 text-xs font-bold text-neutral-900 dark:text-white hover:text-brand-600 dark:hover:text-brand-400 transition-colors"
            >
                <span>Lihat Studi Kasus</span>
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </Link>

            <a
                v-if="project.live_url"
                :href="project.live_url"
                target="_blank"
                rel="noopener noreferrer"
                class="text-xs font-medium text-neutral-500 hover:text-brand-600 dark:hover:text-brand-400 flex items-center gap-1 transition-colors"
                title="Kunjungi website langsung"
            >
                <span>Buka Web</span>
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
            </a>
        </div>
    </div>
</template>
