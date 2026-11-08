<script setup lang="ts">
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import PublicLayout from '@/Layouts/PublicLayout.vue';

interface Props {
    settings?: Record<string, string>;
}

const props = withDefaults(defineProps<Props>(), {
    settings: () => ({}),
});

const page = usePage();
const activeSettings = computed<Record<string, string>>(() => ({
    ...props.settings,
    ...((page.props as any).siteSettings || {}),
}));

const whatsappNumber = computed(() => activeSettings.value.whatsapp || '62895325852575');
const emailAddress = computed(() => activeSettings.value.email || 'halo@swiftcode.id');
const instagramHandle = computed(() => activeSettings.value.instagram || '@swiftcode.lpg');
const officeAddress = computed(() => activeSettings.value.address || 'Bandar Lampung, Lampung, Indonesia');

const cleanWaNumber = computed(() => String(whatsappNumber.value).replace(/[^0-9]/g, ''));
const waLink = computed(() => {
    const text = 'Halo Swift Code Lampung, saya ingin berkonsultasi mengenai pembuatan website untuk bisnis saya.';
    return `https://wa.me/${cleanWaNumber.value}?text=${encodeURIComponent(text)}`;
});

const suggestions = [
    'Landing Page',
    'Company Profile',
    'Toko Online',
    'Website Sekolah',
    'Sistem Custom',
];

const form = useForm({
    name: '',
    phone: '',
    email: '',
    service_type: '',
    budget: '',
    message: '',
    website_hp: '', // Honeypot anti-spam
});

const isSubmittedSuccess = ref<boolean>(false);

const submitForm = () => {
    form.post('/kontak', {
        preserveScroll: true,
        onSuccess: () => {
            isSubmittedSuccess.value = true;
            form.reset();
        },
        onError: () => {
            // Fallback: If network issue occurs, open WhatsApp directly
            const text = `Halo Swift Code Lampung, saya *${form.name}* ingin berkonsultasi mengenai pembuatan website *${form.service_type}*.\n\nPesan: ${form.message}`;
            window.open(`https://wa.me/${cleanWaNumber.value}?text=${encodeURIComponent(text)}`, '_blank');
        },
    });
};

const activeFaq = ref<number | null>(0);
const toggleFaq = (index: number) => {
    activeFaq.value = activeFaq.value === index ? null : index;
};

const faqs = [
    {
        q: 'Apakah konsultasi awal dan penyusunan RAB ini benar-benar gratis?',
        a: 'Ya, 100% gratis tanpa komitmen apa pun. Tim kami akan mendengarkan kebutuhan bisnis Anda, memberikan saran struktur website yang tepat, serta mengestimasi anggaran yang paling efisien.',
    },
    {
        q: 'Berapa lama waktu yang dibutuhkan hingga website siap online?',
        a: 'Untuk Paket Landing Page biasanya selesai dalam 3 - 5 hari kerja. Untuk Company Profile berkisar 5 - 10 hari kerja setelah materi konten dan foto kami terima secara lengkap.',
    },
    {
        q: 'Bisakah bertemu langsung (tatap muka) di Lampung?',
        a: 'Tentu bisa! Untuk area Bandar Lampung dan sekitarnya, tim kami siap mengatur jadwal pertemuan langsung di kantor Anda atau di tempat yang nyaman untuk berdiskusi.',
    },
    {
        q: 'Apa saja yang perlu saya persiapkan sebelum memesan website?',
        a: 'Cukup siapkan nama bisnis/domain yang diinginkan, rincian produk atau layanan yang ditawarkan, dan nomor kontak aktif. Jika belum memiliki logo atau materi teks, tim kami siap membantu menyusunnya.',
    },
];
</script>

