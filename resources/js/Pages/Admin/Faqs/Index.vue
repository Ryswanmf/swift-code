<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface FaqRow {
    id: number;
    question: string;
    answer: string;
    sort_order: number;
    is_published: boolean;
}

defineProps<{
    faqs: FaqRow[];
}>();

const deleteFaq = (id: number, question: string) => {
    if (confirm(`Hapus pertanyaan FAQ "${question}"?`)) {
        router.delete(`/admin/faqs/${id}`);
    }
};
</script>

<template>
    <Head title="Kelola FAQ - Panel Admin" />

    <AdminLayout title="Kelola FAQ">
        <div class="space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">Pertanyaan Umum / FAQ ({{ faqs.length }})</h2>
                    <p class="text-xs text-neutral-500">Kelola daftar pertanyaan dan jawaban yang sering diajukan calon klien</p>
                </div>
                <Link
                    href="/admin/faqs/create"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-sm transition-all self-start sm:self-auto"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah FAQ</span>
                </Link>
            </div>

            <div class="bg-white dark:bg-neutral-900 rounded-2xl border border-neutral-200/90 dark:border-neutral-800 overflow-hidden shadow-xs">
                <table class="w-full text-left text-xs">
                    <thead class="bg-neutral-50 dark:bg-neutral-800/60 text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800">
                        <tr>
                            <th class="py-3.5 px-6 font-semibold">Pertanyaan</th>
                            <th class="py-3.5 px-4 font-semibold">Jawaban</th>
                            <th class="py-3.5 px-4 font-semibold text-center">Urutan</th>
                            <th class="py-3.5 px-4 font-semibold text-center">Status</th>
                            <th class="py-3.5 px-6 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
                        <tr v-if="faqs.length === 0">
                            <td colspan="5" class="py-10 text-center text-neutral-400">Belum ada pertanyaan FAQ.</td>
                        </tr>
                        <tr v-for="faq in faqs" :key="faq.id" class="hover:bg-neutral-50/50 dark:hover:bg-neutral-800/40">
                            <td class="py-4 px-6 font-bold text-neutral-900 dark:text-white max-w-xs">
                                {{ faq.question }}
                            </td>
                            <td class="py-4 px-4 text-neutral-600 dark:text-neutral-300 max-w-sm">
                                <p class="line-clamp-2">{{ faq.answer }}</p>
                            </td>
                            <td class="py-4 px-4 text-center font-mono">{{ faq.sort_order }}</td>
                            <td class="py-4 px-4 text-center">
                                <span :class="faq.is_published ? 'text-emerald-500 font-bold' : 'text-neutral-400'">
                                    {{ faq.is_published ? 'Tayang' : 'Draft' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <Link :href="`/admin/faqs/${faq.id}/edit`" class="text-brand-600 font-bold hover:underline">
                                    Edit
                                </Link>
                                <button type="button" @click="deleteFaq(faq.id, faq.question)" class="text-rose-600 font-bold hover:underline">
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
