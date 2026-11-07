<script setup lang="ts">
import { ref, computed } from 'vue';

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

const faqId = computed(() => {
    return props.faq.id
        ? `faq-${props.faq.id}`
        : `faq-${props.faq.question.toLowerCase().replace(/[^a-z0-9]/g, '-').slice(0, 30)}`;
});
</script>

<template>
    <div
        :class="[
            'border rounded-2xl transition-all duration-200 overflow-hidden',
            isOpen
                ? 'bg-white dark:bg-neutral-900 border-brand-500/40 dark:border-brand-500/40 shadow-xs'
                : 'bg-white dark:bg-neutral-900/70 border-neutral-200/90 dark:border-neutral-800 hover:border-neutral-300 dark:hover:border-neutral-700',
        ]"
    >
        <button
            type="button"
            @click="toggle"
            class="w-full py-4 sm:py-5 px-5 sm:px-6 flex items-center justify-between text-left gap-4 select-none focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 cursor-pointer"
            :aria-expanded="isOpen"
            :aria-controls="faqId"
        >
            <span
                :class="[
                    'font-bold text-sm sm:text-base transition-colors leading-snug',
                    isOpen
                        ? 'text-brand-600 dark:text-brand-400'
                        : 'text-neutral-900 dark:text-white',
                ]"
            >
                {{ faq.question }}
            </span>
            <span
                :class="[
                    'w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-all duration-200',
                    isOpen
                        ? 'bg-brand-50 dark:bg-brand-950/80 text-brand-600 dark:text-brand-400 rotate-180'
                        : 'bg-neutral-100 dark:bg-neutral-800 text-neutral-500 dark:text-neutral-400',
                ]"
            >
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </span>
        </button>

        <transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="opacity-0 -translate-y-1"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 -translate-y-1"
        >
            <div
                v-show="isOpen"
                :id="faqId"
                class="px-5 sm:px-6 pb-5 sm:pb-6 text-xs sm:text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed border-t border-neutral-100 dark:border-neutral-800 pt-3.5"
            >
                {{ faq.answer }}
            </div>
        </transition>
    </div>
</template>