<template>
    <Head>
        <title>Hubungi Kami - Konsultasi Pembuatan Website Lampung | Swift Code</title>
        <meta
            name="description"
            content="Hubungi tim Swift Code Lampung untuk konsultasi gratis pembuatan website perusahaan, toko online, sekolah, dan landing page. Respons kilat WhatsApp & email."
        />
        <meta property="og:title" content="Hubungi Kami - Swift Code Lampung" />
        <meta
            property="og:description"
            content="Konsultasikan kebutuhan website bisnis Anda bersama tim ahli Swift Code Lampung. Estimasi biaya transparan dan pengerjaan cepat."
        />
    </Head>

    <PublicLayout>
        <!-- 1. Header Banner Section (Signature Brand Red Gradient) -->
        <section class="relative pt-28 pb-12 sm:pt-32 sm:pb-16 bg-gradient-to-r from-brand-800 via-brand-600 to-rose-600 text-white overflow-hidden shadow-inner">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
                <!-- Breadcrumbs -->
                <div class="flex items-center justify-center">
                    <nav class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 border border-white/20 text-xs font-medium text-white/90 backdrop-blur-xs">
                        <Link href="/" class="hover:text-white transition-colors">Beranda</Link>
                        <span>/</span>
                        <span class="text-white font-bold">Kontak Kami</span>
                    </nav>
                </div>

                <!-- Headline -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white leading-tight">
                    Hubungi Kami & <br class="hidden sm:inline" />
                    <span>Mulai Konsultasi Gratis</span>
                </h1>

                <!-- Subheadline -->
                <p class="text-base sm:text-lg text-white/90 max-w-2xl mx-auto leading-relaxed">
                    Punya ide website baru atau ingin meningkatkan omzet bisnis Anda di Lampung? Diskusikan bersama tim ahli Swift Code. Kami siap membantu Anda setiap saat.
                </p>
            </div>
        </section>

        <!-- 2. Main Contact & Form Section -->
        <section class="py-12 sm:py-16 lg:py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
                    <!-- Left: Direct Contact Information (5 Cols) -->
                    <div class="lg:col-span-5 space-y-8">
                        <div>
                            <span class="text-xs sm:text-sm font-bold tracking-widest uppercase text-brand-600">
                                Kanal Komunikasi Resmi
                            </span>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight mt-1.5">
                                Kami Siap Mendengarkan Kebutuhan Anda
                            </h2>
                            <p class="text-sm sm:text-base text-neutral-600 mt-2.5 leading-relaxed">
                                Silakan hubungi kami melalui salah satu kontak di bawah ini atau isi formulir di samping. Tim kami akan merespons dalam hitungan menit!
                            </p>
                        </div>

                        <!-- Direct Cards List -->
                        <div class="space-y-4">
                            <!-- WhatsApp Card -->
                            <a
                                :href="waLink"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="group flex items-start gap-4 p-5 rounded-2xl bg-white border border-neutral-200/90 hover:border-emerald-500 shadow-2xs hover:shadow-md transition-all duration-200 hover:-translate-y-0.5"
                            >
                                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs text-neutral-500 font-medium">Respons Cepat WhatsApp</p>
                                    <p class="text-base font-bold text-neutral-900 group-hover:text-emerald-600 transition-colors mt-0.5">
                                        +{{ cleanWaNumber }}
                                    </p>
                                    <p class="text-xs text-emerald-600 font-semibold mt-1 flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        Online • Rata-rata respons &lt; 15 menit
                                    </p>
                                </div>
                            </a>

                            <!-- Email Card -->
                            <a
                                :href="`mailto:${emailAddress}`"
                                class="group flex items-start gap-4 p-5 rounded-2xl bg-white border border-neutral-200/90 hover:border-brand-500 shadow-2xs hover:shadow-md transition-all duration-200 hover:-translate-y-0.5"
                            >
                                <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center shrink-0 group-hover:bg-brand-600 group-hover:text-white transition-colors">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs text-neutral-500 font-medium">Email Resmi & Proposal</p>
                                    <p class="text-base font-bold text-neutral-900 group-hover:text-brand-600 transition-colors mt-0.5 truncate">
                                        {{ emailAddress }}
                                    </p>
                                    <p class="text-xs text-neutral-500 mt-1">
                                        Untuk surat penawaran, tender & kerjasama
                                    </p>
                                </div>
                            </a>

                            <!-- Instagram Card -->
                            <a
                                :href="`https://instagram.com/${instagramHandle.replace('@', '')}`"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="group flex items-start gap-4 p-5 rounded-2xl bg-white border border-neutral-200/90 hover:border-rose-500 shadow-2xs hover:shadow-md transition-all duration-200 hover:-translate-y-0.5"
                            >
                                <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0 group-hover:bg-rose-600 group-hover:text-white transition-colors">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <rect x="2" y="2" width="20" height="20" rx="5" stroke-width="2" />
                                        <circle cx="12" cy="12" r="4" stroke-width="2" />
                                        <circle cx="18" cy="6" r="1" fill="currentColor" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs text-neutral-500 font-medium">Instagram Resmi</p>
                                    <p class="text-base font-bold text-neutral-900 group-hover:text-rose-600 transition-colors mt-0.5">
                                        {{ instagramHandle }}
                                    </p>
                                    <p class="text-xs text-neutral-500 mt-1">
                                        Portofolio terbaru, tips web & behind the scenes
                                    </p>
                                </div>
                            </a>

                            <!-- Location & Working Hours Card -->
                            <div class="flex items-start gap-4 p-5 rounded-2xl bg-neutral-50 border border-neutral-200/90">
                                <div class="w-12 h-12 rounded-xl bg-neutral-200/80 text-neutral-700 flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs text-neutral-500 font-medium">Lokasi Kantor & Operasional</p>
                                    <p class="text-sm font-bold text-neutral-900 mt-0.5">
                                        {{ officeAddress }}
                                    </p>
                                    <p class="text-xs text-neutral-600 mt-1">
                                        Senin - Sabtu: 08:00 - 18:00 WIB <br />
                                        Minggu & Hari Libur: Chat WhatsApp Tetap Dilayani
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Interactive Consultation Form (7 Cols) -->
                    <div class="lg:col-span-7">
                        <div class="p-7 sm:p-10 rounded-3xl bg-white border border-neutral-200 shadow-xl">
                            <!-- Success State Alert -->
                            <div
                                v-if="isSubmittedSuccess"
                                class="p-8 rounded-2xl bg-emerald-50 border border-emerald-200 text-center space-y-4"
                            >
                                <div class="w-16 h-16 rounded-full bg-emerald-500 text-white flex items-center justify-center mx-auto shadow-md shadow-emerald-500/20">
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-extrabold text-emerald-900">
                                    Pesan Konsultasi Berhasil Terkirim!
                                </h3>
                                <p class="text-sm text-emerald-800 max-w-md mx-auto leading-relaxed">
                                    Terima kasih telah menghubungi Swift Code Lampung. Tim kami akan segera meninjau kebutuhan website Anda dan menghubungi Anda kembali.
                                </p>
                                <div class="pt-2">
                                    <a
                                        :href="waLink"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs sm:text-sm font-bold shadow-md shadow-emerald-600/25 transition-all"
                                    >
                                        <span>Konfirmasi Cepat via WhatsApp</span>
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Main Form -->
                            <form v-else @submit.prevent="submitForm" class="space-y-6">
                                <div>
                                    <h3 class="text-xl sm:text-2xl font-extrabold text-neutral-900 tracking-tight">
                                        Formulir Rencana Website
                                    </h3>
                                    <p class="text-xs sm:text-sm text-neutral-500 mt-1">
                                        Isi rincian di bawah ini untuk mendapatkan proposal dan estimasi biaya gratis.
                                    </p>
                                </div>

                                <!-- Honeypot anti-spam -->
                                <div class="hidden" aria-hidden="true">
                                    <label for="website_hp">Jangan isi kolom ini</label>
                                    <input id="website_hp" v-model="form.website_hp" type="text" tabindex="-1" autocomplete="off" />
                                </div>

                                <!-- Field: Nama & WhatsApp (Grid 2 Kolom) -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">
                                            Nama Lengkap / Bisnis <span class="text-brand-600">*</span>
                                        </label>
                                        <input
                                            v-model="form.name"
                                            type="text"
                                            required
                                            placeholder="Contoh: Rian - Cafe Kopi Lampung"
                                            class="w-full px-4 py-3 rounded-xl border border-neutral-300 bg-white text-neutral-900 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all"
                                        />
                                        <p v-if="form.errors.name" class="mt-1 text-xs text-rose-500">{{ form.errors.name }}</p>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">
                                            Nomor WhatsApp <span class="text-brand-600">*</span>
                                        </label>
                                        <input
                                            v-model="form.phone"
                                            type="tel"
                                            required
                                            placeholder="Contoh: 08123456789"
                                            class="w-full px-4 py-3 rounded-xl border border-neutral-300 bg-white text-neutral-900 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all"
                                        />
                                        <p v-if="form.errors.phone" class="mt-1 text-xs text-rose-500">{{ form.errors.phone }}</p>
                                    </div>
                                </div>

                                <!-- Field: Email (Opsional) -->
                                <div>
                                    <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">
                                        Alamat Email <span class="text-neutral-400 font-normal text-xs">(Opsional, untuk pengiriman penawaran/invoice)</span>
                                    </label>
                                    <input
                                        v-model="form.email"
                                        type="email"
                                        placeholder="Contoh: rian@bisnis.com"
                                        class="w-full px-4 py-3 rounded-xl border border-neutral-300 bg-white text-neutral-900 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all"
                                    />
                                    <p v-if="form.errors.email" class="mt-1 text-xs text-rose-500">{{ form.errors.email }}</p>
                                </div>

                                <!-- Field: Jenis Website yang Dibutuhkan (Input Kosong untuk Diisi Sendiri) -->
                                <div>
                                    <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">
                                        Jenis Website yang Dibutuhkan <span class="text-brand-600">*</span>
                                    </label>
                                    <input
                                        v-model="form.service_type"
                                        type="text"
                                        required
                                        placeholder="Contoh: Landing Page, Company Profile, Toko Online, Website Sekolah, Sistem Custom, dll."
                                        class="w-full px-4 py-3 rounded-xl border border-neutral-300 bg-white text-neutral-900 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all"
                                    />
                                    <div class="flex flex-wrap items-center gap-1.5 mt-2">
                                        <span class="text-[11px] text-neutral-500">Contoh cepat:</span>
                                        <button
                                            type="button"
                                            v-for="sug in suggestions"
                                            :key="sug"
                                            @click="form.service_type = sug"
                                            class="px-2 py-0.5 text-[11px] rounded-md bg-neutral-100 hover:bg-brand-50 text-neutral-600 hover:text-brand-600 border border-neutral-200/60 transition-colors cursor-pointer"
                                        >
                                            {{ sug }}
                                        </button>
                                    </div>
                                    <p v-if="form.errors.service_type" class="mt-1 text-xs text-rose-500">{{ form.errors.service_type }}</p>
                                </div>

                                <!-- Field: Pesan Kebutuhan -->
                                <div>
                                    <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">
                                        Jelaskan Kebutuhan / Referensi Website <span class="text-brand-600">*</span>
                                    </label>
                                    <textarea
                                        v-model="form.message"
                                        rows="4"
                                        required
                                        placeholder="Ceritakan gambaran singkat tentang bisnis Anda, fitur yang diinginkan, atau tautan contoh website yang disukai..."
                                        class="w-full px-4 py-3 rounded-xl border border-neutral-300 bg-white text-neutral-900 text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all resize-y"
                                    ></textarea>
                                    <p v-if="form.errors.message" class="mt-1 text-xs text-rose-500">{{ form.errors.message }}</p>
                                </div>

                                <!-- Submit Button -->
                                <div>
                                    <button
                                        type="submit"
                                        :disabled="form.processing"
                                        class="w-full flex items-center justify-center gap-2 py-4 px-6 bg-brand-600 hover:bg-brand-700 active:bg-brand-800 disabled:opacity-60 text-white font-bold text-sm sm:text-base rounded-xl shadow-lg shadow-brand-600/25 transition-all duration-200 hover:-translate-y-0.5 cursor-pointer"
                                    >
                                        <span v-if="form.processing">Mengirim Data Konsultasi...</span>
                                        <template v-else>
                                            <span>Kirim & Teruskan ke WhatsApp</span>
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </template>
                                    </button>
                                    <p class="text-[11px] text-neutral-500 text-center mt-2.5">
                                        * Form otomatis menghubungkan Anda ke WhatsApp resmi Swift Code Lampung untuk konfirmasi instan.
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- 3. Mini FAQ Section (Tanya Jawab Seputar Konsultasi) -->
                <div class="mt-20 pt-16 border-t border-neutral-200/80">
                    <div class="text-center max-w-3xl mx-auto mb-10">
                        <span class="text-xs sm:text-sm font-bold tracking-widest uppercase text-brand-600">
                            FAQ Konsultasi
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight mt-1">
                            Pertanyaan Umum Sebelum Berkonsultasi
                        </h2>
                    </div>

                    <div class="max-w-3xl mx-auto space-y-3">
                        <div
                            v-for="(faq, i) in faqs"
                            :key="i"
                            class="rounded-2xl border border-neutral-200 bg-white overflow-hidden transition-all shadow-2xs"
                        >
                            <button
                                type="button"
                                @click="toggleFaq(i)"
                                class="w-full flex items-center justify-between p-5 text-left font-bold text-neutral-900 hover:text-brand-600 transition-colors cursor-pointer select-none text-sm sm:text-base"
                            >
                                <span>{{ faq.q }}</span>
                                <svg
                                    class="w-5 h-5 text-neutral-400 shrink-0 transition-transform duration-200 ml-4"
                                    :class="{ 'rotate-180 text-brand-600': activeFaq === i }"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div
                                v-show="activeFaq === i"
                                class="px-5 pb-5 text-xs sm:text-sm text-neutral-600 leading-relaxed border-t border-neutral-100 pt-3"
                            >
                                {{ faq.a }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>
