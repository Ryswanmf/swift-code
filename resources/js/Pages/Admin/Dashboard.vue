<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '../../Layouts/AdminLayout.vue';

interface Stats {
    new_leads: number;
    total_leads: number;
    total_projects: number;
    total_services: number;
    total_packages: number;
}

interface RecentLead {
    id: number;
    name: string;
    phone: string;
    service_type: string;
    budget: string | null;
    status: 'new' | 'contacted' | 'deal' | 'lost';
    created_at: string;
}

interface RecentProject {
    id: number;
    title: string;
    category: string;
    client_name: string | null;
    is_published: boolean;
    created_at: string;
}

defineProps<{
    stats: Stats;
    recentLeads: RecentLead[];
    recentProjects: RecentProject[];
}>();

const statusLabels: Record<string, { label: string; class: string }> = {
    new: { label: 'Baru', class: 'bg-rose-50 text-rose-700 dark:bg-rose-950/60 dark:text-rose-300 border-rose-200 dark:border-rose-800' },
    contacted: { label: 'Dihubungi', class: 'bg-amber-50 text-amber-700 dark:bg-amber-950/60 dark:text-amber-300 border-amber-200 dark:border-amber-800' },
    deal: { label: 'Deal / Closing', class: 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800' },
    lost: { label: 'Batal', class: 'bg-neutral-100 text-neutral-600 dark:bg-neutral-800 dark:text-neutral-400 border-neutral-200 dark:border-neutral-700' },
};
</script>

<template>
    <Head title="Dashboard Ringkasan - Panel Admin" />

    <AdminLayout title="Dashboard Ringkasan">
        <div class="space-y-8">
            <!-- Metric Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Card 1: Leads Baru -->
                <div class="p-6 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-neutral-500 uppercase tracking-wider">Leads Baru</p>
                        <p class="text-3xl font-black text-rose-600 dark:text-rose-500 mt-1">{{ stats.new_leads }}</p>
                        <p class="text-xs text-neutral-400 mt-1">Perlu ditindaklanjuti</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                </div>

                <!-- Card 2: Total Semua Leads -->
                <div class="p-6 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-neutral-500 uppercase tracking-wider">Total Leads</p>
                        <p class="text-3xl font-black text-neutral-900 dark:text-white mt-1">{{ stats.total_leads }}</p>
                        <p class="text-xs text-neutral-400 mt-1">Semua pesan masuk</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>

                <!-- Card 3: Total Portofolio -->
                <div class="p-6 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-neutral-500 uppercase tracking-wider">Portofolio</p>
                        <p class="text-3xl font-black text-neutral-900 dark:text-white mt-1">{{ stats.total_projects }}</p>
                        <p class="text-xs text-neutral-400 mt-1">Proyek terdaftar</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>

                <!-- Card 4: Layanan & Paket -->
                <div class="p-6 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-neutral-500 uppercase tracking-wider">Layanan / Paket</p>
                        <p class="text-3xl font-black text-neutral-900 dark:text-white mt-1">
                            {{ stats.total_services }} <span class="text-base font-normal text-neutral-400">/ {{ stats.total_packages }}</span>
                        </p>
                        <p class="text-xs text-neutral-400 mt-1">Siap tampil di publik</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Two Columns: Recent Leads & Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Left: Recent Leads Table (8 cols) -->
                <div class="lg:col-span-8 bg-white dark:bg-neutral-900 rounded-2xl border border-neutral-200/90 dark:border-neutral-800 shadow-xs p-6 space-y-4">
                    <div class="flex items-center justify-between pb-4 border-b border-neutral-100 dark:border-neutral-800">
                        <div>
                            <h2 class="text-base font-bold text-neutral-900 dark:text-white">Pesan & Lead Calon Klien Terbaru</h2>
                            <p class="text-xs text-neutral-500">Tindak lanjuti calon pembeli yang mengirim formulir</p>
                        </div>
                        <Link href="/admin/leads" class="text-xs font-bold text-brand-600 hover:text-brand-700">
                            Lihat Semua →
                        </Link>
                    </div>

                    <div v-if="recentLeads.length === 0" class="py-8 text-center text-neutral-400 text-sm">
                        Belum ada pesan calon klien masuk.
                    </div>

                    <div v-else class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800">
                                <tr>
                                    <th class="py-3 font-semibold">Nama / Bisnis</th>
                                    <th class="py-3 font-semibold">Layanan</th>
                                    <th class="py-3 font-semibold">Status</th>
                                    <th class="py-3 font-semibold text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
                                <tr v-for="lead in recentLeads" :key="lead.id" class="hover:bg-neutral-50/50 dark:hover:bg-neutral-800/40">
                                    <td class="py-3.5">
                                        <p class="font-bold text-neutral-900 dark:text-white">{{ lead.name }}</p>
                                        <p class="text-[11px] text-neutral-400">{{ lead.phone }}</p>
                                    </td>
                                    <td class="py-3.5 text-neutral-600 dark:text-neutral-300">
                                        {{ lead.service_type }}
                                    </td>
                                    <td class="py-3.5">
                                        <span
                                            :class="[
                                                'px-2 py-0.5 rounded-md text-[10px] font-bold border uppercase',
                                                statusLabels[lead.status]?.class || 'bg-neutral-100',
                                            ]"
                                        >
                                            {{ statusLabels[lead.status]?.label || lead.status }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 text-right space-x-1.5 whitespace-nowrap">
                                        <Link
                                            :href="`/admin/leads/${lead.id}`"
                                            class="inline-flex items-center px-2 py-1 rounded-lg bg-neutral-100 dark:bg-neutral-800 hover:bg-brand-600 hover:text-white transition-colors text-xs font-semibold"
                                        >
                                            Detail
                                        </Link>
                                        <Link
                                            :href="`/admin/leads/${lead.id}/edit`"
                                            class="inline-flex items-center px-2 py-1 rounded-lg text-brand-600 hover:bg-brand-50 dark:hover:bg-brand-950 font-bold transition-colors text-xs"
                                        >
                                            Edit
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Right: Quick Navigation & Projects (4 cols) -->
                <div class="lg:col-span-4 space-y-6">
                    <!-- Quick Actions -->
                    <div class="p-6 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-3">
                        <h3 class="text-sm font-bold text-neutral-900 dark:text-white uppercase tracking-wider">
                            Aksi Cepat
                        </h3>
                        <div class="grid grid-cols-1 gap-2 pt-1">
                            <Link
                                href="/admin/leads/create"
                                class="flex items-center gap-3 p-3 rounded-xl bg-brand-50 hover:bg-brand-100 dark:bg-brand-950/60 dark:hover:bg-brand-900/60 text-brand-700 dark:text-brand-300 font-bold text-xs transition-colors"
                            >
                                <svg class="w-4 h-4 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                <span>Tambah Kontak Masuk Baru</span>
                            </Link>
                            <Link
                                href="/admin/projects/create"
                                class="flex items-center gap-3 p-3 rounded-xl bg-neutral-50 hover:bg-neutral-100 dark:bg-neutral-800/60 dark:hover:bg-neutral-800 text-neutral-800 dark:text-neutral-200 font-bold text-xs transition-colors"
                            >
                                <svg class="w-4 h-4 text-neutral-600 dark:text-neutral-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                <span>Tambah Portofolio Proyek</span>
                            </Link>
                            <Link
                                href="/admin/articles/create"
                                class="flex items-center gap-3 p-3 rounded-xl bg-neutral-50 hover:bg-neutral-100 dark:bg-neutral-800/60 dark:hover:bg-neutral-800 text-neutral-800 dark:text-neutral-200 font-bold text-xs transition-colors"
                            >
                                <svg class="w-4 h-4 text-neutral-600 dark:text-neutral-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                                <span>Tulis Artikel & Panduan Baru</span>
                            </Link>
                            <Link
                                href="/admin/services/create"
                                class="flex items-center gap-3 p-3 rounded-xl bg-neutral-50 hover:bg-neutral-100 dark:bg-neutral-800/60 dark:hover:bg-neutral-800 text-neutral-800 dark:text-neutral-200 font-bold text-xs transition-colors"
                            >
                                <svg class="w-4 h-4 text-neutral-600 dark:text-neutral-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                <span>Tambah Layanan Baru</span>
                            </Link>
                            <Link
                                href="/admin/settings"
                                class="flex items-center gap-3 p-3 rounded-xl bg-neutral-50 hover:bg-neutral-100 dark:bg-neutral-800/60 dark:hover:bg-neutral-800 text-neutral-800 dark:text-neutral-200 font-bold text-xs transition-colors"
                            >
                                <svg class="w-4 h-4 text-neutral-600 dark:text-neutral-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Edit Nomor WA & Pengaturan</span>
                            </Link>
                        </div>
                    </div>

                    <!-- Recent Projects mini list -->
                    <div class="p-6 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-3">
                        <div class="flex items-center justify-between pb-2 border-b border-neutral-100 dark:border-neutral-800">
                            <h3 class="text-xs font-bold text-neutral-500 uppercase tracking-wider">Proyek Terbaru</h3>
                            <Link href="/admin/projects" class="text-xs text-brand-600 hover:text-brand-700 font-bold">Kelola</Link>
                        </div>
                        <div class="space-y-2">
                            <div
                                v-for="p in recentProjects"
                                :key="p.id"
                                class="flex items-center justify-between py-1.5 text-xs"
                            >
                                <div class="truncate max-w-[180px]">
                                    <p class="font-semibold text-neutral-900 dark:text-white truncate">{{ p.title }}</p>
                                    <p class="text-[10px] text-neutral-400 capitalize">{{ p.category }}</p>
                                </div>
                                <span :class="p.is_published ? 'text-emerald-500 font-semibold' : 'text-neutral-400'">
                                    {{ p.is_published ? 'Tayang' : 'Draft' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
