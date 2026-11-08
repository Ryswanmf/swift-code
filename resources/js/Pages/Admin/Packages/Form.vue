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
    is_highlighted: props.package ? Boolean(props.package.is_highlighted) : false,
    is_active: props.package ? Boolean(props.package.is_active) : true,
    sort_order: props.package?.sort_order ?? 0,
});

const featurePresets = [
    'Domain .com / .id gratis 1 tahun',
    'Hosting SSD kilat kapasitas tinggi 1 tahun',
    'Sertifikat keamanan SSL aktif',
    'Desain modern 100% mobile-first',
    'Tombol chat WhatsApp & form pesan leads',
    'Panel Admin mandiri untuk update konten',
    'Email bisnis resmi (@namaperusahaan.com)',
    'Optimasi SEO dasar Google Search',
    'Garansi pendampingan teknis 6 bulan',
];

const insertFeature = (text: string) => {
    const current = form.features.trim();
    if (!current) {
        form.features = text;
    } else {
        const lines = current.split('\n');
        if (!lines.includes(text)) {
            form.features = current + '\n' + text;
        }
    }
};

const applyTemplate = (type: 'landing' | 'company' | 'custom') => {
    if (type === 'landing') {
        form.name = 'Paket Basic (Landing Page)';
        form.price = 950000;
        form.price_note = 'Mulai dari • Cocok untuk promosi produk & UMKM';
        form.features = [
            '1 Halaman Landing Page responsif',
            'Desain modern & mobile-first',
            'Tombol WhatsApp & formulir kontak',
            'Domain .my.id / .com gratis 1 tahun',
            'Hosting kilat SSD 1 tahun',
            'Sertifikat keamanan SSL aktif',
            'Pengerjaan 3 - 5 hari kerja',
        ].join('\n');
        form.is_highlighted = false;
    } else if (type === 'company') {
        form.name = 'Paket Pro (Company Profile)';
        form.price = 2450000;
        form.price_note = 'Paling diminati • Standar resmi perusahaan & instansi';
        form.features = [
            'Hingga 5 - 7 Halaman menu terstruktur',
            'Panel Admin kelola konten & artikel',
            'Optimasi SEO dasar Google Search',
            'Domain .com / .sch.id gratis 1 tahun',
            'Hosting cepat kapasitas tinggi 1 tahun',
            'Email bisnis profesional (nama@perusahaan.com)',
            'Pengerjaan 5 - 10 hari kerja',
            'Garansi support 6 bulan penuh',
        ].join('\n');
        form.is_highlighted = true;
    } else if (type === 'custom') {
        form.name = 'Paket Custom / Sistem Web';
        form.price = '';
        form.price_note = 'Sesuai spesifikasi • Toko online & sistem khusus';
        form.features = [
            'Struktur database & fungsionalitas kustom',
            'Integrasi Payment Gateway / Ekspedisi Ongkir',
            'Hak akses multi-role (Admin, Kasir, Klien)',
            'Laporan data & export PDF/Excel',
            'Infrastruktur VPS / Server khusus',
            'Pelatihan langsung tim operasional',
            'Maintenance & pemeliharaan teratur',
        ].join('\n');
        form.is_highlighted = false;
    }
};

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
        <div class="max-w-3xl mx-auto space-y-6">
            <!-- Header bar -->
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">
                        {{ isEdit ? `Edit: ${package?.name}` : 'Tambah Paket Harga Baru' }}
                    </h2>
                    <p class="text-xs text-neutral-500">
                        Atur rincian investasi, nominal harga, poin fitur, dan highlight paket
                    </p>
                </div>
                <Link
                    href="/admin/packages"
                    class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 hover:bg-neutral-300 dark:hover:bg-neutral-700 text-neutral-700 dark:text-neutral-300 font-bold text-xs rounded-xl transition-colors cursor-pointer"
                >
                    Kembali
                </Link>
            </div>

            <!-- Form Card -->
            <form
                @submit.prevent="submit"
                class="p-6 sm:p-8 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-6"
            >
                <!-- Quick Template Selection (For Create Mode) -->
                <div v-if="!isEdit" class="p-4 rounded-xl bg-neutral-50 dark:bg-neutral-800/60 border border-neutral-200/70 dark:border-neutral-700 space-y-2">
                    <span class="text-xs font-bold text-neutral-700 dark:text-neutral-300 block">
                        Gunakan Template Rekomendasi Cepat:
                    </span>
                    <div class="flex flex-wrap gap-2">
                        <button
                            type="button"
                            @click="applyTemplate('landing')"
                            class="px-3 py-1.5 rounded-lg bg-white dark:bg-neutral-800 hover:bg-brand-50 text-neutral-700 dark:text-neutral-300 hover:text-brand-600 border border-neutral-200 dark:border-neutral-700 text-xs font-semibold transition-colors cursor-pointer"
                        >
                            Landing Page (Rp 950rb)
                        </button>
                        <button
                            type="button"
                            @click="applyTemplate('company')"
                            class="px-3 py-1.5 rounded-lg bg-white dark:bg-neutral-800 hover:bg-brand-50 text-neutral-700 dark:text-neutral-300 hover:text-brand-600 border border-neutral-200 dark:border-neutral-700 text-xs font-semibold transition-colors cursor-pointer"
                        >
                            Company Profile (Rp 2,45jt - Populer)
                        </button>
                        <button
                            type="button"
                            @click="applyTemplate('custom')"
                            class="px-3 py-1.5 rounded-lg bg-white dark:bg-neutral-800 hover:bg-brand-50 text-neutral-700 dark:text-neutral-300 hover:text-brand-600 border border-neutral-200 dark:border-neutral-700 text-xs font-semibold transition-colors cursor-pointer"
                        >
                            Custom / Toko Online
                        </button>
                    </div>
                </div>

                <!-- 1. Identitas Paket & Harga -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800 pb-2">
                        Nama Paket & Nominal Investasi
                    </h3>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Nama Paket <span class="text-brand-600">*</span>
                        </label>
                        <input
                            v-model="form.name"
                            type="text"
                            required
                            placeholder="Contoh: Paket Pro (Company Profile)"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-bold focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                        <p v-if="form.errors.name" class="mt-1 text-xs text-rose-500">{{ form.errors.name }}</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Nominal Harga (Hanya Angka)
                            </label>
                            <div class="relative flex items-center">
                                <span class="absolute left-3.5 text-xs font-bold text-neutral-400 font-mono">
                                    Rp
                                </span>
                                <input
                                    v-model="form.price"
                                    type="number"
                                    min="0"
                                    step="10000"
                                    placeholder="Kosongkan jika Custom"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-mono font-bold focus:ring-2 focus:ring-brand-500 outline-none"
                                />
                            </div>
                            <p class="text-[10px] text-neutral-400 mt-1">Kosongkan jika paket bersifat konsultasi / custom.</p>
                            <p v-if="form.errors.price" class="mt-1 text-xs text-rose-500">{{ form.errors.price }}</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Subteks / Keterangan Harga
                            </label>
                            <input
                                v-model="form.price_note"
                                type="text"
                                placeholder="Contoh: Mulai dari • Paling diminati"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                            <p v-if="form.errors.price_note" class="mt-1 text-xs text-rose-500">{{ form.errors.price_note }}</p>
                        </div>
                    </div>
                </div>

                <!-- 2. Fitur & Deliverables -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800 pb-2">
                        Daftar Fitur & Fasilitas (Deliverables)
                    </h3>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Fitur Paket (Satu baris per fitur) <span class="text-brand-600">*</span>
                        </label>
                        <textarea
                            v-model="form.features"
                            rows="7"
                            required
                            placeholder="1 Halaman Landing Page responsif&#10;Domain .com gratis 1 tahun&#10;Hosting SSD cepat 1 tahun&#10;Sertifikat SSL aktif&#10;Panel Admin mandiri"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none font-mono leading-relaxed"
                        ></textarea>
                        <p class="text-[10px] text-neutral-400 mt-1">Tekan Enter pada keyboard untuk membuat poin deliverable baru.</p>
                        <p v-if="form.errors.features" class="mt-1 text-xs text-rose-500">{{ form.errors.features }}</p>

                        <!-- Preset Feature Tags -->
                        <div class="mt-3">
                            <span class="text-[11px] text-neutral-500 dark:text-neutral-400 font-medium">Klik untuk menambahkan fitur standar:</span>
                            <div class="flex flex-wrap gap-1.5 mt-1.5">
                                <button
                                    v-for="preset in featurePresets"
                                    :key="preset"
                                    type="button"
                                    @click="insertFeature(preset)"
                                    class="px-2.5 py-1 text-[10px] rounded-lg bg-neutral-100 dark:bg-neutral-800 hover:bg-brand-50 dark:hover:bg-brand-950 text-neutral-700 dark:text-neutral-300 hover:text-brand-600 border border-neutral-200/80 dark:border-neutral-700 transition-colors cursor-pointer"
                                >
                                    + {{ preset }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Status & Urutan Tampil -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800 pb-2">
                        Status Tampil & Prioritas
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Urutan Prioritas Tampil
                            </label>
                            <input
                                v-model.number="form.sort_order"
                                type="number"
                                min="0"
                                placeholder="0"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-mono focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                            <p class="text-[10px] text-neutral-400 mt-1">Urutan 0 akan tampil paling kiri / atas.</p>
                            <p v-if="form.errors.sort_order" class="mt-1 text-xs text-rose-500">{{ form.errors.sort_order }}</p>
                        </div>

                        <div class="space-y-3 pt-2">
                            <label class="flex items-center gap-2.5 cursor-pointer">
                                <input
                                    v-model="form.is_highlighted"
                                    type="checkbox"
                                    class="w-4 h-4 text-brand-600 rounded border-neutral-300 focus:ring-brand-500"
                                />
                                <div>
                                    <span class="text-xs font-bold text-neutral-900 dark:text-white block">
                                        Badge "Paling Banyak Dipilih"
                                    </span>
                                    <span class="text-[10px] text-neutral-500 block">
                                        Memberikan kartu tema gelap menonjol dengan ring brand red.
                                    </span>
                                </div>
                            </label>

                            <label class="flex items-center gap-2.5 cursor-pointer">
                                <input
                                    v-model="form.is_active"
                                    type="checkbox"
                                    class="w-4 h-4 text-brand-600 rounded border-neutral-300 focus:ring-brand-500"
                                />
                                <div>
                                    <span class="text-xs font-bold text-neutral-900 dark:text-white block">
                                        Status Aktif di Halaman Publik
                                    </span>
                                    <span class="text-[10px] text-neutral-500 block">
                                        Paket akan tampil di Beranda dan halaman `/harga`.
                                    </span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Action Footer -->
                <div class="pt-5 border-t border-neutral-100 dark:border-neutral-800 flex items-center justify-end gap-3">
                    <Link
                        href="/admin/packages"
                        class="px-5 py-2.5 rounded-xl text-xs font-bold text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors"
                    >
                        Batal
                    </Link>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 active:bg-brand-800 text-white font-bold text-xs shadow-md shadow-brand-600/30 transition-all disabled:opacity-50 flex items-center gap-2 cursor-pointer"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ form.processing ? 'Menyimpan...' : (isEdit ? 'Simpan Perubahan Paket' : 'Tambahkan Paket Baru') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
