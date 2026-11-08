<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface LeadRow {
    id: number;
    name: string;
    phone: string;
    email: string | null;
    service_type: string;
    budget: string | null;
    message: string;
    status: 'new' | 'contacted' | 'deal' | 'lost';
    created_at: string;
}

interface PaginationData {
    data: LeadRow[];
    links: Array<{ url: string | null; label: string; active: boolean }>;
    total: number;
}

const props = defineProps<{
    leads: PaginationData;
    statusCounts: Record<string, number>;
    filters: { status?: string; search?: string };
}>();

const search = ref(props.filters.search || '');
const currentStatus = ref(props.filters.status || 'all');

const handleSearch = () => {
    router.get(
        '/admin/leads',
        { status: currentStatus.value !== 'all' ? currentStatus.value : undefined, search: search.value || undefined },
        { preserveState: true, replace: true },
    );
};

const filterStatus = (statusKey: string) => {
    currentStatus.value = statusKey;
    router.get(
        '/admin/leads',
        { status: statusKey !== 'all' ? statusKey : undefined, search: search.value || undefined },
        { preserveState: true, replace: true },
    );
};

const deleteLead = (id: number, name: string) => {
    if (confirm(`Hapus data lead dari "${name}"?`)) {
        router.delete(`/admin/leads/${id}`);
    }
};

