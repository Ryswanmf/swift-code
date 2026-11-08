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

const heroImage = computed(() => props.settings?.hero_image || '/images/hero-showcase.png');
const metricScore = computed(() => props.settings?.hero_metric_score || '100');
const metricLabel = computed(() => props.settings?.hero_metric_label || 'PageSpeed Score');
const metricDesc = computed(() => props.settings?.hero_metric_desc || '0.4s Super Kilat');
const mockupUrl = computed(() => props.settings?.hero_mockup_url || 'swiftcode.id');
const mockupBadge = computed(() => props.settings?.hero_mockup_badge || 'Laravel 12 • Vue 3 • Tailwind CSS');
const mockupLocation = computed(() => props.settings?.hero_mockup_location || 'Bandar Lampung');

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
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-10 items-center">
                <!-- Left column: Grounded Value Proposition & CTAs -->
                <div class="lg:col-span-7 text-center lg:text-left space-y-6">
                    <!-- Identity Badge -->
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-neutral-200 dark:border-neutral-800 bg-white dark:bg-neutral-900 shadow-xs">
                        <span class="inline-flex items-center px-2 py-0.5 rounded bg-brand-600 text-white font-bold text-[10px] tracking-wider uppercase">
                            Swift Code
                        </span>
                        <span class="text-xs font-semibold text-neutral-800 dark:text-neutral-200">
                            {{ heroBadge }}
                        </span>
                    </div>

                    <!-- Main Headline -->
                    <h1 class="text-4xl sm:text-5xl lg:text-[54px] font-extrabold tracking-tight text-neutral-900 dark:text-white leading-[1.14]">
                        {{ heroHeadline }}
                    </h1>

                    <!-- Subheadline -->
                    <p class="text-base sm:text-lg text-neutral-600 dark:text-neutral-300 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        {{ heroSubheadline }}
                    </p>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-1">
                        <a
                            :href="ctaPrimaryLink"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 text-base font-bold text-white bg-brand-600 hover:bg-brand-700 active:bg-brand-800 rounded-xl shadow-lg shadow-brand-600/25 transition-all duration-200 hover:-translate-y-0.5 cursor-pointer"
                        >
                            <span>{{ ctaPrimaryText }}</span>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        <a
                            :href="ctaSecondaryLink"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 text-base font-semibold text-neutral-800 dark:text-neutral-200 bg-white hover:bg-neutral-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 border border-neutral-300/90 dark:border-neutral-800 rounded-xl transition-all duration-200"
                        >
                            <span>{{ ctaSecondaryText }}</span>
                        </a>
                    </div>

                    <!-- Factual Trust Indicators -->
                    <div class="pt-3 flex flex-wrap items-center justify-center lg:justify-start gap-y-2.5 gap-x-6 text-xs text-neutral-600 dark:text-neutral-400">
                        <div v-if="trust1" class="flex items-center gap-1.5 font-medium">
                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>{{ trust1 }}</span>
                        </div>
                        <div v-if="trust2" class="flex items-center gap-1.5 font-medium">
                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>{{ trust2 }}</span>
                        </div>
                        <div v-if="trust3" class="flex items-center gap-1.5 font-medium">
                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>{{ trust3 }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right column: Crisp Browser Showcase Mockup -->
                <div class="lg:col-span-5 relative">
                    <div class="relative mx-auto max-w-lg lg:max-w-none select-none">
                        <!-- Subtle Focus Accent Light -->
                        <div class="absolute -top-6 -right-6 w-64 h-64 bg-brand-600/15 rounded-full blur-3xl pointer-events-none -z-10"></div>

                        <!-- Metric Badge -->
                        <div class="absolute -top-3 -right-2 sm:-right-4 z-20 flex items-center gap-2.5 px-3.5 py-2 rounded-xl bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-xl">
                            <div class="w-7 h-7 rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-black text-xs ring-1 ring-emerald-500/30">
                                {{ metricScore }}
                            </div>
                            <div>
                                <div class="text-[10px] text-neutral-500 font-medium">{{ metricLabel }}</div>
                                <div class="text-xs font-bold text-neutral-900 dark:text-white flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    {{ metricDesc }}
                                </div>
                            </div>
                        </div>

                        <!-- Browser Frame -->
                        <div class="relative rounded-2xl bg-neutral-950 p-2 border border-neutral-800 shadow-2xl overflow-hidden group">
                            <!-- Browser Chrome Bar -->
                            <div class="flex items-center justify-between px-3 py-2 rounded-t-xl bg-neutral-900/90 border-b border-white/5 mb-2">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-neutral-700"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-neutral-700"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-neutral-700"></span>
                                </div>
                                <div class="flex items-center gap-1.5 px-3 py-0.5 rounded-md bg-neutral-950/80 border border-white/5 text-[11px] text-neutral-400 font-mono">
                                    <svg class="w-3 h-3 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    <span class="text-neutral-300">{{ mockupUrl }}</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                    <span class="text-[10px] text-emerald-400 font-bold uppercase tracking-wider hidden sm:inline">Live</span>
                                </div>
                            </div>

                            <!-- Inner Image Container -->
                            <div class="relative rounded-xl overflow-hidden aspect-[4/3] sm:aspect-[16/11] bg-neutral-900">
                                <img
                                    :src="heroImage"
                                    alt="Swift Code Lampung - Modern Web Development & Digital Solution"
                                    class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                                    loading="eager"
                                    fetchpriority="high"
                                    decoding="async"
                                />

                                <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-neutral-950/70 via-transparent to-transparent"></div>

                                <div class="absolute bottom-3 right-3 z-10 flex items-center gap-2 px-3 py-1.5 rounded-lg bg-neutral-900/90 border border-white/10 text-white text-[11px] font-mono shadow-md">
                                    <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                                    <span>{{ mockupBadge }}</span>
                                </div>

                                <div v-if="mockupLocation" class="absolute bottom-3 left-3 z-10 hidden sm:flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-neutral-900/80 border border-white/10 text-neutral-300 text-[11px]">
                                    <svg class="w-3.5 h-3.5 text-brand-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>{{ mockupLocation }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Value Highlights Strip -->
            <div class="mt-16 sm:mt-20 rounded-2xl bg-white dark:bg-neutral-900/90 border border-neutral-200/90 dark:border-neutral-800 shadow-sm p-6 sm:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
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
