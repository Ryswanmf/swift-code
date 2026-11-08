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
    icon: props.service?.icon || 'rocket',
    title: props.service?.title || '',
    description: props.service?.description || '',
    badge: props.service?.badge || '',
    sort_order: props.service?.sort_order ?? 0,
    is_active: props.service?.is_active ?? true,
});

// Icon options with visual SVG and descriptions
const iconOptions = [
    { key: 'rocket', label: 'Roket (Kilat / Landing Page)' },
    { key: 'building', label: 'Gedung (Profil Bisnis / Korporat)' },
    { key: 'academic', label: 'Toga (Sekolah / Pendidikan)' },
    { key: 'cart', label: 'Keranjang (Toko Online / E-Commerce)' },
    { key: 'code', label: 'Kode (Sistem Web / Aplikasi)' },
    { key: 'tool', label: 'Perkakas (Maintenance / Optimasi)' },
    { key: 'server', label: 'Server (Hosting / Infrastruktur)' },
    { key: 'shield', label: 'Perisai (Keamanan / Proteksi SSL)' },
    { key: 'mobile', label: 'Ponsel (Mobile Responsive)' },
];

// Quick preset templates
const templates = [
    {
        name: 'Company Profile',
        badgePill: 'Profil Bisnis',
        icon: 'building',
        title: 'Website Profil Bisnis & Korporat',
        description: 'Desain website eksklusif untuk perusahaan dan instansi dengan tampilan elegan, cepat, dan teroptimasi SEO lokal Lampung.',
        badge: 'Paling Populer',
        sort_order: 1,
        is_active: true,
    },
    {
        name: 'Landing Page',
        badgePill: 'Iklan & Penjualan',
        icon: 'rocket',
        title: 'Landing Page Penjualan & Iklan',
        description: 'Halaman arahan fokus konversi tinggi dengan copywriting persuasif, integrasi tombol WhatsApp instan, dan loading super kilat.',
        badge: 'Favorit UMKM',
        sort_order: 2,
        is_active: true,
    },
    {
        name: 'Toko Online',
        badgePill: 'E-Commerce',
        icon: 'cart',
        title: 'Toko Online & Katalog Digital',
        description: 'Platform katalog produk modern, hitung estimasi ongkir otomatis ke seluruh Indonesia, dan alur checkout mudah langsung ke WhatsApp atau payment gateway.',
        badge: 'Katalog & Penjualan',
        sort_order: 3,
        is_active: true,
    },
    {
        name: 'Web Sekolah',
        badgePill: 'Pendidikan',
        icon: 'academic',
        title: 'Website Sekolah & Lembaga Pendidikan',
        description: 'Portal informasi resmi institusi pendidikan dengan publikasi pengumuman sekolah, kalender akademik, galeri siswa, dan alur formulir PPDB online.',
        badge: 'Domain Resmi Institusi',
        sort_order: 4,
        is_active: true,
    },
    {
        name: 'Sistem Custom',
        badgePill: 'Aplikasi Web',
        icon: 'code',
        title: 'Sistem Informasi & Web App Kustom',
        description: 'Aplikasi berbasis web sesuai alur kerja spesifik usaha: manajemen stok inventaris, kasir, absensi, hingga dashboard operasional internal.',
        badge: 'Solusi Khusus',
        sort_order: 5,
        is_active: true,
    },
    {
        name: 'Redesign Web',
        badgePill: 'Optimasi',
        icon: 'tool',
        title: 'Redesign & Optimasi SEO Website',
        description: 'Perbarui website lama yang lambat, berantakan, atau rusak agar kembali modern, cepat di HP, dan naik ke halaman utama Google.',
        badge: 'Performa & Traffic',
        sort_order: 6,
        is_active: true,
    },
];

const loadTemplate = (tmpl: typeof templates[0]) => {
    form.icon = tmpl.icon;
    form.title = tmpl.title;
    form.description = tmpl.description;
    form.badge = tmpl.badge;
    form.sort_order = tmpl.sort_order;
    form.is_active = tmpl.is_active;
};

// Preset badge chips
const badgeSuggestions = [
    'Paling Populer',
    'Favorit UMKM',
    'Best Seller',
    'Solusi Khusus',
    'Domain Resmi Institusi',
    'Performa & Traffic',
    'Support 24/7',
];

const setBadge = (val: string) => {
    form.badge = val;
};

const submit = () => {
    if (props.isEdit && props.service) {
        form.put(`/admin/services/${props.service.id}`);
    } else {
        form.post('/admin/services');
    }
};
</script>

