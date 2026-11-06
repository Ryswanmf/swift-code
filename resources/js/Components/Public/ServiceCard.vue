<script setup lang="ts">
export interface ServiceItem {
    id?: number;
    icon: string;
    title: string;
    description: string;
    badge?: string;
}

defineProps<{
    service: ServiceItem;
}>();
</script>

<template>
    <div
        class="group relative p-7 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-sm hover:shadow-xl hover:border-brand-500/50 dark:hover:border-brand-500/40 transition-all duration-300 hover:-translate-y-1 flex flex-col justify-between"
    >
        <div>
            <!-- Icon & Badge Header -->
            <div class="flex items-center justify-between mb-5">
                <div
                    class="w-13 h-13 rounded-2xl bg-brand-50 dark:bg-brand-950/60 border border-brand-200 dark:border-brand-800/80 text-brand-600 dark:text-brand-400 flex items-center justify-center text-2xl shadow-xs group-hover:scale-110 group-hover:bg-brand-600 group-hover:text-white transition-all duration-300"
                >
                    <span>{{ service.icon }}</span>
                </div>

                <span
                    v-if="service.badge"
                    class="text-[11px] font-semibold tracking-wide uppercase px-2.5 py-1 rounded-full bg-brand-50 dark:bg-brand-950/80 text-brand-700 dark:text-brand-300 border border-brand-200/60 dark:border-brand-800/60"
                >
                    {{ service.badge }}
                </span>
            </div>

            <!-- Title -->
            <h3 class="text-xl font-bold text-neutral-900 dark:text-white mb-2.5 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">
                {{ service.title }}
            </h3>

            <!-- Description -->
            <p class="text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">
                {{ service.description }}
            </p>
        </div>

        <!-- Action link -->
        <div class="pt-6 mt-4 border-t border-neutral-100 dark:border-neutral-800/80 flex items-center justify-between">
            <a
                href="#kontak"
                class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-600 dark:text-brand-400 hover:text-brand-700 group-hover:gap-2.5 transition-all"
            >
                <span>Pesan Layanan</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            <span class="text-xs text-neutral-400">Konsultasi Gratis</span>
        </div>
    </div>
</template>
