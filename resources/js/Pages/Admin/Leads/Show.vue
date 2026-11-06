<script setup lang="ts">
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { computed } from 'vue';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

interface LeadDetail {
    id: number;
    name: string;
    phone: string;
    email: string | null;
    service_type: string;
    budget: string | null;
    message: string;
    status: 'new' | 'contacted' | 'deal' | 'lost';
    notes: string | null;
    ip_address: string | null;
    user_agent: string | null;
    created_at: string;
}

const props = defineProps<{
    lead: LeadDetail;
}>();

const form = useForm({
    status: props.lead.status,
    notes: props.lead.notes || '',
});

const submit = () => {
    form.put(`/admin/leads/${props.lead.id}`);
};

const deleteLead = () => {
    if (confirm(`Yakin ingin menghapus data lead dari "${props.lead.name}"?`)) {
        router.delete(`/admin/leads/${props.lead.id}`);
    }
};

const waChatUrl = computed(() => {
    const clean = props.lead.phone.replace(/[^0-9]/g, '');
    const cleanPhone = clean.startsWith('0') ? '62' + clean.slice(1) : clean;
    const text = `Halo Bapak/Ibu ${props.lead.name},\n\nTerima kasih telah menghubungi Swift Code Lampung. Kami menerima pesan Anda terkait pembuatan website *${props.lead.service_type}*.\n\nApakah ada waktu yang pas untuk kita berdiskusi lebih lanjut via chat atau telepon?`;
    return `https://wa.me/${cleanPhone}?text=${encodeURIComponent(text)}`;
});
</script>

<template>
    <Head :title="`Detail Lead: ${lead.name} - Panel Admin`" />

    <AdminLayout :title="`Detail Lead: ${lead.name}`">
        <div class="max-w-4xl mx-auto space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-extrabold text-neutral-900 dark:text-white">
                        Lead: {{ lead.name }}
                    </h2>
                    <p class="text-xs text-neutral-500">Diterima pada {{ new Date(lead.created_at).toLocaleString('id-ID') }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <Link href="/admin/leads" class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 font-bold text-xs rounded-xl">
                        Kembali
                    </Link>
                    <button
                        type="button"
                        @click="deleteLead"
                        class="px-4 py-2 bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold text-xs rounded-xl border border-rose-200"
                    >
                        Hapus Lead
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Left: Client Info & Message (7 cols) -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="p-6 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-4">
                        <h3 class="text-sm font-bold text-neutral-900 dark:text-white uppercase tracking-wider">
                            Informasi Kontak Klien
                        </h3>

                        <div class="space-y-3 text-xs divide-y divide-neutral-100 dark:divide-neutral-800">
                            <div class="pt-2 flex justify-between">
                                <span class="text-neutral-500">Nama Lengkap / Usaha</span>
                                <span class="font-bold text-neutral-900 dark:text-white">{{ lead.name }}</span>
                            </div>

                            <div class="pt-3 flex justify-between items-center">
                                <span class="text-neutral-500">Nomor WhatsApp</span>
                                <div class="flex items-center gap-2">
                                    <span class="font-mono font-bold text-neutral-900 dark:text-white">{{ lead.phone }}</span>
                                    <a
                                        :href="waChatUrl"
                                        target="_blank"
                                        class="px-2 py-0.5 rounded-lg bg-emerald-500 text-white font-bold text-[10px] hover:bg-emerald-600"
                                    >
                                        Chat Sekarang ↗
                                    </a>
                                </div>
                            </div>

                            <div v-if="lead.email" class="pt-3 flex justify-between">
                                <span class="text-neutral-500">Email</span>
                                <a :href="`mailto:${lead.email}`" class="text-brand-600 font-semibold">{{ lead.email }}</a>
                            </div>

                            <div class="pt-3 flex justify-between">
                                <span class="text-neutral-500">Layanan Diminta</span>
                                <span class="font-bold text-brand-600 dark:text-brand-400">{{ lead.service_type }}</span>
                            </div>

                            <div class="pt-3 flex justify-between">
                                <span class="text-neutral-500">Estimasi Budget</span>
                                <span class="font-semibold text-neutral-900 dark:text-white">{{ lead.budget || 'Tidak dicantumkan' }}</span>
                            </div>
                        </div>

                        <!-- Message Box -->
                        <div class="pt-4 border-t border-neutral-100 dark:border-neutral-800">
                            <span class="block text-xs font-bold text-neutral-500 uppercase tracking-wider mb-2">Pesan & Kebutuhan Klien:</span>
                            <div class="p-4 rounded-xl bg-neutral-50 dark:bg-neutral-800/60 border border-neutral-100 dark:border-neutral-800 text-xs text-neutral-800 dark:text-neutral-200 whitespace-pre-line leading-relaxed">
                                {{ lead.message }}
                            </div>
                        </div>

                        <!-- Tech Meta -->
                        <div class="pt-2 text-[10px] text-neutral-400 space-y-1">
                            <p>IP Pengirim: {{ lead.ip_address || '-' }}</p>
                            <p class="truncate">Browser: {{ lead.user_agent || '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Right: Status Update & Admin Notes (5 cols) -->
                <div class="lg:col-span-5 space-y-6">
                    <form @submit.prevent="submit" class="p-6 rounded-2xl bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs space-y-4">
                        <h3 class="text-sm font-bold text-neutral-900 dark:text-white uppercase tracking-wider">
                            Tindak Lanjut & Status
                        </h3>

                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Status Lead Saat Ini
                            </label>
                            <select
                                v-model="form.status"
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs font-bold focus:ring-2 focus:ring-brand-500 outline-none"
                            >
                                <option value="new">📬 Baru (Belum Ditindaklanjuti)</option>
                                <option value="contacted">💬 Sudah Dihubungi / Diskusi</option>
                                <option value="deal">🎉 Deal / Closing (Jadi Klien)</option>
                                <option value="lost">❌ Batal / Tidak Merespons</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                Catatan Internal Admin
                            </label>
                            <textarea
                                v-model="form.notes"
                                rows="5"
                                placeholder="Tuliskan catatan hasil follow up WhatsApp, kesepakatan harga, atau jadwal meeting..."
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-xs focus:ring-2 focus:ring-brand-500 outline-none resize-none"
                            ></textarea>
                        </div>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md transition-all"
                        >
                            {{ form.processing ? 'Menyimpan...' : 'Simpan Catatan & Status' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
