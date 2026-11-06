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
        class="group rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 overflow-hidden shadow-sm hover:shadow-xl hover:border-brand-500/50 transition-all duration-300 hover:-translate-y-1 flex flex-col justify-between"
    >
        <div>
            <!-- Cover Image Container -->
            <div class="relative aspect-video w-full overflow-hidden bg-neutral-100 dark:bg-neutral-800">
                <img
                    v-if="project.cover_image"
                    :src="project.cover_image"
                    :alt="project.title"
                    loading="lazy"
                    class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105"
                />
                <!-- Fallback Mock Cover when no image uploaded yet -->
                <div
                    v-else
                    class="w-full h-full flex flex-col items-center justify-center p-6 bg-gradient-to-br from-neutral-800 to-neutral-950 text-neutral-400 group-hover:from-brand-950 group-hover:to-neutral-950 transition-colors"
                >
                    <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center text-white mb-2">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-neutral-300">{{ project.title }}</span>
                </div>

                <!-- Category Pill Overlay -->
                <div class="absolute top-3 left-3">
                    <span class="px-2.5 py-1 text-[11px] font-bold rounded-lg bg-neutral-900/80 backdrop-blur-md text-white border border-white/10 uppercase tracking-wide">
                        {{ categoryLabels[project.category] || project.category }}
                    </span>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-6">
                <!-- Client & Meta -->
                <div v-if="project.client_name" class="text-xs font-semibold text-brand-600 dark:text-brand-400 mb-1.5">
                    Klien: {{ project.client_name }}
                </div>

                <!-- Title -->
                <h3 class="text-lg font-bold text-neutral-900 dark:text-white group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors line-clamp-1">
                    {{ project.title }}
                </h3>

                <!-- Summary -->
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-2 line-clamp-2 leading-relaxed">
                    {{ project.summary }}
                </p>

                <!-- Tech Stack tags -->
                <div v-if="project.tech_stack && project.tech_stack.length > 0" class="flex flex-wrap gap-1.5 mt-4">
                    <span
                        v-for="tech in project.tech_stack"
                        :key="tech"
                        class="px-2 py-0.5 text-[10px] font-medium rounded-md bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300"
                    >
                        {{ tech }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Card Footer -->
        <div class="px-6 pb-6 pt-2 flex items-center justify-between border-t border-neutral-100 dark:border-neutral-800/80 mt-2">
            <Link
                :href="`/portofolio/${project.slug}`"
                class="inline-flex items-center gap-1.5 text-xs font-bold text-neutral-800 dark:text-neutral-200 hover:text-brand-600 dark:hover:text-brand-400 transition-colors"
            >
                <span>Lihat Detail</span>
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </Link>

            <a
                v-if="project.live_url"
                :href="project.live_url"
                target="_blank"
                rel="noopener noreferrer"
                class="text-xs text-neutral-500 hover:text-brand-600 flex items-center gap-1 transition-colors"
                title="Kunjungi website langsung"
            >
                <span>Demo Live</span>
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
            </a>
        </div>
    </div>
</template>
