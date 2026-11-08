<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface ProjectRow {
    id: number;
    title: string;
    slug: string;
    category: 'company' | 'sekolah' | 'toko' | 'sistem' | string;
    summary: string;
    client_name: string | null;
    live_url: string | null;
    cover_image: string | null;
    tech_stack: string[] | null;
    is_featured: boolean;
    is_published: boolean;
    sort_order: number;
    created_at?: string;
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface PaginationData {
    data: ProjectRow[];
    links: PaginationLink[];
    total: number;
    current_page: number;
    last_page: number;
}

const props = defineProps<{
    projects: PaginationData;
    filters: {
        status?: string;
        category?: string;
        search?: string;
    };
    counts: {
        all: number;
        published: number;
        draft: number;
        featured: number;
    };
}>();

const search = ref(props.filters.search || '');
const currentStatus = ref(props.filters.status || 'all');
const currentCategory = ref(props.filters.category || '');

const deleteModalOpen = ref(false);
const itemToDelete = ref<{ id: number; title: string } | null>(null);

const applyFilters = () => {
    router.get(
        '/admin/projects',
        {
            status: currentStatus.value !== 'all' ? currentStatus.value : undefined,
            category: currentCategory.value || undefined,
            search: search.value.trim() || undefined,
        },
        { preserveState: true, replace: true, preserveScroll: true },
    );
};

const setStatusTab = (status: string) => {
    currentStatus.value = status;
    applyFilters();
};

const handleSearchKeyup = (e: KeyboardEvent) => {
    if (e.key === 'Enter') {
        applyFilters();
    }
};

const clearSearch = () => {
    search.value = '';
    applyFilters();
};

const resetAllFilters = () => {
    search.value = '';
    currentStatus.value = 'all';
    currentCategory.value = '';
    applyFilters();
};

const openDeleteConfirm = (id: number, title: string) => {
    itemToDelete.value = { id, title };
    deleteModalOpen.value = true;
};

const closeDeleteModal = () => {
    deleteModalOpen.value = false;
    itemToDelete.value = null;
};

const executeDelete = () => {
    if (!itemToDelete.value) return;
    router.delete(`/admin/projects/${itemToDelete.value.id}`, {
        onSuccess: () => {
            closeDeleteModal();
        },
    });
};

const getCategoryLabel = (cat: string) => {
    switch (cat) {
        case 'company':
            return 'Company Profile';
        case 'sekolah':
            return 'Sekolah / Institusi';
        case 'toko':
            return 'Toko Online';
        case 'sistem':
            return 'Sistem Custom';
        default:
            return cat;
    }
};

const getCategoryClass = (cat: string) => {
    switch (cat) {
        case 'company':
            return 'bg-blue-50 text-blue-700 dark:bg-blue-950/60 dark:text-blue-300 border-blue-200 dark:border-blue-800';
        case 'sekolah':
            return 'bg-purple-50 text-purple-700 dark:bg-purple-950/60 dark:text-purple-300 border-purple-200 dark:border-purple-800';
        case 'toko':
            return 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800';
        case 'sistem':
            return 'bg-amber-50 text-amber-700 dark:bg-amber-950/60 dark:text-amber-300 border-amber-200 dark:border-amber-800';
        default:
            return 'bg-neutral-100 text-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 border-neutral-200 dark:border-neutral-700';
    }
};
</script>

<template>
    <Head title="Kelola Portofolio Proyek - Panel Admin Swift Code" />

    <AdminLayout title="Portofolio Proyek">
        <div class="space-y-6">
            <!-- Header bar & Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
                        Portofolio Proyek
                    </h2>
                    <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-0.5">
                        Kelola hasil karya, studi kasus, live demo, dan portofolio unggulan klien Swift Code.
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <Link
                        href="/portofolio"
                        target="_blank"
                        class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 font-bold text-xs transition-all"
                    >
                        <svg class="w-4 h-4 text-neutral-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        <span>Lihat Arsip Publik</span>
                    </Link>
                    <Link
                        href="/admin/projects/create"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-sm shadow-brand-600/30 transition-all self-start sm:self-auto"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Tambah Portofolio</span>
                    </Link>
                </div>
            </div>

            <!-- Status Tabs -->
            <div class="flex items-center gap-2 border-b border-neutral-200 dark:border-neutral-800 pb-2 overflow-x-auto">
                <button
                    type="button"
                    @click="setStatusTab('all')"
                    :class="[
                        'px-3.5 py-2 rounded-xl text-xs font-bold transition-all shrink-0 inline-flex items-center gap-2',
                        currentStatus === 'all'
                            ? 'bg-brand-600 text-white shadow-xs'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 border border-neutral-200 dark:border-neutral-800',
                    ]"
                >
                    <span>Semua Proyek</span>
                    <span
                        :class="[
                            'px-1.5 py-0.5 rounded-md text-[10px] font-mono',
                            currentStatus === 'all'
                                ? 'bg-white/20 text-white'
                                : 'bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300',
                        ]"
                    >
                        {{ counts.all }}
                    </span>
                </button>

                <button
                    type="button"
                    @click="setStatusTab('published')"
                    :class="[
                        'px-3.5 py-2 rounded-xl text-xs font-bold transition-all shrink-0 inline-flex items-center gap-2',
                        currentStatus === 'published'
                            ? 'bg-brand-600 text-white shadow-xs'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 border border-neutral-200 dark:border-neutral-800',
                    ]"
                >
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span>Tayang Publik</span>
                    <span
                        :class="[
                            'px-1.5 py-0.5 rounded-md text-[10px] font-mono',
                            currentStatus === 'published'
                                ? 'bg-white/20 text-white'
                                : 'bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300',
                        ]"
                    >
                        {{ counts.published }}
                    </span>
                </button>

                <button
                    type="button"
                    @click="setStatusTab('draft')"
                    :class="[
                        'px-3.5 py-2 rounded-xl text-xs font-bold transition-all shrink-0 inline-flex items-center gap-2',
                        currentStatus === 'draft'
                            ? 'bg-brand-600 text-white shadow-xs'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 border border-neutral-200 dark:border-neutral-800',
                    ]"
                >
                    <span class="w-2 h-2 rounded-full bg-neutral-400"></span>
                    <span>Draft / Konsep</span>
                    <span
                        :class="[
                            'px-1.5 py-0.5 rounded-md text-[10px] font-mono',
                            currentStatus === 'draft'
                                ? 'bg-white/20 text-white'
                                : 'bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300',
                        ]"
                    >
                        {{ counts.draft }}
                    </span>
                </button>

                <button
                    type="button"
                    @click="setStatusTab('featured')"
                    :class="[
                        'px-3.5 py-2 rounded-xl text-xs font-bold transition-all shrink-0 inline-flex items-center gap-2',
                        currentStatus === 'featured'
                            ? 'bg-brand-600 text-white shadow-xs'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 border border-neutral-200 dark:border-neutral-800',
                    ]"
                >
                    <svg class="w-3.5 h-3.5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <span>Unggulan Beranda</span>
                    <span
                        :class="[
                            'px-1.5 py-0.5 rounded-md text-[10px] font-mono',
                            currentStatus === 'featured'
                                ? 'bg-white/20 text-white'
                                : 'bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300',
                        ]"
                    >
                        {{ counts.featured }}
                    </span>
                </button>
            </div>

            <!-- Search & Filters Toolbar -->
            <div class="p-4 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 flex flex-col md:flex-row gap-3 shadow-xs">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-neutral-400">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input
                        v-model="search"
                        @keyup="handleSearchKeyup"
                        type="text"
                        placeholder="Cari judul proyek, nama klien, atau ringkasan... (Tekan Enter)"
                        class="w-full pl-10 pr-10 py-2.5 text-xs rounded-xl border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white outline-none focus:ring-2 focus:ring-brand-500 transition-all"
                    />
                    <button
                        v-if="search"
                        type="button"
                        @click="clearSearch"
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-200"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="flex items-center gap-2">
                    <select
                        v-model="currentCategory"
                        @change="applyFilters"
                        class="px-4 py-2.5 text-xs rounded-xl border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white outline-none focus:ring-2 focus:ring-brand-500 transition-all font-semibold"
                    >
                        <option value="">Semua Kategori</option>
                        <option value="company">Company Profile</option>
                        <option value="sekolah">Sekolah / Institusi</option>
                        <option value="toko">Toko Online</option>
                        <option value="sistem">Sistem Custom</option>
                    </select>

                    <button
                        type="button"
                        @click="applyFilters"
                        class="px-4 py-2.5 bg-neutral-900 dark:bg-neutral-100 hover:bg-neutral-800 dark:hover:bg-neutral-200 text-white dark:text-neutral-900 text-xs font-bold rounded-xl transition-all shrink-0"
                    >
                        Terapkan
                    </button>

                    <button
                        v-if="search || currentCategory || currentStatus !== 'all'"
                        type="button"
                        @click="resetAllFilters"
                        class="px-3.5 py-2.5 bg-neutral-100 dark:bg-neutral-800 hover:bg-neutral-200 dark:hover:bg-neutral-700 text-neutral-700 dark:text-neutral-300 text-xs font-bold rounded-xl transition-all shrink-0"
                        title="Reset Filter"
                    >
                        Reset
                    </button>
                </div>
            </div>

            <!-- Table Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-2xl border border-neutral-200/90 dark:border-neutral-800 overflow-hidden shadow-xs">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-neutral-50 dark:bg-neutral-800/60 text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800">
                            <tr>
                                <th class="py-3.5 px-6 font-semibold">Proyek & Klien</th>
                                <th class="py-3.5 px-4 font-semibold">Kategori</th>
                                <th class="py-3.5 px-4 font-semibold">Tech Stack</th>
                                <th class="py-3.5 px-4 font-semibold text-center">Status</th>
                                <th class="py-3.5 px-4 font-semibold text-center">Urutan</th>
                                <th class="py-3.5 px-6 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
                            <!-- Empty State -->
                            <tr v-if="projects.data.length === 0">
                                <td colspan="6" class="py-16 text-center">
                                    <div class="max-w-xs mx-auto space-y-3">
                                        <div class="w-12 h-12 rounded-2xl bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center mx-auto text-neutral-400">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                        </div>
                                        <p class="font-bold text-neutral-800 dark:text-neutral-200 text-sm">Tidak Ada Portofolio Ditemukan</p>
                                        <p class="text-xs text-neutral-500">
                                            Tidak ada hasil yang sesuai dengan kriteria pencarian atau filter yang dipilih.
                                        </p>
                                        <button
                                            v-if="search || currentCategory || currentStatus !== 'all'"
                                            type="button"
                                            @click="resetAllFilters"
                                            class="inline-block px-4 py-2 bg-neutral-200 dark:bg-neutral-800 text-neutral-800 dark:text-neutral-200 font-bold rounded-xl text-xs hover:bg-neutral-300"
                                        >
                                            Reset Filter
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Rows -->
                            <tr
                                v-for="proj in projects.data"
                                :key="proj.id"
                                class="hover:bg-neutral-50/50 dark:hover:bg-neutral-800/40 transition-colors"
                            >
                                <!-- Proyek & Klien -->
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <!-- Thumbnail -->
                                        <div class="w-14 h-10 rounded-xl bg-neutral-100 dark:bg-neutral-800 overflow-hidden shrink-0 border border-neutral-200/80 dark:border-neutral-700/80">
                                            <img
                                                v-if="proj.cover_image"
                                                :src="proj.cover_image"
                                                :alt="proj.title"
                                                class="w-full h-full object-cover transition-transform hover:scale-105 duration-200"
                                                loading="lazy"
                                            />
                                            <div v-else class="w-full h-full flex items-center justify-center text-neutral-400 bg-neutral-100 dark:bg-neutral-800">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        </div>

                                        <!-- Title & Meta -->
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-1.5">
                                                <p class="font-bold text-neutral-900 dark:text-white truncate">
                                                    {{ proj.title }}
                                                </p>
                                                <span
                                                    v-if="proj.is_featured"
                                                    class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-md bg-amber-50 text-amber-700 dark:bg-amber-950/60 dark:text-amber-300 border border-amber-200 dark:border-amber-800 text-[10px] font-bold"
                                                    title="Ditampilkan di Beranda"
                                                >
                                                    <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                    <span>Unggulan</span>
                                                </span>
                                            </div>

                                            <div class="flex items-center gap-2 mt-0.5 text-[11px] text-neutral-500">
                                                <span v-if="proj.client_name" class="font-medium text-neutral-600 dark:text-neutral-300">
                                                    {{ proj.client_name }}
                                                </span>
                                                <span v-if="proj.client_name">•</span>
                                                <span class="font-mono text-neutral-400">/portofolio/{{ proj.slug }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Kategori -->
                                <td class="py-4 px-4">
                                    <span
                                        :class="[
                                            'px-2.5 py-1 rounded-lg text-[10px] font-bold border inline-block',
                                            getCategoryClass(proj.category),
                                        ]"
                                    >
                                        {{ getCategoryLabel(proj.category) }}
                                    </span>
                                </td>

                                <!-- Tech Stack -->
                                <td class="py-4 px-4">
                                    <div v-if="proj.tech_stack && proj.tech_stack.length > 0" class="flex flex-wrap items-center gap-1 max-w-xs">
                                        <span
                                            v-for="(tech, tIndex) in proj.tech_stack.slice(0, 3)"
                                            :key="tIndex"
                                            class="px-2 py-0.5 rounded-md bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700 text-[10px] font-medium"
                                        >
                                            {{ tech }}
                                        </span>
                                        <span
                                            v-if="proj.tech_stack.length > 3"
                                            class="px-1.5 py-0.5 rounded-md bg-neutral-100 dark:bg-neutral-800 text-neutral-400 text-[10px] font-bold"
                                        >
                                            +{{ proj.tech_stack.length - 3 }}
                                        </span>
                                    </div>
                                    <span v-else class="text-neutral-400 text-[11px]">-</span>
                                </td>

                                <!-- Status -->
                                <td class="py-4 px-4 text-center">
                                    <span
                                        :class="[
                                            'px-2.5 py-1 rounded-lg text-[10px] font-bold border uppercase inline-block',
                                            proj.is_published
                                                ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800'
                                                : 'bg-neutral-100 text-neutral-500 dark:bg-neutral-800 dark:text-neutral-400 border-neutral-200 dark:border-neutral-700',
                                        ]"
                                    >
                                        {{ proj.is_published ? 'Tayang' : 'Draft' }}
                                    </span>
                                </td>

                                <!-- Sort Order -->
                                <td class="py-4 px-4 text-center font-mono text-neutral-600 dark:text-neutral-400 font-bold">
                                    {{ proj.sort_order }}
                                </td>

                                <!-- Aksi -->
                                <td class="py-4 px-6 text-right space-x-1.5 whitespace-nowrap">
                                    <!-- Live Demo Link (If available) -->
                                    <a
                                        v-if="proj.live_url"
                                        :href="proj.live_url"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center justify-center p-2 rounded-xl text-neutral-600 dark:text-neutral-300 hover:text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-950 font-semibold transition-colors"
                                        title="Buka Website Demo Klien"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>

                                    <!-- Public Detail Preview -->
                                    <Link
                                        :href="`/portofolio/${proj.slug}`"
                                        target="_blank"
                                        class="inline-flex items-center justify-center p-2 rounded-xl text-neutral-600 dark:text-neutral-300 hover:text-brand-600 hover:bg-brand-50 dark:hover:bg-brand-950 font-semibold transition-colors"
                                        title="Pratinjau Halaman Publik"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </Link>

                                    <!-- Edit -->
                                    <Link
                                        :href="`/admin/projects/${proj.id}/edit`"
                                        class="inline-flex items-center justify-center p-2 rounded-xl text-brand-600 hover:bg-brand-50 dark:hover:bg-brand-950 font-bold transition-colors"
                                        title="Edit Portofolio"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </Link>

                                    <!-- Delete -->
                                    <button
                                        type="button"
                                        @click="openDeleteConfirm(proj.id, proj.title)"
                                        class="inline-flex items-center justify-center p-2 rounded-xl text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950 font-bold transition-colors"
                                        title="Hapus Portofolio"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div
                    v-if="projects.links.length > 3"
                    class="px-6 py-4 border-t border-neutral-100 dark:border-neutral-800 flex flex-col sm:flex-row items-center justify-between gap-3"
                >
                    <p class="text-xs text-neutral-500">
                        Menampilkan halaman {{ projects.current_page }} dari {{ projects.last_page }} (Total {{ projects.total }} data)
                    </p>
                    <div class="flex items-center gap-1">
                        <template v-for="(link, i) in projects.links" :key="i">
                            <Link
                                v-if="link.url"
                                :href="link.url"
                                v-html="link.label"
                                :class="[
                                    'px-3 py-1.5 rounded-xl text-xs font-semibold transition-all',
                                    link.active
                                        ? 'bg-brand-600 text-white shadow-xs'
                                        : 'bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-200 dark:hover:bg-neutral-700',
                                ]"
                            />
                            <span
                                v-else
                                v-html="link.label"
                                class="px-3 py-1.5 text-xs text-neutral-400 select-none"
                            />
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div
            v-if="deleteModalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs"
        >
            <div class="bg-white dark:bg-neutral-900 rounded-3xl p-6 max-w-md w-full border border-neutral-200 dark:border-neutral-800 shadow-xl space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-neutral-900 dark:text-white">Konfirmasi Hapus Portofolio</h3>
                    <p class="text-xs text-neutral-500 mt-1 leading-relaxed">
                        Apakah Anda yakin ingin menghapus portofolio <strong class="text-neutral-900 dark:text-white">"{{ itemToDelete?.title }}"</strong>? Tindakan ini permanen dan tidak dapat dibatalkan.
                    </p>
                </div>
                <div class="flex items-center justify-end gap-3 pt-2">
                    <button
                        type="button"
                        @click="closeDeleteModal"
                        class="px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 text-neutral-700 dark:text-neutral-300 text-xs font-bold hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-all"
                    >
                        Batal
                    </button>
                    <button
                        type="button"
                        @click="executeDelete"
                        class="px-4 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold shadow-md shadow-rose-600/30 transition-all"
                    >
                        Ya, Hapus Permanen
                    </button>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
