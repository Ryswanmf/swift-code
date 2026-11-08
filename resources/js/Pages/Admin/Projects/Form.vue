<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface ProjectData {
    id?: number;
    title: string;
    slug: string;
    category: string;
    summary: string;
    description: string | null;
    client_name: string | null;
    live_url: string | null;
    cover_image: string | null;
    gallery: string[] | null;
    tech_stack: string[] | null;
    is_featured: boolean;
    is_published: boolean;
    sort_order: number;
}

const props = defineProps<{
    project: ProjectData | null;
    isEdit: boolean;
}>();

const coverPreview = ref<string | null>(props.project?.cover_image || null);
const existingGallery = ref<string[]>(
    props.project?.gallery && Array.isArray(props.project.gallery) ? [...props.project.gallery] : []
);
const galleryPreviews = ref<string[]>([]);
const deleteCover = ref(false);

const form = useForm({
    title: props.project?.title || '',
    slug: props.project?.slug || '',
    category: props.project?.category || 'company',
    summary: props.project?.summary || '',
    description: props.project?.description || '',
    client_name: props.project?.client_name || '',
    live_url: props.project?.live_url || '',
    tech_stack: props.project?.tech_stack ? props.project.tech_stack.join(', ') : 'Laravel, Vue.js, Tailwind CSS',
    is_featured: props.project?.is_featured ?? true,
    is_published: props.project?.is_published ?? true,
    sort_order: props.project?.sort_order ?? 0,
    cover_file: null as File | null,
    gallery_files: [] as File[],
    existing_gallery: [] as string[],
    delete_cover: false,
});

// Quick preset templates
const templates = [
    {
        name: 'Company Profile',
        badge: 'Profil Korporat',
        title: 'Website Profil Korporat & Bisnis Modern',
        category: 'company',
        client_name: 'PT Dinamika Karya Gemilang',
        live_url: 'https://dinamikakarya.co.id',
        summary: 'Website profil korporat modern dengan navigasi cepat, responsif di seluruh layar ponsel, dan teroptimasi SEO lokal untuk meningkatkan kredibilitas bisnis.',
        description: 'Membangun kehadiran digital korporasi yang profesional dan elegan dengan arsitektur headless modern. Dilengkapi integrasi langsung WhatsApp kontak, katalog portofolio layanan, dan struktur SEO on-page yang siap bersaing di halaman pencarian Google.',
        tech_stack: 'Laravel, Vue.js, Inertia.js, Tailwind CSS, MySQL',
        sort_order: 1,
        is_featured: true,
        is_published: true,
    },
    {
        name: 'Toko Online UMKM',
        badge: 'E-Commerce',
        title: 'Toko Online Kerajinan & Kuliner Khas Lampung',
        category: 'toko',
        client_name: 'Toko Keripik & Oleh-Oleh Shinta',
        live_url: 'https://shintaoleholeh.com',
        summary: 'Platform toko online modern dengan katalog produk cepat, kalkulator ongkir kurir terintegrasi, dan kemudahan order via WhatsApp atau payment gateway.',
        description: 'Solusi e-commerce terpadu yang membantu pelaku usaha lokal Lampung memperluas penjualan hingga ke luar daerah. Sistem katalog interaktif memungkinkan pelanggan memilih varian rasa, menghitung biaya kirim secara akurat, dan menyelesaikan pembayaran secara instan.',
        tech_stack: 'Laravel, Vue.js, Tailwind CSS, Midtrans API, MySQL',
        sort_order: 2,
        is_featured: true,
        is_published: true,
    },
    {
        name: 'Web Sekolah / Institusi',
        badge: 'Pendidikan',
        title: 'Portal Web Informasi & PPDB SMA Unggulan',
        category: 'sekolah',
        client_name: 'SMA Kebangsaan Lampung',
        live_url: 'https://smakebangsaan.sch.id',
        summary: 'Website resmi institusi pendidikan dengan publikasi pengumuman sekolah, agenda akademik, galeri kegiatan siswa, dan informasi pendaftaran PPDB online.',
        description: 'Mendukung transformasi digital dunia pendidikan di Lampung dengan portal sekolah yang informatif, ramah pengguna, dan cepat diakses oleh siswa maupun wali murid dari berbagai perangkat.',
        tech_stack: 'Laravel, Vue.js, Tailwind CSS, MySQL',
        sort_order: 3,
        is_featured: false,
        is_published: true,
    },
    {
        name: 'Sistem Informasi Web',
        badge: 'Aplikasi Web',
        title: 'Sistem Informasi Manajemen Logistik & Inventaris',
        category: 'sistem',
        client_name: 'PT Logistik Sejahtera Nusantara',
        live_url: 'https://app.logistiksejahtera.id',
        summary: 'Aplikasi web kustom untuk manajemen stok pergudangan multi-cabang, pelacakan armada pengiriman real-time, dan laporan operasional berkala.',
        description: 'Sistem operasional berbasis web yang dirancang khusus untuk memangkas proses manual dan meminimalisir kesalahan stok barang. Dilengkapi dashboard analitik performa armada, hak akses berbasis peran (RBAC), dan ekspor laporan terpadu.',
        tech_stack: 'Laravel, Vue.js, REST API, Tailwind CSS, MySQL',
        sort_order: 4,
        is_featured: true,
        is_published: true,
    },
];

