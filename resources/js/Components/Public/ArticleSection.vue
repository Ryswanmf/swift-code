<script setup lang="ts">
const articles = [
    {
        title: '5 Alasan Bisnis di Lampung Wajib Punya Website Resmi di 2026',
        summary: 'Meningkatkan kredibilitas saat negosiasi proyek atau tender, mudah ditemukan lewat Google Lampung, serta otomasi penjualan langsung ke WhatsApp.',
        category: 'Strategi Bisnis',
        readTime: '5 menit baca',
        date: '6 Nov 2026',
        image: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=800&auto=format&fit=crop',
    },
    {
        title: 'Landing Page vs Company Profile: Mana yang Tepat untuk Usaha Anda?',
        summary: 'Ketahui perbedaan mendasar fokus konversi iklan satu produk dibanding profil kredibilitas institusi agar anggaran pembuatan website Anda efektif.',
        category: 'Panduan Web',
        readTime: '4 menit baca',
        date: '4 Nov 2026',
        image: 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?q=80&w=800&auto=format&fit=crop',
    },
    {
        title: 'Cara Efektif Mendominasi Pencarian Google Lokal di Daerah Lampung',
        summary: 'Strategi SEO lokal, optimasi kata kunci jasa pembuatan website, integrasi Google Business Profile, dan kecepatan loading agar calon klien menemukan bisnis Anda.',
        category: 'SEO & Trafik',
        readTime: '6 menit baca',
        date: '1 Nov 2026',
        image: 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?q=80&w=800&auto=format&fit=crop',
    },
];
</script>

<template>
    <section id="artikel" class="pt-12 sm:pt-14 pb-20 lg:pb-28 bg-gradient-to-r from-brand-800 via-brand-600 to-rose-600 text-white relative overflow-hidden shadow-inner">
        <!-- Background Ambient Accents -->
        <div class="pointer-events-none absolute -top-24 -left-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-24 -right-24 w-96 h-96 bg-black/20 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-14 space-y-3">
                <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight drop-shadow-xs">
                    Artikel & Panduan <span class="text-white/95">Website Bisnis</span>
                </h2>
                <p class="text-base text-white/90 leading-relaxed">
                    Pelajari strategi memaksimalkan kehadiran online bisnis Anda agar lebih dipercaya dan menghasilkan penjualan nyata.
                </p>
            </div>

            <!-- Articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <article
                    v-for="(post, idx) in articles"
                    :key="idx"
                    class="group rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-100 dark:border-neutral-800 overflow-hidden shadow-xl shadow-black/15 hover:shadow-2xl hover:border-brand-500/40 transition-all duration-300 hover:-translate-y-1 flex flex-col justify-between"
                >
                    <div>
                        <!-- Cover Image -->
                        <div class="aspect-video w-full overflow-hidden bg-neutral-200 dark:bg-neutral-800">
                            <img
                                :src="post.image"
                                :alt="post.title"
                                loading="lazy"
                                decoding="async"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            />
                        </div>

                        <!-- Card Content -->
                        <div class="p-6 space-y-3">
                            <div class="flex items-center justify-between text-[11px] text-neutral-500">
                                <span class="px-2 py-0.5 rounded-md bg-brand-50 dark:bg-brand-950/60 text-brand-700 dark:text-brand-300 font-bold uppercase tracking-wider border border-brand-200/50 dark:border-brand-800/50">
                                    {{ post.category }}
                                </span>
                                <span>{{ post.readTime }}</span>
                            </div>

                            <h3 class="text-lg font-bold text-neutral-900 dark:text-white group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors line-clamp-2 leading-snug">
                                {{ post.title }}
                            </h3>

                            <p class="text-xs text-neutral-600 dark:text-neutral-400 line-clamp-3 leading-relaxed">
                                {{ post.summary }}
                            </p>
                        </div>
                    </div>

                    <!-- Footer / Link -->
                    <div class="px-6 pb-6 pt-2 border-t border-neutral-200/60 dark:border-neutral-800/80 flex items-center justify-between text-xs">
                        <span class="text-neutral-400">{{ post.date }}</span>
                        <a
                            href="#kontak"
                            class="inline-flex items-center gap-1 font-bold text-brand-600 dark:text-brand-400 hover:text-brand-700"
                        >
                            <span>Konsultasi Topik Ini</span>
                            <span>→</span>
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>
</template>
