<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import PricingCard, { PackageItem } from '@/Components/Public/PricingCard.vue';
import FaqItem, { FaqData } from '@/Components/Public/FaqItem.vue';

interface Props {
    packages?: PackageItem[];
    faqs?: FaqData[];
    settings?: Record<string, string>;
}

const props = withDefaults(defineProps<Props>(), {
    packages: () => [],
    faqs: () => [],
    settings: () => ({}),
});

// Fallback pricing packages
const defaultPackages: PackageItem[] = [
    {
        name: 'Paket Basic (Landing Page)',
        price: 950000,
        price_note: 'Mulai dari • Cocok untuk promosi produk & UMKM',
        features: [
            '1 Halaman Landing Page responsif',
            'Desain modern & mobile-first',
            'Tombol WhatsApp & formulir leads',
            'Domain .my.id / .com gratis 1 tahun',
            'Hosting kilat SSD 1 tahun',
            'Sertifikat keamanan SSL aktif',
            'Pengerjaan 3 - 5 hari kerja',
        ],
        is_highlighted: false,
    },
    {
        name: 'Paket Business (Company Profile)',
        price: 2450000,
        price_note: 'Mulai dari • Paling diminati perusahaan & sekolah',
        features: [
            'Hingga 5-7 Halaman (Home, Profil, Layanan, Galeri, Kontak)',
            'Panel Admin kelola konten & artikel',
            'Optimasi SEO dasar Google Search',
            'Domain .com / .sch.id gratis 1 tahun',
            'Hosting cepat kapasitas tinggi 1 tahun',
            'Email bisnis profesional (nama@perusahaan.com)',
            'Pengerjaan 5 - 10 hari kerja',
            'Garansi support 6 bulan penuh',
        ],
        is_highlighted: true,
    },
    {
        name: 'Paket Custom / Sistem Web',
        price: null,
        price_note: 'Sesuai spesifikasi • Toko online & sistem khusus',
        features: [
            'Struktur database & fungsionalitas kustom',
            'Integrasi Payment Gateway / Ekspedisi Ongkir',
            'Hak akses multi-role (Admin, Kasir, Klien)',
            'Laporan data & export PDF/Excel',
            'Infrastruktur VPS / Server khusus',
            'Pelatihan langsung tim operasional',
            'Maintenance & pemeliharaan teratur',
        ],
        is_highlighted: false,
    },
];

const packagesList = computed(() => (props.packages && props.packages.length > 0 ? props.packages : defaultPackages));

const pricingFaqs: FaqData[] = [
    {
        question: 'Apakah ada biaya langganan bulanan tersembunyi?',
        answer: 'Tidak ada. Seluruh paket website di Swift Code Lampung adalah sistem beli putus. Anda hanya membayar biaya pembuatan di awal. Biaya berikutnya hanya perpanjangan domain dan hosting tahunan yang sangat terjangkau mulai tahun ke-2.',
    },
    {
        question: 'Bagaimana sistem pembayaran di Swift Code?',
        answer: 'Kami menerapkan sistem aman dan transparan dengan DP (Down Payment) sebesar 50% di awal sebelum proyek dimulai, dan pelunasan sisa 50% dibayarkan setelah website selesai diuji dan siap tayang online.',
    },
    {
        question: 'Berapa biaya perpanjangan domain & hosting di tahun ke-2?',
        answer: 'Tahun pertama sudah gratis 100%. Untuk tahun kedua dan seterusnya, perpanjangan domain dan hosting berkisar mulai Rp 350.000 - Rp 650.000 per tahun tergantung jenis domain (.com/.id) dan kapasitas server.',
    },
    {
        question: 'Berapa lama proses pembuatan hingga website siap pakai?',
        answer: 'Untuk Paket Basic (Landing Page) berkisar 3 - 5 hari kerja. Untuk Paket Business (Company Profile) sekitar 5 - 10 hari kerja setelah materi teks dan foto kami terima.',
    },
    {
        question: 'Bisakah memesan fitur kustom yang tidak ada dalam paket?',
        answer: 'Tentu saja! Kami memiliki Paket Custom / Sistem Web. Anda dapat mengonsultasikan alur sistem yang diinginkan, seperti sistem kasir kasir, reservasi, portal absensi, atau integrasi API khusus.',
    },
    {
        question: 'Apakah saya mendapatkan panduan cara mengelola website?',
        answer: 'Ya, setiap website yang dilengkapi panel admin akan disertai panduan video dan pelatihan langsung dari tim kami hingga Anda lancar mengelola teks, gambar, maupun artikel.',
    },
];

