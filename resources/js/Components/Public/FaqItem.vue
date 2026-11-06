<script setup lang="ts">
import { ref } from 'vue';

export interface FaqData {
    id?: number;
    question: string;
    answer: string;
}

const props = defineProps<{
    faq: FaqData;
    isOpenDefault?: boolean;
}>();

const isOpen = ref(props.isOpenDefault || false);

const toggle = () => {
    isOpen.value = !isOpen.value;
};
</script>

<template>
    <div
        class="border border-neutral-200/90 dark:border-neutral-800 rounded-2xl bg-white dark:bg-neutral-900 transition-colors duration-200 overflow-hidden"
    >
        <button
            type="button"
            @click="toggle"
            class="w-full py-5 px-6 flex items-center justify-between text-left gap-4 select-none focus:outline-none"
            :aria-expanded="isOpen"
        >
            <span class="font-bold text-neutral-900 dark:text-white text-base">
                {{ faq.question }}
            </span>
            <span
                :class="[
                    'w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-transform duration-200',
                    isOpen
                        ? 'bg-brand-50 dark:bg-brand-950/60 text-brand-600 rotate-180'
                        : 'bg-neutral-100 dark:bg-neutral-800 text-neutral-500',
                ]"
            >
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </span>
        </button>

        <transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="opacity-0 -translate-y-2"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 -translate-y-2"
        >
            <div v-show="isOpen" class="px-6 pb-6 text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed border-t border-neutral-100 dark:border-neutral-800/80 pt-4">
                {{ faq.answer }}
            </div>
        </transition>
    </div>
</template>
