<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ref, computed, watch, onMounted, onUnmounted } from 'vue';
import PublicLayout from '@/Layouts/PublicLayout.vue';

export interface ArticleItem {
    id: number;
    slug: string;
    title: string;
    summary: string;
    category: string;
    read_time: string;
    published_at: string;
    author: string;
    image: string;
    content?: string;
}

interface Props {
    articles: ArticleItem[];
    settings?: Record<string, string>;
}

const props = withDefaults(defineProps<Props>(), {
    articles: () => [],
    settings: () => ({}),
});

const searchQuery = ref<string>('');
const activeCategory = ref<string>('all');
const isDropdownOpen = ref<boolean>(false);
const dropdownRef = ref<HTMLElement | null>(null);

const itemsPerPage = 6;
const currentPage = ref<number>(1);

const articleList = computed(() => props.articles || []);

const categories = computed(() => {
    const list = [
        { key: 'all', label: 'Semua Kategori' },
    ];
    const uniqueCats = Array.from(new Set(articleList.value.map((a) => a.category)));
    uniqueCats.forEach((cat) => {
        list.push({ key: cat, label: cat });
    });
    return list;
});

const selectedCategoryLabel = computed(() => {
    const found = categories.value.find((c) => c.key === activeCategory.value);
    return found ? found.label : 'Semua Kategori';
});

const getCategoryCount = (key: string) => {
    if (key === 'all') return articleList.value.length;
    return articleList.value.filter((a) => a.category === key).length;
};

const selectCategory = (key: string) => {
    activeCategory.value = key;
    isDropdownOpen.value = false;
};

const resetFilters = () => {
    searchQuery.value = '';
    activeCategory.value = 'all';
    currentPage.value = 1;
};

const filteredArticles = computed(() => {
    let result = articleList.value;

    if (activeCategory.value !== 'all') {
        result = result.filter((a) => a.category === activeCategory.value);
    }

    if (searchQuery.value.trim() !== '') {
        const query = searchQuery.value.toLowerCase().trim();
        result = result.filter(
            (a) =>
                a.title.toLowerCase().includes(query) ||
                a.summary.toLowerCase().includes(query) ||
                a.category.toLowerCase().includes(query)
        );
    }

    return result;
});

// Reset pagination back to page 1 whenever search query or category filter changes
watch([searchQuery, activeCategory], () => {
    currentPage.value = 1;
});

const totalPages = computed(() => Math.ceil(filteredArticles.value.length / itemsPerPage));

const paginatedArticles = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    return filteredArticles.value.slice(start, start + itemsPerPage);
});

const isFiltered = computed(() => searchQuery.value.trim() !== '' || activeCategory.value !== 'all');

const goToPage = (page: number) => {
    if (page < 1 || page > totalPages.value) return;
    currentPage.value = page;
    const gridEl = document.getElementById('articles-listing');
    if (gridEl) {
        gridEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};

const handleClickOutside = (e: MouseEvent) => {
    if (dropdownRef.value && !dropdownRef.value.contains(e.target as Node)) {
        isDropdownOpen.value = false;
    }
};

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
});

const page = usePage();
const whatsappNumber = computed(() => {
    const raw = (page.props as any).siteSettings?.whatsapp || props.settings?.whatsapp || '62895325852575';
    return String(raw).replace(/[^0-9]/g, '');
});
</script>