const loadTemplate = (tmpl: typeof templates[0]) => {
    form.title = tmpl.title;
    form.category = tmpl.category;
    form.client_name = tmpl.client_name;
    form.live_url = tmpl.live_url;
    form.summary = tmpl.summary;
    form.description = tmpl.description;
    form.tech_stack = tmpl.tech_stack;
    form.sort_order = tmpl.sort_order;
    form.is_featured = tmpl.is_featured;
    form.is_published = tmpl.is_published;
};

// Tech stack chips
const availableTechs = [
    'Laravel',
    'Vue.js',
    'Inertia.js',
    'Tailwind CSS',
    'TypeScript',
    'MySQL',
    'Midtrans API',
    'REST API',
    'Alpine.js',
    'Filament',
];

const activeTechList = computed(() => {
    if (!form.tech_stack) return [];
    return form.tech_stack.split(',').map((t) => t.trim()).filter((t) => t.length > 0);
});

const toggleTech = (tech: string) => {
    const list = activeTechList.value;
    const index = list.indexOf(tech);
    if (index >= 0) {
        list.splice(index, 1);
    } else {
        list.push(tech);
    }
    form.tech_stack = list.join(', ');
};

const handleCoverChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.cover_file = file;
        deleteCover.value = false;
        form.delete_cover = false;
        coverPreview.value = URL.createObjectURL(file);
    }
};

const removeCover = () => {
    form.cover_file = null;
    coverPreview.value = null;
    deleteCover.value = true;
    form.delete_cover = true;
};

const removeExistingGalleryImage = (index: number) => {
    existingGallery.value.splice(index, 1);
};

const handleGalleryChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files) {
        const files = Array.from(target.files);
        form.gallery_files = [...form.gallery_files, ...files];
        galleryPreviews.value = [
            ...galleryPreviews.value,
            ...files.map((f) => URL.createObjectURL(f)),
        ];
    }
};

const removeNewGalleryFile = (index: number) => {
    form.gallery_files.splice(index, 1);
    galleryPreviews.value.splice(index, 1);
};

const submit = () => {
    form.existing_gallery = existingGallery.value;

    if (props.isEdit && props.project) {
        // Inertia multipart PUT is submitted via post with _method=PUT
        form.transform((data) => ({
            ...data,
            existing_gallery: existingGallery.value,
            _method: 'PUT',
        })).post(`/admin/projects/${props.project.id}`, {
            forceFormData: true,
        });
    } else {
        form.transform((data) => ({
            ...data,
            existing_gallery: existingGallery.value,
        })).post('/admin/projects', {
            forceFormData: true,
        });
    }
};
</script>

