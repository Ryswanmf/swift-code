<script setup lang="ts">
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface ArticleRow {
    id: number;
    title: string;
    slug: string;
    category: string;
    summary: string;
    author: string;
    read_time: string;
    image: string | null;
    is_published: boolean;
    published_at: string | null;
    sort_order: number;
    created_at: string;
}

interface PaginationData {
    data: ArticleRow[];
    links: Array<{ url: string | null; label: string; active: boolean }>;
    total: number;
}

const props = defineProps<{
    articles: PaginationData;
    categories: string[];
    counts: { all: number; published: number; scheduled: number; draft: number };
    filters: { search?: string; category?: string; status?: string };
}>();

const search = ref(props.filters.search || '');
const currentCategory = ref(props.filters.category || 'all');
const currentStatus = ref(props.filters.status || 'all');

// Bulk Generator Modal State
const isGeneratorModalOpen = ref(false);

const tomorrowDateStr = () => {
    const d = new Date();
    d.setDate(d.getDate() + 1);
    return d.toISOString().split('T')[0];
};

const generatorForm = useForm({
    count: 30,
    category: 'all',
    frequency: '1_daily',
    start_date: tomorrowDateStr(),
    author: 'Tim Swift Code Lampung',
});

const presetCounts = [10, 30, 60, 100, 365, 1000];

const frequencyOptions = [
    { value: '1_daily', label: '1 Artikel per Hari (09:00 WIB)', desc: 'Cocok untuk membangun konsistensi SEO bertahap' },
    { value: '2_daily', label: '2 Artikel per Hari (09:00 & 16:00 WIB)', desc: 'Publikasi intensif pagi dan sore' },
    { value: 'every_2_days', label: '1 Artikel setiap 2 Hari', desc: 'Jadwal santai 15 artikel per bulan' },
    { value: 'every_3_days', label: '1 Artikel setiap 3 Hari', desc: 'Jadwal 10 artikel per bulan' },
    { value: 'weekly', label: '1 Artikel per Minggu', desc: 'Jadwal mingguan konsisten' },
    { value: 'instant', label: 'Semua Terbit Hari Ini (Instan)', desc: 'Langsung tayang sekaligus dengan jeda waktu singkat' },
];

const categoryOptions = [
    { value: 'all', label: 'Campuran Seimbang (Semua Topik)' },
    { value: 'Strategi Bisnis', label: 'Strategi Bisnis & Kredibilitas' },
    { value: 'SEO & Trafik', label: 'SEO Google & Pencarian Lokal' },
    { value: 'Panduan Web', label: 'Panduan Web & Biaya Pembuatan' },
    { value: 'E-Commerce', label: 'Toko Online & E-Commerce UMKM' },
    { value: 'Edukasi & Sekolah', label: 'Website Sekolah & Portal PPDB' },
    { value: 'Teknologi & Fitur', label: 'Teknologi, Performa & Keamanan' },
];

const estimatedDays = computed(() => {
    const c = Number(generatorForm.count) || 1;
    switch (generatorForm.frequency) {
        case '2_daily':
            return Math.ceil(c / 2);
        case 'every_2_days':
            return c * 2;
        case 'every_3_days':
            return c * 3;
        case 'weekly':
            return c * 7;
        case 'instant':
            return 0;
        default:
            return c;
    }
});

const submitGenerator = () => {
    generatorForm.post('/admin/articles/bulk-generate', {
        preserveScroll: true,
        onSuccess: () => {
            isGeneratorModalOpen.value = false;
        },
    });
};

const deleteScheduledArticles = () => {
    if (confirm(`Apakah Anda yakin ingin menghapus SEMUA (${props.counts.scheduled}) artikel yang berstatus terjadwal? Artikel yang sudah tayang tidak akan terhapus.`)) {
        router.post('/admin/articles/bulk-delete-scheduled');
    }
};

const handleFilter = () => {
    router.get(
        '/admin/articles',
        {
            search: search.value || undefined,
            category: currentCategory.value !== 'all' ? currentCategory.value : undefined,
            status: currentStatus.value !== 'all' ? currentStatus.value : undefined,
        },
        { preserveState: true, replace: true },
    );
};

