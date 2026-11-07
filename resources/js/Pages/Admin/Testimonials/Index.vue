<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface TestimonialRow {
    id: number;
    name: string;
    role: string | null;
    company: string | null;
    quote: string;
    avatar: string | null;
    rating: number;
    is_published: boolean;
    sort_order: number;
}

defineProps<{
    testimonials: TestimonialRow[];
}>();

const deleteTestimonial = (id: number, name: string) => {
    if (confirm(`Hapus testimoni dari "${name}"?`)) {
        router.delete(`/admin/testimonials/${id}`);
    }
};
</script>

<template>
    <Head title="Kelola Testimoni - Panel Admin" />

    <AdminLayout title="Kelola Testimoni">
        <div class="space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">Ulasan Klien ({{ testimonials.length }})</h2>
                    <p class="text-xs text-neutral-500">Kelola ulasan dan kutipan testimoni klien yang tayang di halaman publik</p>
                </div>
                <Link
                    href="/admin/testimonials/create"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-sm transition-all self-start sm:self-auto"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Testimoni</span>
                </Link>
            </div>

            <div class="bg-white dark:bg-neutral-900 rounded-2xl border border-neutral-200/90 dark:border-neutral-800 overflow-hidden shadow-xs">
                <table class="w-full text-left text-xs">
                    <thead class="bg-neutral-50 dark:bg-neutral-800/60 text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800">
                        <tr>
                            <th class="py-3.5 px-6 font-semibold">Nama Klien</th>
                            <th class="py-3.5 px-4 font-semibold">Ulasan</th>
                            <th class="py-3.5 px-4 font-semibold text-center">Rating</th>
                            <th class="py-3.5 px-4 font-semibold text-center">Status</th>
                            <th class="py-3.5 px-6 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
                        <tr v-if="testimonials.length === 0">
                            <td colspan="5" class="py-10 text-center text-neutral-400">Belum ada testimoni.</td>
                        </tr>
                        <tr v-for="t in testimonials" :key="t.id" class="hover:bg-neutral-50/50 dark:hover:bg-neutral-800/40">
                            <td class="py-4 px-6">
                                <p class="font-bold text-neutral-900 dark:text-white">{{ t.name }}</p>
                                <p class="text-[11px] text-neutral-400">{{ t.role }}<span v-if="t.company">, {{ t.company }}</span></p>
                            </td>
                            <td class="py-4 px-4 text-neutral-600 dark:text-neutral-300">
                                <p class="line-clamp-2 max-w-md italic">"{{ t.quote }}"</p>
                            </td>
                            <td class="py-4 px-4 text-center text-amber-500 font-bold">
                                ⭐ {{ t.rating }}/5
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span :class="t.is_published ? 'text-emerald-500 font-bold' : 'text-neutral-400'">
                                    {{ t.is_published ? 'Tayang' : 'Draft' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <Link :href="`/admin/testimonials/${t.id}/edit`" class="text-brand-600 font-bold hover:underline">
                                    Edit
                                </Link>
                                <button type="button" @click="deleteTestimonial(t.id, t.name)" class="text-rose-600 font-bold hover:underline">
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
