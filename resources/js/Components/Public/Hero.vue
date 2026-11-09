<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{
    settings?: Record<string, string>;
}>();

const heroBadge = computed(() => props.settings?.hero_badge || 'Jasa Pembuatan Website Lampung');
const heroHeadline = computed(() => props.settings?.hero_headline || 'Bangun Website Bisnis yang Kredibel, Cepat, & Siap Datangkan Pelanggan.');
const heroSubheadline = computed(() => props.settings?.hero_subheadline || 'Kami merancang landing page, company profile, dan toko online untuk UMKM hingga perusahaan di Lampung. Siap online dalam 3–7 hari, ringan diakses di HP, serta mudah ditemukan calon klien lewat Google.');

const ctaPrimaryText = computed(() => props.settings?.hero_cta_primary_text || 'Konsultasi Gratis Sekarang');
const ctaPrimaryLink = computed(() => props.settings?.hero_cta_primary_link || '#kontak');
const ctaSecondaryText = computed(() => props.settings?.hero_cta_secondary_text || 'Lihat Hasil Portofolio');
const ctaSecondaryLink = computed(() => props.settings?.hero_cta_secondary_link || '#portofolio');

const trust1 = computed(() => props.settings?.hero_trust_1 || 'Domain & Cloud Hosting Termasuk');
const trust2 = computed(() => props.settings?.hero_trust_2 || 'Struktur SEO & Kecepatan Dioptimasi');
const trust3 = computed(() => props.settings?.hero_trust_3 || 'Garansi Perbaikan & Dukungan');

const highlights = computed(() => [
    {
        title: props.settings?.hero_highlight_1_title || '3 – 7 Hari',
        label: props.settings?.hero_highlight_1_label || 'Estimasi Rilis Cepat',
        desc: props.settings?.hero_highlight_1_desc || 'Website siap online tepat waktu tanpa menunggu berbulan-bulan.',
    },
    {
        title: props.settings?.hero_highlight_2_title || '100% Responsif',
        label: props.settings?.hero_highlight_2_label || 'Optimal di Semua Layar',
        desc: props.settings?.hero_highlight_2_desc || 'Navigasi ringan dan nyaman diakses dari smartphone maupun PC.',
    },
    {
        title: props.settings?.hero_highlight_3_title || 'Domain & SSL',
        label: props.settings?.hero_highlight_3_label || 'Siap Pakai Lengkap',
        desc: props.settings?.hero_highlight_3_desc || 'Termasuk konfigurasi domain resmi, hosting cloud, dan keamanan SSL.',
    },
    {
        title: props.settings?.hero_highlight_4_title || 'Garansi Teknis',
        label: props.settings?.hero_highlight_4_label || 'Dukungan Pasca Rilis',
        desc: props.settings?.hero_highlight_4_desc || 'Bantuan pemeliharaan dan panduan pengelolaan konten website.',
    },
]);
</script>

<template>
    <section id="hero" class="relative pt-32 pb-16 lg:pt-36 lg:pb-24 overflow-hidden bg-neutral-50/50 dark:bg-neutral-950">
        <!-- Single Subtle Ambient Accent -->
        <div class="absolute top-12 left-1/2 -translate-x-1/2 w-[720px] h-[360px] bg-brand-600/10 dark:bg-brand-600/15 blur-[140px] rounded-full pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Centered 1-Column Hero Layout -->
            <div class="max-w-4xl mx-auto text-center space-y-7 sm:space-y-8">
                <!-- Identity Badge -->
                <div class="flex justify-center">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border border-neutral-200 dark:border-neutral-800 bg-white dark:bg-neutral-900 shadow-xs backdrop-blur-xs">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-brand-600 text-white font-bold text-[10px] tracking-wider uppercase">
                            Swift Code
                        </span>
                        <span class="text-xs font-semibold text-neutral-800 dark:text-neutral-200">
                            {{ heroBadge }}
                        </span>
                    </div>
                </div>

                <!-- Main Headline -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-neutral-900 dark:text-white leading-[1.14]">
                    {{ heroHeadline }}
                </h1>

                <!-- Subheadline -->
                <p class="text-base sm:text-lg lg:text-xl text-neutral-600 dark:text-neutral-300 max-w-3xl mx-auto leading-relaxed">
                    {{ heroSubheadline }}
                </p>

                <!-- CTAs -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                    <a
                        :href="ctaPrimaryLink"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-bold text-white bg-brand-600 hover:bg-brand-700 active:bg-brand-800 rounded-xl shadow-lg shadow-brand-600/25 transition-all duration-200 hover:-translate-y-0.5 cursor-pointer"
                    >
                        <span>{{ ctaPrimaryText }}</span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a
                        :href="ctaSecondaryLink"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-semibold text-neutral-800 dark:text-neutral-200 bg-white hover:bg-neutral-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 border border-neutral-300/90 dark:border-neutral-800 rounded-xl transition-all duration-200 shadow-xs"
                    >
                        <span>{{ ctaSecondaryText }}</span>
                    </a>
                </div>

                <!-- Factual Trust Indicators -->
                <div class="pt-3 flex flex-wrap items-center justify-center gap-y-3 gap-x-8 text-xs sm:text-sm text-neutral-600 dark:text-neutral-400">
                    <div v-if="trust1" class="flex items-center gap-2 font-medium">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ trust1 }}</span>
                    </div>
                    <div v-if="trust2" class="flex items-center gap-2 font-medium">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ trust2 }}</span>
                    </div>
                    <div v-if="trust3" class="flex items-center gap-2 font-medium">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ trust3 }}</span>
                    </div>
                </div>
            </div>

            <!-- Value Highlights Strip -->
            <div class="mt-16 sm:mt-20 rounded-2xl bg-white dark:bg-neutral-900/90 border border-neutral-200/90 dark:border-neutral-800 shadow-sm p-6 sm:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 text-center sm:text-left">
                    <div
                        v-for="(item, idx) in highlights"
                        :key="item.label"
                        :class="[
                            idx !== 0 ? 'sm:border-l sm:border-neutral-200/80 dark:sm:border-neutral-800 sm:pl-6' : '',
                            'space-y-1',
                        ]"
                    >
                        <p class="text-2xl sm:text-3xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
                            {{ item.title }}
                        </p>
                        <p class="text-xs font-bold text-brand-600 dark:text-brand-400 uppercase tracking-wider">
                            {{ item.label }}
                        </p>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400 leading-relaxed pt-1">
                            {{ item.desc }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
