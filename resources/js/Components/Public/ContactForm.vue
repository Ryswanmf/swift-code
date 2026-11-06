<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const serviceOptions = [
    'Landing Page & Promosi',
    'Company Profile Perusahaan',
    'Website Sekolah / Pesantren',
    'Toko Online (E-Commerce)',
    'Sistem Informasi Custom',
    'Konsultasi & Redesign',
];

const budgetOptions = [
    '< Rp 1.000.000 (Paket Hemat)',
    'Rp 1.000.000 - Rp 3.000.000',
    'Rp 3.000.000 - Rp 5.000.000',
    '> Rp 5.000.000 (Sistem Custom)',
];

const form = useForm({
    name: '',
    phone: '',
    email: '',
    service_type: serviceOptions[0],
    budget: budgetOptions[1],
    message: '',
    // Honeypot field for anti-spam
    website_hp: '',
});

const isSubmittedSuccess = ref(false);

const submit = () => {
    form.post('/kontak', {
        preserveScroll: true,
        onSuccess: () => {
            isSubmittedSuccess.value = true;
            form.reset();
        },
        onError: () => {
            // Fallback: If backend endpoint is not yet mounted (Fase 1 static), redirect directly to WhatsApp!
            const text = `Halo Swift Code Lampung, saya *${form.name}* ingin membuat website *${form.service_type}* dengan estimasi budget *${form.budget}*.\n\nPesan: ${form.message}`;
            window.open(`https://wa.me/62895325852575?text=${encodeURIComponent(text)}`, '_blank');
        },
    });
};
</script>