const faqsList = computed(() => (props.faqs && props.faqs.length > 0 ? props.faqs : pricingFaqs));

const standardFeatures = [
    {
        title: 'Domain & Cloud Hosting 1 Tahun',
        desc: 'Gratis domain pilihan (.com / .my.id / .sch.id) dan hosting SSD berkapasitas optimal dengan uptime 99.9%.',
        icon: 'server',
    },
    {
        title: '100% Mobile Responsive',
        desc: 'Tampilan website otomatis menyesuaikan sempurna di semua perangkat: HP Android/iOS, tablet, dan laptop.',
        icon: 'mobile',
    },
    {
        title: 'Optimasi SEO & Schema Local',
        desc: 'Struktur kode ramah mesin pencari, meta tag lengkap, sitemap XML, dan terdaftar di Google Search Console.',
        icon: 'search',
    },
    {
        title: 'Tombol Chat WhatsApp Instan',
        desc: 'Memudahkan pengunjung langsung berkomunikasi dengan customer service Anda melalui template pesan siap kirim.',
        icon: 'chat',
    },
    {
        title: 'Panel Admin Mandiri (CMS)',
        desc: 'Kemudahan memperbarui teks, foto portofolio, produk, maupun artikel kapan saja tanpa perlu keahlian coding.',
        icon: 'cog',
    },
    {
        title: 'Garansi Teknis & Pendampingan',
        desc: 'Bebas biaya konsultasi dan perbaikan jika terjadi kendala teknis pasca website online, agar operasional lancar.',
        icon: 'shield',
    },
];

const page = usePage();
const whatsappNumber = computed(() => {
    const raw = (page.props as any).siteSettings?.whatsapp || props.settings?.whatsapp || '62895325852575';
    return String(raw).replace(/[^0-9]/g, '');
});

const buildPackageWaUrl = (pkgName: string) => {
    const text = `Halo Swift Code Lampung, saya ingin berkonsultasi dan memesan *${pkgName}* untuk bisnis saya.`;
    return `https://wa.me/${whatsappNumber.value}?text=${encodeURIComponent(text)}`;
};
</script>

