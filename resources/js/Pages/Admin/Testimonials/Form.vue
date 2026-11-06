<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface TestimonialData {
    id?: number;
    name: string;
    role: string | null;
    company: string | null;
    quote: string;
    avatar: string | null;
    rating: number;
    is_published: boolean;
    sort_order: number;
}

const props = defineProps<{
    testimonial: TestimonialData | null;
    isEdit: boolean;
}>();

const avatarPreview = ref<string | null>(props.testimonial?.avatar || null);

const form = useForm({
    name: props.testimonial?.name || '',
    role: props.testimonial?.role || '',
    company: props.testimonial?.company || '',
    quote: props.testimonial?.quote || '',
    rating: props.testimonial?.rating || 5,
    sort_order: props.testimonial?.sort_order ?? 0,
    is_published: props.testimonial?.is_published ?? true,
    avatar_file: null as File | null,
});

const handleAvatarChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.avatar_file = file;
        avatarPreview.value = URL.createObjectURL(file);
    }
};

const submit = () => {
    if (props.isEdit && props.testimonial) {
        form.transform((data) => ({
            ...data,
            _method: 'PUT',
        })).post(`/admin/testimonials/${props.testimonial.id}`, {
            forceFormData: true,
        });
    } else {
        form.post('/admin/testimonials', {
            forceFormData: true,
        });
    }
};
</script>

<template>
    <Head :title="`${isEdit ? 'Edit' : 'Tambah'} Testimoni - Panel Admin`" />

    <AdminLayout :title="`${isEdit ? 'Edit' : 'Tambah'} Testimoni`">
        <div class="max-w-2xl mx-auto space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">
                        {{ isEdit ? `Edit: ${testimonial?.name}` : 'Tambah Testimoni Baru' }}
                    </h2>
                    <p class="text-xs text-neutral-500">Kelola ulasan dan kutipan klien</p>
                </div>
                <Link href="/admin/testimonials" class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 font-bold text-xs rounded-xl">
                    Kembali
                </Link>
            </div>

            <form @submit.prevent="submit" class="p-6 sm:p-8 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Nama Klien <span class="text-brand-600">*</span>
                        </label>
                        <input
                            v-model="form.name"
                            type="text"
                            required
                            placeholder="Contoh: Bambang Irawan"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Jabatan / Role
                        </label>
                        <input
                            v-model="form.role"
                            type="text"
                            placeholder="Contoh: Direktur Operasional"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Nama Perusahaan / Bisnis
                        </label>
                        <input
                            v-model="form.company"
                            type="text"
                            placeholder="Contoh: CV Dinamika Konstruksi"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Rating Bintang (1-5)
                        </label>
                        <select
                            v-model.number="form.rating"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        >
                            <option :value="5">⭐⭐⭐⭐⭐ 5 Bintang</option>
                            <option :value="4">⭐⭐⭐⭐ 4 Bintang</option>
                            <option :value="3">⭐⭐⭐ 3 Bintang</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                        Isi Ulasan / Kutipan Testimoni <span class="text-brand-600">*</span>
                    </label>
                    <textarea
                        v-model="form.quote"
                        rows="4"
                        required
                        placeholder="Tuliskan pengalaman positif klien menggunakan jasa Swift Code..."
                        class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none resize-none"
                    ></textarea>
                </div>

                <div class="pt-2 border-t border-neutral-100 dark:border-neutral-800 flex items-center justify-between">
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Foto Profil Klien (Opsional)
                        </label>
                        <input
                            type="file"
                            accept="image/*"
                            @change="handleAvatarChange"
                            class="text-xs text-neutral-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-neutral-100 file:text-neutral-700 cursor-pointer"
                        />
                    </div>
                    <div v-if="avatarPreview" class="w-12 h-12 rounded-full overflow-hidden border border-neutral-300 shrink-0">
                        <img :src="avatarPreview" alt="Avatar preview" class="w-full h-full object-cover" />
                    </div>
                </div>

                <div class="flex items-center gap-6 pt-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            v-model="form.is_published"
                            type="checkbox"
                            class="w-4 h-4 text-brand-600 rounded-sm focus:ring-brand-500"
                        />
                        <span class="text-xs font-bold text-neutral-700 dark:text-neutral-300">Tayang di Halaman Publik</span>
                    </label>
                </div>

                <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800 flex justify-end gap-3">
                    <Link href="/admin/testimonials" class="px-5 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 text-neutral-700 dark:text-neutral-300 font-bold text-xs hover:bg-neutral-100">
                        Batal
                    </Link>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md shadow-brand-600/30 transition-all"
                    >
                        {{ form.processing ? 'Menyimpan...' : (isEdit ? 'Simpan Perubahan' : 'Tambahkan Testimoni') }}
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
