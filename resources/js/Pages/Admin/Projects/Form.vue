<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
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
});

const handleCoverChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.cover_file = file;
        coverPreview.value = URL.createObjectURL(file);
    }
};

const handleGalleryChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files) {
        form.gallery_files = Array.from(target.files);
    }
};

const submit = () => {
    if (props.isEdit && props.project) {
        // Inertia multipart PUT is submitted via post with _method=PUT
        form.transform((data) => ({
            ...data,
            _method: 'PUT',
        })).post(`/admin/projects/${props.project.id}`, {
            forceFormData: true,
        });
    } else {
        form.post('/admin/projects', {
            forceFormData: true,
        });
    }
};
</script>

<template>
    <Head :title="`${isEdit ? 'Edit' : 'Tambah'} Portofolio - Panel Admin`" />

    <AdminLayout :title="`${isEdit ? 'Edit' : 'Tambah'} Portofolio Proyek`">
        <div class="max-w-4xl mx-auto space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">
                        {{ isEdit ? `Edit: ${project?.title}` : 'Tambah Portofolio Baru' }}
                    </h2>
                    <p class="text-xs text-neutral-500">Isi data proyek showcase dan konversi gambar otomatis ke WebP</p>
                </div>
                <Link
                    href="/admin/projects"
                    class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 font-bold text-xs rounded-xl hover:bg-neutral-300"
                >
                    Kembali
                </Link>
            </div>

            <form @submit.prevent="submit" class="p-6 sm:p-8 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-6">
                <!-- Basic fields -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Judul Proyek <span class="text-brand-600">*</span>
                        </label>
                        <input
                            v-model="form.title"
                            type="text"
                            required
                            placeholder="Contoh: Company Profile CV Dinamika"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                        <p v-if="form.errors.title" class="text-xs text-rose-500 mt-1">{{ form.errors.title }}</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Slug URL (Opsional)
                        </label>
                        <input
                            v-model="form.slug"
                            type="text"
                            placeholder="Otomatis dari judul jika dikosongkan"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                        <p v-if="form.errors.slug" class="text-xs text-rose-500 mt-1">{{ form.errors.slug }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Kategori <span class="text-brand-600">*</span>
                        </label>
                        <select
                            v-model="form.category"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        >
                            <option value="company">Company Profile</option>
                            <option value="sekolah">Sekolah / Institusi</option>
                            <option value="toko">Toko Online</option>
                            <option value="sistem">Sistem Custom</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Nama Klien
                        </label>
                        <input
                            v-model="form.client_name"
                            type="text"
                            placeholder="Contoh: CV Dinamika"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            URL Website Live (Demo)
                        </label>
                        <input
                            v-model="form.live_url"
                            type="url"
                            placeholder="https://..."
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                    </div>
                </div>

                <!-- Summary & Description -->
                <div>
                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                        Ringkasan Singkat (Muncul di Kartu) <span class="text-brand-600">*</span>
                    </label>
                    <textarea
                        v-model="form.summary"
                        rows="2"
                        required
                        placeholder="Ringkasan 1-2 kalimat untuk tampilan grid portofolio..."
                        class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none resize-none"
                    ></textarea>
                    <p v-if="form.errors.summary" class="text-xs text-rose-500 mt-1">{{ form.errors.summary }}</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                        Deskripsi Lengkap / Cerita Proyek
                    </label>
                    <textarea
                        v-model="form.description"
                        rows="5"
                        placeholder="Jelaskan latar belakang, solusi yang dibangun, dan hasil yang dicapai..."
                        class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none resize-none"
                    ></textarea>
                </div>

                <!-- Media Uploads: Cover Image & Gallery -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2 border-t border-neutral-100 dark:border-neutral-800">
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Gambar Sampul (Cover)
                        </label>
                        <div class="space-y-3">
                            <input
                                type="file"
                                accept="image/*"
                                @change="handleCoverChange"
                                class="w-full text-xs text-neutral-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 cursor-pointer"
                            />
                            <div v-if="coverPreview" class="relative w-full aspect-video rounded-xl overflow-hidden border border-neutral-200 dark:border-neutral-700 bg-neutral-100">
                                <img :src="coverPreview" alt="Cover preview" class="w-full h-full object-cover" />
                            </div>
                        </div>
                        <p class="text-[11px] text-neutral-400 mt-1">Otomatis dikonversi ke format WebP terkompresi.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Galeri Foto Tambahan (Opsional)
                        </label>
                        <input
                            type="file"
                            multiple
                            accept="image/*"
                            @change="handleGalleryChange"
                            class="w-full text-xs text-neutral-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-neutral-100 file:text-neutral-700 hover:file:bg-neutral-200 cursor-pointer"
                        />
                        <p class="text-[11px] text-neutral-400 mt-1">Bisa pilih beberapa gambar screenshot fitur.</p>
                    </div>
                </div>

                <!-- Tech Stack & Sort Order -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2 border-t border-neutral-100 dark:border-neutral-800">
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Tech Stack (Pisahkan dengan koma)
                        </label>
                        <input
                            v-model="form.tech_stack"
                            type="text"
                            placeholder="Laravel, Vue.js, Tailwind CSS"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Urutan Tampil (Sort Order)
                        </label>
                        <input
                            v-model.number="form.sort_order"
                            type="number"
                            min="0"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                    </div>
                </div>

                <!-- Status Checkboxes -->
                <div class="flex items-center gap-6 pt-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            v-model="form.is_published"
                            type="checkbox"
                            class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500"
                        />
                        <span class="text-xs font-bold text-neutral-700 dark:text-neutral-300">Tayang di Publik</span>
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            v-model="form.is_featured"
                            type="checkbox"
                            class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500"
                        />
                        <span class="text-xs font-bold text-neutral-700 dark:text-neutral-300">Unggulkan di Beranda</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800 flex justify-end gap-3">
                    <Link
                        href="/admin/projects"
                        class="px-5 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 text-neutral-700 dark:text-neutral-300 font-bold text-xs hover:bg-neutral-100"
                    >
                        Batal
                    </Link>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md shadow-brand-600/30 disabled:opacity-50 transition-all"
                    >
                        {{ form.processing ? 'Menyimpan...' : (isEdit ? 'Simpan Perubahan' : 'Tambahkan Proyek') }}
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
