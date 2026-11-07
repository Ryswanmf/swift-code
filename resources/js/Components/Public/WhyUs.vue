<script setup lang="ts">
const coreStrengths = [
    {
        id: 'seo',
        title: 'Optimasi Google & SEO Lokal Lampung',
        desc: 'Dilengkapi Schema.org LocalBusiness, sitemap otomatis, dan kata kunci lokal agar bisnis Anda mudah ditemukan calon pembeli terdekat.',
        tag: 'Ditemukan di Google',
    },
    {
        id: 'chat',
        title: 'Konversi Langsung ke WhatsApp',
        desc: 'Setiap tombol pemesanan dan formulir langsung mengarahkan pengunjung ke chat WhatsApp admin Anda dengan format pesan rapi.',
        tag: 'Konversi Instan',
    },
    {
        id: 'cms',
        title: 'Dashboard Kelola Konten Praktis',
        desc: 'Ubah teks profil, tambah foto portofolio, atau perbarui kontak bisnis kapan saja dengan mudah tanpa perlu paham koding.',
        tag: 'Mudah Dikelola',
    },
    {
        id: 'warranty',
        title: 'Garansi & Dukungan Teknis Purna Jual',
        desc: 'Kami tidak lepas tangan setelah serah terima. Anda mendapatkan proteksi SSL, perbaikan error teknis, dan konsultasi lanjutan.',
        tag: 'Pendampingan Penuh',
    },
];
</script>

<template>
    <section id="keunggulan" class="py-16 sm:py-20 lg:py-28 bg-white dark:bg-neutral-950 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-14 sm:mb-16 space-y-3">
                <span class="text-xs sm:text-sm font-bold tracking-widest uppercase text-brand-600 dark:text-brand-400">
                    Standar Kualitas Swift Code
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
                    Website Anda Bukan Sekadar Pajangan, Tapi <span class="text-brand-600">Alat Penjualan Nyata</span>
                </h2>
                <p class="text-base text-neutral-600 dark:text-neutral-400 leading-relaxed">
                    Calon pelanggan di Lampung kini selalu mengecek kredibilitas bisnis lewat internet sebelum membeli. Website yang lambat dan berantakan membuat mereka langsung beralih ke kompetitor.
                </p>
            </div>

            <!-- Asymmetrical Feature Layout (Replaces Uniform Copy-Paste Cards) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch mb-12">
                <!-- Flagship Spotlight Card (Left 5 Cols): Real Comparison Problem vs Solution -->
                <div class="lg:col-span-5 p-7 sm:p-8 rounded-3xl bg-neutral-950 text-white border border-neutral-800 shadow-xl flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute -top-16 -right-16 w-48 h-48 bg-brand-600/20 rounded-full blur-3xl pointer-events-none"></div>

                    <div class="space-y-6 relative z-10">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-brand-600/20 border border-brand-500/30 text-brand-400 text-xs font-bold uppercase tracking-wider">
                            <span>⚡ Performa Utama</span>
                        </div>

                        <div>
                            <h3 class="text-2xl font-extrabold tracking-tight text-white leading-snug">
                                Kecepatan Akses Tinggi &amp; Tampilan Mobile Sempurna
                            </h3>
                            <p class="text-sm text-neutral-400 mt-2 leading-relaxed">
                                Pengunjung rata-rata meninggalkan website jika loading lebih dari 3 detik. Swift Code membangun website dengan kompresi modern dan struktur kode yang sangat ringan.
                            </p>
                        </div>

                        <!-- Real Side-by-side Technical Contrast -->
                        <div class="space-y-3 pt-2">
                            <div class="p-4 rounded-xl bg-neutral-900/90 border border-neutral-800 text-xs space-y-1.5">
                                <div class="flex items-center justify-between font-bold">
                                    <span class="text-neutral-400">Website Konvensional / Template Berat</span>
                                    <span class="text-rose-400">Lambat</span>
                                </div>
                                <p class="text-neutral-500 leading-normal">
                                    Loading 4 - 8 detik, font berantakan di layar HP, pengunjung frustrasi sebelum membaca penawaran Anda.
                                </p>
                            </div>

                            <div class="p-4 rounded-xl bg-brand-950/40 border border-brand-500/40 text-xs space-y-1.5 ring-1 ring-brand-500/20">
                                <div class="flex items-center justify-between font-bold">
                                    <span class="text-white">Standar Website Swift Code</span>
                                    <span class="text-emerald-400">⚡ &lt; 1 Detik</span>
                                </div>
                                <p class="text-neutral-300 leading-normal">
                                    Skor Lighthouse 90+, navigasi sentuh instan, gambar otomatis terkompresi WebP, dan siap dibuka di jaringan 4G.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-4 border-t border-neutral-800/80 flex items-center justify-between text-xs text-neutral-400">
                        <span class="font-mono text-neutral-400">Core Web Vitals Validated</span>
                        <span class="text-emerald-400 font-semibold">100% Mobile Ready</span>
                    </div>
                </div>

                <!-- 4 Supporting Pillars Grid (Right 7 Cols) -->
                <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div
                        v-for="item in coreStrengths"
                        :key="item.id"
                        class="p-6 rounded-2xl bg-neutral-50/80 dark:bg-neutral-900/60 border border-neutral-200/90 dark:border-neutral-800 flex flex-col justify-between hover:border-brand-500/50 transition-colors"
                    >
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="px-2.5 py-0.5 rounded-md bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 text-[11px] font-bold text-neutral-700 dark:text-neutral-300">
                                    {{ item.tag }}
                                </span>

                                <div class="w-8 h-8 rounded-lg bg-brand-50 dark:bg-brand-950/50 text-brand-600 dark:text-brand-400 flex items-center justify-center shrink-0">
                                    <!-- SEO -->
                                    <svg v-if="item.id === 'seo'" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <!-- Chat -->
                                    <svg v-else-if="item.id === 'chat'" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <!-- CMS -->
                                    <svg v-else-if="item.id === 'cms'" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <!-- Warranty -->
                                    <svg v-else class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                            </div>

                            <h4 class="text-base font-bold text-neutral-900 dark:text-white leading-snug">
                                {{ item.title }}
                            </h4>

                            <p class="text-xs text-neutral-600 dark:text-neutral-400 leading-relaxed">
                                {{ item.desc }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Callout Card: Replaces Loud Gradient with High-Contrast Dark Card -->
            <div class="rounded-3xl bg-neutral-900 dark:bg-neutral-900/90 border border-neutral-800 p-8 sm:p-10 shadow-xl flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
                <div class="absolute -left-10 -bottom-10 w-48 h-48 bg-brand-600/15 rounded-full blur-3xl pointer-events-none"></div>

                <div class="space-y-2 text-center md:text-left relative z-10">
                    <h3 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                        Sudah Punya Rencana Website untuk Usaha Anda?
                    </h3>
                    <p class="text-sm text-neutral-400 max-w-xl leading-relaxed">
                        Konsultasikan konsep bisnis Anda dengan tim kami di Lampung. Dapatkan rekomendasi struktur website dan estimasi biaya tanpa dipungut biaya.
                    </p>
                </div>

                <a
                    href="#kontak"
                    class="relative z-10 shrink-0 px-6 py-3.5 bg-brand-600 hover:bg-brand-700 active:bg-brand-800 text-white font-bold text-sm rounded-xl shadow-lg shadow-brand-600/25 transition-all duration-200 hover:-translate-y-0.5 cursor-pointer"
                >
                    Konsultasi Gratis Sekarang
                </a>
            </div>
        </div>
    </section>
</template>
