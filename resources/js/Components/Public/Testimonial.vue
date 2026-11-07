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
        class="p-7 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 flex flex-col justify-between relative overflow-hidden"
    >
        <!-- Subtle Quote Graphic Accent -->
        <div class="absolute -top-3 -right-2 text-neutral-100 dark:text-neutral-800/40 text-7xl font-serif pointer-events-none select-none -z-0">
            “
        </div>

        <div class="relative z-10">
            <!-- Stars Rating & Verified Badge -->
            <div class="flex items-center justify-between gap-1 mb-4">
                <div class="flex items-center text-amber-400 text-xs gap-0.5">
                    <svg
                        v-for="star in (testimonial.rating || 5)"
                        :key="star"
                        class="w-4 h-4 fill-current"
                        viewBox="0 0 20 20"
                    >
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>

                <span class="inline-flex items-center gap-1 text-[10px] font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/50 px-2 py-0.5 rounded-md border border-emerald-200/60 dark:border-emerald-800/50">
                    <svg class="w-3 h-3 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Klien Terverifikasi</span>
                </span>
            </div>

            <!-- Quote Text -->
            <p class="text-xs sm:text-sm text-neutral-700 dark:text-neutral-300 leading-relaxed mb-6">
                “{{ testimonial.quote }}”
            </p>
        </div>

        <!-- Author info -->
        <div class="flex items-center gap-3 pt-4 border-t border-neutral-100 dark:border-neutral-800 relative z-10">
            <div class="w-10 h-10 rounded-full bg-brand-50 dark:bg-brand-950/60 text-brand-700 dark:text-brand-300 font-extrabold flex items-center justify-center text-sm shrink-0 border border-brand-200/60 dark:border-brand-800/60">
                <img
                    v-if="testimonial.avatar"
                    :src="testimonial.avatar"
                    :alt="testimonial.name"
                    class="w-full h-full rounded-full object-cover"
                />
                <span v-else>{{ testimonial.name.charAt(0) }}</span>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-xs sm:text-sm font-bold text-neutral-900 dark:text-white leading-tight truncate">
                    {{ testimonial.name }}
                </p>
                <p class="text-[11px] text-neutral-500 dark:text-neutral-400 mt-0.5 truncate">
                    {{ testimonial.role }}<span v-if="testimonial.company"> • {{ testimonial.company }}</span>
                </p>
            </div>
        </div>
    </div>
</template>
