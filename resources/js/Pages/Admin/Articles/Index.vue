<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
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
    counts: { all: number; published: number; draft: number };
    filters: { search?: string; category?: string; status?: string };
}>();

const search = ref(props.filters.search || '');
const currentCategory = ref(props.filters.category || 'all');
const currentStatus = ref(props.filters.status || 'all');

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

const filterCategory = (categoryKey: string) => {
    currentCategory.value = categoryKey;
    handleFilter();
};

const deleteArticle = (id: number, title: string) => {
    if (confirm(`Apakah Anda yakin ingin menghapus artikel "${title}"?`)) {
        router.delete(`/admin/articles/${id}`);
    }
};

const formatDate = (dateString: string | null) => {
    if (!dateString) return '-';
    return new Date(dateString).toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'short',
        year: 'numeric',
    });
};
</script>

<template>
    <Head title="Kelola Artikel & Blog - Panel Admin" />

    <AdminLayout title="Kelola Artikel & Panduan">
        <div class="space-y-6">
            <!-- Header bar & Action button -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">Daftar Artikel ({{ articles.total }})</h2>
                    <p class="text-xs text-neutral-500">Kelola artikel edukasi digital, panduan website, dan wawasan bisnis untuk SEO Google</p>
                </div>
                <Link
                    href="/admin/articles/create"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-sm shadow-brand-600/30 transition-all self-start sm:self-auto cursor-pointer"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tulis Artikel Baru</span>
                </Link>
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
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100',
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
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100',
                    ]"
                >
                    <span>Tayang</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">
                        {{ counts.published }}
                    </span>
                </button>

                <button
                    type="button"
                    @click="filterStatus('draft')"
                    :class="[
                        'px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 cursor-pointer',
                        currentStatus === 'draft'
                            ? 'bg-amber-600 text-white'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100',
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
                                <th class="py-3.5 px-4 font-semibold">Tanggal Publikasi</th>
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
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300">
                                        {{ article.category }}
                                    </span>
                                    <p class="text-[10px] text-neutral-400 mt-0.5">{{ article.read_time }}</p>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span
                                        :class="[
                                            'px-2 py-0.5 rounded-md text-[10px] font-bold border uppercase',
                                            article.is_published
                                                ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800'
                                                : 'bg-amber-50 text-amber-700 dark:bg-amber-950/60 dark:text-amber-300 border-amber-200 dark:border-amber-800',
                                        ]"
                                    >
                                        {{ article.is_published ? 'Tayang' : 'Draft' }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-neutral-600 dark:text-neutral-300 text-xs">
                                    {{ formatDate(article.published_at) }}
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
                                        class="px-2.5 py-1 rounded-lg text-brand-600 hover:bg-brand-50 dark:hover:bg-brand-950/60 font-bold transition-colors"
                                    >
                                        Edit
                                    </Link>
                                    <button
                                        type="button"
                                        @click="deleteArticle(article.id, article.title)"
                                        class="text-rose-600 font-bold hover:underline cursor-pointer"
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
    </AdminLayout>
</template>