<template>
    <Head :title="`${isEdit ? 'Edit' : 'Tambah'} Layanan - Panel Admin Swift Code`" />

    <AdminLayout :title="`${isEdit ? 'Edit' : 'Tambah'} Layanan`">
        <div class="max-w-3xl mx-auto space-y-6">
            <!-- Header bar -->
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
                        {{ isEdit ? `Edit: ${service?.title}` : 'Tambah Layanan Baru' }}
                    </h2>
                    <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-0.5">
                        Kelola data penawaran solusi pembuatan website yang ditampilkan pada pengunjung.
                    </p>
                </div>
                <Link
                    href="/admin/services"
                    class="inline-flex items-center gap-1.5 px-4 py-2 bg-neutral-200 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 font-bold text-xs rounded-xl hover:bg-neutral-300 dark:hover:bg-neutral-700 transition-all"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali</span>
                </Link>
            </div>

            <!-- Preset Templates (Create mode only) -->
            <div v-if="!isEdit" class="p-5 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-3">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xs font-bold text-neutral-900 dark:text-white uppercase tracking-wider">
                            Template Kilat Layanan
                        </h3>
                        <p class="text-[11px] text-neutral-500">
                            Pilih salah satu template solusi untuk mengisi form secara otomatis.
                        </p>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-brand-50 text-brand-700 dark:bg-brand-950/60 dark:text-brand-300 border border-brand-200 dark:border-brand-800">
                        Pintasan Cepat
                    </span>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 pt-1">
                    <button
                        v-for="(tmpl, idx) in templates"
                        :key="idx"
                        type="button"
                        @click="loadTemplate(tmpl)"
                        class="p-3 text-left rounded-xl border border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-800/60 hover:border-brand-500 hover:bg-brand-50/40 dark:hover:bg-brand-950/30 transition-all group"
                    >
                        <span class="inline-block px-1.5 py-0.5 text-[10px] font-bold rounded-md bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 text-neutral-700 dark:text-neutral-300 group-hover:text-brand-600 mb-1">
                            {{ tmpl.badgePill }}
                        </span>
                        <p class="font-bold text-xs text-neutral-900 dark:text-white group-hover:text-brand-600 transition-colors line-clamp-1">
                            {{ tmpl.title }}
                        </p>
                        <p class="text-[10px] text-neutral-400 font-mono mt-0.5">
                            Ikon: {{ tmpl.icon }}
                        </p>
                    </button>
                </div>
            </div>

            <!-- Main Form Card -->
            <form
                @submit.prevent="submit"
                class="p-6 sm:p-8 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-6"
            >
                <!-- Visual Icon Selector -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider">
                            Pilih Ikon Layanan <span class="text-rose-500">*</span>
                        </label>
                        <span class="text-[11px] text-neutral-500 font-mono">
                            Ikon terpilih: <strong class="text-brand-600 dark:text-brand-400 font-bold">{{ form.icon }}</strong>
                        </span>
                    </div>

                    <div class="grid grid-cols-3 sm:grid-cols-5 gap-2.5">
                        <button
                            v-for="ico in iconOptions"
                            :key="ico.key"
                            type="button"
                            @click="form.icon = ico.key"
                            :class="[
                                'p-3 rounded-xl border flex flex-col items-center justify-center gap-1.5 transition-all text-center group',
                                form.icon === ico.key
                                    ? 'bg-brand-50 dark:bg-brand-950/60 border-brand-500 text-brand-600 dark:text-brand-400 ring-2 ring-brand-500/20 shadow-xs'
                                    : 'bg-neutral-50 dark:bg-neutral-800/60 border-neutral-200 dark:border-neutral-700 text-neutral-600 dark:text-neutral-400 hover:border-neutral-300',
                            ]"
                        >
                            <div class="w-6 h-6 flex items-center justify-center">
                                <!-- Rocket -->
                                <svg v-if="ico.key === 'rocket'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <!-- Building -->
                                <svg v-else-if="ico.key === 'building'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <!-- Academic -->
                                <svg v-else-if="ico.key === 'academic'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5" />
                                </svg>
                                <!-- Cart -->
                                <svg v-else-if="ico.key === 'cart'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                <!-- Code -->
                                <svg v-else-if="ico.key === 'code'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                </svg>
                                <!-- Tool -->
                                <svg v-else-if="ico.key === 'tool'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                                </svg>
                                <!-- Server -->
                                <svg v-else-if="ico.key === 'server'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                                </svg>
                                <!-- Shield -->
                                <svg v-else-if="ico.key === 'shield'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                <!-- Mobile -->
                                <svg v-else-if="ico.key === 'mobile'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="text-[10px] font-bold capitalize">{{ ico.key }}</span>
                        </button>
                    </div>

                    <div class="pt-1">
                        <input
                            v-model="form.icon"
                            type="text"
                            required
                            placeholder="Ketik kode ikon kustom (misal: rocket, building, cart)"
                            class="w-full px-4 py-2 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-mono focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                        <p v-if="form.errors.icon" class="text-xs text-rose-500 mt-1 font-semibold">{{ form.errors.icon }}</p>
                    </div>
                </div>

                <!-- Title -->
                <div>
                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                        Nama Layanan <span class="text-rose-500">*</span>
                    </label>
                    <input
                        v-model="form.title"
                        type="text"
                        required
                        placeholder="Contoh: Landing Page Penjualan & Iklan"
                        class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none transition-all"
                    />
                    <p v-if="form.errors.title" class="text-xs text-rose-500 mt-1 font-semibold">{{ form.errors.title }}</p>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                        Deskripsi Layanan & Nilai Tambah <span class="text-rose-500">*</span>
                    </label>
                    <textarea
                        v-model="form.description"
                        rows="3"
                        required
                        placeholder="Jelaskan manfaat, keunggulan, atau solusi yang diberikan layanan ini bagi calon klien..."
                        class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none resize-none transition-all"
                    ></textarea>
                    <p v-if="form.errors.description" class="text-xs text-rose-500 mt-1 font-semibold">{{ form.errors.description }}</p>
                </div>

                <!-- Badge and Sort Order -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2 border-t border-neutral-100 dark:border-neutral-800">
                    <!-- Badge Input & Suggestions -->
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider">
                            Badge Penanda (Opsional)
                        </label>
                        <input
                            v-model="form.badge"
                            type="text"
                            placeholder="Contoh: Paling Populer, Favorit UMKM"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none transition-all"
                        />
                        <div class="flex flex-wrap items-center gap-1.5 pt-1">
                            <span class="text-[10px] text-neutral-400">Pilihan:</span>
                            <button
                                v-for="bg in badgeSuggestions"
                                :key="bg"
                                type="button"
                                @click="setBadge(bg)"
                                class="px-2 py-0.5 rounded-md text-[10px] font-semibold bg-neutral-100 dark:bg-neutral-800 hover:bg-brand-50 dark:hover:bg-brand-950 text-neutral-600 dark:text-neutral-400 hover:text-brand-600 transition-colors"
                            >
                                {{ bg }}
                            </button>
                        </div>
                        <p v-if="form.errors.badge" class="text-xs text-rose-500 mt-1 font-semibold">{{ form.errors.badge }}</p>
                    </div>

                    <!-- Sort Order -->
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Urutan Tampil (Sort Order)
                        </label>
                        <input
                            v-model.number="form.sort_order"
                            type="number"
                            min="0"
                            placeholder="0"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none transition-all font-mono"
                        />
                        <p class="text-[11px] text-neutral-400 mt-1">
                            Angka lebih kecil akan ditampilkan lebih dulu pada katalog layanan.
                        </p>
                        <p v-if="form.errors.sort_order" class="text-xs text-rose-500 mt-1 font-semibold">{{ form.errors.sort_order }}</p>
                    </div>
                </div>

                <!-- Active Toggle Switch -->
                <div class="pt-2 border-t border-neutral-100 dark:border-neutral-800">
                    <label class="flex items-center gap-2.5 cursor-pointer select-none">
                        <input
                            v-model="form.is_active"
                            type="checkbox"
                            class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500 border-neutral-300 dark:border-neutral-700"
                        />
                        <div>
                            <span class="text-xs font-bold text-neutral-800 dark:text-neutral-200 block">
                                Tampilkan di Halaman Layanan Publik
                            </span>
                            <span class="text-[10px] text-neutral-400">
                                Jika dinonaktifkan, layanan ini akan disimpan sebagai draft internal dan tidak terlihat oleh pengunjung.
                            </span>
                        </div>
                    </label>
                </div>

                <!-- Submit Button Bar -->
                <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800 flex items-center justify-between">
                    <p class="text-[11px] text-neutral-400">
                        Perubahan akan langsung tercermin pada halaman publik setelah disimpan.
                    </p>

                    <div class="flex items-center gap-3">
                        <Link
                            href="/admin/services"
                            class="px-5 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 text-neutral-700 dark:text-neutral-300 font-bold text-xs hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-all"
                        >
                            Batal
                        </Link>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md shadow-brand-600/30 disabled:opacity-50 transition-all"
                        >
                            <svg v-if="form.processing" class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <span>{{ form.processing ? 'Menyimpan...' : (isEdit ? 'Simpan Perubahan' : 'Tambahkan Layanan') }}</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
