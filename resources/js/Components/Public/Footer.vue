<script setup lang="ts">
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import SwiftCodeLogo from '../SwiftCodeLogo.vue';

const page = usePage();
const currentYear = new Date().getFullYear();

const siteSettings = computed(() => ((page.props as any).siteSettings || (page.props as any).settings || {}) as Record<string, string>);

const rawWa = computed(() => siteSettings.value.whatsapp || '62895325852575');
const cleanWa = computed(() => rawWa.value.replace(/[^0-9]/g, ''));
const formattedWa = computed(() => {
    const num = cleanWa.value;
    if (num.startsWith('62') && num.length >= 11) {
        return `+62 ${num.slice(2, 5)}-${num.slice(5, 9)}-${num.slice(9)}`;
    }
    return `+${num}`;
});
const email = computed(() => siteSettings.value.email || 'halo@swiftcode.id');
const address = computed(() => siteSettings.value.address || 'Bandar Lampung, Lampung, Indonesia');
const instagram = computed(() => siteSettings.value.instagram || 'https://instagram.com/swiftcode.lpg');
const waUrl = computed(() => `https://wa.me/${cleanWa.value}`);

const navLinks = [
    { name: 'Beranda', href: '/#hero' },
    { name: 'Layanan Kami', href: '/layanan' },
    { name: 'Portofolio Proyek', href: '/portofolio' },
    { name: 'Paket Investasi', href: '/harga' },
    { name: 'Keunggulan Kami', href: '/#keunggulan' },
    { name: 'Testimoni Klien', href: '/#testimoni' },
    { name: 'Tanya Jawab (FAQ)', href: '/#faq' },
    { name: 'Artikel & Panduan', href: '/artikel' },
    { name: 'Hubungi Kami', href: '/kontak' },
];

const servicesList = [
    { name: 'Landing Page Konversi Tinggi', href: '/#layanan' },
    { name: 'Website Company Profile', href: '/#layanan' },
    { name: 'Website Sekolah & Pesantren', href: '/#layanan' },
    { name: 'Toko Online (E-Commerce)', href: '/#layanan' },
    { name: 'Sistem Informasi Kustom', href: '/#layanan' },
    { name: 'Redesign & Optimasi SEO', href: '/#layanan' },
];
</script>

