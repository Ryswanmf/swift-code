<script setup lang="ts">
export interface TestimonialItem {
    id?: number;
    name: string;
    role?: string;
    company?: string;
    quote: string;
    avatar?: string;
    rating?: number;
}

defineProps<{
    testimonial: TestimonialItem;
}>();
</script>

<template>
    <div
        class="p-7 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-100 dark:border-neutral-800 shadow-xl shadow-black/15 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 flex flex-col justify-between"
    >
        <!-- Stars Rating -->
        <div>
            <div class="flex items-center gap-1 mb-4 text-amber-400">
                <svg
                    v-for="star in 5"
                    :key="star"
                    class="w-4 h-4 fill-current"
                    viewBox="0 0 20 20"
                >
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
            </div>

            <!-- Quote -->
            <p class="text-sm text-neutral-700 dark:text-neutral-300 italic leading-relaxed mb-6">
                "{{ testimonial.quote }}"
            </p>
        </div>

        <!-- Author info -->
        <div class="flex items-center gap-3 pt-4 border-t border-neutral-100 dark:border-neutral-800">
            <div class="w-10 h-10 rounded-full bg-brand-100 dark:bg-brand-900/60 text-brand-700 dark:text-brand-300 font-bold flex items-center justify-center text-sm shrink-0">
                <img
                    v-if="testimonial.avatar"
                    :src="testimonial.avatar"
                    :alt="testimonial.name"
                    class="w-full h-full rounded-full object-cover"
                />
                <span v-else>{{ testimonial.name.charAt(0) }}</span>
            </div>
            <div>
                <p class="text-sm font-bold text-neutral-900 dark:text-white leading-tight">
                    {{ testimonial.name }}
                </p>
                <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-0.5">
                    {{ testimonial.role }}<span v-if="testimonial.company">, {{ testimonial.company }}</span>
                </p>
            </div>
        </div>
    </div>
</template>
