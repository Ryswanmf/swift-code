<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface FaqData {
    id?: number;
    question: string;
    answer: string;
    sort_order: number;
    is_published: boolean;
}

const props = defineProps<{
    faq: FaqData | null;
    isEdit: boolean;
}>();

const form = useForm({
    question: props.faq?.question || '',
    answer: props.faq?.answer || '',
    sort_order: props.faq?.sort_order ?? 0,
    is_published: props.faq?.is_published ?? true,
});

const submit = () => {
    if (props.isEdit && props.faq) {
        form.put(`/admin/faqs/${props.faq.id}`);
    } else {
        form.post('/admin/faqs');
    }
};
</script>

<template>
    <Head :title="`${isEdit ? 'Edit' : 'Tambah'} FAQ - Panel Admin`" />

    <AdminLayout :title="`${isEdit ? 'Edit' : 'Tambah'} FAQ`">
        <div class="max-w-2xl mx-auto space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">
                        {{ isEdit ? 'Edit Pertanyaan FAQ' : 'Tambah FAQ Baru' }}
                    </h2>
                    <p class="text-xs text-neutral-500">Kelola tanya jawab yang tampil pada accordion di beranda</p>
                </div>
                <Link href="/admin/faqs" class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 font-bold text-xs rounded-xl">
                    Kembali
                </Link>
            </div>

            <form @submit.prevent="submit" class="p-6 sm:p-8 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-5">
                <div>
                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                        Pertanyaan <span class="text-brand-600">*</span>
                    </label>
                    <input
                        v-model="form.question"
                        type="text"
                        required
                        placeholder="Contoh: Berapa lama pengerjaan website?"
                        class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                    />
                </div>

                <div>
                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                        Jawaban Lengkap <span class="text-brand-600">*</span>
                    </label>
                    <textarea
                        v-model="form.answer"
                        rows="4"
                        required
                        placeholder="Tuliskan jawaban yang ramah dan mudah dipahami calon klien..."
                        class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none resize-none"
                    ></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Urutan Tampil
                        </label>
                        <input
                            v-model.number="form.sort_order"
                            type="number"
                            min="0"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                    </div>

                    <div class="pt-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input
                                v-model="form.is_published"
                                type="checkbox"
                                class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500"
                            />
                            <span class="text-xs font-bold text-neutral-700 dark:text-neutral-300">Tayang di Accordion Publik</span>
                        </label>
                    </div>
                </div>

                <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800 flex justify-end gap-3">
                    <Link href="/admin/faqs" class="px-5 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 text-neutral-700 dark:text-neutral-300 font-bold text-xs hover:bg-neutral-100">
                        Batal
                    </Link>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md shadow-brand-600/30 transition-all"
                    >
                        {{ form.processing ? 'Menyimpan...' : (isEdit ? 'Simpan Perubahan' : 'Tambahkan FAQ') }}
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
