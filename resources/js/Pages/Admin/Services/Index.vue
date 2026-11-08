<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface ServiceRow {
    id: number;
    icon: string;
    title: string;
    description: string;
    badge: string | null;
    sort_order: number;
    is_active: boolean;
    created_at?: string;
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface PaginationData {
    data: ServiceRow[];
    links: PaginationLink[];
    total: number;
    current_page: number;
    last_page: number;
}

const props = defineProps<{
    services: PaginationData;
    filters: {
        status?: string;
        search?: string;
    };
    counts: {
        all: number;
        active: number;
        inactive: number;
    };
}>();

const search = ref(props.filters.search || '');
const currentStatus = ref(props.filters.status || 'all');

const deleteModalOpen = ref(false);
const itemToDelete = ref<{ id: number; title: string } | null>(null);

const applyFilters = () => {
    router.get(
        '/admin/services',
        {
            status: currentStatus.value !== 'all' ? currentStatus.value : undefined,
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
    router.delete(`/admin/services/${itemToDelete.value.id}`, {
        onSuccess: () => {
            closeDeleteModal();
        },
    });
};
</script>

<template>
    <Head title="Kelola Layanan Website - Panel Admin Swift Code" />

    <AdminLayout title="Kelola Layanan">
        <div class="space-y-6">
            <!-- Header bar & Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
                        Layanan & Solusi Web
                    </h2>
                    <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-0.5">
                        Kelola katalog penawaran solusi pembuatan website, deskripsi manfaat, ikon, dan urutan tampil.
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <Link
                        href="/layanan"
                        target="_blank"
                        class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 font-bold text-xs transition-all"
                    >
                        <svg class="w-4 h-4 text-neutral-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        <span>Lihat Halaman Publik</span>
                    </Link>
                    <Link
                        href="/admin/services/create"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-sm shadow-brand-600/30 transition-all self-start sm:self-auto"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Tambah Layanan Baru</span>
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
                    <span>Semua Layanan</span>
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
                    @click="setStatusTab('active')"
                    :class="[
                        'px-3.5 py-2 rounded-xl text-xs font-bold transition-all shrink-0 inline-flex items-center gap-2',
                        currentStatus === 'active'
                            ? 'bg-brand-600 text-white shadow-xs'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 border border-neutral-200 dark:border-neutral-800',
                    ]"
                >
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span>Aktif di Publik</span>
                    <span
                        :class="[
                            'px-1.5 py-0.5 rounded-md text-[10px] font-mono',
                            currentStatus === 'active'
                                ? 'bg-white/20 text-white'
                                : 'bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300',
                        ]"
                    >
                        {{ counts.active }}
                    </span>
                </button>

                <button
                    type="button"
                    @click="setStatusTab('inactive')"
                    :class="[
                        'px-3.5 py-2 rounded-xl text-xs font-bold transition-all shrink-0 inline-flex items-center gap-2',
                        currentStatus === 'inactive'
                            ? 'bg-brand-600 text-white shadow-xs'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 border border-neutral-200 dark:border-neutral-800',
                    ]"
                >
                    <span class="w-2 h-2 rounded-full bg-neutral-400"></span>
                    <span>Nonaktif / Disimpan</span>
                    <span
                        :class="[
                            'px-1.5 py-0.5 rounded-md text-[10px] font-mono',
                            currentStatus === 'inactive'
                                ? 'bg-white/20 text-white'
                                : 'bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300',
                        ]"
                    >
                        {{ counts.inactive }}
                    </span>
                </button>
            </div>

            <!-- Search Toolbar -->
            <div class="p-4 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 flex flex-col sm:flex-row gap-3 shadow-xs">
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
                        placeholder="Cari nama layanan, deskripsi, atau label badge... (Tekan Enter)"
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
                    <button
                        type="button"
                        @click="applyFilters"
                        class="px-4 py-2.5 bg-neutral-900 dark:bg-neutral-100 hover:bg-neutral-800 dark:hover:bg-neutral-200 text-white dark:text-neutral-900 text-xs font-bold rounded-xl transition-all shrink-0"
                    >
                        Cari
                    </button>

                    <button
                        v-if="search || currentStatus !== 'all'"
                        type="button"
                        @click="resetAllFilters"
                        class="px-3.5 py-2.5 bg-neutral-100 dark:bg-neutral-800 hover:bg-neutral-200 dark:hover:bg-neutral-700 text-neutral-700 dark:text-neutral-300 text-xs font-bold rounded-xl transition-all shrink-0"
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
                                <th class="py-3.5 px-6 font-semibold w-16">Ikon</th>
                                <th class="py-3.5 px-4 font-semibold">Nama Layanan & Deskripsi</th>
                                <th class="py-3.5 px-4 font-semibold">Badge</th>
                                <th class="py-3.5 px-4 font-semibold text-center">Status</th>
                                <th class="py-3.5 px-4 font-semibold text-center">Urutan</th>
                                <th class="py-3.5 px-6 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
                            <!-- Empty State -->
                            <tr v-if="services.data.length === 0">
                                <td colspan="6" class="py-16 text-center">
                                    <div class="max-w-xs mx-auto space-y-3">
                                        <div class="w-12 h-12 rounded-2xl bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center mx-auto text-neutral-400">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                        </div>
                                        <p class="font-bold text-neutral-800 dark:text-neutral-200 text-sm">Tidak Ada Layanan Ditemukan</p>
                                        <p class="text-xs text-neutral-500">
                                            Tidak ada data layanan yang sesuai dengan kata kunci atau filter yang Anda pilih.
                                        </p>
                                        <button
                                            v-if="search || currentStatus !== 'all'"
                                            type="button"
                                            @click="resetAllFilters"
                                            class="inline-block px-4 py-2 bg-neutral-200 dark:bg-neutral-800 text-neutral-800 dark:text-neutral-200 font-bold rounded-xl text-xs hover:bg-neutral-300"
                                        >
                                            Reset Filter
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Data Rows -->
                            <tr
                                v-for="srv in services.data"
                                :key="srv.id"
                                class="hover:bg-neutral-50/50 dark:hover:bg-neutral-800/40 transition-colors"
                            >
                                <!-- Icon Preview (SVG) -->
                                <td class="py-4 px-6">
                                    <div class="w-10 h-10 rounded-xl bg-brand-50 dark:bg-brand-950/60 border border-brand-200 dark:border-brand-900 text-brand-600 dark:text-brand-400 flex items-center justify-center shrink-0 shadow-xs">
                                        <!-- Rocket -->
                                        <svg v-if="srv.icon === 'rocket'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                        <!-- Building -->
                                        <svg v-else-if="srv.icon === 'building'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <!-- Academic -->
                                        <svg v-else-if="srv.icon === 'academic'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5" />
                                        </svg>
                                        <!-- Cart -->
                                        <svg v-else-if="srv.icon === 'cart'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                        <!-- Code -->
                                        <svg v-else-if="srv.icon === 'code'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                        </svg>
                                        <!-- Tool -->
                                        <svg v-else-if="srv.icon === 'tool'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                                        </svg>
                                        <!-- Server -->
                                        <svg v-else-if="srv.icon === 'server'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                                        </svg>
                                        <!-- Shield -->
                                        <svg v-else-if="srv.icon === 'shield'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        <!-- Mobile -->
                                        <svg v-else-if="srv.icon === 'mobile'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        <!-- Fallback Globe -->
                                        <svg v-else class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                        </svg>
                                    </div>
                                </td>

                                <!-- Title & Description -->
                                <td class="py-4 px-4">
                                    <div class="max-w-md">
                                        <p class="font-bold text-neutral-900 dark:text-white text-xs sm:text-sm">
                                            {{ srv.title }}
                                        </p>
                                        <p class="text-[11px] text-neutral-500 dark:text-neutral-400 line-clamp-2 mt-0.5 leading-relaxed">
                                            {{ srv.description }}
                                        </p>
                                    </div>
                                </td>

                                <!-- Badge -->
                                <td class="py-4 px-4">
                                    <span
                                        v-if="srv.badge"
                                        class="px-2.5 py-1 rounded-lg text-[10px] font-bold bg-brand-50 text-brand-700 dark:bg-brand-950/60 dark:text-brand-300 border border-brand-200 dark:border-brand-800 inline-block"
                                    >
                                        {{ srv.badge }}
                                    </span>
                                    <span v-else class="text-neutral-400 text-[11px]">-</span>
                                </td>

                                <!-- Status -->
                                <td class="py-4 px-4 text-center">
                                    <span
                                        :class="[
                                            'px-2.5 py-1 rounded-lg text-[10px] font-bold border uppercase inline-block',
                                            srv.is_active
                                                ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800'
                                                : 'bg-neutral-100 text-neutral-500 dark:bg-neutral-800 dark:text-neutral-400 border-neutral-200 dark:border-neutral-700',
                                        ]"
                                    >
                                        {{ srv.is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>

                                <!-- Sort Order -->
                                <td class="py-4 px-4 text-center font-mono text-neutral-600 dark:text-neutral-400 font-bold">
                                    {{ srv.sort_order }}
                                </td>

                                <!-- Actions -->
                                <td class="py-4 px-6 text-right space-x-1.5 whitespace-nowrap">
                                    <Link
                                        href="/layanan"
                                        target="_blank"
                                        class="inline-flex items-center justify-center p-2 rounded-xl text-neutral-600 dark:text-neutral-300 hover:text-brand-600 hover:bg-brand-50 dark:hover:bg-brand-950 font-semibold transition-colors"
                                        title="Pratinjau di Halaman Layanan Publik"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </Link>

                                    <Link
                                        :href="`/admin/services/${srv.id}/edit`"
                                        class="inline-flex items-center justify-center p-2 rounded-xl text-brand-600 hover:bg-brand-50 dark:hover:bg-brand-950 font-bold transition-colors"
                                        title="Edit Layanan"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </Link>

                                    <button
                                        type="button"
                                        @click="openDeleteConfirm(srv.id, srv.title)"
                                        class="inline-flex items-center justify-center p-2 rounded-xl text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950 font-bold transition-colors"
                                        title="Hapus Layanan"
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
                    v-if="services.links.length > 3"
                    class="px-6 py-4 border-t border-neutral-100 dark:border-neutral-800 flex flex-col sm:flex-row items-center justify-between gap-3"
                >
                    <p class="text-xs text-neutral-500">
                        Menampilkan halaman {{ services.current_page }} dari {{ services.last_page }} (Total {{ services.total }} layanan)
                    </p>
                    <div class="flex items-center gap-1">
                        <template v-for="(link, i) in services.links" :key="i">
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
                    <h3 class="text-base font-extrabold text-neutral-900 dark:text-white">Konfirmasi Hapus Layanan</h3>
                    <p class="text-xs text-neutral-500 mt-1 leading-relaxed">
                        Apakah Anda yakin ingin menghapus layanan <strong class="text-neutral-900 dark:text-white">"{{ itemToDelete?.title }}"</strong>? Layanan ini tidak akan lagi ditampilkan pada halaman publik.
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
                        Ya, Hapus Layanan
                    </button>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
