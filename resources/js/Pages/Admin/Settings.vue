<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
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
    opening_hours: props.settings.opening_hours || 'Setiap Hari: 08.00 - 21.00 WIB',
    instagram: props.settings.instagram || 'https://instagram.com/swiftcode.lpg',
    facebook: props.settings.facebook || '',
    tiktok: props.settings.tiktok || '',
    linkedin: props.settings.linkedin || '',
    youtube: props.settings.youtube || '',
    meta_title: props.settings.meta_title || 'Jasa Pembuatan Website Profesional Lampung | Swift Code',
    meta_description: props.settings.meta_description || 'Swift Code Lampung melayani jasa pembuatan landing page, company profile, website sekolah, toko online, dan sistem custom.',
    google_analytics_id: props.settings.google_analytics_id || '',
    google_tag_manager_id: props.settings.google_tag_manager_id || '',
    meta_pixel_id: props.settings.meta_pixel_id || '',
    owner_name: props.settings.owner_name || 'Muhammad Riswan Mufid',
    owner_role: props.settings.owner_role || 'Founder & Lead Software Engineer',
    owner_bio: props.settings.owner_bio || 'Praktisi software engineer dan pendiri Swift Code Lampung. Berfokus pada pembangunan sistem website modern dengan arsitektur kode bersih, performa loading kilat, dan solusi digital yang terbukti membantu bisnis berkembang secara konsisten.',
    owner_linkedin: props.settings.owner_linkedin || 'https://linkedin.com',
    owner_github: props.settings.owner_github || 'https://github.com/Ryswanmf',
    owner_photo: null as File | null,
    site_logo: null as File | null,
    site_favicon: null as File | null,
});

const logoPreview = ref<string | null>(props.settings.site_logo || null);
const faviconPreview = ref<string | null>(props.settings.site_favicon || null);
const ownerPhotoPreview = ref<string | null>(props.settings.owner_photo || null);

const handleOwnerPhotoChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.owner_photo = file;
        ownerPhotoPreview.value = URL.createObjectURL(file);
    }
};

const handleLogoChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.site_logo = file;
        logoPreview.value = URL.createObjectURL(file);
    }
};

const handleFaviconChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.site_favicon = file;
        faviconPreview.value = URL.createObjectURL(file);
    }
};

const submit = () => {
    form.post('/admin/settings', {
        headers: {
            'X-HTTP-Method-Override': 'PUT',
        },
    });
};
</script>

