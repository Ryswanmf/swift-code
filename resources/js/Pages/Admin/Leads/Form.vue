<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface LeadData {
    id?: number;
    name: string;
    phone: string;
    email: string | null;
    service_type: string;
    budget: string | null;
    message: string;
    status: 'new' | 'contacted' | 'deal' | 'lost';
    notes: string | null;
}

const props = defineProps<{
    lead: LeadData | null;
    isEdit: boolean;
}>();

const form = useForm({
    name: props.lead?.name || '',
    phone: props.lead?.phone || '',
    email: props.lead?.email || '',
    service_type: props.lead?.service_type || 'Landing Page Konversi Tinggi',
    budget: props.lead?.budget || '',
    message: props.lead?.message || '',
    status: props.lead?.status || 'new',
    notes: props.lead?.notes || '',
});

const serviceOptions = [
    'Landing Page Konversi Tinggi',
    'Website Company Profile',
    'Website Sekolah & Pesantren',
    'Toko Online (E-Commerce)',
    'Sistem Informasi Kustom',
    'Redesign & Optimasi SEO',
    'Konsultasi Khusus Lainnya',
];

const budgetOptions = [
    'Di bawah Rp 1.000.000',
    'Rp 1.000.000 - Rp 3.000.000',
    'Rp 3.000.000 - Rp 5.000.000',
    'Di atas Rp 5.000.000',
    'Fleksibel / Sesuai Kesepakatan',
];

const submit = () => {
    if (props.isEdit && props.lead?.id) {
        form.put(`/admin/leads/${props.lead.id}`);
    } else {
        form.post('/admin/leads');
    }
};
</script>

<template>
    <Head :title="`${isEdit ? 'Edit' : 'Tambah'} Kontak & Lead - Panel Admin`" />

    <AdminLayout :title="`${isEdit ? 'Edit' : 'Tambah'} Kontak Baru`">
        <div class="max-w-3xl mx-auto space-y-6">
            <!-- Header bar -->
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">
                        {{ isEdit ? `Edit Kontak: ${lead?.name}` : 'Tambah Kontak / Lead Masuk Baru' }}
                    </h2>
                    <p class="text-xs text-neutral-500">
                        {{ isEdit ? 'Perbarui informasi kontak dan riwayat follow up' : 'Catat data calon klien baru yang menghubungi via telepon atau offline' }}
                    </p>
                </div>
                <Link
                    href="/admin/leads"
                    class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 hover:bg-neutral-300 dark:hover:bg-neutral-700 text-neutral-700 dark:text-neutral-300 font-bold text-xs rounded-xl transition-colors"
                >
                    Kembali
                </Link>
            </div>

            <!-- Form Card -->
            <form
                @submit.prevent="submit"
                class="p-6 sm:p-8 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-6"
            >
                <!-- 1. Client Identity -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800 pb-2">
                        Identitas Klien
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Nama Lengkap / Bisnis -->
                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Nama Lengkap / Bisnis <span class="text-brand-600">*</span>
                            </label>
                            <input
                                v-model="form.name"
                                type="text"
                                required
                                placeholder="Contoh: Rian - Cafe Kopi Lampung"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                            <p v-if="form.errors.name" class="mt-1 text-xs text-rose-500">{{ form.errors.name }}</p>
                        </div>

                        <!-- Nomor WhatsApp / Telepon -->
                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Nomor WhatsApp / HP <span class="text-brand-600">*</span>
                            </label>
                            <input
                                v-model="form.phone"
                                type="text"
                                required
                                placeholder="Contoh: 0895325852575"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-mono focus:ring-2 focus:ring-brand-500 outline-none"
                            />
                            <p v-if="form.errors.phone" class="mt-1 text-xs text-rose-500">{{ form.errors.phone }}</p>
                        </div>
                    </div>

                    <!-- Email (Optional) -->
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Alamat Email (Opsional)
                        </label>
                        <input
                            v-model="form.email"
                            type="email"
                            placeholder="Contoh: rian@bisnis.com"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none"
                        />
                        <p v-if="form.errors.email" class="mt-1 text-xs text-rose-500">{{ form.errors.email }}</p>
                    </div>
                </div>

                <!-- 2. Project Requirements -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800 pb-2">
                        Kebutuhan Layanan & Anggaran
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Jenis Layanan -->
                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Jenis Layanan Website <span class="text-brand-600">*</span>
                            </label>
                            <select
                                v-model="form.service_type"
                                required
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-medium focus:ring-2 focus:ring-brand-500 outline-none"
                            >
                                <option v-for="srv in serviceOptions" :key="srv" :value="srv">
                                    {{ srv }}
                                </option>
                            </select>
                            <p v-if="form.errors.service_type" class="mt-1 text-xs text-rose-500">{{ form.errors.service_type }}</p>
                        </div>

                        <!-- Estimasi Anggaran -->
                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Perkiraan Budget Klien
                            </label>
                            <select
                                v-model="form.budget"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-medium focus:ring-2 focus:ring-brand-500 outline-none"
                            >
                                <option value="">Belum Ditentukan / Fleksibel</option>
                                <option v-for="bg in budgetOptions" :key="bg" :value="bg">
                                    {{ bg }}
                                </option>
                            </select>
                            <p v-if="form.errors.budget" class="mt-1 text-xs text-rose-500">{{ form.errors.budget }}</p>
                        </div>
                    </div>

                    <!-- Pesan / Kebutuhan Klien -->
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Pesan / Detail Kebutuhan Website <span class="text-brand-600">*</span>
                        </label>
                        <textarea
                            v-model="form.message"
                            rows="4"
                            required
                            placeholder="Ceritakan gambaran website yang diinginkan klien, referensi kompetitor, atau fitur khusus..."
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none resize-none leading-relaxed"
                        ></textarea>
                        <p v-if="form.errors.message" class="mt-1 text-xs text-rose-500">{{ form.errors.message }}</p>
                    </div>
                </div>

                <!-- 3. Status & Follow Up -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider border-b border-neutral-100 dark:border-neutral-800 pb-2">
                        Status & Catatan Follow-up
                    </h3>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Status Prospek Saat Ini <span class="text-brand-600">*</span>
                        </label>
                        <select
                            v-model="form.status"
                            required
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-bold focus:ring-2 focus:ring-brand-500 outline-none"
                        >
                            <option value="new">Baru (Belum Ditindaklanjuti)</option>
                            <option value="contacted">Sudah Dihubungi / Diskusi</option>
                            <option value="deal">Deal / Closing (Jadi Klien)</option>
                            <option value="lost">Batal / Tidak Merespons</option>
                        </select>
                        <p v-if="form.errors.status" class="mt-1 text-xs text-rose-500">{{ form.errors.status }}</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                            Catatan Internal Tim
                        </label>
                        <textarea
                            v-model="form.notes"
                            rows="3"
                            placeholder="Tuliskan catatan hasil follow up WhatsApp, jadwal janji temu tatap muka, atau rincian kesepakatan harga..."
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none resize-none leading-relaxed"
                        ></textarea>
                        <p v-if="form.errors.notes" class="mt-1 text-xs text-rose-500">{{ form.errors.notes }}</p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800 flex items-center justify-end gap-3">
                    <Link
                        href="/admin/leads"
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
                        <span>{{ form.processing ? 'Menyimpan...' : (isEdit ? 'Perbarui Data Kontak' : 'Simpan Kontak Baru') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
