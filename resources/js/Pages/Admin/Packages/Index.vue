<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface PackageRow {
    id: number;
    name: string;
    price: number | null;
    price_note: string | null;
    features: string[];
    is_highlighted: boolean;
    sort_order: number;
    is_active: boolean;
    created_at?: string;
}

const props = defineProps<{
    packages: PackageRow[];
    counts: { all: number; active: number; inactive: number; highlighted: number };
    filters: { search?: string; status?: string; highlight?: string };
}>();

const search = ref(props.filters.search || '');
const currentStatus = ref(props.filters.status || 'all');
const currentHighlight = ref(props.filters.highlight || 'all');

const handleFilter = () => {
    router.get(
        '/admin/packages',
        {
            search: search.value || undefined,
            status: currentStatus.value !== 'all' ? currentStatus.value : undefined,
            highlight: currentHighlight.value !== 'all' ? currentHighlight.value : undefined,
        },
        { preserveState: true, replace: true },
    );
};

const filterStatus = (statusKey: string) => {
    currentStatus.value = statusKey;
    currentHighlight.value = 'all';
    handleFilter();
};

const filterHighlight = (highlightKey: string) => {
    currentHighlight.value = highlightKey;
    currentStatus.value = 'all';
    handleFilter();
};

const formatPrice = (val: number | null) => {
    if (val === null || val === undefined) return 'Custom / Hubungi Kami';
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(val);
};

const deletePackage = (id: number, name: string) => {
    if (confirm(`Apakah Anda yakin ingin menghapus paket harga "${name}"?`)) {
        router.delete(`/admin/packages/${id}`);
    }
};
</script>

