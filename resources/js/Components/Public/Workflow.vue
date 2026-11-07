<script setup lang="ts">
const steps = [
    {
        num: '01',
        title: 'Konsultasi & Konsep',
        desc: 'Diskusikan model bisnis, tujuan website, referensi desain, dan fitur utama yang Anda perlukan.',
        id: 'consult',
    },
    {
        num: '02',
        title: 'Desain & Revisi',
        desc: 'Kami buatkan susunan tampilan modern yang selaras dengan identitas brand hingga disetujui.',
        id: 'design',
    },
    {
        num: '03',
        title: 'Coding & Integrasi',
        desc: 'Tahap pengembangan sistem dengan standar kode bersih, optimasi kecepatan kilat, dan mobile-friendly.',
        id: 'code',
    },
    {
        num: '04',
        title: 'Rilis & Pendampingan',
        desc: 'Website online dengan domain & hosting aktif. Kami berikan panduan cara kelola konten tanpa ribet.',
        id: 'launch',
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
                        <div class="w-10 h-10 rounded-xl bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 flex items-center justify-center text-brand-600 dark:text-brand-400 shadow-xs shrink-0">
                            <!-- Consult -->
                            <svg v-if="step.id === 'consult'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                            <!-- Design -->
                            <svg v-else-if="step.id === 'design'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4 5 5 0 013-4.5V10a5 5 0 0110 0v2.5A5 5 0 0119 17a4 4 0 01-4 4H7zM12 3v4m0 0a2 2 0 100 4 2 2 0 000-4z" />
                            </svg>
                            <!-- Code -->
                            <svg v-else-if="step.id === 'code'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                            <!-- Launch -->
                            <svg v-else class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7m0 0l-4 4m4-4H3" />
                            </svg>
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