const filterStatus = (statusKey: string) => {
    currentStatus.value = statusKey;
    handleFilter();
};

const deleteArticle = (id: number, title: string) => {
    if (confirm(`Apakah Anda yakin ingin menghapus artikel "${title}"?`)) {
        router.delete(`/admin/articles/${id}`);
    }
};

const isScheduled = (article: ArticleRow) => {
    if (!article.is_published || !article.published_at) return false;
    return new Date(article.published_at) > new Date();
};

const formatDateTime = (dateString: string | null) => {
    if (!dateString) return '-';
    return new Date(dateString).toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    }) + ' WIB';
};
</script>

<template>
    <Head title="Kelola Artikel & Blog - Panel Admin" />

    <AdminLayout title="Kelola Artikel & Panduan">
        <div class="space-y-6">
            <!-- Header bar & Action buttons -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">Daftar Artikel ({{ articles.total }})</h2>
                    <p class="text-xs text-neutral-500">Kelola artikel edukasi digital, panduan website, dan wawasan bisnis untuk SEO Google</p>
                </div>

                <div class="flex flex-wrap items-center gap-2.5 self-start sm:self-auto">
                    <!-- Delete Scheduled Batch Button -->
                    <button
                        v-if="counts.scheduled > 0"
                        type="button"
                        @click="deleteScheduledArticles"
                        class="inline-flex items-center gap-1.5 px-3 py-2 text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-950/50 hover:bg-rose-100 dark:hover:bg-rose-900/50 border border-rose-200 dark:border-rose-900/60 rounded-xl text-xs font-bold transition-all cursor-pointer"
                        title="Hapus semua artikel terjadwal"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span>Hapus Terjadwal ({{ counts.scheduled }})</span>
                    </button>

                    <!-- Bulk Generator Trigger -->
                    <button
                        type="button"
                        @click="isGeneratorModalOpen = true"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-sm shadow-indigo-600/30 transition-all cursor-pointer"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <span>Generator Terjadwal (1-1000)</span>
                    </button>

                    <!-- Manual Create -->
                    <Link
                        href="/admin/articles/create"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-sm shadow-brand-600/30 transition-all cursor-pointer"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Tulis Manual</span>
                    </Link>
                </div>
            </div>

            <!-- Status Tabs -->
            <div class="flex flex-wrap gap-2 border-b border-neutral-200 dark:border-neutral-800 pb-3">
                <button
                    type="button"
                    @click="filterStatus('all')"
                    :class="[
                        'px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 cursor-pointer',
                        currentStatus === 'all'
                            ? 'bg-neutral-900 text-white dark:bg-white dark:text-neutral-900'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800',
                    ]"
                >
                    <span>Semua Artikel</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-neutral-200/60 dark:bg-neutral-800">
                        {{ counts.all }}
                    </span>
                </button>

                <button
                    type="button"
                    @click="filterStatus('published')"
                    :class="[
                        'px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 cursor-pointer',
                        currentStatus === 'published'
                            ? 'bg-emerald-600 text-white'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800',
                    ]"
                >
                    <span>Tayang</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">
                        {{ counts.published }}
                    </span>
                </button>

                <button
                    type="button"
                    @click="filterStatus('scheduled')"
                    :class="[
                        'px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 cursor-pointer',
                        currentStatus === 'scheduled'
                            ? 'bg-indigo-600 text-white'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800',
                    ]"
                >
                    <span>Terjadwal</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-indigo-100 text-indigo-800 dark:bg-indigo-950 dark:text-indigo-300">
                        {{ counts.scheduled }}
                    </span>
                </button>

                <button
                    type="button"
                    @click="filterStatus('draft')"
                    :class="[
                        'px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 cursor-pointer',
                        currentStatus === 'draft'
                            ? 'bg-amber-600 text-white'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800',
                    ]"
                >
                    <span>Draft</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300">
                        {{ counts.draft }}
                    </span>
                </button>
            </div>

            <!-- Search & Category Filters -->
            <div class="p-4 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 flex flex-col sm:flex-row gap-3">
                <input
                    v-model="search"
                    @keyup.enter="handleFilter"
                    type="text"
                    placeholder="Cari judul artikel, topik, atau kata kunci..."
                    class="flex-1 px-4 py-2 text-xs rounded-xl border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white outline-none focus:ring-2 focus:ring-brand-500"
                />

                <select
                    v-model="currentCategory"
                    @change="handleFilter"
                    class="px-4 py-2 text-xs rounded-xl border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white outline-none focus:ring-2 focus:ring-brand-500 font-medium"
                >
                    <option value="all">Semua Kategori</option>
                    <option v-for="cat in categories" :key="cat" :value="cat">
                        {{ cat }}
                    </option>
                </select>

                <button
                    type="button"
                    @click="handleFilter"
                    class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 hover:bg-neutral-300 dark:hover:bg-neutral-700 text-neutral-800 dark:text-neutral-200 text-xs font-bold rounded-xl cursor-pointer"
                >
                    Terapkan
                </button>
            </div>

            <!-- Articles Table -->
            <div class="bg-white dark:bg-neutral-900 rounded-2xl border border-neutral-200/90 dark:border-neutral-800 overflow-hidden shadow-xs">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-neutral-50 dark:bg-neutral-800/60 text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800">
                            <tr>
                                <th class="py-3.5 px-6 font-semibold">Artikel</th>
                                <th class="py-3.5 px-4 font-semibold">Kategori</th>
                                <th class="py-3.5 px-4 font-semibold text-center">Status</th>
                                <th class="py-3.5 px-4 font-semibold">Jadwal / Tanggal Rilis</th>
                                <th class="py-3.5 px-6 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
                            <tr v-if="articles.data.length === 0">
                                <td colspan="5" class="py-12 text-center text-neutral-400">
                                    Belum ada artikel pada kriteria ini.
                                </td>
                            </tr>
                            <tr
                                v-for="article in articles.data"
                                :key="article.id"
                                class="hover:bg-neutral-50/50 dark:hover:bg-neutral-800/40"
                            >
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-14 h-10 rounded-lg bg-neutral-100 dark:bg-neutral-800 overflow-hidden shrink-0 border border-neutral-200 dark:border-neutral-700">
                                            <img
                                                v-if="article.image"
                                                :src="article.image"
                                                :alt="article.title"
                                                loading="lazy"
                                                decoding="async"
                                                class="w-full h-full object-cover"
                                            />
                                            <div v-else class="w-full h-full flex items-center justify-center text-[10px] text-neutral-400 font-bold">
                                                ARTIKEL
                                            </div>
                                        </div>
                                        <div class="min-w-0 max-w-md">
                                            <p class="font-bold text-neutral-900 dark:text-white line-clamp-1">
                                                {{ article.title }}
                                            </p>
                                            <p class="text-[11px] text-neutral-500 dark:text-neutral-400 line-clamp-1 mt-0.5">
                                                {{ article.summary }}
                                            </p>
                                            <span class="text-[10px] text-neutral-400 font-mono">/artikel/{{ article.slug }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300">
                                        {{ article.category }}
                                    </span>
                                    <p class="text-[10px] text-neutral-400 mt-0.5">{{ article.read_time }}</p>
                                </td>
                                <td class="py-4 px-4 text-center whitespace-nowrap">
                                    <span
                                        v-if="!article.is_published"
                                        class="px-2 py-0.5 rounded-md text-[10px] font-bold border uppercase bg-amber-50 text-amber-700 dark:bg-amber-950/60 dark:text-amber-300 border-amber-200 dark:border-amber-800"
                                    >
                                        Draft
                                    </span>
                                    <span
                                        v-else-if="isScheduled(article)"
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold border uppercase bg-indigo-50 text-indigo-700 dark:bg-indigo-950/60 dark:text-indigo-300 border-indigo-200 dark:border-indigo-800"
                                        :title="`Akan tayang otomatis: ${formatDateTime(article.published_at)}`"
                                    >
                                        <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Terjadwal</span>
                                    </span>
                                    <span
                                        v-else
                                        class="px-2 py-0.5 rounded-md text-[10px] font-bold border uppercase bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800"
                                    >
                                        Tayang
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-neutral-600 dark:text-neutral-300 text-xs whitespace-nowrap">
                                    <span>{{ formatDateTime(article.published_at) }}</span>
                                    <span v-if="isScheduled(article)" class="block text-[10px] text-indigo-600 dark:text-indigo-400 font-semibold">
                                        Rilis di masa depan
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2 whitespace-nowrap">
                                    <Link
                                        :href="`/artikel/${article.slug}`"
                                        target="_blank"
                                        class="inline-flex items-center justify-center p-1.5 rounded-lg text-neutral-600 hover:text-brand-600 bg-neutral-100 dark:bg-neutral-800 font-semibold"
                                        title="Pratinjau Halaman Publik"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </Link>
                                    <Link
                                        :href="`/admin/articles/${article.id}/edit`"
                                        class="inline-flex items-center justify-center p-1.5 rounded-lg text-neutral-600 hover:text-brand-600 bg-neutral-100 dark:bg-neutral-800 font-semibold"
                                        title="Edit Artikel"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </Link>
                                    <button
                                        type="button"
                                        @click="deleteArticle(article.id, article.title)"
                                        class="inline-flex items-center justify-center px-2 py-1 text-rose-600 hover:text-white hover:bg-rose-600 rounded-lg text-xs font-semibold transition-colors cursor-pointer"
                                    >
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div v-if="articles.links.length > 3" class="px-6 py-4 border-t border-neutral-100 dark:border-neutral-800 flex items-center justify-between">
                    <div class="flex items-center gap-1">
                        <template v-for="(link, i) in articles.links" :key="i">
                            <Link
                                v-if="link.url"
                                :href="link.url"
                                v-html="link.label"
                                :class="[
                                    'px-3 py-1.5 rounded-lg text-xs font-semibold',
                                    link.active
                                        ? 'bg-brand-600 text-white'
                                        : 'bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-200',
                                ]"
                            />
                            <span
                                v-else
                                v-html="link.label"
                                class="px-3 py-1.5 text-xs text-neutral-400"
                            />
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bulk Scheduled Articles Generator Modal -->
        <Teleport to="body">
            <div
                v-if="isGeneratorModalOpen"
                class="fixed inset-0 z-50 flex items-center justify-center bg-neutral-950/70 backdrop-blur-xs p-4 overflow-y-auto"
                @click.self="isGeneratorModalOpen = false"
            >
                <div class="relative w-full max-w-2xl bg-white dark:bg-neutral-900 rounded-3xl border border-neutral-200 dark:border-neutral-800 shadow-2xl p-6 sm:p-8 space-y-6 my-8">
                    <!-- Modal Header -->
                    <div class="flex items-start justify-between border-b border-neutral-100 dark:border-neutral-800 pb-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded-md bg-indigo-50 dark:bg-indigo-950/60 text-indigo-700 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800 text-[10px] font-bold uppercase tracking-wider">
                                    Tanpa API Luar
                                </span>
                                <h3 class="text-base sm:text-lg font-extrabold text-neutral-900 dark:text-white">
                                    Generator Artikel Otomatis Terjadwal
                                </h3>
                            </div>
                            <p class="text-xs text-neutral-500 mt-1">
                                Hasilkan 1 sampai 1000 artikel edukasi digital &amp; SEO lokal dengan distribusi tanggal tayang otomatis secara kilat.
                            </p>
                        </div>
                        <button
                            type="button"
                            @click="isGeneratorModalOpen = false"
                            class="p-1.5 text-neutral-400 hover:text-neutral-700 dark:hover:text-white rounded-lg cursor-pointer"
                        >
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Generator Form -->
                    <form @submit.prevent="submitGenerator" class="space-y-5">
                        <!-- 1. Article Count with Quick Presets -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-neutral-800 dark:text-neutral-200 uppercase tracking-wider">
                                Jumlah Artikel (1 &mdash; 1000)
                            </label>
                            <div class="flex items-center gap-3">
                                <input
                                    v-model.number="generatorForm.count"
                                    type="number"
                                    min="1"
                                    max="1000"
                                    required
                                    class="w-32 px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-mono font-bold focus:ring-2 focus:ring-indigo-500 outline-none"
                                />
                                <div class="flex flex-wrap gap-1.5 flex-1">
                                    <button
                                        v-for="p in presetCounts"
                                        :key="p"
                                        type="button"
                                        @click="generatorForm.count = p"
                                        :class="[
                                            'px-2.5 py-1 rounded-lg text-xs font-bold transition-all cursor-pointer',
                                            generatorForm.count === p
                                                ? 'bg-indigo-600 text-white'
                                                : 'bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-200',
                                        ]"
                                    >
                                        {{ p }}
                                    </button>
                                </div>
                            </div>
                            <p class="text-[11px] text-neutral-400">
                                Contoh: 30 artikel untuk 1 bulan penuh, 60 artikel untuk 2 bulan, atau 365 artikel untuk 1 tahun penuh.
                            </p>
                        </div>

                        <!-- 2. Category / Topic Focus -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-neutral-800 dark:text-neutral-200 uppercase tracking-wider">
                                Fokus Kategori Topik
                            </label>
                            <select
                                v-model="generatorForm.category"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-indigo-500 outline-none font-medium"
                            >
                                <option v-for="cat in categoryOptions" :key="cat.value" :value="cat.value">
                                    {{ cat.label }}
                                </option>
                            </select>
                        </div>

                        <!-- 3. Frequency & Scheduling Logic -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-neutral-800 dark:text-neutral-200 uppercase tracking-wider">
                                Frekuensi Jadwal Publikasi (Drip-Feed)
                            </label>
                            <select
                                v-model="generatorForm.frequency"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-indigo-500 outline-none font-medium"
                            >
                                <option v-for="freq in frequencyOptions" :key="freq.value" :value="freq.value">
                                    {{ freq.label }}
                                </option>
                            </select>
                        </div>

                        <!-- 4. Start Date & Author Name -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-neutral-800 dark:text-neutral-200 uppercase tracking-wider mb-2">
                                    Mulai Tanggal Tayang
                                </label>
                                <input
                                    v-model="generatorForm.start_date"
                                    type="date"
                                    required
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-indigo-500 outline-none"
                                />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-neutral-800 dark:text-neutral-200 uppercase tracking-wider mb-2">
                                    Nama Penulis Artikel
                                </label>
                                <input
                                    v-model="generatorForm.author"
                                    type="text"
                                    required
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-indigo-500 outline-none"
                                />
                            </div>
                        </div>

                        <!-- 5. Estimation Summary Card -->
                        <div class="p-4 rounded-2xl bg-indigo-50/70 dark:bg-indigo-950/40 border border-indigo-200/80 dark:border-indigo-800/60 space-y-2">
                            <div class="flex items-center gap-2 text-indigo-900 dark:text-indigo-200 font-bold text-xs">
                                <svg class="w-4 h-4 text-indigo-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Ringkasan Rencana Penjadwalan:</span>
                            </div>
                            <p class="text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                                Anda akan menghasilkan <strong>{{ generatorForm.count }} artikel</strong> unik lengkap dengan foto sampul Unsplash, struktur heading H2, daftar tips, dan CTA kontak.
                                <span v-if="generatorForm.frequency !== 'instant'">
                                    Artikel akan terdistribusi otomatis selama kurang lebih <strong>{{ estimatedDays }} hari</strong> ke depan.
                                </span>
                                <span v-else>
                                    Seluruh artikel akan langsung berstatus tayang hari ini.
                                </span>
                            </p>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800 flex items-center justify-end gap-3">
                            <button
                                type="button"
                                @click="isGeneratorModalOpen = false"
                                class="px-5 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 text-neutral-700 dark:text-neutral-300 font-bold text-xs hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-all cursor-pointer"
                            >
                                Batal
                            </button>
                            <button
                                type="submit"
                                :disabled="generatorForm.processing"
                                class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow-md shadow-indigo-600/30 disabled:opacity-50 transition-all cursor-pointer"
                            >
                                <svg v-if="generatorForm.processing" class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>
                                <span>{{ generatorForm.processing ? 'Menghasilkan Artikel...' : `Generate Sekarang (${generatorForm.count} Artikel)` }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </Teleport>
    </AdminLayout>
</template>
