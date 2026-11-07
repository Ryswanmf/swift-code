<script setup lang="ts">
withDefaults(
    defineProps<{
        size?: 'sm' | 'md' | 'lg';
        showText?: boolean;
        inverted?: boolean;
    }>(),
    {
        size: 'md',
        showText: true,
        inverted: false,
    },
);
</script>

<template>
    <div class="inline-flex items-center gap-3 group select-none">
        <!-- Logo Icon Image -->
        <img
            src="/images/logo.png"
            alt="Swift Code Lampung"
            :class="{
                'w-8 h-8': size === 'sm',
                'w-10 h-10': size === 'md',
                'w-12 h-12': size === 'lg',
            }"
            class="object-contain transition-transform duration-300 group-hover:scale-105 shrink-0"
        />

        <!-- Typography -->
        <div v-if="showText" class="flex flex-col">
            <span
                :class="[
                    {
                        'text-base': size === 'sm',
                        'text-xl': size === 'md',
                        'text-2xl': size === 'lg',
                    },
                    inverted ? 'text-white' : 'text-neutral-900',
                ]"
                class="font-extrabold tracking-tight flex items-center gap-1 leading-none"
            >
                Swift<span class="text-brand-600">Code</span>
            </span>
            <span
                :class="[
                    {
                        'text-[9px]': size === 'sm',
                        'text-[10px]': size === 'md',
                        'text-xs': size === 'lg',
                    },
                    inverted ? 'text-neutral-400' : 'text-neutral-500',
                ]"
                class="font-semibold tracking-widest uppercase mt-0.5"
            >
                Lampung
            </span>
        </div>
    </div>
</template>
