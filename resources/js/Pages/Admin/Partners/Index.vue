<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface PartnerRow {
    id: number;
    name: string;
    category: string | null;
    color: string;
    icon: string;
    logo_image: string | null;
    sort_order: number;
    is_active: boolean;
}

interface PaginationLinks {
    url: string | null;
    label: string;
    active: boolean;
}

interface PaginatedPartners {
    data: PartnerRow[];
    links: PaginationLinks[];
    total: number;
}

const props = defineProps<{
    partners: PaginatedPartners;
    filters: {
        status: string;
        search: string | null;
    };
    counts: {
        all: number;
        active: number;
        inactive: number;
    };
}>();

const deletePartner = (id: number, name: string) => {
    if (confirm(`Hapus mitra "${name}" dari marquee?`)) {
        router.delete(`/admin/partners/${id}`);
    }
};
</script>

<template>
    <Head title="Kelola Mitra & Klien - Panel Admin" />

    <AdminLayout title="Kelola Mitra">
        <div class="space-y-6">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">Mitra & Klien Marquee ({{ counts.all }})</h2>
                    <p class="text-xs text-neutral-500">Kelola daftar logo dan nama instansi yang tampil di pita bergerak Beranda</p>
                </div>
                <Link
                    href="/admin/partners/create"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-sm transition-all self-start sm:self-auto"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Mitra</span>
                </Link>
            </div>

            <!-- Table Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-2xl border border-neutral-200/90 dark:border-neutral-800 overflow-hidden shadow-xs">
                <table class="w-full text-left text-xs">
                    <thead class="bg-neutral-50 dark:bg-neutral-800/60 text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800">
                        <tr>
                            <th class="py-3.5 px-6 font-semibold">Nama Mitra</th>
                            <th class="py-3.5 px-4 font-semibold">Kategori / Sektor</th>
                            <th class="py-3.5 px-4 font-semibold">Tampilan Ikon / Logo</th>
                            <th class="py-3.5 px-4 font-semibold text-center">Urutan</th>
                            <th class="py-3.5 px-4 font-semibold text-center">Status</th>
                            <th class="py-3.5 px-6 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
                        <tr v-if="partners.data.length === 0">
                            <td colspan="6" class="py-10 text-center text-neutral-400">Belum ada data mitra.</td>
                        </tr>
                        <tr v-for="partner in partners.data" :key="partner.id" class="hover:bg-neutral-50/50 dark:hover:bg-neutral-800/40">
                            <td class="py-3.5 px-6 font-bold text-neutral-900 dark:text-white">
                                {{ partner.name }}
                            </td>
                            <td class="py-3.5 px-4 text-neutral-500">
                                {{ partner.category || '-' }}
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-2">
                                    <div v-if="partner.logo_image" class="w-7 h-7 rounded-lg bg-neutral-100 border p-0.5 overflow-hidden">
                                        <img :src="partner.logo_image" :alt="partner.name" class="w-full h-full object-contain" />
                                    </div>
                                    <div
                                        v-else
                                        :class="partner.color || 'from-brand-600 to-rose-600'"
                                        class="w-7 h-7 rounded-lg bg-gradient-to-br flex items-center justify-center text-white text-[10px] font-bold"
                                    >
                                        {{ partner.icon?.slice(0, 2).toUpperCase() }}
                                    </div>
                                    <span class="text-[11px] text-neutral-400 font-mono">{{ partner.icon }}</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-center font-mono text-neutral-400">
                                {{ partner.sort_order }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <span
                                    :class="[
                                        'px-2 py-0.5 rounded-full text-[10px] font-bold',
                                        partner.is_active
                                            ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-400'
                                            : 'bg-neutral-100 text-neutral-500 dark:bg-neutral-800 dark:text-neutral-400',
                                    ]"
                                >
                                    {{ partner.is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-6 text-right space-x-2">
                                <Link
                                    :href="`/admin/partners/${partner.id}/edit`"
                                    class="text-brand-600 hover:text-brand-700 font-semibold"
                                >
                                    Edit
                                </Link>
                                <button
                                    type="button"
                                    @click="deletePartner(partner.id, partner.name)"
                                    class="text-rose-600 hover:text-rose-700 font-semibold cursor-pointer"
                                >
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
