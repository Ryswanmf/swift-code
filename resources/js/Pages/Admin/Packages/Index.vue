<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
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
}

defineProps<{
    packages: PackageRow[];
}>();

const formatPrice = (val: number | null) => {
    if (val === null) return 'Custom / Hubungi Kami';
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(val);
};

const deletePackage = (id: number, name: string) => {
    if (confirm(`Hapus paket harga "${name}"?`)) {
        router.delete(`/admin/packages/${id}`);
    }
};
</script>

<template>
    <Head title="Kelola Paket Harga - Panel Admin" />

    <AdminLayout title="Kelola Paket Harga">
        <div class="space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">Daftar Paket Harga ({{ packages.length }})</h2>
                    <p class="text-xs text-neutral-500">Kelola rincian harga, fitur, dan highlight paket pembuatan website</p>
                </div>
                <Link
                    href="/admin/packages/create"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-sm transition-all self-start sm:self-auto"
                >
                    <span>➕ Tambah Paket</span>
                </Link>
            </div>

            <div class="bg-white dark:bg-neutral-900 rounded-2xl border border-neutral-200/90 dark:border-neutral-800 overflow-hidden shadow-xs">
                <table class="w-full text-left text-xs">
                    <thead class="bg-neutral-50 dark:bg-neutral-800/60 text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800">
                        <tr>
                            <th class="py-3.5 px-6 font-semibold">Nama Paket</th>
                            <th class="py-3.5 px-4 font-semibold">Harga Investasi</th>
                            <th class="py-3.5 px-4 font-semibold">Jumlah Fitur</th>
                            <th class="py-3.5 px-4 font-semibold text-center">Highlight</th>
                            <th class="py-3.5 px-4 font-semibold text-center">Status</th>
                            <th class="py-3.5 px-6 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
                        <tr v-if="packages.length === 0">
                            <td colspan="6" class="py-10 text-center text-neutral-400">Belum ada paket harga.</td>
                        </tr>
                        <tr v-for="pkg in packages" :key="pkg.id" class="hover:bg-neutral-50/50 dark:hover:bg-neutral-800/40">
                            <td class="py-4 px-6">
                                <p class="font-bold text-neutral-900 dark:text-white">{{ pkg.name }}</p>
                                <p class="text-[11px] text-neutral-400">{{ pkg.price_note }}</p>
                            </td>
                            <td class="py-4 px-4 font-bold text-neutral-900 dark:text-white font-mono">
                                {{ formatPrice(pkg.price) }}
                            </td>
                            <td class="py-4 px-4 text-neutral-600 dark:text-neutral-300">
                                {{ pkg.features.length }} fitur terdaftar
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span v-if="pkg.is_highlighted" class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200 uppercase">
                                    Populer
                                </span>
                                <span v-else class="text-neutral-400">-</span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span :class="pkg.is_active ? 'text-emerald-500 font-bold' : 'text-neutral-400'">
                                    {{ pkg.is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <Link :href="`/admin/packages/${pkg.id}/edit`" class="text-brand-600 font-bold hover:underline">
                                    Edit
                                </Link>
                                <button type="button" @click="deletePackage(pkg.id, pkg.name)" class="text-rose-600 font-bold hover:underline">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
