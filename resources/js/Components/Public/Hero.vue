<script setup lang="ts">
const stats = [
    { label: 'Proyek Selesai', value: '50+' },
    { label: 'Tingkat Kepuasan', value: '99%' },
    { label: 'Waktu Rilis Cepat', value: '3-7 Hari' },
    { label: 'Optimasi Mobile & SEO', value: '100%' },
];
</script>

<template>
    <section id="hero" class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden">
        <!-- Ambient background glow effects -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[350px] bg-brand-500/10 dark:bg-brand-600/15 blur-[120px] rounded-full pointer-events-none -z-10"></div>
        <div class="absolute -top-24 right-0 w-96 h-96 bg-brand-700/10 blur-[100px] rounded-full pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                <!-- Left column: Copy & CTA -->
                <div class="lg:col-span-7 text-center lg:text-left space-y-6">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-50 dark:bg-brand-950/60 border border-brand-200/80 dark:border-brand-800/60 text-brand-700 dark:text-brand-300 text-xs sm:text-sm font-semibold shadow-xs">
                        <span class="flex h-2 w-2 rounded-full bg-brand-600 animate-pulse"></span>
                        <span>Jasa Pembuatan Website Terpercaya di Lampung</span>
                    </div>

                    <!-- Main Headline -->
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-neutral-900 dark:text-white leading-[1.15]">
                        Tingkatkan Kredibilitas Bisnis Anda dengan <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 via-brand-500 to-rose-600">Website Profesional</span>
                    </h1>

                    <!-- Subheadline -->
                    <p class="text-base sm:text-lg text-neutral-600 dark:text-neutral-300 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        Kami merancang landing page konversi tinggi, company profile elegan, website sekolah, dan sistem kustom yang cepat, responsif di HP, dan mudah ditemukan calon klien lewat Google.
                    </p>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a
                            href="#kontak"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 text-base font-semibold text-white bg-brand-600 hover:bg-brand-700 active:bg-brand-800 rounded-xl shadow-lg shadow-brand-600/30 transition-all duration-200 hover:-translate-y-0.5"
                        >
                            <span>Konsultasi Gratis Sekarang</span>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a
                            href="#portofolio"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 text-base font-semibold text-neutral-800 dark:text-neutral-200 bg-neutral-100 hover:bg-neutral-200 dark:bg-neutral-900 dark:hover:bg-neutral-800 border border-neutral-300/80 dark:border-neutral-800 rounded-xl transition-all duration-200"
                        >
                            <span>Lihat Portofolio</span>
                        </a>
                    </div>

                    <!-- Micro Trust Indicators -->
                    <div class="pt-4 flex flex-wrap items-center justify-center lg:justify-start gap-y-2 gap-x-6 text-xs text-neutral-500 dark:text-neutral-400">
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Tanpa Ribet Coding</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Domain & Hosting Siap Pakai</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Garansi Perbaikan & Support</span>
                        </div>
                    </div>
                </div>

                <!-- Right column: Interactive Visual Card -->
                <div class="lg:col-span-5 relative">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <!-- Background glow frame -->
                        <div class="absolute -inset-1 rounded-3xl bg-gradient-to-r from-brand-600 to-rose-600 opacity-20 blur-xl"></div>

                        <!-- Card UI Mockup -->
                        <div class="relative rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-2xl p-6 sm:p-7 space-y-6">
                            <!-- Window Titlebar -->
                            <div class="flex items-center justify-between pb-4 border-b border-neutral-100 dark:border-neutral-800">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                                    <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                                    <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                                </div>
                                <span class="text-xs font-mono font-medium text-neutral-400">swiftcode-preview.id</span>
                                <div class="w-12"></div>
                            </div>

                            <!-- Showcase Metric Banner -->
                            <div class="bg-gradient-to-br from-brand-600/10 via-brand-500/5 to-transparent border border-brand-500/20 rounded-xl p-4 flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-neutral-500 dark:text-neutral-400 font-medium">Google Lighthouse Score</p>
                                    <p class="text-2xl font-black text-brand-600 dark:text-brand-400 mt-0.5">98 / 100</p>
                                </div>
                                <div class="w-12 h-12 rounded-full border-4 border-emerald-500 flex items-center justify-center font-bold text-emerald-600 dark:text-emerald-400 text-xs">
                                    A+
                                </div>
                            </div>

                            <!-- Sample Project Preview Snippet -->
                            <div class="space-y-3">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="font-bold text-neutral-700 dark:text-neutral-200">Keunggulan Desain</span>
                                    <span class="text-emerald-500 font-semibold">Siap Pakai</span>
                                </div>
                                <div class="space-y-2">
                                    <div class="p-3 rounded-xl bg-neutral-50 dark:bg-neutral-800/60 border border-neutral-100 dark:border-neutral-800 flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-brand-100 dark:bg-brand-900/50 text-brand-600 dark:text-brand-400 flex items-center justify-center text-sm font-bold">
                                            ⚡
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold text-neutral-900 dark:text-white">Kecepatan Loading Tinggi</p>
                                            <p class="text-[11px] text-neutral-500">LCP &lt; 1.8s di jaringan mobile 4G</p>
                                        </div>
                                    </div>
                                    <div class="p-3 rounded-xl bg-neutral-50 dark:bg-neutral-800/60 border border-neutral-100 dark:border-neutral-800 flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-sm font-bold">
                                            📱
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold text-neutral-900 dark:text-white">Responsif Semua Perangkat</p>
                                            <p class="text-[11px] text-neutral-500">Tampilan sempurna dari HP hingga layar lebar</p>
                                        </div>
                                    </div>
                                    <div class="p-3 rounded-xl bg-neutral-50 dark:bg-neutral-800/60 border border-neutral-100 dark:border-neutral-800 flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 flex items-center justify-center text-sm font-bold">
                                            🔍
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold text-neutral-900 dark:text-white">SEO Friendly Google</p>
                                            <p class="text-[11px] text-neutral-500">Struktur Schema.org, Open Graph & Sitemap</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Live preview pill -->
                            <div class="pt-2 flex items-center justify-between text-xs text-neutral-500">
                                <span class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    Siap Terima Proyek Baru
                                </span>
                                <span class="font-mono text-brand-600 dark:text-brand-400 font-bold">@swiftcode.lpg</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Bar -->
            <div class="mt-16 pt-10 border-t border-neutral-200 dark:border-neutral-800/80 grid grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    v-for="stat in stats"
                    :key="stat.label"
                    class="text-center p-4 rounded-xl bg-neutral-50/60 dark:bg-neutral-900/40 border border-neutral-100 dark:border-neutral-800/50"
                >
                    <p class="text-3xl sm:text-4xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
                        {{ stat.value }}
                    </p>
                    <p class="text-xs sm:text-sm font-medium text-neutral-500 dark:text-neutral-400 mt-1">
                        {{ stat.label }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
