<script setup lang="ts">
const reasons = [
    {
        id: 'design',
        title: 'Desain Unik & Profesional',
        description: 'Tampilan website dibuat khusus sesuai karakter brand bisnis Anda, bukan sekadar salin-tempel template murahan.',
    },
    {
        id: 'speed',
        title: 'Performa Super Kilat (Lighthouse 90+)',
        description: 'Website dibangun dengan kode bersih, kompresi gambar WebP otomatis, dan server cepat agar pengunjung tidak kabur karena loading lama.',
    },
    {
        id: 'seo',
        title: 'Siap Bersaing di Google (SEO Lokal)',
        description: 'Dilengkapi metadata lengkap, schema.org LocalBusiness, sitemap otomatis, dan kata kunci lokal untuk mendominasi pencarian di Lampung.',
    },
    {
        id: 'chat',
        title: 'Langsung Terhubung ke WhatsApp',
        description: 'Setiap formulir dan tombol aksi dirancang mengarahkan calon pembeli langsung ke chat WhatsApp Anda dalam satu klik.',
    },
    {
        id: 'cms',
        title: 'Panel Kelola Konten Praktis',
        description: 'Ubah teks, portofolio, dan nomor kontak kapan saja tanpa perlu paham bahasa pemrograman.',
    },
    {
        id: 'warranty',
        title: 'Garansi & Pendampingan Penuh',
        description: 'Kami tidak lepas tangan setelah website selesai. Ada garansi error, SSL gratis, dan konsultasi lanjutan.',
    },
];
</script>

<template>
    <section id="keunggulan" class="pt-12 sm:pt-14 pb-20 lg:pb-28 bg-white dark:bg-neutral-950 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-14 space-y-3">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
                    Website Anda Bukan Sekadar Pajangan, Tapi <span class="text-brand-600">Mesin Penjual</span>
                </h2>
                <p class="text-base text-neutral-600 dark:text-neutral-400 leading-relaxed">
                    Lebih dari 80% calon pembeli memeriksa website sebelum bertransaksi. Jangan biarkan kompetitor merebut peluang Anda hanya karena tidak memiliki kehadiran digital yang meyakinkan.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div
                    v-for="(item, idx) in reasons"
                    :key="item.title"
                    class="p-7 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/80 dark:border-neutral-800 shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between"
                >
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 dark:bg-brand-950/50 text-brand-600 dark:text-brand-400 flex items-center justify-center shrink-0">
                            <!-- Design -->
                            <svg v-if="item.id === 'design'" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4 5 5 0 013-4.5V10a5 5 0 0110 0v2.5A5 5 0 0119 17a4 4 0 01-4 4H7zM12 3v4m0 0a2 2 0 100 4 2 2 0 000-4z" />
                            </svg>
                            <!-- Speed -->
                            <svg v-else-if="item.id === 'speed'" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <!-- SEO -->
                            <svg v-else-if="item.id === 'seo'" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <!-- Chat -->
                            <svg v-else-if="item.id === 'chat'" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <!-- CMS -->
                            <svg v-else-if="item.id === 'cms'" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <!-- Warranty -->
                            <svg v-else class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-neutral-900 dark:text-white">
                            {{ item.title }}
                        </h3>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">
                            {{ item.description }}
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-neutral-100 dark:border-neutral-800/80 flex items-center justify-between text-xs text-neutral-400">
                        <span>Keunggulan #0{{ idx + 1 }}</span>
                        <span class="text-emerald-500 font-semibold">✓ Standar Swift Code</span>
                    </div>
                </div>
            </div>

            <!-- Callout Banner -->
            <div class="mt-14 p-8 sm:p-10 rounded-3xl bg-gradient-to-r from-brand-700 via-brand-600 to-rose-600 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="space-y-2 text-center md:text-left">
                    <h3 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                        Sudah Punya Ide Website untuk Usaha Anda?
                    </h3>
                    <p class="text-sm sm:text-base text-white/80 max-w-xl">
                        Ceritakan konsep bisnis Anda kepada tim kami. Kami berikan saran strategi dan estimasi pengerjaan tanpa biaya.
                    </p>
                </div>
                <a
                    href="#kontak"
                    class="shrink-0 px-6 py-3.5 bg-white hover:bg-neutral-100 text-brand-700 font-bold text-sm rounded-xl shadow-lg transition-transform hover:scale-105"
                >
                    Diskusikan Sekarang
                </a>
            </div>
        </div>
    </section>
</template>
