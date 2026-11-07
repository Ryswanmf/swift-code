<script setup lang="ts">
export interface ServiceItem {
    id?: number;
    icon: string;
    title: string;
    description: string;
    badge?: string;
    timeline?: string;
    target?: string;
    features?: string[];
}

defineProps<{
    service: ServiceItem;
}>();
</script>

<template>
    <div
        class="group relative p-7 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs hover:shadow-xl hover:border-brand-500/40 transition-all duration-300 hover:-translate-y-1 flex flex-col justify-between"
    >
        <div>
            <!-- Header: Icon & Category Badge -->
            <div class="flex items-center justify-between mb-5">
                <div
                    class="w-12 h-12 rounded-xl bg-brand-50 dark:bg-brand-950/60 border border-brand-200 dark:border-brand-800/80 text-brand-600 dark:text-brand-400 flex items-center justify-center group-hover:bg-brand-600 group-hover:text-white transition-all duration-300 shrink-0"
                >
                    <!-- Landing page / Speed -->
                    <svg v-if="service.icon === 'rocket'" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <!-- Company profile / Building -->
                    <svg v-else-if="service.icon === 'building'" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <!-- School / Academic -->
                    <svg v-else-if="service.icon === 'academic'" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5" />
                    </svg>
                    <!-- Store / Cart -->
                    <svg v-else-if="service.icon === 'cart'" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <!-- Custom system / Code -->
                    <svg v-else-if="service.icon === 'code'" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                    <!-- Redesign & SEO / Tool -->
                    <svg v-else-if="service.icon === 'tool'" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <!-- Default fallback SVG -->
                    <svg v-else class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>

                <div class="flex items-center gap-2">
                    <span
                        v-if="service.timeline"
                        class="text-[10px] font-mono text-neutral-500 dark:text-neutral-400 bg-neutral-100 dark:bg-neutral-800 px-2 py-0.5 rounded border border-neutral-200/80 dark:border-neutral-700/80 flex items-center gap-1"
                    >
                        <svg class="w-3 h-3 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ service.timeline }}</span>
                    </span>

                    <span
                        v-if="service.badge"
                        class="text-[10px] font-bold tracking-wider uppercase px-2.5 py-0.5 rounded-full bg-brand-50 dark:bg-brand-950/80 text-brand-700 dark:text-brand-300 border border-brand-200/60 dark:border-brand-800/60"
                    >
                        {{ service.badge }}
                    </span>
                </div>
            </div>

            <!-- Title -->
            <h3 class="text-lg sm:text-xl font-extrabold text-neutral-900 dark:text-white mb-2 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">
                {{ service.title }}
            </h3>

            <!-- Target Audience Note -->
            <p v-if="service.target" class="text-xs font-semibold text-brand-600 dark:text-brand-400 mb-2">
                Sasaran: {{ service.target }}
            </p>

            <!-- Description -->
            <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed mb-4">
                {{ service.description }}
            </p>

            <!-- Key Inclusions -->
            <div v-if="service.features && service.features.length > 0" class="space-y-1.5 pt-1">
                <div
                    v-for="(feat, fIdx) in service.features"
                    :key="fIdx"
                    class="flex items-center gap-2 text-xs text-neutral-700 dark:text-neutral-300"
                >
                    <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ feat }}</span>
                </div>
            </div>
        </div>

        <!-- Action Footer -->
        <div class="pt-5 mt-5 border-t border-neutral-100 dark:border-neutral-800 flex items-center justify-between">
            <a
                href="#kontak"
                class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-600 dark:text-brand-400 hover:text-brand-700 dark:hover:text-brand-300 transition-colors"
            >
                <span>Konsultasikan Layanan</span>
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            <span class="text-[11px] text-neutral-400">RAB Gratis</span>
        </div>
    </div>
</template>
