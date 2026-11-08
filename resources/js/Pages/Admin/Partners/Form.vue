<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface PartnerData {
    id?: number;
    name: string;
    category?: string | null;
    color?: string;
    icon?: string;
    logo_image?: string | null;
    sort_order?: number;
    is_active?: boolean;
}

const props = defineProps<{
    partner: PartnerData | null;
    isEdit: boolean;
}>();

const form = useForm({
    name: props.partner?.name || '',
    category: props.partner?.category || '',
    color: props.partner?.color || 'from-brand-600 to-rose-600',
    icon: props.partner?.icon || 'building',
    logo_image: null as File | string | null,
    sort_order: props.partner?.sort_order ?? 0,
    is_active: props.partner?.is_active ?? true,
});

const previewUrl = ref<string | null>(props.partner?.logo_image || null);

const handleFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.logo_image = file;
        previewUrl.value = URL.createObjectURL(file);
    }
};

const iconOptions = [
    { key: 'education', label: 'Toga / Pendidikan' },
    { key: 'leaf', label: 'Daun / Agro' },
    { key: 'clinic', label: 'Klinik / Kesehatan' },
    { key: 'coffee', label: 'Kopi / F&B' },
    { key: 'truck', label: 'Truk / Logistik' },
    { key: 'travel', label: 'Kompas / Wisata' },
    { key: 'shop', label: 'Toko / Retail' },
    { key: 'building', label: 'Gedung / Korporasi' },
];

const colorOptions = [
    { key: 'from-blue-600 to-indigo-700', label: 'Biru - Indigo (Pemerintah/Edukasi)' },
    { key: 'from-emerald-600 to-teal-700', label: 'Hijau Zamrud (Agrobisnis/Ekspor)' },
    { key: 'from-rose-600 to-pink-700', label: 'Mawar - Merah Muda (Kesehatan)' },
    { key: 'from-amber-600 to-orange-700', label: 'Kuning Jingga (Kopi/F&B)' },
    { key: 'from-cyan-600 to-blue-700', label: 'Cyan - Biru Muda (Sekolah)' },
    { key: 'from-neutral-700 to-neutral-900', label: 'Abu-Abu Gelap (Logistik)' },
    { key: 'from-purple-600 to-indigo-700', label: 'Ungu (Pariwisata)' },
    { key: 'from-brand-600 to-rose-600', label: 'Merah Brand Swift Code' },
];

const submit = () => {
    if (props.isEdit && props.partner?.id) {
        form.post(`/admin/partners/${props.partner.id}`, {
            headers: {
                'X-HTTP-Method-Override': 'PUT',
            },
        });
    } else {
        form.post('/admin/partners');
    }
};
</script>

<template>
    <Head :title="isEdit ? 'Edit Mitra - Panel Admin' : 'Tambah Mitra - Panel Admin'" />

    <AdminLayout :title="isEdit ? 'Edit Mitra' : 'Tambah Mitra Baru'">
        <div class="max-w-3xl space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">
                        {{ isEdit ? 'Edit Data Mitra' : 'Tambah Mitra Baru' }}
                    </h2>
                    <p class="text-xs text-neutral-500">
                        Mitra akan muncul pada pita marquee bergerak di halaman Beranda
                    </p>
                </div>
                <Link
                    href="/admin/partners"
                    class="px-3.5 py-2 rounded-xl border border-neutral-300 dark:border-neutral-700 text-xs font-semibold hover:bg-neutral-50 dark:hover:bg-neutral-800"
                >
                    Kembali
                </Link>
            </div>

            <form
                @submit.prevent="submit"
                class="p-6 sm:p-8 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-5"
            >
                <!-- Nama Mitra -->
                <div>
                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                        Nama Instansi / Perusahaan <span class="text-rose-500">*</span>
                    </label>
                    <input
                        v-model="form.name"
                        type="text"
                        required
                        placeholder="Contoh: PT Sinar Agro Lampung"
                        class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                    />
                    <p v-if="form.errors.name" class="text-xs text-rose-500 mt-1">{{ form.errors.name }}</p>
                </div>

                <!-- Kategori / Sektor -->
                <div>
                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                        Kategori / Sektor Usaha
                    </label>
                    <input
                        v-model="form.category"
                        type="text"
                        placeholder="Contoh: Agrobisnis & Ekspor, Instansi Pemerintah, dll"
                        class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                    />
                    <p v-if="form.errors.category" class="text-xs text-rose-500 mt-1">{{ form.errors.category }}</p>
                </div>

                <!-- Upload Logo Mitra (Opsional) -->
                <div>
                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                        Upload Logo Mitra (PNG / WebP Transparan - Opsional)
                    </label>
                    <div class="flex items-center gap-4">
                        <div v-if="previewUrl" class="w-16 h-16 rounded-xl border border-neutral-200 bg-neutral-50 p-1 flex items-center justify-center shrink-0">
                            <img :src="previewUrl" alt="Preview Logo" class="w-full h-full object-contain" />
                        </div>
                        <input
                            type="file"
                            accept="image/*"
                            @change="handleFileChange"
                            class="text-xs text-neutral-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100"
                        />
                    </div>
                    <p class="text-[10px] text-neutral-400 mt-1">Jika tidak mengunggah logo gambar, sistem akan menggunakan ikon warna di bawah.</p>
                </div>

                <!-- Ikon Fallback -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Pilihan Ikon Vektor
                        </label>
                        <select
                            v-model="form.icon"
                            class="w-full px-3 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs outline-none"
                        >
                            <option v-for="ico in iconOptions" :key="ico.key" :value="ico.key">
                                {{ ico.label }}
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Warna Latar Ikon
                        </label>
                        <select
                            v-model="form.color"
                            class="w-full px-3 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs outline-none"
                        >
                            <option v-for="col in colorOptions" :key="col.key" :value="col.key">
                                {{ col.label }}
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Urutan & Status -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-neutral-100 dark:border-neutral-800">
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Urutan Tampil
                        </label>
                        <input
                            v-model.number="form.sort_order"
                            type="number"
                            min="0"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-mono outline-none"
                        />
                    </div>

                    <div class="flex items-center pt-6">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input
                                v-model="form.is_active"
                                type="checkbox"
                                class="w-4 h-4 rounded text-brand-600 focus:ring-brand-500 border-neutral-300"
                            />
                            <span class="text-xs font-bold text-neutral-700 dark:text-neutral-300">Tampilkan di Marquee (Aktif)</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4 flex justify-end gap-3 border-t border-neutral-100 dark:border-neutral-800">
                    <Link
                        href="/admin/partners"
                        class="px-5 py-2.5 rounded-xl border border-neutral-300 text-xs font-bold text-neutral-700 hover:bg-neutral-50"
                    >
                        Batal
                    </Link>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold shadow-md shadow-brand-600/20 disabled:opacity-50"
                    >
                        {{ form.processing ? 'Menyimpan...' : (isEdit ? 'Simpan Perubahan' : 'Tambah Mitra') }}
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
