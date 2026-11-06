<script setup lang="ts">
withDefaults(
    defineProps<{
        size?: 'sm' | 'md' | 'lg';
        showText?: boolean;
    }>(),
    {
        size: 'md',
        showText: true,
    },
);
</script>

<template>
    <div class="inline-flex items-center gap-3 group select-none">
        <!-- Logo Icon -->
        <div
            :class="{
                'w-8 h-8 rounded-lg text-sm': size === 'sm',
                'w-10 h-10 rounded-xl text-base': size === 'md',
                'w-12 h-12 rounded-2xl text-lg': size === 'lg',
            }"
            class="relative flex items-center justify-center bg-gradient-to-br from-brand-600 via-brand-700 to-brand-800 text-white font-bold shadow-lg shadow-brand-600/25 ring-1 ring-white/20 transition-transform duration-300 group-hover:scale-105"
        >
            <!-- Code Tab Motif SVG -->
            <svg
                class="w-3/5 h-3/5 text-white drop-shadow-sm"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2.5"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <!-- Left angle bracket -->
                <polyline points="7 8 3 12 7 16" />
                <!-- Slash / S spine -->
                <line x1="14" y1="5" x2="10" y2="19" />
                <!-- Right angle bracket -->
                <polyline points="17 8 21 12 17 16" />
            </svg>

            <!-- Subtle top shine -->
            <div class="absolute inset-x-0 top-0 h-1/2 bg-white/15 rounded-t-[inherit]"></div>
        </div>

        <!-- Typography -->
        <div v-if="showText" class="flex flex-col">
            <span
                :class="{
                    'text-base': size === 'sm',
                    'text-xl': size === 'md',
                    'text-2xl': size === 'lg',
                }"
                class="font-extrabold tracking-tight text-neutral-900 dark:text-white flex items-center gap-1 leading-none"
            >
                Swift<span class="text-brand-600">Code</span>
            </span>
            <span
                :class="{
                    'text-[9px]': size === 'sm',
                    'text-[10px]': size === 'md',
                    'text-xs': size === 'lg',
                }"
                class="font-semibold tracking-widest text-neutral-500 dark:text-neutral-400 uppercase mt-0.5"
            >
                Lampung
            </span>
        </div>
    </div>
</template>