<template>
    <section id="kontak" class="py-20 lg:py-28 bg-neutral-50/70 dark:bg-neutral-900/40 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-start">
                <!-- Left info -->
                <div class="lg:col-span-5 space-y-6">
                    <span class="text-xs sm:text-sm font-bold tracking-widest uppercase text-brand-600 dark:text-brand-400">
                        Mulai Kolaborasi
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-neutral-900 dark:text-white tracking-tight leading-tight">
                        Siap Membawa Bisnis Anda ke <span class="text-brand-600">Level Selanjutnya?</span>
                    </h2>
                    <p class="text-base text-neutral-600 dark:text-neutral-400 leading-relaxed">
                        Isi formulir di samping untuk mendapatkan konsultasi gratis dan rancangan anggaran yang sesuai dengan target bisnis Anda. Tim kami akan merespons dalam hitungan menit!
                    </p>

                    <!-- Contact Details -->
                    <div class="space-y-4 pt-4">
                        <div class="flex items-center gap-4 p-4 rounded-xl bg-white dark:bg-neutral-900 border border-neutral-200/80 dark:border-neutral-800">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl shrink-0">
                                💬
                            </div>
                            <div>
                                <p class="text-xs text-neutral-500 dark:text-neutral-400">Respons Cepat WhatsApp</p>
                                <a href="https://wa.me/62895325852575" target="_blank" class="text-sm font-bold text-neutral-900 dark:text-white hover:text-brand-600 transition-colors">
                                    +62 895-3258-52575
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 p-4 rounded-xl bg-white dark:bg-neutral-900 border border-neutral-200/80 dark:border-neutral-800">
                            <div class="w-12 h-12 rounded-xl bg-brand-50 dark:bg-brand-950/60 text-brand-600 dark:text-brand-400 flex items-center justify-center text-xl shrink-0">
                                ✉️
                            </div>
                            <div>
                                <p class="text-xs text-neutral-500 dark:text-neutral-400">Email Resmi</p>
                                <a href="mailto:halo@swiftcode.id" class="text-sm font-bold text-neutral-900 dark:text-white hover:text-brand-600 transition-colors">
                                    halo@swiftcode.id
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 p-4 rounded-xl bg-white dark:bg-neutral-900 border border-neutral-200/80 dark:border-neutral-800">
                            <div class="w-12 h-12 rounded-xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center text-xl shrink-0">
                                📸
                            </div>
                            <div>
                                <p class="text-xs text-neutral-500 dark:text-neutral-400">Instagram Resmi</p>
                                <a href="https://instagram.com/swiftcode.lpg" target="_blank" class="text-sm font-bold text-neutral-900 dark:text-white hover:text-brand-600 transition-colors">
                                    @swiftcode.lpg
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Form Box -->
                <div class="lg:col-span-7">
                    <div class="p-8 sm:p-10 rounded-3xl bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-xl">
                        <div v-if="isSubmittedSuccess" class="p-6 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 text-center space-y-3">
                            <div class="w-12 h-12 rounded-full bg-emerald-500 text-white flex items-center justify-center mx-auto text-xl font-bold">
                                ✓
                            </div>
                            <h3 class="text-lg font-bold text-emerald-800 dark:text-emerald-200">
                                Pesan Anda Berhasil Dikirim!
                            </h3>
                            <p class="text-sm text-emerald-700 dark:text-emerald-300">
                                Terima kasih telah menghubungi Swift Code Lampung. Tim kami akan segera meninjau kebutuhan website Anda.
                            </p>
                        </div>

                        <form v-else @submit.prevent="submit" class="space-y-5">
                            <!-- Honeypot hidden input -->
                            <div class="hidden" aria-hidden="true">
                                <label for="website_hp">Do not fill this</label>
                                <input id="website_hp" v-model="form.website_hp" type="text" tabindex="-1" autocomplete="off" />
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <!-- Nama -->
                                <div>
                                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                        Nama Lengkap / Bisnis <span class="text-brand-600">*</span>
                                    </label>
                                    <input
                                        v-model="form.name"
                                        type="text"
                                        required
                                        placeholder="Contoh: Rian - Cafe Kopi Lampung"
                                        class="w-full px-4 py-3 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all"
                                    />
                                    <p v-if="form.errors.name" class="mt-1 text-xs text-rose-500">{{ form.errors.name }}</p>
                                </div>

                                <!-- WhatsApp -->
                                <div>
                                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                        Nomor WhatsApp <span class="text-brand-600">*</span>
                                    </label>
                                    <input
                                        v-model="form.phone"
                                        type="tel"
                                        required
                                        placeholder="Contoh: 08123456789"
                                        class="w-full px-4 py-3 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all"
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
                                    class="w-full px-4 py-3 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all"
                                />
                                <p v-if="form.errors.email" class="mt-1 text-xs text-rose-500">{{ form.errors.email }}</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <!-- Service Type -->
                                <div>
                                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                        Jenis Website
                                    </label>
                                    <select
                                        v-model="form.service_type"
                                        class="w-full px-4 py-3 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all"
                                    >
                                        <option v-for="srv in serviceOptions" :key="srv" :value="srv">
                                            {{ srv }}
                                        </option>
                                    </select>
                                </div>

                                <!-- Budget -->
                                <div>
                                    <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                        Perkiraan Anggaran
                                    </label>
                                    <select
                                        v-model="form.budget"
                                        class="w-full px-4 py-3 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all"
                                    >
                                        <option v-for="bdg in budgetOptions" :key="bdg" :value="bdg">
                                            {{ bdg }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Pesan -->
                            <div>
                                <label class="block text-xs font-bold text-neutral-700 dark:text-neutral-300 uppercase tracking-wider mb-2">
                                    Jelaskan Kebutuhan / Referensi Website <span class="text-brand-600">*</span>
                                </label>
                                <textarea
                                    v-model="form.message"
                                    rows="4"
                                    required
                                    placeholder="Ceritakan tentang bisnis Anda, fitur yang diinginkan, atau contoh website yang disukai..."
                                    class="w-full px-4 py-3 rounded-xl border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all resize-none"
                                ></textarea>
                                <p v-if="form.errors.message" class="mt-1 text-xs text-rose-500">{{ form.errors.message }}</p>
                            </div>

                            <!-- Submit Button -->
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="w-full py-4 px-6 rounded-xl font-bold text-white bg-brand-600 hover:bg-brand-700 active:bg-brand-800 shadow-lg shadow-brand-600/30 transition-all duration-200 flex items-center justify-center gap-2 hover:-translate-y-0.5 disabled:opacity-50"
                            >
                                <span v-if="!form.processing">Kirim & Terhubung ke WhatsApp</span>
                                <span v-else>Memproses...</span>
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>

                            <p class="text-center text-xs text-neutral-500 dark:text-neutral-400">
                                🔒 Data Anda aman dan tidak akan disalahgunakan. Kami mematuhi privasi klien.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
