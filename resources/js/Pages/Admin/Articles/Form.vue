<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface ArticleData {
    id?: number;
    title: string;
    slug: string;
    category: string;
    summary: string;
    content: string;
    author: string;
    read_time: string;
    image: string | null;
    is_published: boolean;
    published_at: string | null;
    sort_order: number;
}

const props = defineProps<{
    article: ArticleData | null;
    isEdit: boolean;
}>();

const form = useForm({
    title: props.article?.title || '',
    slug: props.article?.slug || '',
    category: props.article?.category || 'Strategi Bisnis',
    summary: props.article?.summary || '',
    content: props.article?.content || '',
    author: props.article?.author || 'Tim Swift Code',
    read_time: props.article?.read_time || '',
    image: props.article?.image || '',
    is_published: props.article ? Boolean(props.article.is_published) : true,
    published_at: props.article?.published_at ? props.article.published_at.slice(0, 10) : new Date().toISOString().slice(0, 10),
    sort_order: props.article?.sort_order ?? 0,
});

const categoryOptions = [
    'Strategi Bisnis',
    'Panduan Web',
    'SEO & Trafik',
    'Biaya & Anggaran',
    'E-Commerce',
    'Institusi & Sekolah',
    'Desain & UI/UX',
    'Keamanan Web',
];

