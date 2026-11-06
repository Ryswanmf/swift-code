<script setup lang="ts">
const steps = [
    {
        num: '01',
        title: 'Konsultasi & Konsep',
        desc: 'Diskusikan model bisnis, tujuan website, referensi desain, dan fitur utama yang Anda perlukan.',
        icon: '💡',
    },
    {
        num: '02',
        title: 'Desain & Revisi',
        desc: 'Kami buatkan susunan tampilan modern yang selaras dengan identitas brand hingga disetujui.',
        icon: '🎨',
    },
    {
        num: '03',
        title: 'Coding & Integrasi',
        desc: 'Tahap pengembangan sistem dengan standar kode bersih, optimasi kecepatan kilat, dan mobile-friendly.',
        icon: '💻',
    },
    {
        num: '04',
        title: 'Rilis & Pendampingan',
        desc: 'Website online dengan domain & hosting aktif. Kami berikan panduan cara kelola konten tanpa ribet.',
        icon: '🚀',
    },
];
</script>

<template>
    <section id="alur" class="py-20 lg:py-28 bg-white dark:bg-neutral-950 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <span class="text-xs sm:text-sm font-bold tracking-widest uppercase text-brand-600 dark:text-brand-400">
                    Proses Transparan & Terarah
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
                    4 Langkah Praktis Menuju <span class="text-brand-600">Website Impian</span>
                </h2>
                <p class="text-base text-neutral-600 dark:text-neutral-400">
                    Anda tidak perlu pusing memikirkan hal teknis rumit. Serahkan semuanya kepada tim Swift Code.
                </p>
            </div>

            <!-- Steps Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative">
                <div
                    v-for="(step, idx) in steps"
                    :key="step.num"
                    class="relative p-7 rounded-2xl bg-neutral-50/80 dark:bg-neutral-900/60 border border-neutral-200/80 dark:border-neutral-800 hover:border-brand-500/40 transition-all duration-300"
                >
                    <!-- Step badge -->
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-3xl font-black text-brand-600/30 dark:text-brand-500/20 font-mono">
                            {{ step.num }}
                        </span>
                        <div class="w-10 h-10 rounded-xl bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 flex items-center justify-center text-xl shadow-xs">
                            {{ step.icon }}
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-neutral-900 dark:text-white mb-2">
                        {{ step.title }}
                    </h3>

                    <p class="text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">
                        {{ step.desc }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
