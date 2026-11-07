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
                    <!-- Modern Tech Badge (No curved pill shape) -->
                    <div class="inline-flex items-center rounded-lg border border-neutral-200 dark:border-neutral-800 bg-white/70 dark:bg-neutral-900/70 backdrop-blur-md p-1 shadow-xs">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md bg-brand-600 text-white font-bold text-[11px] tracking-wider uppercase">
                            Swift Code
                        </span>
                        <span class="px-3 text-xs sm:text-sm font-semibold text-neutral-800 dark:text-neutral-200">
                            Jasa Pembuatan Website Lampung
                        </span>
                    </div>

                    <!-- Main Headline -->
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-neutral-900 dark:text-white leading-[1.15]">
                        Swift Code – Your Business, <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 via-brand-500 to-rose-600">Our Digital Solution.</span>
                    </h1>

                    <!-- Subheadline -->
                    <p class="text-base sm:text-lg text-neutral-600 dark:text-neutral-300 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        Swift Code adalah penyedia jasa pembuatan website di Lampung yang membantu bisnis, UMKM, sekolah, dan instansi mengembangkan kehadiran digital.
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

                <!-- Right column: Modern 3D Web Showcase Illustration & Interactive Browser Mockup -->
                <div class="lg:col-span-5 relative">
                    <div class="relative mx-auto max-w-lg lg:max-w-none select-none">
                        <!-- Multi-color Ambient Glows Behind Showcase -->
                        <div class="absolute -top-12 -left-12 w-80 h-80 bg-brand-600/25 rounded-full blur-3xl pointer-events-none -z-10 animate-pulse" style="animation-duration: 6s;"></div>
                        <div class="absolute -bottom-10 -right-10 w-80 h-80 bg-rose-600/25 rounded-full blur-3xl pointer-events-none -z-10"></div>
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-amber-500/10 rounded-full blur-2xl pointer-events-none -z-10"></div>

                        <!-- Floating Badge Top Left: Client Satisfaction & Rating -->
                        <div class="absolute -top-4 -left-2 sm:-left-5 z-20 flex items-center gap-2.5 px-3.5 py-2 rounded-2xl bg-white/95 dark:bg-neutral-900/95 border border-neutral-200/90 dark:border-neutral-800 shadow-xl backdrop-blur-md transition-transform hover:-translate-y-0.5">
                            <div class="flex items-center text-amber-400 text-xs">
                                <span>★★★★★</span>
                            </div>
                            <div class="h-3.5 w-px bg-neutral-200 dark:bg-neutral-800"></div>
                            <span class="text-xs font-extrabold text-neutral-900 dark:text-white">4.9/5</span>
                            <span class="text-[10px] text-neutral-500">50+ Klien</span>
                        </div>

                        <!-- Floating Badge Top Right: Speed Metric Core Web Vitals -->
                        <div class="absolute -top-4 -right-2 sm:-right-5 z-20 flex items-center gap-2.5 px-3.5 py-2 rounded-2xl bg-white/95 dark:bg-neutral-900/95 border border-neutral-200/90 dark:border-neutral-800 shadow-xl backdrop-blur-md transition-transform hover:-translate-y-0.5">
                            <div class="w-7 h-7 rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-black text-xs ring-1 ring-emerald-500/30">
                                100
                            </div>
                            <div>
                                <div class="text-[10px] text-neutral-500 font-medium">PageSpeed Score</div>
                                <div class="text-xs font-bold text-neutral-900 dark:text-white flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    0.4s Super Kilat
                                </div>
                            </div>
                        </div>

                        <!-- Floating Badge Bottom Left: Growth & Conversion Metric -->
                        <div class="absolute -bottom-5 -left-2 sm:-left-5 z-20 flex items-center gap-3 px-4 py-2.5 rounded-2xl bg-white/95 dark:bg-neutral-900/95 border border-neutral-200/90 dark:border-neutral-800 shadow-xl backdrop-blur-md transition-transform hover:-translate-y-0.5">
                            <div class="w-8 h-8 rounded-xl bg-brand-500/10 text-brand-600 dark:text-brand-400 flex items-center justify-center shrink-0 ring-1 ring-brand-500/30">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs font-extrabold text-neutral-900 dark:text-white">Tingkat Konversi +280%</div>
                                <div class="text-[10px] text-neutral-500">Desain Modern & SEO Siap Google</div>
                            </div>
                        </div>

                        <!-- Floating Badge Bottom Right: Responsive & Multi-device -->
                        <div class="absolute -bottom-5 -right-2 sm:-right-5 z-20 hidden sm:flex items-center gap-2.5 px-3.5 py-2 rounded-2xl bg-neutral-950/90 text-white border border-white/10 shadow-xl backdrop-blur-md transition-transform hover:-translate-y-0.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                            <span class="text-[11px] font-semibold text-neutral-200">Mobile, Tablet & PC</span>
                        </div>

                        <!-- Main Modern Device / Browser Showcase Frame -->
                        <div class="relative rounded-3xl bg-neutral-950 p-2 sm:p-2.5 border border-neutral-800 shadow-2xl ring-1 ring-white/10 overflow-hidden group">
                            <!-- Browser Chrome Bar -->
                            <div class="flex items-center justify-between px-3.5 py-2 rounded-t-2xl bg-neutral-900/90 border-b border-white/5 mb-2">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500/80"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500/80"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500/80"></span>
                                </div>
                                <div class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-neutral-950/70 border border-white/5 text-[11px] text-neutral-400 font-mono">
                                    <svg class="w-3 h-3 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    <span class="text-neutral-300">swiftcode.id</span>
                                    <span class="text-neutral-500 hidden sm:inline">/preview</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                    <span class="text-[10px] text-emerald-400 font-bold uppercase tracking-wider hidden sm:inline">Live</span>
                                </div>
                            </div>

                            <!-- Inner Image Container with High-End 3D Visual -->
                            <div class="relative rounded-2xl overflow-hidden aspect-[4/3] sm:aspect-[16/11] bg-neutral-900">
                                <img
                                    src="/images/hero-showcase.png"
                                    alt="Swift Code Lampung - Modern Web Development & Digital Solution"
                                    class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                                    loading="eager"
                                />

                                <!-- Gradient Ambient Overlay for seamless blend -->
                                <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-neutral-950/70 via-neutral-950/10 to-transparent"></div>

                                <!-- Floating Glass Tag inside visual: Tech Architecture -->
                                <div class="absolute bottom-3 right-3 z-10 flex items-center gap-2 px-3 py-1.5 rounded-xl bg-neutral-900/90 backdrop-blur-md border border-white/10 text-white text-[11px] font-mono shadow-lg">
                                    <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                                    <span>Laravel 12 • Vue 3 • Tailwind CSS</span>
                                </div>

                                <!-- Floating Status inside visual: Lampung Digital Agency -->
                                <div class="absolute bottom-3 left-3 z-10 hidden sm:flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-neutral-900/80 backdrop-blur-md border border-white/10 text-neutral-300 text-[11px]">
                                    <span class="text-brand-500 font-bold">⚡</span>
                                    <span>Bandar Lampung, Indonesia</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Bar with Red Gradient Background -->
            <div class="mt-16 p-5 sm:p-8 rounded-3xl bg-gradient-to-r from-brand-800 via-brand-600 to-rose-600 shadow-xl shadow-brand-700/20 relative overflow-hidden">
                <!-- Background Ambient Highlights -->
                <div class="absolute -top-12 -right-12 w-48 h-48 bg-white/15 rounded-full blur-2xl pointer-events-none"></div>
                <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-black/20 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                    <div
                        v-for="stat in stats"
                        :key="stat.label"
                        class="text-center p-4 sm:p-5 rounded-2xl bg-white/10 backdrop-blur-xs border border-white/15 transition-transform hover:-translate-y-0.5"
                    >
                        <p class="text-3xl sm:text-4xl font-black text-white tracking-tight drop-shadow-xs">
                            {{ stat.value }}
                        </p>
                        <p class="text-xs sm:text-sm font-medium text-white/90 mt-1.5 leading-snug">
                            {{ stat.label }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
