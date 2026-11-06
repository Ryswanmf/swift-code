<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../Layouts/AdminLayout.vue';

const props = defineProps<{
    settings: Record<string, string>;
}>();

const form = useForm({
    site_name: props.settings.site_name || 'Swift Code Lampung',
    tagline: props.settings.tagline || 'Jasa Pembuatan Website Profesional & Cepat di Lampung',
    whatsapp: props.settings.whatsapp || '62895325852575',
    email: props.settings.email || 'halo@swiftcode.id',
    address: props.settings.address || 'Bandar Lampung, Lampung, Indonesia',
    instagram: props.settings.instagram || 'https://instagram.com/swiftcode.lpg',
    meta_title: props.settings.meta_title || 'Jasa Pembuatan Website Profesional Lampung | Swift Code',
    meta_description: props.settings.meta_description || 'Swift Code Lampung melayani jasa pembuatan landing page, company profile, website sekolah, toko online, dan sistem custom.',
});

const submit = () => {
    form.put('/admin/settings');
};
</script>

<template>
    <Head title="Pengaturan Situs - Panel Admin" />

    <AdminLayout title="Pengaturan Situs">
        <div class="max-w-3xl mx-auto space-y-6">
            <div>
                <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">Pengaturan Umum & Kontak</h2>
                <p class="text-xs text-neutral-500">Ubah nomor WhatsApp tujuan, email notifikasi, alamat, dan meta SEO default</p>
            </div>

            <form @submit.prevent="submit" class="p-6 sm:p-8 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-6">
                <!-- Kontak Utama -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-neutral-400 uppercase tracking-widest border-b border-neutral-100 dark:border-neutral-800 pb-2">
                        Kontak & Media Sosial
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Nomor WhatsApp Tujuan Form & Tombol <span class="text-brand-600">*</span>
                            </label>
                            <input
                                v-model="form.whatsapp"
                                type="text"
                                required
                                placeholder="62895325852575"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-mono focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                            <p class="text-[10px] text-neutral-400 mt-1">Gunakan kode negara (mis. 628...)</p>
                            <p v-if="form.errors.whatsapp" class="text-xs text-rose-500 mt-1">{{ form.errors.whatsapp }}</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Email Notifikasi Lead <span class="text-brand-600">*</span>
                            </label>
                            <input
                                v-model="form.email"
                                type="email"
                                required
                                placeholder="halo@swiftcode.id"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                            <p v-if="form.errors.email" class="text-xs text-rose-500 mt-1">{{ form.errors.email }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Alamat Kantor / Studio
                            </label>
                            <input
                                v-model="form.address"
                                type="text"
                                placeholder="Bandar Lampung, Lampung, Indonesia"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Akun Instagram
                            </label>
                            <input
                                v-model="form.instagram"
                                type="text"
                                placeholder="https://instagram.com/swiftcode.lpg"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                        </div>
                    </div>
                </div>

                <!-- Identitas Situs -->
                <div class="space-y-4 pt-4 border-t border-neutral-100 dark:border-neutral-800">
                    <h3 class="text-xs font-bold text-neutral-400 uppercase tracking-widest border-b border-neutral-100 dark:border-neutral-800 pb-2">
                        Identitas & SEO Default
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Nama Website / Brand <span class="text-brand-600">*</span>
                            </label>
                            <input
                                v-model="form.site_name"
                                type="text"
                                required
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Tagline Singkat
                            </label>
                            <input
                                v-model="form.tagline"
                                type="text"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Default Meta Title Google
                        </label>
                        <input
                            v-model="form.meta_title"
                            type="text"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Default Meta Description Google
                        </label>
                        <textarea
                            v-model="form.meta_description"
                            rows="3"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none resize-none"
                        ></textarea>
                    </div>
                </div>

                <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800 flex justify-end">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md shadow-brand-600/30 transition-all"
                    >
                        {{ form.processing ? 'Menyimpan...' : 'Simpan Semua Pengaturan' }}
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
