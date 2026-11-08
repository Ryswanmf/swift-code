<script setup lang="ts">
import { computed } from 'vue';

export interface Partner {
    id?: number;
    name: string;
    category?: string;
    color?: string;
    icon?: string;
    logo_image?: string | null;
}

const props = defineProps<{
    partners?: Partner[];
}>();

const defaultPartners: Partner[] = [
    {
        name: 'Dinas Pendidikan Lampung',
        category: 'Instansi Pemerintah',
        color: 'from-blue-600 to-indigo-700',
        icon: 'education',
    },
    {
        name: 'PT Sinar Agro Lampung',
        category: 'Agrobisnis & Ekspor',
        color: 'from-emerald-600 to-teal-700',
        icon: 'leaf',
    },
    {
        name: 'RS Medika Bunda Lampung',
        category: 'Layanan Kesehatan',
        color: 'from-rose-600 to-pink-700',
        icon: 'clinic',
    },
    {
        name: 'Kopi Robusta Lampung Barat',
        category: 'Produsen & Roastery',
        color: 'from-amber-600 to-orange-700',
        icon: 'coffee',
    },
    {
        name: 'SMA Negeri Unggulan Lampung',
        category: 'Institusi Sekolah',
        color: 'from-cyan-600 to-blue-700',
        icon: 'education',
    },
    {
        name: 'PT Mandiri Logistik Sumatera',
        category: 'Transportasi & Logistik',
        color: 'from-neutral-700 to-neutral-900',
        icon: 'truck',
    },
    {
        name: 'Bumi Ruwa Jurai Tour',
        category: 'Travel & Pariwisata',
        color: 'from-purple-600 to-indigo-700',
        icon: 'travel',
    },
    {
        name: 'CV Tapis Mas Nusantara',
        category: 'Kerajinan UMKM',
        color: 'from-amber-500 to-brand-600',
        icon: 'shop',
    },
    {
        name: 'PT Lampung Digital Solusindo',
        category: 'Teknologi Informasi',
        color: 'from-brand-600 to-rose-700',
        icon: 'building',
    },
];

const activePartners = computed(() => (props.partners && props.partners.length > 0 ? props.partners : defaultPartners));
</script>

<template>
    <section class="py-8 sm:py-10 bg-gradient-to-r from-brand-800 via-brand-600 to-rose-600 relative overflow-hidden select-none shadow-inner">
        <!-- Ambient background highlights -->
        <div class="pointer-events-none absolute -top-16 -left-16 w-64 h-64 bg-white/10 rounded-full blur-2xl"></div>
        <div class="pointer-events-none absolute -bottom-16 -right-16 w-64 h-64 bg-black/15 rounded-full blur-2xl"></div>

        <!-- Section Subtitle / Header -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-5 text-center relative z-10">
            <p class="text-xs sm:text-sm font-extrabold tracking-widest uppercase text-white/95 drop-shadow-xs">
                Telah Bekerja Sama Dengan Berbagai Mitra, Instansi, & Perusahaan
            </p>
        </div>

        <!-- Running Marquee Viewport with Edge Fade Masks -->
        <div class="relative w-full overflow-hidden">
            <!-- Left Gradient Fade -->
            <div class="pointer-events-none absolute inset-y-0 left-0 w-16 sm:w-32 bg-gradient-to-r from-brand-800 to-transparent z-10"></div>
            <!-- Right Gradient Fade -->
            <div class="pointer-events-none absolute inset-y-0 right-0 w-16 sm:w-32 bg-gradient-to-l from-rose-600 to-transparent z-10"></div>

            <!-- Infinite Moving Track -->
            <div class="partner-marquee-track flex items-center gap-4 sm:gap-6 py-2">
                <!-- Duplicate array twice for smooth infinite loop -->
                <div
                    v-for="(partner, idx) in [...activePartners, ...activePartners]"
                    :key="`${partner.name}-${idx}`"
                    class="group flex items-center gap-3.5 px-4 sm:px-5 py-3 rounded-2xl bg-white shadow-md hover:shadow-xl border border-white/40 transition-all shrink-0 cursor-default hover:scale-102"
                >
                    <!-- Partner Logo Image (if uploaded) -->
                    <div
                        v-if="partner.logo_image"
                        class="w-10 h-10 rounded-xl bg-neutral-50 border border-neutral-100 flex items-center justify-center p-1 overflow-hidden shrink-0 group-hover:scale-105 transition-transform"
                    >
                        <img :src="partner.logo_image" :alt="partner.name" class="w-full h-full object-contain" loading="lazy" decoding="async" />
                    </div>

                    <!-- Partner Logo Badge (Icon SVG fallback) -->
                    <div
                        v-else
                        :class="partner.color || 'from-brand-600 to-rose-600'"
                        class="w-10 h-10 rounded-xl bg-gradient-to-br flex items-center justify-center text-white shadow-xs shrink-0 group-hover:scale-105 transition-transform"
                    >
                        <!-- Education -->
                        <svg v-if="partner.icon === 'education'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5" />
                        </svg>
                        <!-- Leaf / Agro -->
                        <svg v-else-if="partner.icon === 'leaf'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21c2-5 5-8 10-9m-5 9c5-2 8-5 9-10M9 3a9.96 9.96 0 017 3c2.5 2.5 3 6.5 2 9-2.5 1-6.5.5-9-2a9.96 9.96 0 01-3-7c0-1 .5-2 1-3z" />
                        </svg>
                        <!-- Clinic / Health -->
                        <svg v-else-if="partner.icon === 'clinic'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                        <!-- Coffee -->
                        <svg v-else-if="partner.icon === 'coffee'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 8h1a4 4 0 010 8h-1M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8zM6 1v3M10 1v3M14 1v3" />
                        </svg>
                        <!-- Truck / Logistics -->
                        <svg v-else-if="partner.icon === 'truck'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                        </svg>
                        <!-- Travel -->
                        <svg v-else-if="partner.icon === 'travel'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <!-- Shop -->
                        <svg v-else-if="partner.icon === 'shop'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <!-- Corporate Building -->
                        <svg v-else class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>

                    <!-- Partner Typography -->
                    <div class="flex flex-col">
                        <span class="text-xs sm:text-sm font-bold text-neutral-900 group-hover:text-brand-600 transition-colors whitespace-nowrap">
                            {{ partner.name }}
                        </span>
                        <span class="text-[10px] font-semibold text-neutral-500 uppercase tracking-wider">
                            {{ partner.category }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.partner-marquee-track {
    display: flex;
    width: max-content;
    animation: partnerMarquee 38s linear infinite;
}

.partner-marquee-track:hover {
    animation-play-state: paused;
}

@keyframes partnerMarquee {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}
</style>
