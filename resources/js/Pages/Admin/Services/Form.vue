<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface ServiceData {
    id?: number;
    icon: string;
    title: string;
    description: string;
    badge: string | null;
    sort_order: number;
    is_active: boolean;
}

const props = defineProps<{
    service: ServiceData | null;
    isEdit: boolean;
}>();

const form = useForm({
    icon: props.service?.icon || '🚀',
    title: props.service?.title || '',
    description: props.service?.description || '',
    badge: props.service?.badge || '',
    sort_order: props.service?.sort_order ?? 0,
    is_active: props.service?.is_active ?? true,
});

const submit = () => {
    if (props.isEdit && props.service) {
        form.put(`/admin/services/${props.service.id}`);
    } else {
        form.post('/admin/services');
    }
};
</script>

<template>
    <Head :title="`${isEdit ? 'Edit' : 'Tambah'} Layanan - Panel Admin`" />

    <AdminLayout :title="`${isEdit ? 'Edit' : 'Tambah'} Layanan`">
        <div class="max-w-2xl mx-auto space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">
                        {{ isEdit ? `Edit: ${service?.title}` : 'Tambah Layanan Baru' }}
                    </h2>
                    <p class="text-xs text-neutral-500">Kelola info penawaran layanan website</p>
                </div>
                <Link href="/admin/services" class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 font-bold text-xs rounded-xl">
                    Kembali
                </Link>
            </div>

            <form @submit.prevent="submit" class="p-6 sm:p-8 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Ikon Emoji <span class="text-brand-600">*</span>
                        </label>
                        <input
                            v-model="form.icon"
                            type="text"
                            required
                            placeholder="🚀"
                            class="w-full text-center px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-lg focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Nama Layanan <span class="text-brand-600">*</span>
                        </label>
                        <input
                            v-model="form.title"
                            type="text"
                            required
                            placeholder="Contoh: Landing Page Konversi Tinggi"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                        Deskripsi Layanan <span class="text-brand-600">*</span>
                    </label>
                    <textarea
                        v-model="form.description"
                        rows="3"
                        required
                        placeholder="Penjelasan manfaat dan detail layanan ini..."
                        class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none resize-none"
                    ></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Badge Teks (Opsional)
                        </label>
                        <input
                            v-model="form.badge"
                            type="text"
                            placeholder="Contoh: Favorit UMKM"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                    </div>

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
                </div>

                <div class="pt-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            v-model="form.is_active"
                            type="checkbox"
                            class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500"
                        />
                        <span class="text-xs font-bold text-neutral-700 dark:text-neutral-300">Status Aktif di Halaman Publik</span>
                    </label>
                </div>

                <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800 flex justify-end gap-3">
                    <Link href="/admin/services" class="px-5 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 text-neutral-700 dark:text-neutral-300 font-bold text-xs hover:bg-neutral-100">
                        Batal
                    </Link>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md shadow-brand-600/30 transition-all"
                    >
                        {{ form.processing ? 'Menyimpan...' : (isEdit ? 'Simpan Perubahan' : 'Tambahkan Layanan') }}
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
