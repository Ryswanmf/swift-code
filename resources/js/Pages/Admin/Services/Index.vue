<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface ServiceRow {
    id: number;
    icon: string;
    title: string;
    description: string;
    badge: string | null;
    sort_order: number;
    is_active: boolean;
}

defineProps<{
    services: ServiceRow[];
}>();

const deleteService = (id: number, title: string) => {
    if (confirm(`Hapus layanan "${title}"?`)) {
        router.delete(`/admin/services/${id}`);
    }
};
</script>

<template>
    <Head title="Kelola Layanan - Panel Admin" />

    <AdminLayout title="Kelola Layanan">
        <div class="space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">Daftar Layanan Website ({{ services.length }})</h2>
                    <p class="text-xs text-neutral-500">Kelola daftar layanan dan solusi pembuatan website</p>
                </div>
                <Link
                    href="/admin/services/create"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-sm transition-all self-start sm:self-auto"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Layanan</span>
                </Link>
            </div>

            <div class="bg-white dark:bg-neutral-900 rounded-2xl border border-neutral-200/90 dark:border-neutral-800 overflow-hidden shadow-xs">
                <table class="w-full text-left text-xs">
                    <thead class="bg-neutral-50 dark:bg-neutral-800/60 text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800">
                        <tr>
                            <th class="py-3.5 px-6 font-semibold">Ikon</th>
                            <th class="py-3.5 px-4 font-semibold">Nama Layanan</th>
                            <th class="py-3.5 px-4 font-semibold">Badge</th>
                            <th class="py-3.5 px-4 font-semibold text-center">Status</th>
                            <th class="py-3.5 px-4 font-semibold text-center">Urutan</th>
                            <th class="py-3.5 px-6 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
                        <tr v-if="services.length === 0">
                            <td colspan="6" class="py-10 text-center text-neutral-400">Belum ada data layanan.</td>
                        </tr>
                        <tr v-for="srv in services" :key="srv.id" class="hover:bg-neutral-50/50 dark:hover:bg-neutral-800/40">
                            <td class="py-4 px-6 text-2xl">{{ srv.icon }}</td>
                            <td class="py-4 px-4">
                                <p class="font-bold text-neutral-900 dark:text-white">{{ srv.title }}</p>
                                <p class="text-[11px] text-neutral-400 line-clamp-1 max-w-sm">{{ srv.description }}</p>
                            </td>
                            <td class="py-4 px-4">
                                <span v-if="srv.badge" class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-brand-50 text-brand-700 dark:bg-brand-950/60 dark:text-brand-300 border border-brand-200">
                                    {{ srv.badge }}
                                </span>
                                <span v-else class="text-neutral-400">-</span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span :class="srv.is_active ? 'text-emerald-500 font-bold' : 'text-neutral-400'">
                                    {{ srv.is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-center font-mono">{{ srv.sort_order }}</td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <Link :href="`/admin/services/${srv.id}/edit`" class="text-brand-600 font-bold hover:underline">
                                    Edit
                                </Link>
                                <button type="button" @click="deleteService(srv.id, srv.title)" class="text-rose-600 font-bold hover:underline">
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
