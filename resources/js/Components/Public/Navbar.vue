<script setup lang="ts">
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import SwiftCodeLogo from '../SwiftCodeLogo.vue';

const isScrolled = ref(false);
const isMobileMenuOpen = ref(false);
const page = usePage();
const siteSettings = computed(() => ((page.props as any).siteSettings || {}) as Record<string, string>);
const siteLogo = computed(() => siteSettings.value.site_logo || null);

const isHomePage = computed(() => page.url === '/' || page.url.startsWith('/#'));

const navLinks = computed(() => [
    { name: 'Beranda', href: isHomePage.value ? '#hero' : '/', isRoute: !isHomePage.value },
    { name: 'Layanan', href: '/layanan', isRoute: true },
    { name: 'Portofolio', href: '/portofolio', isRoute: true },
    { name: 'Paket Harga', href: '/harga', isRoute: true },
    { name: 'Artikel', href: '/artikel', isRoute: true },
    { name: 'Kontak', href: '/kontak', isRoute: true },
]);

const handleScroll = () => {
    isScrolled.value = window.scrollY > 20;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});

const closeMobileMenu = () => {
    isMobileMenuOpen.value = false;
};
</script>

<template>
    <header
        :class="[
            'fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-white/95 backdrop-blur-md border-b border-neutral-200/80 shadow-xs',
            isScrolled ? 'py-3.5' : 'py-4',
        ]"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <!-- Brand Logo -->
                <Link :href="isHomePage ? '#hero' : '/'" class="flex items-center gap-2">
                    <div v-if="siteLogo" class="h-9 flex items-center">
                        <img :src="siteLogo" alt="Logo" class="max-h-9 w-auto object-contain" />
                    </div>
                    <SwiftCodeLogo v-else size="md" />
                </Link>

                <!-- Desktop Nav -->
                <nav class="hidden lg:flex items-center gap-1 xl:gap-2">
                    <template v-for="link in navLinks" :key="link.name">
                        <Link
                            v-if="link.isRoute"
                            :href="link.href"
                            class="px-3 py-2 text-sm font-medium text-neutral-700 hover:text-brand-600 rounded-lg transition-colors"
                        >
                            {{ link.name }}
                        </Link>
                        <a
                            v-else
                            :href="link.href"
                            class="px-3 py-2 text-sm font-medium text-neutral-700 hover:text-brand-600 rounded-lg transition-colors"
                        >
                            {{ link.name }}
                        </a>
                    </template>
                </nav>

                <!-- Actions: CTA -->
                <div class="hidden lg:flex items-center gap-3">
                    <!-- CTA Button -->
                    <a
                        :href="isHomePage ? '#kontak' : '/#kontak'"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-brand-600 hover:bg-brand-700 active:bg-brand-800 rounded-xl shadow-md shadow-brand-600/25 transition-all duration-200 hover:-translate-y-0.5"
                    >
                        <span>Konsultasi Sekarang</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="flex items-center gap-2 lg:hidden">
                    <button
                        type="button"
                        @click="isMobileMenuOpen = !isMobileMenuOpen"
                        class="p-2 text-neutral-700 hover:text-brand-600 rounded-lg hover:bg-neutral-100"
                        aria-label="Buka menu navigasi"
                    >
                        <svg v-if="!isMobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg v-else class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="opacity-0 -translate-y-2"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 -translate-y-2"
        >
            <div
                v-if="isMobileMenuOpen"
                class="lg:hidden mt-3 px-4 pt-2 pb-6 bg-white/95 backdrop-blur-xl border-b border-neutral-200 shadow-xl"
            >
                <div class="flex flex-col space-y-2">
                    <template v-for="link in navLinks" :key="link.name">
                        <Link
                            v-if="link.isRoute"
                            :href="link.href"
                            @click="closeMobileMenu"
                            class="px-4 py-2.5 text-base font-medium text-neutral-800 hover:text-brand-600 hover:bg-neutral-100 rounded-xl transition-colors"
                        >
                            {{ link.name }}
                        </Link>
                        <a
                            v-else
                            :href="link.href"
                            @click="closeMobileMenu"
                            class="px-4 py-2.5 text-base font-medium text-neutral-800 hover:text-brand-600 hover:bg-neutral-100 rounded-xl transition-colors"
                        >
                            {{ link.name }}
                        </a>
                    </template>

                    <div class="pt-4 border-t border-neutral-200">
                        <a
                            :href="isHomePage ? '#kontak' : '/#kontak'"
                            @click="closeMobileMenu"
                            class="w-full flex items-center justify-center gap-2 px-5 py-3 text-base font-semibold text-white bg-brand-600 hover:bg-brand-700 active:bg-brand-800 rounded-xl shadow-md transition-all"
                        >
                            <span>Konsultasi Sekarang</span>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </transition>
    </header>
</template>