<template>
    <footer class="bg-neutral-950 text-neutral-300 pt-16 sm:pt-20 pb-12 border-t border-neutral-800/80 relative overflow-hidden">
        <!-- Ambient subtle glow behind footer -->
        <div class="pointer-events-none absolute -top-40 left-1/2 -translate-x-1/2 w-[600px] h-60 bg-brand-600/10 blur-[120px] rounded-full"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Main Grid: 4 Kolom Proporsional (12 cols) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 pb-14 border-b border-neutral-800/80">
                <!-- Col 1: Brand & Bio (4 cols) -->
                <div class="lg:col-span-4 space-y-5">
                    <SwiftCodeLogo size="md" :inverted="true" />

                    <p class="text-sm text-neutral-400 leading-relaxed max-w-sm">
                        Jasa pembuatan website profesional di Lampung. Kami membantu UMKM, instansi sekolah, dan korporat memiliki kehadiran digital yang cepat, berkelas, dan terbukti menghasilkan pelanggan nyata.
                    </p>

                    <!-- Social Contact Buttons -->
                    <div class="pt-2 flex flex-wrap items-center gap-2.5">
                        <a
                            :href="waUrl"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-neutral-900 hover:bg-emerald-600 text-neutral-300 hover:text-white border border-neutral-800 text-xs font-semibold transition-all duration-200"
                            aria-label="WhatsApp Swift Code Lampung"
                        >
                            <svg class="w-4 h-4 fill-current text-emerald-400 hover:text-white" viewBox="0 0 24 24">
                                <path d="M12.031 2C6.495 2 2 6.494 2 12.031c0 1.84.498 3.567 1.365 5.064L2 22l5.053-1.326a9.98 9.98 0 004.978 1.357h.005c5.534 0 10.029-4.494 10.029-10.031A10.015 10.015 0 0012.031 2zm0 18.232c-1.57 0-3.102-.42-4.437-1.213l-.318-.189-3.298.865.881-3.214-.207-.33a8.212 8.212 0 01-1.258-4.321c0-4.542 3.696-8.237 8.243-8.237 2.203 0 4.273.858 5.829 2.416a8.196 8.196 0 012.412 5.825c0 4.544-3.696 8.239-8.245 8.239zm4.518-6.177c-.248-.124-1.465-.723-1.692-.806-.228-.083-.394-.124-.56.124-.166.248-.642.806-.787.972-.145.166-.29.186-.538.062-.248-.124-1.047-.386-1.995-1.231-.738-.658-1.236-1.472-1.381-1.72-.145-.248-.016-.382.108-.506.112-.111.248-.29.373-.435.124-.145.166-.248.248-.415.083-.166.042-.311-.021-.435-.062-.124-.56-1.35-.767-1.849-.202-.486-.407-.42-.56-.428l-.477-.008c-.166 0-.435.062-.663.311-.228.248-.871.851-.871 2.075s.892 2.406 1.016 2.572c.124.166 1.755 2.68 4.252 3.758.594.257 1.058.41 1.42.525.597.19 1.14.163 1.57.099.479-.071 1.465-.6 1.672-1.179.207-.58.207-1.077.145-1.179-.062-.102-.228-.166-.476-.29z"/>
                            </svg>
                            <span>WhatsApp</span>
                        </a>

                        <a
                            :href="instagram"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-neutral-900 hover:bg-gradient-to-tr hover:from-amber-600 hover:to-rose-600 text-neutral-300 hover:text-white border border-neutral-800 text-xs font-semibold transition-all duration-200"
                            aria-label="Instagram Swift Code Lampung"
                        >
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                            <span>Instagram</span>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Navigasi Cepat (2 cols) -->
                <div class="lg:col-span-2 space-y-4">
                    <h3 class="text-xs font-bold text-white uppercase tracking-widest">Navigasi</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li v-for="link in navLinks" :key="link.name">
                            <a :href="link.href" class="text-neutral-400 hover:text-white transition-colors duration-150 inline-block py-0.5">
                                {{ link.name }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Col 3: Solusi Layanan (3 cols) -->
                <div class="lg:col-span-3 space-y-4">
                    <h3 class="text-xs font-bold text-white uppercase tracking-widest">Layanan Kami</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li v-for="srv in servicesList" :key="srv.name">
                            <a :href="srv.href" class="text-neutral-400 hover:text-white transition-colors duration-150 inline-block py-0.5">
                                {{ srv.name }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Col 4: Kontak & Operasional (3 cols) -->
                <div class="lg:col-span-3 space-y-4">
                    <h3 class="text-xs font-bold text-white uppercase tracking-widest">Hubungi Kami</h3>
                    <ul class="space-y-3.5 text-sm">
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-neutral-900 border border-neutral-800 flex items-center justify-center shrink-0 mt-0.5 text-brand-500">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-neutral-500 font-medium">Lokasi Kantor</p>
                                <span class="text-neutral-300">{{ address }}</span>
                            </div>
                        </li>

                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-neutral-900 border border-neutral-800 flex items-center justify-center shrink-0 mt-0.5 text-emerald-500">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-neutral-500 font-medium">WhatsApp / Telepon</p>
                                <a :href="waUrl" target="_blank" class="text-neutral-300 hover:text-white font-semibold transition-colors">
                                    {{ formattedWa }}
                                </a>
                            </div>
                        </li>

                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-neutral-900 border border-neutral-800 flex items-center justify-center shrink-0 mt-0.5 text-brand-500">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-neutral-500 font-medium">Email Resmi</p>
                                <a :href="`mailto:${email}`" class="text-neutral-300 hover:text-white transition-colors">
                                    {{ email }}
                                </a>
                            </div>
                        </li>

                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-neutral-900 border border-neutral-800 flex items-center justify-center shrink-0 mt-0.5 text-amber-500">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-neutral-500 font-medium">Jam Operasional</p>
                                <span class="text-neutral-300">Setiap Hari: 08.00 - 21.00 WIB</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-neutral-500 gap-4">
                <p>© {{ currentYear }} Swift Code Lampung. Seluruh hak cipta dilindungi.</p>
                <div class="flex flex-wrap items-center gap-4 text-neutral-400">
                    <span class="inline-flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Status Server & Layanan: Normal
                    </span>
                    <span>•</span>
                    <span>Your Business, Our Digital Solution.</span>
                </div>
            </div>
        </div>
    </footer>
</template>