<template>
    <Head title="Kelola Paket Harga - Panel Admin" />

    <AdminLayout title="Kelola Paket Investasi Website">
        <div class="space-y-6">
            <!-- Header bar & Action button -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">Daftar Paket Harga ({{ packages.length }})</h2>
                    <p class="text-xs text-neutral-500">Kelola rincian harga, deliverable fitur, serta paket highlight rekomendasi</p>
                </div>
                <Link
                    href="/admin/packages/create"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-sm shadow-brand-600/30 transition-all self-start sm:self-auto cursor-pointer"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Paket Baru</span>
                </Link>
            </div>

            <!-- Status Tabs -->
            <div class="flex flex-wrap gap-2 border-b border-neutral-200 dark:border-neutral-800 pb-3">
                <button
                    type="button"
                    @click="filterStatus('all')"
                    :class="[
                        'px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 cursor-pointer',
                        currentStatus === 'all' && currentHighlight === 'all'
                            ? 'bg-neutral-900 text-white dark:bg-white dark:text-neutral-900'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100',
                    ]"
                >
                    <span>Semua Paket</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-neutral-200/60 dark:bg-neutral-800">
                        {{ counts.all }}
                    </span>
                </button>

                <button
                    type="button"
                    @click="filterStatus('active')"
                    :class="[
                        'px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 cursor-pointer',
                        currentStatus === 'active'
                            ? 'bg-emerald-600 text-white'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100',
                    ]"
                >
                    <span>Aktif Tayang</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">
                        {{ counts.active }}
                    </span>
                </button>

                <button
                    type="button"
                    @click="filterHighlight('yes')"
                    :class="[
                        'px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 cursor-pointer',
                        currentHighlight === 'yes'
                            ? 'bg-amber-600 text-white'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100',
                    ]"
                >
                    <span>Paling Diminati</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300">
                        {{ counts.highlighted }}
                    </span>
                </button>

                <button
                    type="button"
                    @click="filterStatus('inactive')"
                    :class="[
                        'px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 cursor-pointer',
                        currentStatus === 'inactive'
                            ? 'bg-neutral-600 text-white'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100',
                    ]"
                >
                    <span>Nonaktif</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-neutral-200 text-neutral-700 dark:bg-neutral-800 dark:text-neutral-300">
                        {{ counts.inactive }}
                    </span>
                </button>
            </div>

            <!-- Search box -->
            <div class="p-4 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 flex gap-3">
                <input
                    v-model="search"
                    @keyup.enter="handleFilter"
                    type="text"
                    placeholder="Cari nama paket harga atau catatan fitur..."
                    class="flex-1 px-4 py-2 text-xs rounded-xl border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white outline-none focus:ring-2 focus:ring-brand-500"
                />
                <button
                    type="button"
                    @click="handleFilter"
                    class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 hover:bg-neutral-300 dark:hover:bg-neutral-700 text-neutral-800 dark:text-neutral-200 text-xs font-bold rounded-xl cursor-pointer"
                >
                    Cari
                </button>
            </div>

            <!-- Packages Table -->
            <div class="bg-white dark:bg-neutral-900 rounded-2xl border border-neutral-200/90 dark:border-neutral-800 overflow-hidden shadow-xs">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-neutral-50 dark:bg-neutral-800/60 text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800">
                            <tr>
                                <th class="py-3.5 px-6 font-semibold">Nama Paket</th>
                                <th class="py-3.5 px-4 font-semibold">Harga Investasi</th>
                                <th class="py-3.5 px-4 font-semibold">Fitur & Spesifikasi</th>
                                <th class="py-3.5 px-4 font-semibold text-center">Badge Populer</th>
                                <th class="py-3.5 px-4 font-semibold text-center">Status</th>
                                <th class="py-3.5 px-6 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
                            <tr v-if="packages.length === 0">
                                <td colspan="6" class="py-12 text-center text-neutral-400">
                                    Belum ada data paket harga pada filter ini.
                                </td>
                            </tr>
                            <tr
                                v-for="pkg in packages"
                                :key="pkg.id"
                                class="hover:bg-neutral-50/50 dark:hover:bg-neutral-800/40"
                            >
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-2">
                                        <p class="font-bold text-neutral-900 dark:text-white text-sm">
                                            {{ pkg.name }}
                                        </p>
                                        <span
                                            v-if="pkg.is_highlighted"
                                            class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-brand-50 text-brand-700 dark:bg-brand-950 dark:text-brand-300 border border-brand-200 dark:border-brand-800"
                                        >
                                            Populer
                                        </span>
                                    </div>
                                    <p class="text-[11px] text-neutral-500 dark:text-neutral-400 mt-0.5">
                                        {{ pkg.price_note || 'Tidak ada catatan khusus' }}
                                    </p>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        :class="[
                                            'font-mono font-extrabold text-sm',
                                            pkg.price !== null ? 'text-neutral-900 dark:text-white' : 'text-brand-600 dark:text-brand-400',
                                        ]"
                                    >
                                        {{ formatPrice(pkg.price) }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 max-w-xs">
                                    <div class="space-y-1">
                                        <div
                                            v-for="(feat, fIdx) in pkg.features.slice(0, 3)"
                                            :key="fIdx"
                                            class="flex items-center gap-1.5 text-[11px] text-neutral-600 dark:text-neutral-300"
                                        >
                                            <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="truncate">{{ feat }}</span>
                                        </div>
                                        <p v-if="pkg.features.length > 3" class="text-[10px] text-neutral-400 italic pl-5">
                                            + {{ pkg.features.length - 3 }} fitur deliverable lainnya
                                        </p>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span
                                        v-if="pkg.is_highlighted"
                                        class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-50 text-amber-700 dark:bg-amber-950 dark:text-amber-300 border border-amber-200 dark:border-amber-800 uppercase"
                                    >
                                        Paling Dipilih
                                    </span>
                                    <span v-else class="text-neutral-400 text-xs">-</span>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span
                                        :class="[
                                            'px-2 py-0.5 rounded-md text-[10px] font-bold border uppercase',
                                            pkg.is_active
                                                ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800'
                                                : 'bg-neutral-100 text-neutral-500 dark:bg-neutral-800 dark:text-neutral-400 border-neutral-200 dark:border-neutral-700',
                                        ]"
                                    >
                                        {{ pkg.is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2 whitespace-nowrap">
                                    <Link
                                        href="/harga"
                                        target="_blank"
                                        class="inline-flex items-center justify-center p-1.5 rounded-lg text-neutral-600 hover:text-brand-600 bg-neutral-100 dark:bg-neutral-800 font-semibold"
                                        title="Pratinjau Halaman Harga Publik"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </Link>
                                    <Link
                                        :href="`/admin/packages/${pkg.id}/edit`"
                                        class="px-2.5 py-1 rounded-lg text-brand-600 hover:bg-brand-50 dark:hover:bg-brand-950/60 font-bold transition-colors"
                                    >
                                        Edit
                                    </Link>
                                    <button
                                        type="button"
                                        @click="deletePackage(pkg.id, pkg.name)"
                                        class="text-rose-600 font-bold hover:underline cursor-pointer"
                                    >
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