const presetImages = [
    { label: 'Analitik & Strategi Bisnis', url: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=800&auto=format&fit=crop' },
    { label: 'Desain & Laptop Modern', url: 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?q=80&w=800&auto=format&fit=crop' },
    { label: 'Pencarian SEO & Google', url: 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?q=80&w=800&auto=format&fit=crop' },
    { label: 'Finansial & Anggaran', url: 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=800&auto=format&fit=crop' },
    { label: 'Edukasi & Sekolah', url: 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=800&auto=format&fit=crop' },
    { label: 'Toko Online & Belanja', url: 'https://images.unsplash.com/photo-1556742049-0a67c5574f73?q=80&w=800&auto=format&fit=crop' },
];

const autoSlug = ref(!props.isEdit);

watch(
    () => form.title,
    (newVal) => {
        if (autoSlug.value && !props.isEdit) {
            form.slug = newVal
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        }
    },
);

const submit = () => {
    if (props.isEdit && props.article?.id) {
        form.put(`/admin/articles/${props.article.id}`);
    } else {
        form.post('/admin/articles');
    }
};
</script>

<template>
    <Head :title="`${isEdit ? 'Edit' : 'Tambah'} Artikel - Panel Admin`" />

    <AdminLayout :title="`${isEdit ? 'Edit' : 'Tambah'} Artikel Baru`">
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Header bar -->
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">
                        {{ isEdit ? `Edit: ${article?.title}` : 'Tulis Artikel & Panduan Baru' }}
                    </h2>
                    <p class="text-xs text-neutral-500">
                        Buat artikel edukatif untuk membantu calon klien memahami pentingnya website dan menaikkan SEO Google
                    </p>
                </div>
                <Link
                    href="/admin/articles"
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
                <!-- 1. Metadata Utama (Judul & Slug) -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800 pb-2">
                        Judul & URL Slug
                    </h3>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Judul Artikel <span class="text-brand-600">*</span>
                        </label>
                        <input
                            v-model="form.title"
                            type="text"
                            required
                            placeholder="Contoh: 5 Alasan Bisnis di Lampung Wajib Punya Website Resmi di 2026"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-sm font-bold focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                        <p v-if="form.errors.title" class="mt-1 text-xs text-rose-500">{{ form.errors.title }}</p>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider">
                                URL Slug Artikel
                            </label>
                            <label class="flex items-center gap-1.5 text-[11px] text-neutral-500 cursor-pointer">
                                <input v-model="autoSlug" type="checkbox" class="rounded text-brand-600 focus:ring-brand-500" />
                                <span>Otomatis dari judul</span>
                            </label>
                        </div>
                        <div class="flex items-center rounded-xl border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 overflow-hidden">
                            <span class="px-3.5 py-2.5 text-xs text-neutral-400 font-mono select-none border-r border-neutral-200 dark:border-neutral-700">
                                /artikel/
                            </span>
                            <input
                                v-model="form.slug"
                                type="text"
                                :disabled="autoSlug && !isEdit"
                                placeholder="alasan-bisnis-lampung-wajib-punya-website"
                                class="flex-1 px-3.5 py-2.5 bg-transparent text-neutral-900 dark:text-white text-xs font-mono outline-none disabled:opacity-60"
                            />
                        </div>
                        <p v-if="form.errors.slug" class="mt-1 text-xs text-rose-500">{{ form.errors.slug }}</p>
                    </div>
                </div>

                <!-- 2. Klasifikasi & Penulis -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800 pb-2">
                        Kategori & Informasi Penulis
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Kategori Topik <span class="text-brand-600">*</span>
                            </label>
                            <select
                                v-model="form.category"
                                required
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-semibold focus:ring-2 focus:ring-brand-500 outline-none"
                            >
                                <option v-for="cat in categoryOptions" :key="cat" :value="cat">
                                    {{ cat }}
                                </option>
                            </select>
                            <p v-if="form.errors.category" class="mt-1 text-xs text-rose-500">{{ form.errors.category }}</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Nama Penulis
                            </label>
                            <input
                                v-model="form.author"
                                type="text"
                                placeholder="Tim Swift Code"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                            <p v-if="form.errors.author" class="mt-1 text-xs text-rose-500">{{ form.errors.author }}</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Estimasi Waktu Baca
                            </label>
                            <input
                                v-model="form.read_time"
                                type="text"
                                placeholder="Otomatis dihitung (cth: 5 menit baca)"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                            <p v-if="form.errors.read_time" class="mt-1 text-xs text-rose-500">{{ form.errors.read_time }}</p>
                        </div>
                    </div>
                </div>

                <!-- 3. Gambar Sampul / Banner -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800 pb-2">
                        Gambar Sampul (Thumbnail)
                    </h3>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            URL Gambar Banner
                        </label>
                        <input
                            v-model="form.image"
                            type="url"
                            placeholder="https://images.unsplash.com/photo-..."
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-mono focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                        <p v-if="form.errors.image" class="mt-1 text-xs text-rose-500">{{ form.errors.image }}</p>

                        <!-- Preset Quick Selectors -->
                        <div class="mt-2.5">
                            <span class="text-[11px] text-neutral-500 dark:text-neutral-400 font-medium">Pilihan cepat ilustrasi Unsplash gratis:</span>
                            <div class="flex flex-wrap gap-1.5 mt-1.5">
                                <button
                                    v-for="preset in presetImages"
                                    :key="preset.label"
                                    type="button"
                                    @click="form.image = preset.url"
                                    class="px-2.5 py-1 text-[10px] rounded-lg bg-neutral-100 dark:bg-neutral-800 hover:bg-brand-50 dark:hover:bg-brand-950 text-neutral-700 dark:text-neutral-300 hover:text-brand-600 border border-neutral-200/80 dark:border-neutral-700 transition-colors cursor-pointer"
                                >
                                    {{ preset.label }}
                                </button>
                            </div>
                        </div>

                        <!-- Image Preview -->
                        <div v-if="form.image" class="mt-3.5 max-w-sm rounded-xl overflow-hidden border border-neutral-200 dark:border-neutral-700 bg-neutral-100 dark:bg-neutral-800">
                            <img :src="form.image" alt="Preview Sampul" class="w-full h-36 object-cover" />
                        </div>
                    </div>
                </div>

                <!-- 4. Ringkasan & Konten Lengkap -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800 pb-2">
                        Ringkasan & Isi Artikel
                    </h3>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Ringkasan / Summary (SEO Meta Snippet) <span class="text-brand-600">*</span>
                        </label>
                        <textarea
                            v-model="form.summary"
                            rows="2"
                            required
                            maxlength="500"
                            placeholder="Deskripsi singkat artikel untuk preview di kartu artikel dan meta description Google..."
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none resize-none leading-relaxed"
                        ></textarea>
                        <div class="flex items-center justify-between mt-1 text-[10px] text-neutral-400">
                            <span>Maksimal 500 karakter</span>
                            <span>{{ form.summary.length }}/500</span>
                        </div>
                        <p v-if="form.errors.summary" class="mt-1 text-xs text-rose-500">{{ form.errors.summary }}</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Konten Lengkap Artikel <span class="text-brand-600">*</span>
                        </label>
                        <textarea
                            v-model="form.content"
                            rows="12"
                            required
                            placeholder="Tuliskan isi panduan atau artikel secara lengkap. Gunakan jeda baris kosong antar-paragraf..."
                            class="w-full px-4 py-3 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs leading-relaxed focus:ring-2 focus:ring-brand-500 outline-none font-sans"
                        ></textarea>
                        <p v-if="form.errors.content" class="mt-1 text-xs text-rose-500">{{ form.errors.content }}</p>
                    </div>
                </div>

                <!-- 5. Status & Pengaturan Publikasi -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800 pb-2">
                        Status Publikasi & Jadwal
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Tanggal Diterbitkan
                            </label>
                            <input
                                v-model="form.published_at"
                                type="date"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                            <p v-if="form.errors.published_at" class="mt-1 text-xs text-rose-500">{{ form.errors.published_at }}</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Urutan Prioritas
                            </label>
                            <input
                                v-model.number="form.sort_order"
                                type="number"
                                min="0"
                                placeholder="0"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-mono focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                            <p v-if="form.errors.sort_order" class="mt-1 text-xs text-rose-500">{{ form.errors.sort_order }}</p>
                        </div>
                    </div>

                    <div class="pt-2">
                        <label class="inline-flex items-center gap-3 cursor-pointer">
                            <input
                                v-model="form.is_published"
                                type="checkbox"
                                class="w-4 h-4 text-brand-600 rounded border-neutral-300 focus:ring-brand-500"
                            />
                            <div>
                                <span class="text-xs font-bold text-neutral-900 dark:text-white block">
                                    Tayangkan Artikel di Website Publik
                                </span>
                                <span class="text-[11px] text-neutral-500 block">
                                    Jika dicentang, artikel akan langsung tampil di halaman `/artikel` dan `/artikel/{slug}`.
                                </span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Action Footer -->
                <div class="pt-5 border-t border-neutral-100 dark:border-neutral-800 flex items-center justify-end gap-3">
                    <Link
                        href="/admin/articles"
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
                        <span>{{ form.processing ? 'Menyimpan...' : (isEdit ? 'Simpan Perubahan Artikel' : 'Terbitkan Artikel Baru') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
