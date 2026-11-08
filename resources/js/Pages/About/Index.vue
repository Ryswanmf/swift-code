<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
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

const siteName = computed(() => activeSettings.value.site_name || 'Swift Code Lampung');
const whatsappNumber = computed(() => activeSettings.value.whatsapp || '62895325852575');

const ownerName = computed(() => activeSettings.value.owner_name || 'Muhammad Riswan Mufid');
const ownerRole = computed(() => activeSettings.value.owner_role || 'Founder & Lead Software Engineer');
const ownerBio = computed(() => activeSettings.value.owner_bio || 'Praktisi software engineer dan pendiri Swift Code Lampung. Berfokus pada pembangunan sistem website modern dengan arsitektur kode bersih, performa loading kilat, dan solusi digital yang terbukti membantu bisnis berkembang secara konsisten.');
const ownerPhoto = computed(() => activeSettings.value.owner_photo || 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=800&auto=format&fit=crop');
const ownerLinkedin = computed(() => activeSettings.value.owner_linkedin || null);
const ownerGithub = computed(() => activeSettings.value.owner_github || null);

const cleanWaNumber = computed(() => String(whatsappNumber.value).replace(/[^0-9]/g, ''));
const waConsultUrl = computed(() => {
    const text = `Halo ${siteName.value}, saya membaca halaman Tentang Kami dan ingin berkonsultasi mengenai rencana pembuatan website bisnis saya.`;
    return `https://wa.me/${cleanWaNumber.value}?text=${encodeURIComponent(text)}`;
});

const coreValues = [
    {
        title: 'Kecepatan Tanpa Kompromi',
        description: 'Kami merancang arsitektur website dengan standar loading di bawah 2 detik. Kecepatan adalah kunci utama untuk menurunkan bounce rate dan meningkatkan konversi penjualan.',
    },
    {
        title: 'Kode Bersih & Terstruktur',
        description: 'Dibangun di atas fondasi Laravel 12 dan Vue 3 yang rapi, modular, dan mematuhi standar industri global. Sistem Anda siap dikembangkan lebih jauh kapan saja.',
    },
    {
        title: 'Desain Human-Centric',
        description: 'Setiap tata letak dirancang ramah pengguna (user-friendly) di ponsel pintar. Tampilan elegan, tipografi nyaman dibaca, dan navigasi yang mengarahkan pengunjung ke aksi nyata.',
    },
    {
        title: 'Transparansi Biaya & Proses',
        description: 'Bebas dari biaya tersembunyi. Setiap rincian fitur, durasi pengerjaan, dan biaya investasi disampaikan terbuka sejak sesi konsultasi awal.',
    },
    {
        title: 'Keamanan Tingkat Enterprise',
        description: 'Dilengkapi proteksi SSL/HTTPS, proteksi form anti-spam, sanitasi input database, dan konfigurasi server yang kokoh guna melindungi integritas data bisnis Anda.',
    },
    {
        title: 'Dukungan & Garansi Purna Jual',
        description: 'Hubungan kerja kami tidak berhenti saat website diluncurkan. Kami menyediakan garansi pemeliharaan, panduan pengelolaan konten, dan jalur konsultasi teknis yang selalu responsif.',
    },
];
</script>

<template>
    <Head>
        <title>Tentang Kami - Agensi Pembuatan Website & Sistem Digital Lampung | Swift Code</title>
        <meta
            name="description"
            content="Mengenal Swift Code Lampung, agensi teknologi pengembang website modern, landing page, toko online, dan sistem digital dengan kecepatan loading tinggi dan kode bersih."
        />
        <meta property="og:title" content="Tentang Kami - Swift Code Lampung" />
        <meta
            property="og:description"
            content="Profil, visi, misi, dan nilai integritas Swift Code Lampung dalam menghadirkan solusi website profesional dan berkinerja tinggi bagi bisnis Anda."
        />
    </Head>

    <PublicLayout>
        <!-- 1. Header Banner Section (Signature Brand Red Gradient) -->
        <section class="relative pt-28 pb-16 sm:pt-32 sm:pb-20 bg-gradient-to-r from-brand-800 via-brand-600 to-rose-600 text-white overflow-hidden shadow-inner">
            <!-- Subtle background ambient pattern -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none"></div>

            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
                <!-- Breadcrumbs -->
                <div class="flex items-center justify-center">
                    <nav class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 border border-white/20 text-xs font-medium text-white/90 backdrop-blur-xs">
                        <Link href="/" class="hover:text-white transition-colors">Beranda</Link>
                        <span>/</span>
                        <span class="text-white font-bold">Tentang Kami</span>
                    </nav>
                </div>

                <!-- Badge -->
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/20 border border-white/20 text-xs font-semibold tracking-wide uppercase text-white/95">
                    <span>Profil & Filosofi Agensi</span>
                </div>

                <!-- Heading -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight max-w-4xl mx-auto">
                    Membangun Solusi Web Berperforma Tinggi & Berkelas untuk Pertumbuhan Bisnis Nyata
                </h1>

                <!-- Subheading -->
                <p class="text-base sm:text-lg text-white/90 max-w-2xl mx-auto font-normal leading-relaxed">
                    Kami memadukan arsitektur kode modern kelas dunia dengan desain antarmuka yang elegan untuk membantu UMKM, institusi pendidikan, dan korporat melesat di era digital.
                </p>
            </div>
        </section>

        <!-- 2. The Story Behind Swift Code -->
        <section class="py-16 sm:py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                    <!-- Left: Meaning & Card Showcase -->
                    <div class="lg:col-span-5 space-y-6">
                        <div class="bg-gradient-to-br from-neutral-950 via-neutral-900 to-neutral-900 text-white rounded-3xl p-8 shadow-2xl border border-neutral-800 relative overflow-hidden">
                            <div class="absolute -right-12 -top-12 w-48 h-48 bg-brand-600/20 rounded-full blur-3xl pointer-events-none"></div>

                            <div class="space-y-6 relative z-10">
                                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-500/10 border border-brand-500/20 text-brand-400 text-xs font-semibold">
                                    <span>Arti Nama & Identitas</span>
                                </div>

                                <h2 class="text-2xl font-bold tracking-tight">
                                    Mengapa Kami Bernama <span class="text-brand-500">Swift Code</span>?
                                </h2>

                                <div class="space-y-4 pt-2">
                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-brand-500/20 text-brand-400 flex items-center justify-center shrink-0 font-bold font-mono text-sm border border-brand-500/30">
                                            01
                                        </div>
                                        <div>
                                            <h3 class="text-base font-semibold text-white">Swift (Cepat & Gesit)</h3>
                                            <p class="text-xs sm:text-sm text-neutral-300 mt-1 leading-relaxed">
                                                Mencerminkan kecepatan pemuatan halaman website di bawah 2 detik serta proses pengerjaan proyek yang gesit, terukur, dan tepat waktu.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center shrink-0 font-bold font-mono text-sm border border-rose-500/30">
                                            02
                                        </div>
                                        <div>
                                            <h3 class="text-base font-semibold text-white">Code (Kode Berkualitas)</h3>
                                            <p class="text-xs sm:text-sm text-neutral-300 mt-1 leading-relaxed">
                                                Mencerminkan pondasi rekayasa perangkat lunak yang bersih, berstruktur rapi, minim beban dependensi, dan mudah dirawat untuk jangka panjang.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-4 border-t border-neutral-800 flex items-center justify-between text-xs text-neutral-400">
                                    <span>Berpusat di Bandar Lampung</span>
                                    <span class="text-brand-400 font-semibold font-mono">Standar Kode Nasional</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Narrative & Philosophy -->
                    <div class="lg:col-span-7 space-y-6">
                        <div class="space-y-2">
                            <span class="text-xs font-bold text-brand-600 tracking-wider uppercase">Latar Belakang & Kisah Kami</span>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight leading-tight">
                                Membawa Standar Teknologi Kelas Dunia ke Ranah Bisnis Lokal
                            </h2>
                        </div>

                        <p class="text-neutral-600 text-sm sm:text-base leading-relaxed">
                            Swift Code bermula dari kepedulian terhadap banyaknya pelaku usaha, lembaga pendidikan, dan instansi di Lampung yang kesulitan menjangkau pasar lebih luas akibat website yang lambat, berantakan di layar ponsel, atau sulit diperbarui kontennya.
                        </p>

                        <p class="text-neutral-600 text-sm sm:text-base leading-relaxed">
                            Kami percaya bahwa memiliki website profesional tidak harus rumit, berbelit-belit, atau membebani anggaran usaha. Dengan memadukan teknologi modern seperti framework Laravel, Vue.js, dan optimasi performa server, kami mewujudkan sistem digital yang tangguh sekaligus ramah bagi pengguna awam.
                        </p>

                        <div class="pt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="p-4 rounded-xl bg-neutral-50 border border-neutral-200/80 space-y-1">
                                <h3 class="text-sm font-bold text-neutral-900">Bukan Sekadar Desain</h3>
                                <p class="text-xs text-neutral-600 leading-relaxed">
                                    Kami mendesain dengan pola pikir konversi penjualan: tombol kontak yang jelas, alur membaca yang terarah, dan kecepatan buka kilat.
                                </p>
                            </div>
                            <div class="p-4 rounded-xl bg-neutral-50 border border-neutral-200/80 space-y-1">
                                <h3 class="text-sm font-bold text-neutral-900">Mandiri Tanpa Ketergantungan</h3>
                                <p class="text-xs text-neutral-600 leading-relaxed">
                                    Setiap klien dibekali panel admin mandiri dan kepemilikan penuh atas domain dan data bisnis tanpa biaya sewa tersembunyi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Owner / Founder Profile Section -->
        <section class="py-16 sm:py-20 bg-neutral-50/70 border-t border-neutral-200/80">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-xl mx-auto space-y-2 mb-10">
                    <span class="text-xs font-bold text-brand-600 tracking-wider uppercase">Kepemimpinan & Dedikasi</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">
                        Sosok di Balik Swift Code
                    </h2>
                    <p class="text-xs sm:text-sm text-neutral-600">
                        Dedikasi penuh dari praktisi teknologi untuk menghadirkan kualitas website terbaik bagi bisnis Anda.
                    </p>
                </div>

                <!-- Main Founder Card -->
                <div class="bg-white rounded-3xl border border-neutral-200/90 shadow-xl shadow-neutral-900/5 overflow-hidden">
                    <div class="grid grid-cols-1 md:grid-cols-12 items-stretch">
                        <!-- Left Photo Column (5 cols) -->
                        <div class="md:col-span-5 relative bg-neutral-900 flex flex-col items-center justify-center min-h-[340px] sm:min-h-[400px] p-6 overflow-hidden">
                            <!-- Background subtle decorative gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-neutral-950 via-neutral-950/40 to-transparent z-10"></div>

                            <!-- Founder Photo with WebP and Lazy Loading -->
                            <img
                                :src="ownerPhoto"
                                :alt="ownerName"
                                class="absolute inset-0 w-full h-full object-cover object-top filter contrast-[1.05]"
                                loading="lazy"
                                decoding="async"
                            />

                            <!-- Floating Badges over Photo -->
                            <div class="absolute top-4 left-4 z-20">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-neutral-950/80 backdrop-blur-md border border-white/15 text-[11px] font-semibold text-white shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                    <span>Founder & Lead Dev</span>
                                </span>
                            </div>

                            <div class="absolute bottom-4 left-4 right-4 z-20 text-white">
                                <div class="px-3.5 py-2.5 rounded-2xl bg-black/70 backdrop-blur-md border border-white/10 flex items-center justify-between">
                                    <div>
                                        <p class="text-xs font-bold leading-tight">{{ ownerName }}</p>
                                        <p class="text-[10px] text-white/70">{{ ownerRole }}</p>
                                    </div>
                                    <span class="text-[10px] font-mono text-brand-300 font-semibold px-2 py-0.5 rounded-md bg-brand-500/20 border border-brand-500/30">
                                        Lampung
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Right Details Column (7 cols) -->
                        <div class="md:col-span-7 p-6 sm:p-10 flex flex-col justify-between space-y-6">
                            <div class="space-y-4">
                                <div class="space-y-1">
                                    <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-md bg-brand-50 text-brand-700 text-xs font-bold tracking-wide">
                                        Profil Pendiri
                                    </div>
                                    <h3 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">
                                        {{ ownerName }}
                                    </h3>
                                    <p class="text-xs sm:text-sm font-semibold text-brand-600">
                                        {{ ownerRole }}
                                    </p>
                                </div>

                                <div class="relative pl-4 border-l-2 border-brand-500">
                                    <p class="text-xs sm:text-sm text-neutral-600 leading-relaxed italic">
                                        "{{ ownerBio }}"
                                    </p>
                                </div>

                                <!-- Core Focus Tags -->
                                <div class="space-y-2 pt-2">
                                    <p class="text-[11px] font-bold text-neutral-400 uppercase tracking-wider">Fokus Keahlian & Spesialisasi</p>
                                    <div class="flex flex-wrap gap-1.5">
                                        <span class="px-2.5 py-1 rounded-lg bg-neutral-100 text-neutral-700 text-xs font-medium border border-neutral-200/60">Laravel Enterprise</span>
                                        <span class="px-2.5 py-1 rounded-lg bg-neutral-100 text-neutral-700 text-xs font-medium border border-neutral-200/60">Vue 3 & Inertia</span>
                                        <span class="px-2.5 py-1 rounded-lg bg-neutral-100 text-neutral-700 text-xs font-medium border border-neutral-200/60">Arsitektur Kode Bersih</span>
                                        <span class="px-2.5 py-1 rounded-lg bg-neutral-100 text-neutral-700 text-xs font-medium border border-neutral-200/60">Optimasi Loading &lt; 2s</span>
                                        <span class="px-2.5 py-1 rounded-lg bg-neutral-100 text-neutral-700 text-xs font-medium border border-neutral-200/60">Keamanan Server</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Footer Actions & Socials -->
                            <div class="pt-6 border-t border-neutral-100 flex flex-wrap items-center justify-between gap-4">
                                <a
                                    :href="waConsultUrl"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-semibold text-xs shadow-md shadow-brand-600/20 transition-all duration-200 hover:-translate-y-0.5"
                                >
                                    <span>Diskusi Langsung dengan Pemilik</span>
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>

                                <div class="flex items-center gap-2">
                                    <a
                                        v-if="ownerLinkedin"
                                        :href="ownerLinkedin"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="p-2.5 rounded-xl bg-neutral-100 hover:bg-brand-50 text-neutral-600 hover:text-brand-600 border border-neutral-200/80 transition-colors"
                                        aria-label="LinkedIn Pemilik"
                                    >
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                        </svg>
                                    </a>

                                    <a
                                        v-if="ownerGithub"
                                        :href="ownerGithub"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="p-2.5 rounded-xl bg-neutral-100 hover:bg-brand-50 text-neutral-600 hover:text-brand-600 border border-neutral-200/80 transition-colors"
                                        aria-label="GitHub Pemilik"
                                    >
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Vision & Mission Section -->
        <section class="py-16 sm:py-20 bg-neutral-50 border-y border-neutral-200/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                <div class="text-center max-w-2xl mx-auto space-y-2">
                    <span class="text-xs font-bold text-brand-600 tracking-wider uppercase">Pijakan Arah</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">
                        Visi & Misi Swift Code
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-600">
                        Prinsip utama yang memandu setiap baris kode dan keputusan desain yang kami buat.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Vision Card -->
                    <div class="bg-white rounded-2xl p-8 border border-neutral-200/90 shadow-sm space-y-5 flex flex-col justify-between">
                        <div class="space-y-4">
                            <div class="w-12 h-12 rounded-xl bg-brand-50 border border-brand-100 text-brand-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>

                            <h3 class="text-xl font-bold text-neutral-900">Visi Kami</h3>

                            <p class="text-sm sm:text-base text-neutral-600 leading-relaxed">
                                Menjadi agensi solusi digital dan pengembangan website terdepan di Indonesia yang dipercaya karena kecepatan eksekusi, estetika elegan, dan kehandalan teknis, serta memberdayakan bisnis lokal untuk bersaing secara tangguh di pasar nasional maupun global.
                            </p>
                        </div>

                        <div class="pt-4 border-t border-neutral-100 flex items-center gap-2 text-xs font-semibold text-brand-600">
                            <span>Fokus Hasil & Pertumbuhan Nyata</span>
                        </div>
                    </div>

                    <!-- Mission Card -->
                    <div class="bg-white rounded-2xl p-8 border border-neutral-200/90 shadow-sm space-y-5 flex flex-col justify-between">
                        <div class="space-y-4">
                            <div class="w-12 h-12 rounded-xl bg-rose-50 border border-rose-100 text-rose-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>

                            <h3 class="text-xl font-bold text-neutral-900">Misi Kami</h3>

                            <ul class="space-y-3 text-xs sm:text-sm text-neutral-600">
                                <li class="flex items-start gap-2.5">
                                    <span class="w-5 h-5 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 font-bold text-[11px] mt-0.5">1</span>
                                    <span>Menghadirkan website cepat, aman, dan mobile-first dengan standar arsitektur perangkat lunak modern.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="w-5 h-5 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 font-bold text-[11px] mt-0.5">2</span>
                                    <span>Memberikan transparansi estimasi biaya dan edukasi digital yang jujur tanpa istilah teknis yang membingungkan.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="w-5 h-5 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 font-bold text-[11px] mt-0.5">3</span>
                                    <span>Mendampingi perjalanan digital klien melalui layanan purna jual dan dukungan teknis yang tulus dan berkelanjutan.</span>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-4 border-t border-neutral-100 flex items-center gap-2 text-xs font-semibold text-rose-600">
                            <span>Komitmen Kualitas Tanpa Kompromi</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Core Values Section -->
        <section class="py-16 sm:py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                <div class="text-center max-w-2xl mx-auto space-y-2">
                    <span class="text-xs font-bold text-brand-600 tracking-wider uppercase">Nilai Integritas</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">
                        Prinsip yang Selalu Kami Pegang Teguh
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-600">
                        Standar etika dan kualitas kerja di balik setiap proyek yang kami tangani.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div
                        v-for="(val, idx) in coreValues"
                        :key="idx"
                        class="p-6 rounded-2xl bg-neutral-50 hover:bg-white border border-neutral-200/80 hover:border-brand-200 hover:shadow-lg hover:shadow-brand-600/5 transition-all duration-300 space-y-3"
                    >
                        <div class="w-10 h-10 rounded-xl bg-brand-100 text-brand-700 flex items-center justify-center font-bold text-sm">
                            0{{ idx + 1 }}
                        </div>
                        <h3 class="text-base font-bold text-neutral-900">{{ val.title }}</h3>
                        <p class="text-xs sm:text-sm text-neutral-600 leading-relaxed">{{ val.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. Call To Action (CTA) Section -->
        <section class="py-16 sm:py-24 bg-gradient-to-r from-brand-900 via-brand-700 to-rose-700 text-white text-center relative overflow-hidden">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 relative z-10">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 border border-white/20 text-xs font-semibold tracking-wide uppercase text-white">
                    <span>Mulai Diskusi Tanpa Komitmen</span>
                </span>

                <h2 class="text-2xl sm:text-4xl font-extrabold tracking-tight leading-tight">
                    Siap Membangun Website Impian Bisnis Anda Bersama Tim Swift Code?
                </h2>

                <p class="text-sm sm:text-base text-white/90 max-w-2xl mx-auto leading-relaxed">
                    Konsultasikan kebutuhan Anda sekarang. Tim kami siap memberikan gambaran struktur website, estimasi biaya transparan, serta solusi terbaik secara gratis.
                </p>

                <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4">
                    <a
                        :href="waConsultUrl"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white text-brand-700 hover:bg-neutral-100 font-bold text-sm shadow-xl transition-all duration-200 hover:-translate-y-0.5"
                    >
                        <svg class="w-4 h-4 fill-current text-emerald-600" viewBox="0 0 24 24">
                            <path d="M12.031 2C6.495 2 2 6.494 2 12.031c0 1.84.498 3.567 1.365 5.064L2 22l5.053-1.326a9.98 9.98 0 004.978 1.357h.005c5.534 0 10.029-4.494 10.029-10.031A10.015 10.015 0 0012.031 2zm0 18.232c-1.57 0-3.102-.42-4.437-1.213l-.318-.189-3.298.865.881-3.214-.207-.33a8.212 8.212 0 01-1.258-4.321c0-4.542 3.696-8.237 8.243-8.237 2.203 0 4.273.858 5.829 2.416a8.196 8.196 0 012.412 5.825c0 4.544-3.696 8.239-8.245 8.239zm4.518-6.177c-.248-.124-1.465-.723-1.692-.806-.228-.083-.394-.124-.56.124-.166.248-.642.806-.787.972-.145.166-.29.186-.538.062-.248-.124-1.047-.386-1.995-1.231-.738-.658-1.236-1.472-1.381-1.72-.145-.248-.016-.382.108-.506.112-.111.248-.29.373-.435.124-.145.166-.248.248-.415.083-.166.042-.311-.021-.435-.062-.124-.56-1.35-.767-1.849-.202-.486-.407-.42-.56-.428l-.477-.008c-.166 0-.435.062-.663.311-.228.248-.871.851-.871 2.075s.892 2.406 1.016 2.572c.124.166 1.755 2.68 4.252 3.758.594.257 1.058.41 1.42.525.597.19 1.14.163 1.57.099.479-.071 1.465-.6 1.672-1.179.207-.58.207-1.077.145-1.179-.062-.102-.228-.166-.476-.29z"/>
                        </svg>
                        <span>Konsultasi Gratis via WhatsApp</span>
                    </a>

                    <Link
                        href="/portofolio"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/25 text-white font-semibold text-sm transition-all duration-200"
                    >
                        <span>Lihat Portofolio Proyek</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </Link>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>
