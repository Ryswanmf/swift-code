<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface PackageData {
    id?: number;
    name: string;
    price: number | null;
    price_note: string | null;
    features: string[];
    is_highlighted: boolean;
    sort_order: number;
    is_active: boolean;
}

const props = defineProps<{
    package: PackageData | null;
    isEdit: boolean;
}>();

const form = useForm({
    name: props.package?.name || '',
    price: props.package?.price !== null && props.package?.price !== undefined ? props.package.price : '',
    price_note: props.package?.price_note || '',
    features: props.package?.features ? props.package.features.join('\n') : '',
    is_highlighted: props.package?.is_highlighted ?? false,
    is_active: props.package?.is_active ?? true,
    sort_order: props.package?.sort_order ?? 0,
});

const submit = () => {
    if (props.isEdit && props.package) {
        form.put(`/admin/packages/${props.package.id}`);
    } else {
        form.post('/admin/packages');
    }
};
</script>

<template>
    <Head :title="`${isEdit ? 'Edit' : 'Tambah'} Paket Harga - Panel Admin`" />

    <AdminLayout :title="`${isEdit ? 'Edit' : 'Tambah'} Paket Harga`">
        <div class="max-w-2xl mx-auto space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">
                        {{ isEdit ? `Edit: ${package?.name}` : 'Tambah Paket Harga Baru' }}
                    </h2>
                    <p class="text-xs text-neutral-500">Kelola nama, harga, dan poin fitur paket</p>
                </div>
                <Link href="/admin/packages" class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 font-bold text-xs rounded-xl">
                    Kembali
                </Link>
            </div>

            <form @submit.prevent="submit" class="p-6 sm:p-8 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-5">
                <div>
                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                        Nama Paket <span class="text-brand-600">*</span>
                    </label>
                    <input
                        v-model="form.name"
                        type="text"
                        required
                        placeholder="Contoh: Paket Business (Company Profile)"
                        class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                    />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Harga (Nominal Angka)
                        </label>
                        <input
                            v-model="form.price"
                            type="number"
                            min="0"
                            placeholder="Kosongkan jika Custom / Hubungi Kami"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                        <p class="text-[10px] text-neutral-400 mt-1">Kosongkan jika paket custom</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Catatan Harga (Subteks)
                        </label>
                        <input
                            v-model="form.price_note"
                            type="text"
                            placeholder="Contoh: Mulai dari • Paling diminati"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                        Daftar Fitur (Satu baris per fitur) <span class="text-brand-600">*</span>
                    </label>
                    <textarea
                        v-model="form.features"
                        rows="6"
                        required
                        placeholder="1 Halaman Landing Page&#10;Domain .com gratis 1 tahun&#10;Hosting SSD cepat&#10;Sertifikat SSL aktif"
                        class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none font-mono"
                    ></textarea>
                    <p class="text-[10px] text-neutral-400 mt-1">Tekan Enter untuk membuat baris fitur baru.</p>
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

                    <div class="space-y-2 pt-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input
                                v-model="form.is_highlighted"
                                type="checkbox"
                                class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500"
                            />
                            <span class="text-xs font-bold text-neutral-700 dark:text-neutral-300">Highlight / Paket Paling Diminati</span>
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer">
                            <input
                                v-model="form.is_active"
                                type="checkbox"
                                class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500"
                            />
                            <span class="text-xs font-bold text-neutral-700 dark:text-neutral-300">Status Aktif di Halaman Publik</span>
                        </label>
                    </div>
                </div>

                <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800 flex justify-end gap-3">
                    <Link href="/admin/packages" class="px-5 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 text-neutral-700 dark:text-neutral-300 font-bold text-xs hover:bg-neutral-100">
                        Batal
                    </Link>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md shadow-brand-600/30 transition-all"
                    >
                        {{ form.processing ? 'Menyimpan...' : (isEdit ? 'Simpan Perubahan' : 'Tambahkan Paket') }}
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