<template>
    <Head>
        <title>Paket Harga Pembuatan Website Lampung | Swift Code</title>
        <meta
            name="description"
            content="Daftar paket harga pembuatan website murah dan profesional di Lampung: Paket Landing Page, Company Profile, Toko Online, dan Sistem Kustom. Transparan & bergaransi."
        />
        <meta property="og:title" content="Paket Harga Pembuatan Website Lampung - Swift Code" />
        <meta
            property="og:description"
            content="Pilihan paket pembuatan website transparan tanpa biaya tersembunyi. Termasuk domain, hosting SSD, dan garansi support penuh."
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
                        <span class="text-white font-bold">Paket Harga</span>
                    </nav>
                </div>

                <!-- Headline -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white leading-tight">
                    Paket Harga Pembuatan Website <br class="hidden sm:inline" />
                    <span>Transparan & Masuk Akal</span>
                </h1>

                <!-- Subheadline -->
                <p class="text-base sm:text-lg text-white/90 max-w-2xl mx-auto leading-relaxed">
                    Investasi terbaik untuk pertumbuhan bisnis Anda. Tanpa biaya tersembunyi, sistem pembayaran bertahap (DP 50%), dan sudah termasuk domain serta hosting 1 tahun pertama.
                </p>
            </div>
        </section>

        <!-- 2. Pricing Packages Grid Section -->
        <section class="py-12 sm:py-16 bg-white relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-12 space-y-2">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">
                        Pilihan Paket Website Siap Pakai
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-600">
                        Pilih paket yang paling pas dengan skala usaha dan target pencapaian Anda saat ini.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">
                    <PricingCard
                        v-for="pkg in packagesList"
                        :key="pkg.name"
                        :pkg="pkg"
                        :action-href="buildPackageWaUrl(pkg.name)"
                        action-text="Pesan Paket Ini via WhatsApp"
                        :is-external="true"
                    />
                </div>
            </div>
        </section>

        <!-- 3. Standard Fasilitas di Semua Paket -->
        <section class="py-12 sm:py-16 bg-neutral-50/70 border-t border-neutral-200/80 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-12 space-y-2">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">
                        Standar Kualitas di <span class="text-brand-600">Semua Paket</span>
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-600">
                        Setiap website yang dikembangkan oleh Swift Code Lampung sudah mencakup fitur-fitur penting berikut tanpa biaya tambahan.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                    <div
                        v-for="feat in standardFeatures"
                        :key="feat.title"
                        class="p-5 sm:p-6 rounded-2xl bg-white border border-neutral-200/80 shadow-xs hover:shadow-md transition-all"
                    >
                        <div class="w-10 h-10 rounded-xl bg-brand-50 border border-brand-200/60 text-brand-600 flex items-center justify-center mb-3.5 font-bold">
                            <!-- Server -->
                            <svg v-if="feat.icon === 'server'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                            </svg>
                            <!-- Mobile -->
                            <svg v-else-if="feat.icon === 'mobile'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <!-- Search -->
                            <svg v-else-if="feat.icon === 'search'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <!-- Chat -->
                            <svg v-else-if="feat.icon === 'chat'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <!-- Cog -->
                            <svg v-else-if="feat.icon === 'cog'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <!-- Shield -->
                            <svg v-else class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-sm sm:text-base font-bold text-neutral-900 mb-1.5">
                            {{ feat.title }}
                        </h3>
                        <p class="text-xs text-neutral-600 leading-relaxed">
                            {{ feat.desc }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. FAQ Seputar Harga & Pembayaran -->
        <section class="py-12 sm:py-16 bg-white border-t border-neutral-200/80">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10 sm:mb-12 space-y-2">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">
                        Tanya Jawab Seputar Harga & Pembayaran
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-600">
                        Pertanyaan yang paling sering diajukan mengenai sistem pembayaran dan garansi layanan.
                    </p>
                </div>

                <div class="space-y-3.5">
                    <FaqItem
                        v-for="(faq, fIdx) in faqsList"
                        :key="faq.question"
                        :faq="faq"
                        :isOpenDefault="fIdx === 0"
                    />
                </div>
            </div>
        </section>

        <!-- 5. CTA Red Gradient Banner -->
        <section class="py-10 sm:py-12 bg-neutral-50/70 border-t border-neutral-200/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-r from-brand-800 via-brand-600 to-rose-600 text-white shadow-xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="space-y-2 text-center md:text-left">
                        <h3 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                            Butuh Spesifikasi atau Penawaran Khusus?
                        </h3>
                        <p class="text-sm sm:text-base text-white/90 max-w-xl leading-relaxed">
                            Diskusikan kebutuhan unik bisnis Anda bersama tim kami. Kami siap memberikan rancangan anggaran yang paling efisien dan efektif.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center gap-3 shrink-0">
                        <a
                            :href="`https://wa.me/${whatsappNumber}?text=${encodeURIComponent('Halo Swift Code, saya ingin berkonsultasi mengenai penawaran harga pembuatan website khusus.')}`"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="px-6 py-3.5 bg-white text-brand-700 hover:bg-neutral-100 font-bold text-xs sm:text-sm rounded-xl shadow-lg transition-transform hover:scale-105 active:scale-95 text-center whitespace-nowrap"
                        >
                            Konsultasi WhatsApp Sekarang
                        </a>
                        <Link
                            href="/portofolio"
                            class="px-6 py-3.5 bg-white/15 hover:bg-white/25 border border-white/25 text-white font-bold text-xs sm:text-sm rounded-xl transition-colors text-center whitespace-nowrap"
                        >
                            Lihat Portofolio Kami
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>
