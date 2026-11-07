<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { ArticleItem } from './Index.vue';

interface Props {
    article: ArticleItem;
    relatedArticles?: ArticleItem[];
    settings?: Record<string, string>;
}

const props = withDefaults(defineProps<Props>(), {
    relatedArticles: () => [],
    settings: () => ({}),
});

const whatsappNumber = computed(() => props.settings?.whatsapp || '62895325852575');

const consultationWaUrl = computed(() => {
    const text = `Halo Swift Code Lampung, saya membaca artikel *${props.article.title}* dan ingin berkonsultasi mengenai solusi website untuk bisnis saya.`;
    return `https://wa.me/${whatsappNumber.value}?text=${encodeURIComponent(text)}`;
});

const contentParagraphs = computed(() => {
    if (!props.article.content) return [];
    return props.article.content.split('\n\n');
});

const articleSchema = computed(() =>
    JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'Article',
        headline: props.article.title,
        description: props.article.summary,
        author: {
            '@type': 'Organization',
            name: props.article.author || 'Swift Code Lampung',
        },
        image: props.article.image,
        datePublished: props.article.published_at,
    })
);
</script>

<template>
    <Head>
        <title>{{ article.title }} | Swift Code Lampung</title>
        <meta name="description" :content="article.summary" />
        <link rel="canonical" :href="`/artikel/${article.slug}`" />

        <meta property="og:type" content="article" />
        <meta property="og:title" :content="`${article.title} - Swift Code Lampung`" />
        <meta property="og:description" :content="article.summary" />
        <meta property="og:image" :content="article.image" />
        <meta property="og:site_name" content="Swift Code Lampung" />
        <meta property="og:locale" content="id_ID" />

        <component :is="'script'" type="application/ld+json" v-html="articleSchema" />
    </Head>

    <PublicLayout>
        <article class="pt-28 pb-16 sm:pt-32 sm:pb-20 bg-white">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Breadcrumbs -->
                <nav class="flex items-center gap-2 text-xs text-neutral-500 mb-6 sm:mb-8 overflow-hidden text-ellipsis whitespace-nowrap">
                    <Link href="/" class="hover:text-brand-600 transition-colors shrink-0">Beranda</Link>
                    <span>/</span>
                    <Link href="/artikel" class="hover:text-brand-600 transition-colors shrink-0">Artikel</Link>
                    <span>/</span>
                    <span class="text-neutral-900 font-semibold truncate">{{ article.title }}</span>
                </nav>

                <!-- Article Header -->
                <header class="space-y-4 mb-8">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="px-3 py-1 text-xs font-bold rounded-lg bg-brand-50 text-brand-700 border border-brand-200/60 uppercase tracking-wide">
                            {{ article.category }}
                        </span>
                        <span class="text-xs text-neutral-500">
                            {{ article.published_at }} • {{ article.read_time }}
                        </span>
                        <span class="text-xs text-neutral-500">
                            Oleh: <strong class="text-neutral-800">{{ article.author }}</strong>
                        </span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-neutral-900 tracking-tight leading-tight">
                        {{ article.title }}
                    </h1>

                    <p class="text-base sm:text-lg text-neutral-600 leading-relaxed p-4 rounded-xl bg-neutral-50 border-l-4 border-brand-600">
                        {{ article.summary }}
                    </p>
                </header>

                <!-- Featured Image -->
                <div class="mb-10 rounded-2xl sm:rounded-3xl overflow-hidden border border-neutral-200 shadow-md aspect-video bg-neutral-100">
                    <img
                        :src="article.image"
                        :alt="article.title"
                        class="w-full h-full object-cover"
                    />
                </div>

                <!-- Two Columns Layout: Content & Sidebar -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
                    <!-- Main Body Text -->
                    <div class="lg:col-span-8 space-y-5 text-neutral-700 text-sm sm:text-base leading-relaxed">
                        <template v-for="(paragraph, pIdx) in contentParagraphs" :key="pIdx">
                            <p class="whitespace-pre-line leading-relaxed">
                                {{ paragraph }}
                            </p>
                        </template>

                        <!-- Share & Action Box -->
                        <div class="pt-6 border-t border-neutral-200 mt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <Link
                                href="/artikel"
                                class="inline-flex items-center gap-2 text-xs font-bold text-neutral-600 hover:text-brand-600 transition-colors"
                            >
                                <span>← Kembali ke Semua Artikel</span>
                            </Link>

                            <a
                                :href="consultationWaUrl"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-brand-600 hover:bg-brand-700 shadow-md transition-all"
                            >
                                <span>Konsultasi Topik Ini via WhatsApp</span>
                            </a>
                        </div>
                    </div>

                    <!-- Right Sidebar -->
                    <aside class="lg:col-span-4 space-y-6">
                        <!-- Quick Consultation Card -->
                        <div class="p-6 rounded-2xl bg-neutral-50 border border-neutral-200/90 space-y-4">
                            <span class="text-[11px] font-bold text-brand-600 uppercase tracking-wider block">
                                Butuh Solusi Website?
                            </span>
                            <h3 class="text-base font-bold text-neutral-900 leading-snug">
                                Wujudkan Website Profesional untuk Bisnis Anda di Lampung
                            </h3>
                            <p class="text-xs text-neutral-600 leading-relaxed">
                                Dapatkan rekomendasi jenis website dan rancangan anggaran transparan dari tim Swift Code Lampung.
                            </p>
                            <a
                                :href="consultationWaUrl"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-full py-3 px-4 rounded-xl font-bold text-center text-xs text-white bg-brand-600 hover:bg-brand-700 block shadow-md transition-all"
                            >
                                Chat WhatsApp Sekarang
                            </a>
                        </div>

                        <!-- Related Articles -->
                        <div v-if="relatedArticles.length > 0" class="p-6 rounded-2xl bg-white border border-neutral-200 space-y-4">
                            <h3 class="text-sm font-bold text-neutral-900 uppercase tracking-wider">
                                Artikel Terkait
                            </h3>
                            <div class="space-y-4 divide-y divide-neutral-100">
                                <article
                                    v-for="rel in relatedArticles"
                                    :key="rel.slug"
                                    class="pt-3 first:pt-0 space-y-1.5"
                                >
                                    <span class="text-[10px] font-bold text-brand-600 uppercase tracking-wider">
                                        {{ rel.category }}
                                    </span>
                                    <h4 class="text-xs sm:text-sm font-bold text-neutral-900 hover:text-brand-600 transition-colors line-clamp-2 leading-snug">
                                        <Link :href="`/artikel/${rel.slug}`">
                                            {{ rel.title }}
                                        </Link>
                                    </h4>
                                    <p class="text-[11px] text-neutral-500">
                                        {{ rel.published_at }}
                                    </p>
                                </article>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </article>
    </PublicLayout>
</template>