<template>
    <Head title="Pengaturan Situs - Panel Admin" />

    <AdminLayout title="Pengaturan Situs">
        <div class="max-w-4xl mx-auto space-y-6">
            <div>
                <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">Pengaturan Umum & Identitas Website</h2>
                <p class="text-xs text-neutral-500">Ubah nomor WhatsApp, media sosial, jam operasional, logo, favicon, dan meta SEO global</p>
            </div>

            <form @submit.prevent="submit" class="p-6 sm:p-8 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-8">
                <!-- 1. Logo & Favicon Upload -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-neutral-400 uppercase tracking-widest border-b border-neutral-100 dark:border-neutral-800 pb-2">
                        Logo & Favicon Website
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Site Logo -->
                        <div class="p-4 rounded-xl border border-neutral-200 dark:border-neutral-800 bg-neutral-50/50 dark:bg-neutral-800/40 space-y-3">
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider">
                                Logo Website (Header & Footer)
                            </label>
                            <div class="flex items-center gap-4">
                                <div class="w-20 h-14 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-2 flex items-center justify-center shrink-0">
                                    <img v-if="logoPreview" :src="logoPreview" alt="Preview Logo" class="max-h-full max-w-full object-contain" />
                                    <span v-else class="text-[10px] text-neutral-400 text-center font-semibold">SVG Default</span>
                                </div>
                                <div class="flex-1">
                                    <input
                                        type="file"
                                        accept="image/*"
                                        @change="handleLogoChange"
                                        class="text-xs text-neutral-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100"
                                    />
                                    <p class="text-[10px] text-neutral-400 mt-1">PNG transparan / WebP. Jika kosong, logo SVG bawaan akan digunakan.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Favicon -->
                        <div class="p-4 rounded-xl border border-neutral-200 dark:border-neutral-800 bg-neutral-50/50 dark:bg-neutral-800/40 space-y-3">
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider">
                                Favicon Tab Browser
                            </label>
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-2 flex items-center justify-center shrink-0">
                                    <img v-if="faviconPreview" :src="faviconPreview" alt="Preview Favicon" class="w-8 h-8 object-contain" />
                                    <span v-else class="text-[10px] text-neutral-400 text-center font-semibold">Default</span>
                                </div>
                                <div class="flex-1">
                                    <input
                                        type="file"
                                        accept="image/*"
                                        @change="handleFaviconChange"
                                        class="text-xs text-neutral-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100"
                                    />
                                    <p class="text-[10px] text-neutral-400 mt-1">PNG rasio 1:1 atau ICO.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Kontak & Operasional -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-neutral-400 uppercase tracking-widest border-b border-neutral-100 dark:border-neutral-800 pb-2">
                        Kontak Utama & Jam Operasional
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
                                Email Notifikasi Lead Masuk <span class="text-brand-600">*</span>
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
                                Jam Operasional (Footer)
                            </label>
                            <input
                                v-model="form.opening_hours"
                                type="text"
                                placeholder="Setiap Hari: 08.00 - 21.00 WIB"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                        </div>
                    </div>
                </div>

                <!-- 3. Akun Media Sosial -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-neutral-400 uppercase tracking-widest border-b border-neutral-100 dark:border-neutral-800 pb-2">
                        Akun Media Sosial Resmi
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                URL Instagram
                            </label>
                            <input
                                v-model="form.instagram"
                                type="text"
                                placeholder="https://instagram.com/swiftcode.lpg"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                URL Facebook (Opsional)
                            </label>
                            <input
                                v-model="form.facebook"
                                type="text"
                                placeholder="https://facebook.com/swiftcode.lpg"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                URL TikTok (Opsional)
                            </label>
                            <input
                                v-model="form.tiktok"
                                type="text"
                                placeholder="https://tiktok.com/@swiftcode.lpg"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                URL LinkedIn / YouTube (Opsional)
                            </label>
                            <input
                                v-model="form.linkedin"
                                type="text"
                                placeholder="https://linkedin.com/company/swiftcode-lpg"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                        </div>
                    </div>
                </div>

                <!-- Profil Pemilik / Founder (Halaman Tentang) -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-neutral-400 uppercase tracking-widest border-b border-neutral-100 dark:border-neutral-800 pb-2">
                        Profil Pemilik / Founder (Tampil di Halaman Tentang)
                    </h3>
                    <p class="text-xs text-neutral-500">
                        Atur foto, nama lengkap, gelar/jabatan, ringkasan bio, dan tautan sosial media pendiri Swift Code yang tampil di halaman Tentang Kami.
                    </p>

                    <div class="p-4 rounded-xl border border-neutral-200 dark:border-neutral-800 bg-neutral-50/50 dark:bg-neutral-800/40 space-y-3">
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider">
                            Foto Pemilik / Founder
                        </label>
                        <div class="flex items-center gap-4">
                            <div class="w-20 h-20 rounded-2xl border-2 border-brand-500/30 overflow-hidden bg-white dark:bg-neutral-900 shrink-0 shadow-sm flex items-center justify-center">
                                <img
                                    v-if="ownerPhotoPreview"
                                    :src="ownerPhotoPreview"
                                    alt="Foto Pemilik"
                                    class="w-full h-full object-cover"
                                />
                                <span v-else class="text-xs text-neutral-400 font-bold">Tanpa Foto</span>
                            </div>
                            <div class="flex-1 space-y-1">
                                <input
                                    type="file"
                                    accept="image/*"
                                    @change="handleOwnerPhotoChange"
                                    class="text-xs text-neutral-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 cursor-pointer"
                                />
                                <p class="text-[10px] text-neutral-400">JPG, PNG, atau WebP. Otomatis dikompresi ke WebP resolusi tinggi.</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Nama Lengkap Pemilik / Founder
                            </label>
                            <input
                                v-model="form.owner_name"
                                type="text"
                                placeholder="Contoh: Muhammad Riswan Mufid"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Posisi / Jabatan
                            </label>
                            <input
                                v-model="form.owner_role"
                                type="text"
                                placeholder="Contoh: Founder & Lead Software Engineer"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Bio Singkat / Pernyataan Pemilik
                        </label>
                        <textarea
                            v-model="form.owner_bio"
                            rows="3"
                            placeholder="Deskripsi singkat pengalaman atau dedikasi pemilik..."
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none resize-none"
                        ></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Profil LinkedIn Pemilik
                            </label>
                            <input
                                v-model="form.owner_linkedin"
                                type="text"
                                placeholder="https://linkedin.com/in/username"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Profil GitHub Pemilik
                            </label>
                            <input
                                v-model="form.owner_github"
                                type="text"
                                placeholder="https://github.com/username"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                        </div>
                    </div>
                </div>

                <!-- 4. Identitas Situs & SEO Default -->
                <div class="space-y-4">
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

                <!-- 5. Pelacakan Iklan & Analitik (Analytics & Pixel) -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-neutral-400 uppercase tracking-widest border-b border-neutral-100 dark:border-neutral-800 pb-2">
                        Pelacakan Iklan & Analitik (Analytics & Pixel)
                    </h3>
                    <p class="text-xs text-neutral-500">
                        Masukkan ID pelacak resmi untuk mengukur traffic pengunjung dan konversi iklan tanpa mengubah kode template.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Google Analytics ID (GA4)
                            </label>
                            <input
                                v-model="form.google_analytics_id"
                                type="text"
                                placeholder="G-XXXXXXXXXX"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none font-mono"
                            />
                            <p class="text-[10px] text-neutral-400 mt-1">Contoh: G-AB12C3D4E5</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Google Tag Manager ID (GTM)
                            </label>
                            <input
                                v-model="form.google_tag_manager_id"
                                type="text"
                                placeholder="GTM-XXXXXXX"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none font-mono"
                            />
                            <p class="text-[10px] text-neutral-400 mt-1">Contoh: GTM-ABCD123</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Meta / Facebook Pixel ID
                            </label>
                            <input
                                v-model="form.meta_pixel_id"
                                type="text"
                                placeholder="123456789012345"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none font-mono"
                            />
                            <p class="text-[10px] text-neutral-400 mt-1">Contoh ID angka: 987654321012345</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800 flex justify-end">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md shadow-brand-600/30 transition-all cursor-pointer disabled:opacity-50"
                    >
                        {{ form.processing ? 'Menyimpan...' : 'Simpan Semua Pengaturan' }}
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
