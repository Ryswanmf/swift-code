<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface ProjectRow {
    id: number;
    title: string;
    slug: string;
    category: string;
    client_name: string | null;
    cover_image: string | null;
    is_featured: boolean;
    is_published: boolean;
    sort_order: number;
}

interface PaginationData {
    data: ProjectRow[];
    links: Array<{ url: string | null; label: string; active: boolean }>;
    total: number;
}

const props = defineProps<{
    projects: PaginationData;
    filters: { category?: string; search?: string };
}>();

const search = ref(props.filters.search || '');
const category = ref(props.filters.category || '');

const handleFilter = () => {
    router.get(
        '/admin/projects',
        { search: search.value || undefined, category: category.value || undefined },
        { preserveState: true, replace: true },
    );
};

const deleteProject = (id: number, title: string) => {
    if (confirm(`Apakah Anda yakin ingin menghapus proyek "${title}"?`)) {
        router.delete(`/admin/projects/${id}`);
    }
};
</script>

<template>
    <Head title="Kelola Portofolio - Panel Admin" />

    <AdminLayout title="Portofolio Proyek">
        <div class="space-y-6">
            <!-- Header bar & Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">Daftar Portofolio ({{ projects.total }})</h2>
                    <p class="text-xs text-neutral-500">Kelola hasil karya dan proyek showcase website Swift Code</p>
                </div>
                <Link
                    href="/admin/projects/create"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-sm shadow-brand-600/30 transition-all self-start sm:self-auto"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Proyek Baru</span>
                </Link>
            </div>

            <!-- Filters -->
            <div class="p-4 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 flex flex-col sm:flex-row gap-3">
                <input
                    v-model="search"
                    @keyup.enter="handleFilter"
                    type="text"
                    placeholder="Cari judul proyek atau nama klien..."
                    class="flex-1 px-4 py-2 text-xs rounded-xl border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white outline-none focus:ring-2 focus:ring-brand-500"
                />
                <select
                    v-model="category"
                    @change="handleFilter"
                    class="px-4 py-2 text-xs rounded-xl border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white outline-none focus:ring-2 focus:ring-brand-500"
                >
                    <option value="">Semua Kategori</option>
                    <option value="company">Company Profile</option>
                    <option value="sekolah">Sekolah / Institusi</option>
                    <option value="toko">Toko Online</option>
                    <option value="sistem">Sistem Custom</option>
                </select>
                <button
                    type="button"
                    @click="handleFilter"
                    class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 hover:bg-neutral-300 text-neutral-800 dark:text-neutral-200 text-xs font-bold rounded-xl"
                >
                    Filter
                </button>
            </div>

            <!-- Table -->
            <div class="bg-white dark:bg-neutral-900 rounded-2xl border border-neutral-200/90 dark:border-neutral-800 overflow-hidden shadow-xs">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-neutral-50 dark:bg-neutral-800/60 text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800">
                            <tr>
                                <th class="py-3.5 px-6 font-semibold">Proyek</th>
                                <th class="py-3.5 px-4 font-semibold">Kategori</th>
                                <th class="py-3.5 px-4 font-semibold">Klien</th>
                                <th class="py-3.5 px-4 font-semibold text-center">Status</th>
                                <th class="py-3.5 px-4 font-semibold text-center">Urutan</th>
                                <th class="py-3.5 px-6 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
                            <tr v-if="projects.data.length === 0">
                                <td colspan="6" class="py-10 text-center text-neutral-400">
                                    Belum ada portofolio proyek yang ditambahkan.
                                </td>
                            </tr>
                            <tr
                                v-for="proj in projects.data"
                                :key="proj.id"
                                class="hover:bg-neutral-50/50 dark:hover:bg-neutral-800/40"
                            >
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-8 rounded-lg bg-neutral-100 dark:bg-neutral-800 overflow-hidden shrink-0 border border-neutral-200 dark:border-neutral-700">
                                            <img
                                                v-if="proj.cover_image"
                                                :src="proj.cover_image"
                                                :alt="proj.title"
                                                class="w-full h-full object-cover"
                                            />
                                            <div v-else class="w-full h-full flex items-center justify-center text-[10px] text-neutral-400 font-bold">
                                                IMG
                                            </div>
                                        </div>
                                        <div>
                                            <p class="font-bold text-neutral-900 dark:text-white">{{ proj.title }}</p>
                                            <span class="text-[10px] text-neutral-400">/portofolio/{{ proj.slug }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-neutral-600 dark:text-neutral-300 capitalize">
                                    {{ proj.category }}
                                </td>
                                <td class="py-4 px-4 text-neutral-600 dark:text-neutral-300">
                                    {{ proj.client_name || '-' }}
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span
                                        :class="[
                                            'px-2 py-0.5 rounded-md text-[10px] font-bold border uppercase',
                                            proj.is_published
                                                ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 border-emerald-200'
                                                : 'bg-neutral-100 text-neutral-500 border-neutral-200',
                                        ]"
                                    >
                                        {{ proj.is_published ? 'Tayang' : 'Draft' }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-center font-mono text-neutral-600 dark:text-neutral-400">
                                    {{ proj.sort_order }}
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <Link
                                        :href="`/portofolio/${proj.slug}`"
                                        target="_blank"
                                        class="inline-flex items-center justify-center p-1.5 rounded-lg text-neutral-600 hover:text-brand-600 bg-neutral-100 dark:bg-neutral-800 font-semibold"
                                        title="Pratinjau Halaman"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </Link>
                                    <Link
                                        :href="`/admin/projects/${proj.id}/edit`"
                                        class="px-2.5 py-1 rounded-lg text-brand-600 hover:bg-brand-50 dark:hover:bg-brand-950 font-bold"
                                    >
                                        Edit
                                    </Link>
                                    <button
                                        type="button"
                                        @click="deleteProject(proj.id, proj.title)"
                                        class="px-2.5 py-1 rounded-lg text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950 font-bold"
                                    >
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div v-if="projects.links.length > 3" class="px-6 py-4 border-t border-neutral-100 dark:border-neutral-800 flex items-center justify-between">
                    <div class="flex items-center gap-1">
                        <template v-for="(link, i) in projects.links" :key="i">
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
