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
    <section id="hero" class="relative pt-32 pb-16 lg:pt-36 lg:pb-24 overflow-hidden bg-neutral-950 text-white">
        <!-- Tech & Red Ambient Background Elements -->
        <div class="pointer-events-none absolute inset-0 overflow-hidden -z-10 select-none">
            <!-- 1. Ambient Red Gradient Glows -->
            <div class="absolute -top-28 left-1/2 -translate-x-1/2 w-[800px] sm:w-[1100px] h-[520px] bg-[radial-gradient(ellipse_at_center,rgba(225,29,72,0.30)_0%,rgba(159,18,57,0.16)_45%,transparent_75%)] blur-[90px] rounded-full"></div>
            <div class="absolute top-1/4 left-1/5 -translate-x-1/2 w-[380px] h-[380px] bg-brand-700/18 blur-[130px] rounded-full"></div>
            <div class="absolute top-1/3 right-1/5 translate-x-1/2 w-[380px] h-[380px] bg-rose-600/16 blur-[130px] rounded-full"></div>

            <!-- 2. Tech Perspective Grid with Red Tint -->
            <div
                class="absolute inset-0 opacity-25"
                style="
                    background-image: linear-gradient(to right, rgba(244, 63, 94, 0.12) 1px, transparent 1px),
                                      linear-gradient(to bottom, rgba(244, 63, 94, 0.12) 1px, transparent 1px);
                    background-size: 48px 48px;
                    mask-image: radial-gradient(ellipse 75% 65% at 50% 30%, #000 30%, transparent 80%);
                    -webkit-mask-image: radial-gradient(ellipse 75% 65% at 50% 30%, #000 30%, transparent 80%);
                "
            ></div>

            <!-- 3. Tech Circuit SVG Geometry (Data Paths & Glowing Red Nodes) -->
            <svg class="absolute inset-0 w-full h-full opacity-40" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1440 800" fill="none">
                <!-- Circuit Tracks -->
                <path d="M-100 180 L320 180 L400 260 L700 260 L750 310 L1150 310 L1220 240 L1600 240" stroke="rgba(244, 63, 94, 0.28)" stroke-width="1.5" stroke-dasharray="6 6" />
                <path d="M-50 420 L240 420 L310 350 L580 350 L630 400 L1080 400 L1140 460 L1550 460" stroke="rgba(225, 29, 72, 0.24)" stroke-width="1.5" />
                <path d="M220 -50 L220 130 L280 190 L280 480 L340 540 L340 900" stroke="rgba(244, 63, 94, 0.18)" stroke-width="1.5" />
                <path d="M1220 -50 L1220 160 L1160 220 L1160 500 L1100 560 L1100 900" stroke="rgba(244, 63, 94, 0.18)" stroke-width="1.5" />

                <!-- Glowing Circuit Nodes (Rose & Crimson) -->
                <circle cx="400" cy="260" r="4" fill="#f43f5e" />
                <circle cx="400" cy="260" r="9" stroke="rgba(244, 63, 94, 0.45)" stroke-width="1.5" />
                <circle cx="750" cy="310" r="4" fill="#e11d48" />
                <circle cx="750" cy="310" r="9" stroke="rgba(225, 29, 72, 0.45)" stroke-width="1.5" />
                <circle cx="1220" cy="240" r="4" fill="#f43f5e" />
                <circle cx="1220" cy="240" r="9" stroke="rgba(244, 63, 94, 0.45)" stroke-width="1.5" />
                <circle cx="310" cy="350" r="3.5" fill="#e11d48" />
                <circle cx="630" cy="400" r="3.5" fill="#f43f5e" />
                <circle cx="1140" cy="460" r="3.5" fill="#e11d48" />
                <circle cx="280" cy="190" r="3.5" fill="#f43f5e" />
                <circle cx="1160" cy="220" r="3.5" fill="#f43f5e" />
            </svg>

            <!-- 4. Subtle Code Engineering Watermarks -->
            <div class="hidden xl:block absolute top-32 left-10 text-rose-500/10 font-mono text-5xl font-bold">
                &lt;code /&gt;
            </div>
            <div class="hidden xl:block absolute top-36 right-12 text-brand-500/10 font-mono text-5xl font-bold">
                { ...stack }
            </div>
            <div class="hidden xl:block absolute bottom-28 left-14 text-rose-500/10 font-mono text-3xl font-bold">
                // swift.build()
            </div>
            <div class="hidden xl:block absolute bottom-32 right-16 text-brand-500/10 font-mono text-3xl font-bold">
                &lt;laravel:vue /&gt;
            </div>

            <!-- 5. Bottom Dark Fade to Section Border -->
            <div class="absolute bottom-0 inset-x-0 h-24 bg-gradient-to-t from-neutral-950 to-transparent"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Centered 1-Column Hero Layout -->
            <div class="max-w-4xl mx-auto text-center space-y-7 sm:space-y-8">
                <!-- Identity Badge -->
                <div class="flex justify-center">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border border-brand-500/30 bg-neutral-900/90 shadow-lg shadow-brand-950/60 backdrop-blur-md">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-gradient-to-r from-brand-600 to-rose-600 text-white font-bold text-[10px] tracking-wider uppercase shadow-xs">
                            <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                            <span>Swift Code</span>
                        </span>
                        <span class="text-xs font-semibold text-neutral-200">
                            {{ heroBadge }}
                        </span>
                    </div>
                </div>

                <!-- Main Headline -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-[1.14]">
                    {{ heroHeadline }}
                </h1>

                <!-- Subheadline -->
                <p class="text-base sm:text-lg lg:text-xl text-neutral-300 max-w-3xl mx-auto leading-relaxed">
                    {{ heroSubheadline }}
                </p>

                <!-- CTAs -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                    <a
                        :href="ctaPrimaryLink"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-bold text-white bg-gradient-to-r from-brand-600 via-rose-600 to-brand-700 hover:from-brand-500 hover:to-rose-500 rounded-xl shadow-xl shadow-brand-600/35 transition-all duration-200 hover:-translate-y-0.5 cursor-pointer border border-white/10"
                    >
                        <span>{{ ctaPrimaryText }}</span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a
                        :href="ctaSecondaryLink"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-semibold text-white bg-neutral-900/80 hover:bg-neutral-800/90 border border-neutral-700/80 hover:border-brand-500/60 rounded-xl transition-all duration-200 shadow-md backdrop-blur-md"
                    >
                        <span>{{ ctaSecondaryText }}</span>
                    </a>
                </div>

                <!-- Factual Trust Indicators -->
                <div class="pt-3 flex flex-wrap items-center justify-center gap-y-3 gap-x-8 text-xs sm:text-sm text-neutral-300">
                    <div v-if="trust1" class="flex items-center gap-2 font-medium">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ trust1 }}</span>
                    </div>
                    <div v-if="trust2" class="flex items-center gap-2 font-medium">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ trust2 }}</span>
                    </div>
                    <div v-if="trust3" class="flex items-center gap-2 font-medium">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ trust3 }}</span>
                    </div>
                </div>
            </div>

            <!-- Value Highlights Strip -->
            <div class="mt-16 sm:mt-20 rounded-2xl bg-neutral-900/85 backdrop-blur-xl border border-neutral-800/90 shadow-2xl p-6 sm:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 text-center sm:text-left">
                    <div
                        v-for="(item, idx) in highlights"
                        :key="item.label"
                        :class="[
                            idx !== 0 ? 'sm:border-l sm:border-neutral-800 sm:pl-6' : '',
                            'space-y-1',
                        ]"
                    >
                        <p class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight font-mono">
                            {{ item.title }}
                        </p>
                        <p class="text-xs font-bold text-brand-400 uppercase tracking-wider">
                            {{ item.label }}
                        </p>
                        <p class="text-xs text-neutral-400 leading-relaxed pt-1">
                            {{ item.desc }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
