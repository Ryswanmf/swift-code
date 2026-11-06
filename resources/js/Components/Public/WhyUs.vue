<script setup lang="ts">
const reasons = [
    {
        title: 'Desain Unik & Profesional',
        description: 'Tampilan website dibuat khusus sesuai karakter brand bisnis Anda, bukan sekadar salin-tempel template murahan.',
        icon: '🎨',
    },
    {
        title: 'Performa Super Kilat (Lighthouse 90+)',
        description: 'Website dibangun dengan kode bersih, kompresi gambar WebP otomatis, dan server cepat agar pengunjung tidak kabur karena loading lama.',
        icon: '⚡',
    },
    {
        title: 'Siap Bersaing di Google (SEO Lokal)',
        description: 'Dilengkapi metadata lengkap, schema.org LocalBusiness, sitemap otomatis, dan kata kunci lokal untuk mendominasi pencarian di Lampung.',
        icon: '🔍',
    },
    {
        title: 'Langsung Terhubung ke WhatsApp',
        description: 'Setiap formulir dan tombol aksi dirancang mengarahkan calon pembeli langsung ke chat WhatsApp Anda dalam satu klik.',
        icon: '💬',
    },
    {
        title: 'Panel Kelola Konten Praktis',
        description: 'Ubah teks, portofolio, dan nomor kontak kapan saja tanpa perlu paham bahasa pemrograman.',
        icon: '⚙️',
    },
    {
        title: 'Garansi & Pendampingan Penuh',
        description: 'Kami tidak lepas tangan setelah website selesai. Ada garansi error, SSL gratis, dan konsultasi lanjutan.',
        icon: '🛡️',
    },
];
</script>

<template>
    <section id="keunggulan" class="py-20 lg:py-28 bg-neutral-50/70 dark:bg-neutral-900/40 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <span class="text-xs sm:text-sm font-bold tracking-widest uppercase text-brand-600 dark:text-brand-400">
                    Kenapa Memilih Swift Code?
                </span>
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
                        <div class="w-12 h-12 rounded-xl bg-neutral-100 dark:bg-neutral-800 text-2xl flex items-center justify-center">
                            {{ item.icon }}
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