const statusLabels: Record<string, { label: string; class: string }> = {
    new: { label: 'Baru', class: 'bg-rose-50 text-rose-700 dark:bg-rose-950/60 dark:text-rose-300 border-rose-200 dark:border-rose-800' },
    contacted: { label: 'Dihubungi', class: 'bg-amber-50 text-amber-700 dark:bg-amber-950/60 dark:text-amber-300 border-amber-200 dark:border-amber-800' },
    deal: { label: 'Deal / Closing', class: 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800' },
    lost: { label: 'Batal', class: 'bg-neutral-100 text-neutral-600 dark:bg-neutral-800 dark:text-neutral-400 border-neutral-200 dark:border-neutral-700' },
};

const getWaUrl = (phone: string, name: string, service: string) => {
    const clean = phone.replace(/[^0-9]/g, '');
    const cleanPhone = clean.startsWith('0') ? '62' + clean.slice(1) : clean;
    const text = `Halo Bapak/Ibu ${name}, terima kasih telah menghubungi Swift Code Lampung mengenai pembuatan website ${service}.`;
    return `https://wa.me/${cleanPhone}?text=${encodeURIComponent(text)}`;
};
</script>

<template>
    <Head title="Kelola Kontak & Leads - Panel Admin" />

    <AdminLayout title="Kelola Kontak & Leads">
        <div class="space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">Daftar Kontak & Leads ({{ leads.total }})</h2>
                    <p class="text-xs text-neutral-500">Kelola calon klien yang masuk dari formulir website, telepon, atau kontak langsung</p>
                </div>
                <Link
                    href="/admin/leads/create"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-sm shadow-brand-600/30 transition-all self-start sm:self-auto cursor-pointer"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Kontak Baru</span>
                </Link>
            </div>

            <!-- Status Tabs -->
            <div class="flex flex-wrap gap-2 border-b border-neutral-200 dark:border-neutral-800 pb-3">
                <button
                    type="button"
                    @click="filterStatus('all')"
                    :class="[
                        'px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2',
                        currentStatus === 'all'
                            ? 'bg-neutral-900 text-white dark:bg-white dark:text-neutral-900'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100',
                    ]"
                >
                    <span>Semua</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-neutral-200/60 dark:bg-neutral-800">
                        {{ statusCounts.all }}
                    </span>
                </button>

                <button
                    type="button"
                    @click="filterStatus('new')"
                    :class="[
                        'px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2',
                        currentStatus === 'new'
                            ? 'bg-rose-600 text-white'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100',
                    ]"
                >
                    <span>Baru</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-rose-100 text-rose-800 dark:bg-rose-950 dark:text-rose-300">
                        {{ statusCounts.new }}
                    </span>
                </button>

                <button
                    type="button"
                    @click="filterStatus('contacted')"
                    :class="[
                        'px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2',
                        currentStatus === 'contacted'
                            ? 'bg-amber-500 text-white'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100',
                    ]"
                >
                    <span>Dihubungi</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300">
                        {{ statusCounts.contacted }}
                    </span>
                </button>

                <button
                    type="button"
                    @click="filterStatus('deal')"
                    :class="[
                        'px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2',
                        currentStatus === 'deal'
                            ? 'bg-emerald-600 text-white'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100',
                    ]"
                >
                    <span>Deal / Closing</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">
                        {{ statusCounts.deal }}
                    </span>
                </button>

                <button
                    type="button"
                    @click="filterStatus('lost')"
                    :class="[
                        'px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2',
                        currentStatus === 'lost'
                            ? 'bg-neutral-600 text-white'
                            : 'bg-white dark:bg-neutral-900 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100',
                    ]"
                >
                    <span>Batal</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-neutral-100 text-neutral-600 dark:bg-neutral-800 dark:text-neutral-400">
                        {{ statusCounts.lost }}
                    </span>
                </button>
            </div>

            <!-- Search box -->
            <div class="p-4 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 flex gap-3">
                <input
                    v-model="search"
                    @keyup.enter="handleSearch"
                    type="text"
                    placeholder="Cari nama, WhatsApp, email, atau jenis layanan..."
                    class="flex-1 px-4 py-2 text-xs rounded-xl border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white outline-none focus:ring-2 focus:ring-brand-500"
                />
                <button
                    type="button"
                    @click="handleSearch"
                    class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 hover:bg-neutral-300 text-neutral-800 dark:text-neutral-200 text-xs font-bold rounded-xl"
                >
                    Cari
                </button>
            </div>

            <!-- Leads Table -->
            <div class="bg-white dark:bg-neutral-900 rounded-2xl border border-neutral-200/90 dark:border-neutral-800 overflow-hidden shadow-xs">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-neutral-50 dark:bg-neutral-800/60 text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800">
                            <tr>
                                <th class="py-3.5 px-6 font-semibold">Nama & Kontak</th>
                                <th class="py-3.5 px-4 font-semibold">Layanan & Budget</th>
                                <th class="py-3.5 px-4 font-semibold">Pesan Masuk</th>
                                <th class="py-3.5 px-4 font-semibold text-center">Status</th>
                                <th class="py-3.5 px-6 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
                            <tr v-if="leads.data.length === 0">
                                <td colspan="5" class="py-12 text-center text-neutral-400">
                                    Tidak ada data lead pada kategori ini.
                                </td>
                            </tr>
                            <tr v-for="lead in leads.data" :key="lead.id" class="hover:bg-neutral-50/50 dark:hover:bg-neutral-800/40">
                                <td class="py-4 px-6">
                                    <p class="font-bold text-neutral-900 dark:text-white">{{ lead.name }}</p>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="text-[11px] text-neutral-500 font-mono">{{ lead.phone }}</span>
                                        <a
                                            :href="getWaUrl(lead.phone, lead.name, lead.service_type)"
                                            target="_blank"
                                            class="px-1.5 py-0.5 rounded bg-emerald-500 text-white text-[10px] font-bold hover:bg-emerald-600"
                                            title="Buka WhatsApp"
                                        >
                                            WA ↗
                                        </a>
                                    </div>
                                    <p v-if="lead.email" class="text-[10px] text-neutral-400 mt-0.5">{{ lead.email }}</p>
                                </td>
                                <td class="py-4 px-4">
                                    <p class="font-semibold text-neutral-900 dark:text-white">{{ lead.service_type }}</p>
                                    <p class="text-[11px] text-brand-600 dark:text-brand-400 mt-0.5">{{ lead.budget || 'Budget belum ditentukan' }}</p>
                                </td>
                                <td class="py-4 px-4 text-neutral-600 dark:text-neutral-300 max-w-xs">
                                    <p class="line-clamp-2">{{ lead.message }}</p>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span
                                        :class="[
                                            'px-2.5 py-1 rounded-md text-[10px] font-bold border uppercase',
                                            statusLabels[lead.status]?.class || 'bg-neutral-100',
                                        ]"
                                    >
                                        {{ statusLabels[lead.status]?.label || lead.status }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2 whitespace-nowrap">
                                    <Link
                                        :href="`/admin/leads/${lead.id}`"
                                        class="px-2.5 py-1 rounded-lg bg-neutral-100 dark:bg-neutral-800 hover:bg-brand-600 hover:text-white font-semibold transition-colors"
                                    >
                                        Detail
                                    </Link>
                                    <Link
                                        :href="`/admin/leads/${lead.id}/edit`"
                                        class="px-2.5 py-1 rounded-lg text-brand-600 hover:bg-brand-50 dark:hover:bg-brand-950/60 font-bold transition-colors"
                                    >
                                        Edit
                                    </Link>
                                    <button
                                        type="button"
                                        @click="deleteLead(lead.id, lead.name)"
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
                <div v-if="leads.links.length > 3" class="px-6 py-4 border-t border-neutral-100 dark:border-neutral-800 flex items-center justify-between">
                    <div class="flex items-center gap-1">
                        <template v-for="(link, i) in leads.links" :key="i">
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