<template>
    <Head :title="`${isEdit ? 'Edit' : 'Tambah'} Portofolio - Panel Admin Swift Code`" />

    <AdminLayout :title="`${isEdit ? 'Edit' : 'Tambah'} Portofolio Proyek`">
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Header bar -->
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
                        {{ isEdit ? `Edit: ${project?.title}` : 'Tambah Portofolio Baru' }}
                    </h2>
                    <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-0.5">
                        Isi detail studi kasus proyek, teknologi yang digunakan, serta gambar sampul WebP.
                    </p>
                </div>
                <Link
                    href="/admin/projects"
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
                            Template Kilat Portofolio
                        </h3>
                        <p class="text-[11px] text-neutral-500">
                            Pilih salah satu preset untuk mengisi seluruh data form secara instan.
                        </p>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-brand-50 text-brand-700 dark:bg-brand-950/60 dark:text-brand-300 border border-brand-200 dark:border-brand-800">
                        Otomatisasi Cepat
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2.5 pt-1">
                    <button
                        v-for="(tmpl, idx) in templates"
                        :key="idx"
                        type="button"
                        @click="loadTemplate(tmpl)"
                        class="p-3 text-left rounded-xl border border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-800/60 hover:border-brand-500 hover:bg-brand-50/40 dark:hover:bg-brand-950/30 transition-all group"
                    >
                        <span class="inline-block px-1.5 py-0.5 text-[10px] font-bold rounded-md bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 text-neutral-700 dark:text-neutral-300 group-hover:text-brand-600 mb-1">
                            {{ tmpl.badge }}
                        </span>
                        <p class="font-bold text-xs text-neutral-900 dark:text-white group-hover:text-brand-600 transition-colors">
                            {{ tmpl.name }}
                        </p>
                        <p class="text-[11px] text-neutral-500 line-clamp-1 mt-0.5">
                            {{ tmpl.client_name }}
                        </p>
                    </button>
                </div>
            </div>

            <!-- Main Form Card -->
            <form
                @submit.prevent="submit"
                class="p-6 sm:p-8 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-6"
            >
                <!-- Title & Slug -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Judul Proyek <span class="text-rose-500">*</span>
                        </label>
                        <input
                            v-model="form.title"
                            type="text"
                            required
                            placeholder="Contoh: Website Profil Korporat PT Dinamika"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none transition-all"
                        />
                        <p v-if="form.errors.title" class="text-xs text-rose-500 mt-1 font-semibold">{{ form.errors.title }}</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Slug URL (Opsional)
                        </label>
                        <input
                            v-model="form.slug"
                            type="text"
                            placeholder="Otomatis dibuat dari judul jika dikosongkan"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none transition-all"
                        />
                        <p v-if="form.errors.slug" class="text-xs text-rose-500 mt-1 font-semibold">{{ form.errors.slug }}</p>
                    </div>
                </div>

                <!-- Category, Client, Live URL -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Kategori Proyek <span class="text-rose-500">*</span>
                        </label>
                        <select
                            v-model="form.category"
                            required
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none transition-all font-semibold"
                        >
                            <option value="company">Company Profile</option>
                            <option value="sekolah">Sekolah / Institusi</option>
                            <option value="toko">Toko Online</option>
                            <option value="sistem">Sistem Custom</option>
                        </select>
                        <p v-if="form.errors.category" class="text-xs text-rose-500 mt-1 font-semibold">{{ form.errors.category }}</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Nama Klien / Perusahaan
                        </label>
                        <input
                            v-model="form.client_name"
                            type="text"
                            placeholder="Contoh: PT Dinamika Karya Gemilang"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none transition-all"
                        />
                        <p v-if="form.errors.client_name" class="text-xs text-rose-500 mt-1 font-semibold">{{ form.errors.client_name }}</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            URL Website Live (Demo)
                        </label>
                        <input
                            v-model="form.live_url"
                            type="url"
                            placeholder="https://namaklien.com"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none transition-all font-mono"
                        />
                        <p v-if="form.errors.live_url" class="text-xs text-rose-500 mt-1 font-semibold">{{ form.errors.live_url }}</p>
                    </div>
                </div>

                <!-- Summary (Ringkasan) -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider">
                            Ringkasan Singkat (Kartu Showcase) <span class="text-rose-500">*</span>
                        </label>
                        <span class="text-[11px] text-neutral-400 font-mono">
                            {{ form.summary.length }}/500 karakter
                        </span>
                    </div>
                    <textarea
                        v-model="form.summary"
                        rows="2"
                        required
                        maxlength="500"
                        placeholder="Ringkasan 1-2 kalimat untuk kartu grid portofolio publik..."
                        class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none resize-none transition-all"
                    ></textarea>
                    <p v-if="form.errors.summary" class="text-xs text-rose-500 mt-1 font-semibold">{{ form.errors.summary }}</p>
                </div>

                <!-- Description (Cerita Proyek) -->
                <div>
                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                        Deskripsi Lengkap / Studi Kasus Proyek
                    </label>
                    <textarea
                        v-model="form.description"
                        rows="5"
                        placeholder="Jelaskan tantangan yang dihadapi klien, solusi teknis yang dibangun, fitur unggulan yang dirancang, serta hasil yang dicapai..."
                        class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none resize-none transition-all"
                    ></textarea>
                    <p v-if="form.errors.description" class="text-xs text-rose-500 mt-1 font-semibold">{{ form.errors.description }}</p>
                </div>

                <!-- Tech Stack with Quick Chips -->
                <div class="pt-2 border-t border-neutral-100 dark:border-neutral-800 space-y-2">
                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider">
                        Teknologi & Stack yang Digunakan
                    </label>

                    <div class="flex flex-wrap items-center gap-1.5 pb-1">
                        <span class="text-[10px] text-neutral-400 font-medium mr-1">Pintasan Stack:</span>
                        <button
                            v-for="tech in availableTechs"
                            :key="tech"
                            type="button"
                            @click="toggleTech(tech)"
                            :class="[
                                'px-2 py-1 rounded-lg text-[10px] font-bold border transition-all',
                                activeTechList.includes(tech)
                                    ? 'bg-brand-600 text-white border-brand-600 shadow-xs'
                                    : 'bg-neutral-50 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border-neutral-200 dark:border-neutral-700 hover:border-neutral-300',
                            ]"
                        >
                            <span v-if="activeTechList.includes(tech)" class="mr-1">✓</span>
                            <span>{{ tech }}</span>
                        </button>
                    </div>

                    <input
                        v-model="form.tech_stack"
                        type="text"
                        placeholder="Laravel, Vue.js, Inertia.js, Tailwind CSS, MySQL (pisahkan dengan koma)"
                        class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none transition-all"
                    />
                    <p class="text-[11px] text-neutral-400">
                        Klik tombol di atas untuk menambah/menghapus teknologi secara cepat, atau ketik langsung dengan pemisah koma.
                    </p>
                    <p v-if="form.errors.tech_stack" class="text-xs text-rose-500 mt-1 font-semibold">{{ form.errors.tech_stack }}</p>
                </div>

                <!-- Media Uploads: Cover Image & Gallery -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2 border-t border-neutral-100 dark:border-neutral-800">
                    <!-- Cover Image -->
                    <div class="space-y-3">
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider">
                            Gambar Sampul (Cover Proyek)
                        </label>

                        <div class="space-y-2">
                            <input
                                type="file"
                                accept="image/jpeg,image/png,image/webp"
                                @change="handleCoverChange"
                                class="w-full text-xs text-neutral-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 dark:file:bg-brand-950 dark:file:text-brand-300 cursor-pointer"
                            />
                            <p class="text-[11px] text-neutral-400">Format JPG, PNG, atau WebP (maksimal 5 MB). Otomatis dikonversi ke WebP terkompresi.</p>

                            <!-- Cover Preview Card -->
                            <div
                                v-if="coverPreview"
                                class="relative w-full aspect-video rounded-xl overflow-hidden border border-neutral-200 dark:border-neutral-700 bg-neutral-100 dark:bg-neutral-800 group"
                            >
                                <img
                                    :src="coverPreview"
                                    alt="Pratinjau Sampul"
                                    class="w-full h-full object-cover"
                                />
                                <button
                                    type="button"
                                    @click="removeCover"
                                    class="absolute top-2 right-2 p-1.5 rounded-lg bg-black/70 hover:bg-rose-600 text-white text-xs font-bold transition-all shadow-md"
                                    title="Hapus Gambar Sampul"
                                >
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <p v-if="form.errors.cover_file" class="text-xs text-rose-500 font-semibold">{{ form.errors.cover_file }}</p>
                    </div>

                    <!-- Gallery Files -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider">
                                Galeri Tangkapan Layar (Opsional)
                            </label>
                            <span class="text-[11px] font-semibold text-neutral-500">
                                {{ existingGallery.length + galleryPreviews.length }} Gambar
                            </span>
                        </div>

                        <div class="space-y-3">
                            <input
                                type="file"
                                multiple
                                accept="image/jpeg,image/png,image/webp"
                                @change="handleGalleryChange"
                                class="w-full text-xs text-neutral-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-neutral-100 file:text-neutral-700 hover:file:bg-neutral-200 dark:file:bg-neutral-800 dark:file:text-neutral-300 cursor-pointer"
                            />
                            <p class="text-[11px] text-neutral-400">Pilih satu atau beberapa gambar tangkapan layar fitur detail (desktop / mobile). Format JPG, PNG, atau WebP.</p>

                            <!-- Existing Gallery Images -->
                            <div v-if="existingGallery.length > 0" class="space-y-1.5 pt-1">
                                <span class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider block">Gambar Tersimpan</span>
                                <div class="grid grid-cols-3 gap-2">
                                    <div
                                        v-for="(imgUrl, gIdx) in existingGallery"
                                        :key="`existing-${gIdx}`"
                                        class="relative aspect-video rounded-lg overflow-hidden border border-neutral-200 dark:border-neutral-700 bg-neutral-100 dark:bg-neutral-800 group"
                                    >
                                        <img :src="imgUrl" alt="Existing gallery" class="w-full h-full object-cover" />
                                        <button
                                            type="button"
                                            @click="removeExistingGalleryImage(gIdx)"
                                            class="absolute top-1 right-1 p-1 rounded-md bg-black/70 hover:bg-rose-600 text-white transition-all shadow-sm"
                                            title="Hapus gambar ini dari galeri"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- New Pending Upload Previews -->
                            <div v-if="galleryPreviews.length > 0" class="space-y-1.5 pt-1">
                                <span class="text-[10px] font-bold text-brand-600 uppercase tracking-wider block">File Baru Siap Diunggah</span>
                                <div class="grid grid-cols-3 gap-2">
                                    <div
                                        v-for="(prev, pIdx) in galleryPreviews"
                                        :key="`new-${pIdx}`"
                                        class="relative aspect-video rounded-lg overflow-hidden border border-brand-300 dark:border-brand-700 bg-neutral-100 dark:bg-neutral-800 group"
                                    >
                                        <img :src="prev" alt="New upload preview" class="w-full h-full object-cover" />
                                        <button
                                            type="button"
                                            @click="removeNewGalleryFile(pIdx)"
                                            class="absolute top-1 right-1 p-1 rounded-md bg-black/70 hover:bg-rose-600 text-white transition-all shadow-sm"
                                            title="Batalkan gambar ini"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sort Order & Options -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 pt-2 border-t border-neutral-100 dark:border-neutral-800">
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
                        <p class="text-[11px] text-neutral-400 mt-1">Angka lebih kecil tampil lebih dulu di arsip.</p>
                        <p v-if="form.errors.sort_order" class="text-xs text-rose-500 mt-1 font-semibold">{{ form.errors.sort_order }}</p>
                    </div>

                    <!-- Toggles -->
                    <div class="sm:col-span-2 flex flex-col sm:flex-row items-start sm:items-center gap-6 pt-3 sm:pt-6">
                        <label class="flex items-center gap-2.5 cursor-pointer select-none">
                            <input
                                v-model="form.is_published"
                                type="checkbox"
                                class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500 border-neutral-300 dark:border-neutral-700"
                            />
                            <div>
                                <span class="text-xs font-bold text-neutral-800 dark:text-neutral-200 block">Tayang di Publik</span>
                                <span class="text-[10px] text-neutral-400">Tampilkan proyek ini pada halaman portofolio pengunjung.</span>
                            </div>
                        </label>

                        <label class="flex items-center gap-2.5 cursor-pointer select-none">
                            <input
                                v-model="form.is_featured"
                                type="checkbox"
                                class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500 border-neutral-300 dark:border-neutral-700"
                            />
                            <div>
                                <span class="text-xs font-bold text-neutral-800 dark:text-neutral-200 block">Unggulkan di Beranda</span>
                                <span class="text-[10px] text-neutral-400">Tampilkan pada section showcase halaman depan.</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Submit Button Bar -->
                <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800 flex items-center justify-between">
                    <p class="text-[11px] text-neutral-400">
                        Pastikan data dan screenshot proyek telah lengkap sebelum menyimpan.
                    </p>

                    <div class="flex items-center gap-3">
                        <Link
                            href="/admin/projects"
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
                            <span>{{ form.processing ? 'Menyimpan...' : (isEdit ? 'Simpan Perubahan' : 'Tambahkan Portofolio') }}</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