<template>
    <Head>
        <title>Artikel & Panduan Pembuatan Website Lampung | Swift Code</title>
        <meta
            name="description"
            content="Kumpulan artikel edukatif, panduan website bisnis, tips SEO lokal Lampung, dan strategi digital marketing terpercaya dari tim Swift Code Lampung."
        />
        <meta property="og:title" content="Artikel & Panduan Pembuatan Website Lampung - Swift Code" />
        <meta
            property="og:description"
            content="Pelajari strategi digital dan panduan website bisnis untuk meningkatkan kredibilitas dan penjualan usaha Anda di Lampung."
        />
    </Head>

    <PublicLayout>
        <!-- 1. Header Banner Section (Signature Brand Red Gradient) -->
        <section class="relative pt-28 pb-12 sm:pt-32 sm:pb-16 bg-gradient-to-r from-brand-800 via-brand-600 to-rose-600 text-white overflow-hidden shadow-inner">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
                <!-- Breadcrumbs -->
                <div class="flex items-center justify-center">
                    <nav class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 border border-white/20 text-xs font-medium text-white/90 backdrop-blur-xs">
                        <Link href="/" class="hover:text-white transition-colors">Beranda</Link>
                        <span>/</span>
                        <span class="text-white font-bold">Artikel & Panduan</span>
                    </nav>
                </div>

                <!-- Headline -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white leading-tight">
                    Artikel & Panduan <br class="hidden sm:inline" />
                    <span>Website Bisnis</span>
                </h1>

                <!-- Subheadline -->
                <p class="text-base sm:text-lg text-white/90 max-w-2xl mx-auto leading-relaxed">
                    Wawasan praktis, tips SEO lokal, dan strategi pengembangan website modern untuk membantu bisnis dan UMKM di Lampung bertumbuh pesat.
                </p>
            </div>
        </section>

        <!-- 2. Main Articles Listing Section -->
        <section id="articles-listing" class="py-12 sm:py-16 bg-white min-h-[60vh] scroll-mt-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Unified Search & Category Filter Bar (One Integrated Box) -->
                <div class="max-w-3xl mx-auto mb-10 sm:mb-14">
                    <div class="relative flex flex-col sm:flex-row items-stretch sm:items-center bg-white border border-neutral-300 rounded-2xl shadow-xs hover:border-neutral-400 focus-within:border-brand-500 focus-within:ring-4 focus-within:ring-brand-500/10 transition-all p-1.5 gap-2 sm:gap-0">
                        <!-- Left: Search Box -->
                        <div class="flex items-center flex-1 px-3">
                            <svg class="w-5 h-5 text-neutral-400 shrink-0 mr-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input
                                v-model="searchQuery"
                                type="text"
                                placeholder="Cari artikel, tips SEO, atau topik bisnis..."
                                class="w-full h-11 bg-transparent border-0 p-0 text-sm text-neutral-900 placeholder-neutral-400 focus:ring-0 focus:outline-none"
                            />
                            <button
                                v-if="searchQuery"
                                type="button"
                                @click="searchQuery = ''"
                                class="p-1 text-neutral-400 hover:text-neutral-600 rounded-lg hover:bg-neutral-100 shrink-0 ml-1 cursor-pointer"
                                title="Hapus pencarian"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Divider (Vertical on Desktop, Horizontal on Mobile) -->
                        <div class="hidden sm:block h-7 w-px bg-neutral-200 shrink-0 mx-1"></div>
                        <div class="block sm:hidden h-px w-full bg-neutral-100"></div>

                        <!-- Right: Category Dropdown Button -->
                        <div ref="dropdownRef" class="relative shrink-0">
                            <button
                                type="button"
                                @click="isDropdownOpen = !isDropdownOpen"
                                class="w-full sm:w-auto h-11 px-3.5 rounded-xl flex items-center justify-between gap-2.5 text-xs sm:text-sm font-semibold transition-all cursor-pointer select-none"
                                :class="[
                                    isDropdownOpen
                                        ? 'bg-brand-50 text-brand-700'
                                        : activeCategory !== 'all'
                                        ? 'bg-brand-50/80 text-brand-700'
                                        : 'text-neutral-700 hover:bg-neutral-100/80',
                                ]"
                            >
                                <div class="flex items-center gap-2 truncate">
                                    <svg
                                        class="w-4 h-4 shrink-0 transition-colors"
                                        :class="activeCategory !== 'all' || isDropdownOpen ? 'text-brand-600' : 'text-neutral-400'"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                    </svg>
                                    <span class="truncate max-w-[150px] sm:max-w-[170px]">{{ selectedCategoryLabel }}</span>
                                </div>

                                <div class="flex items-center gap-1.5 shrink-0">
                                    <span
                                        class="px-1.5 py-0.5 rounded-md text-[10px] font-bold"
                                        :class="activeCategory !== 'all' ? 'bg-brand-600 text-white' : 'bg-neutral-200/80 text-neutral-700'"
                                    >
                                        {{ getCategoryCount(activeCategory) }}
                                    </span>
                                    <svg
                                        class="w-4 h-4 text-neutral-400 transition-transform duration-200"
                                        :class="{ 'rotate-180 text-brand-600': isDropdownOpen }"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </button>

                            <!-- Dropdown Menu Popover with Scroll -->
                            <transition
                                enter-active-class="transition duration-150 ease-out"
                                enter-from-class="transform scale-95 opacity-0"
                                enter-to-class="transform scale-100 opacity-100"
                                leave-active-class="transition duration-100 ease-in"
                                leave-from-class="transform scale-100 opacity-100"
                                leave-to-class="transform scale-95 opacity-0"
                            >
                                <div
                                    v-if="isDropdownOpen"
                                    class="absolute right-0 left-0 sm:left-auto sm:w-72 mt-2 z-50 bg-white rounded-2xl border border-neutral-200 shadow-xl overflow-hidden"
                                >
                                    <!-- Header -->
                                    <div class="px-4 py-2.5 bg-neutral-50/90 border-b border-neutral-100 flex items-center justify-between text-[11px] text-neutral-500 font-bold uppercase tracking-wider">
                                        <span>Pilih Kategori</span>
                                        <span>{{ articleList.length }} Artikel</span>
                                    </div>

                                    <!-- Options with scroll -->
                                    <div class="max-h-60 overflow-y-auto p-1.5 space-y-0.5">
                                        <button
                                            v-for="cat in categories"
                                            :key="cat.key"
                                            type="button"
                                            @click="selectCategory(cat.key)"
                                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs sm:text-sm font-medium transition-colors cursor-pointer text-left"
                                            :class="[
                                                activeCategory === cat.key
                                                    ? 'bg-brand-50 text-brand-700 font-bold'
                                                    : 'text-neutral-700 hover:bg-neutral-50',
                                            ]"
                                        >
                                            <div class="flex items-center gap-2 truncate">
                                                <svg
                                                    class="w-3.5 h-3.5 shrink-0 transition-opacity"
                                                    :class="activeCategory === cat.key ? 'text-brand-600 opacity-100' : 'opacity-0'"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span class="truncate">{{ cat.label }}</span>
                                            </div>
                                            <span
                                                class="px-1.5 py-0.5 rounded-md text-[10px] font-bold shrink-0 ml-2"
                                                :class="[
                                                    activeCategory === cat.key
                                                        ? 'bg-brand-600 text-white'
                                                        : 'bg-neutral-100 text-neutral-500',
                                                ]"
                                            >
                                                {{ getCategoryCount(cat.key) }}
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </transition>
                        </div>
                    </div>

                    <!-- Subtle Filter Status Line -->
                    <div
                        v-if="isFiltered"
                        class="flex items-center justify-between gap-3 mt-3 px-3 text-xs text-neutral-500"
                    >
                        <div class="flex items-center gap-2 truncate">
                            <span>Menampilkan <strong>{{ filteredArticles.length }}</strong> dari {{ articleList.length }} artikel</span>
                            <span v-if="searchQuery" class="text-neutral-400 truncate">• "{{ searchQuery }}"</span>
                            <span v-if="activeCategory !== 'all'" class="text-neutral-400 truncate">• {{ selectedCategoryLabel }}</span>
                        </div>
                        <button
                            type="button"
                            @click="resetFilters"
                            class="text-brand-600 hover:text-brand-700 font-semibold cursor-pointer underline shrink-0"
                        >
                            Reset Filter
                        </button>
                    </div>
                </div>

                <!-- 3 Columns Articles Grid -->
                <div
                    v-if="filteredArticles.length > 0"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8"
                >
                    <article
                        v-for="post in paginatedArticles"
                        :key="post.slug"
                        class="group rounded-2xl bg-white border border-neutral-200 overflow-hidden shadow-xs hover:shadow-xl hover:border-brand-500/40 transition-all duration-300 hover:-translate-y-1 flex flex-col justify-between"
                    >
                        <div>
                            <!-- Cover Image (Clickable) -->
                            <Link
                                :href="`/artikel/${post.slug}`"
                                class="block aspect-video w-full overflow-hidden bg-neutral-100 relative"
                            >
                                <img
                                    :src="post.image"
                                    :alt="post.title"
                                    loading="lazy"
                                    decoding="async"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                />
                                <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 text-[11px] font-bold rounded-lg bg-neutral-900/80 backdrop-blur-md text-white border border-white/10 uppercase tracking-wide">
                                        {{ post.category }}
                                    </span>
                                </div>
                            </Link>

                            <!-- Card Body -->
                            <div class="p-6 space-y-3">
                                <!-- Meta Time -->
                                <div class="flex items-center justify-between text-xs text-neutral-400 font-medium">
                                    <span>{{ post.published_at }}</span>
                                    <span>{{ post.read_time }}</span>
                                </div>

                                <!-- Title -->
                                <h3 class="text-lg font-bold text-neutral-900 group-hover:text-brand-600 transition-colors line-clamp-2 leading-snug">
                                    <Link :href="`/artikel/${post.slug}`">
                                        {{ post.title }}
                                    </Link>
                                </h3>

                                <!-- Summary -->
                                <p class="text-xs sm:text-sm text-neutral-600 line-clamp-3 leading-relaxed">
                                    {{ post.summary }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="px-6 py-4 bg-neutral-50/60 border-t border-neutral-100 flex items-center justify-between text-xs">
                            <span class="text-neutral-500 font-medium">
                                {{ post.author }}
                            </span>

                            <Link
                                :href="`/artikel/${post.slug}`"
                                class="inline-flex items-center gap-1.5 font-bold text-brand-600 group-hover:text-brand-700 transition-colors"
                            >
                                <span>Baca Selengkapnya</span>
                                <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </Link>
                        </div>
                    </article>
                </div>

                <!-- Empty State -->
                <div
                    v-else
                    class="text-center py-16 px-6 rounded-3xl bg-neutral-50 border border-neutral-200/80 max-w-md mx-auto"
                >
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-neutral-200/70 flex items-center justify-center text-neutral-500 mb-4">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-neutral-900">Artikel Tidak Ditemukan</h3>
                    <p class="text-xs sm:text-sm text-neutral-500 mt-1.5 mb-5 leading-relaxed">
                        Tidak ada artikel yang cocok dengan kata kunci atau filter yang Anda pilih.
                    </p>
                    <button
                        type="button"
                        @click="resetFilters"
                        class="px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white rounded-xl text-xs font-bold shadow-md shadow-brand-600/20 transition-all cursor-pointer"
                    >
                        Tampilkan Semua Artikel
                    </button>
                </div>

                <!-- Pagination Component (Tampil jika artikel melebihi 6 / totalPages > 1) -->
                <div
                    v-if="filteredArticles.length > itemsPerPage"
                    class="mt-12 sm:mt-16 flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-neutral-200/80"
                >
                    <!-- Info Count -->
                    <div class="text-xs sm:text-sm text-neutral-500 order-2 sm:order-1">
                        Menampilkan
                        <strong class="text-neutral-900">
                            {{ (currentPage - 1) * itemsPerPage + 1 }}-{{ Math.min(currentPage * itemsPerPage, filteredArticles.length) }}
                        </strong>
                        dari <strong class="text-neutral-900">{{ filteredArticles.length }}</strong> artikel
                    </div>

                    <!-- Pagination Controls -->
                    <nav class="inline-flex items-center gap-1.5 order-1 sm:order-2" aria-label="Navigasi Halaman Artikel">
                        <!-- Previous Button -->
                        <button
                            type="button"
                            @click="goToPage(currentPage - 1)"
                            :disabled="currentPage === 1"
                            class="inline-flex items-center gap-1 px-3.5 py-2 rounded-xl border text-xs font-semibold transition-colors cursor-pointer select-none"
                            :class="[
                                currentPage === 1
                                    ? 'border-neutral-200 text-neutral-300 cursor-not-allowed bg-neutral-50'
                                    : 'border-neutral-200 bg-white text-neutral-700 hover:bg-neutral-50 hover:border-neutral-300 shadow-2xs',
                            ]"
                            aria-label="Halaman Sebelumnya"
                        >
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            <span class="hidden sm:inline">Sebelumnya</span>
                        </button>

                        <!-- Page Numbers -->
                        <button
                            v-for="page in totalPages"
                            :key="page"
                            type="button"
                            @click="goToPage(page)"
                            class="w-9 h-9 flex items-center justify-center rounded-xl text-xs font-bold transition-all cursor-pointer select-none"
                            :class="[
                                currentPage === page
                                    ? 'bg-brand-600 text-white shadow-sm shadow-brand-600/30 ring-2 ring-brand-600/20'
                                    : 'border border-neutral-200 bg-white text-neutral-700 hover:bg-neutral-50 hover:border-neutral-300',
                            ]"
                            :aria-current="currentPage === page ? 'page' : undefined"
                        >
                            {{ page }}
                        </button>

                        <!-- Next Button -->
                        <button
                            type="button"
                            @click="goToPage(currentPage + 1)"
                            :disabled="currentPage === totalPages"
                            class="inline-flex items-center gap-1 px-3.5 py-2 rounded-xl border text-xs font-semibold transition-colors cursor-pointer select-none"
                            :class="[
                                currentPage === totalPages
                                    ? 'border-neutral-200 text-neutral-300 cursor-not-allowed bg-neutral-50'
                                    : 'border-neutral-200 bg-white text-neutral-700 hover:bg-neutral-50 hover:border-neutral-300 shadow-2xs',
                            ]"
                            aria-label="Halaman Selanjutnya"
                        >
                            <span class="hidden sm:inline">Selanjutnya</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </nav>
                </div>

                <!-- Bottom CTA Banner -->
                <div class="mt-16 sm:mt-20 p-8 sm:p-12 rounded-3xl bg-gradient-to-r from-brand-800 via-brand-600 to-rose-600 text-white shadow-xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="space-y-2 text-center md:text-left">
                        <h3 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                            Ingin Website Bisnis Anda Ditangani Ahlinya?
                        </h3>
                        <p class="text-sm sm:text-base text-white/90 max-w-xl leading-relaxed">
                            Diskusikan kebutuhan website dan strategi digital bisnis Anda bersama tim Swift Code Lampung. Konsultasi 100% gratis tanpa komitmen.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center gap-3 shrink-0">
                        <a
                            :href="`https://wa.me/${whatsappNumber}?text=${encodeURIComponent('Halo Swift Code, saya membaca artikel di website dan ingin berkonsultasi mengenai pembuatan website.')}`"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="px-6 py-3.5 bg-white text-brand-700 hover:bg-neutral-100 font-bold text-xs sm:text-sm rounded-xl shadow-lg transition-transform hover:scale-105 active:scale-95 text-center whitespace-nowrap"
                        >
                            Konsultasi WhatsApp Sekarang
                        </a>
                        <Link
                            href="/portofolio"
                            class="px-6 py-3.5 bg-white/15 hover:bg-white/25 border border-white/25 text-white font-bold text-xs sm:text-sm rounded-xl transition-colors text-center whitespace-nowrap"
                        >
                            Lihat Portofolio Kami
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>
