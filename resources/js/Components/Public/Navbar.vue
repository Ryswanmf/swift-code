<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import SwiftCodeLogo from '../SwiftCodeLogo.vue';
import { useDarkMode } from '../../composables/useDarkMode';

const { isDark, toggleDark } = useDarkMode();
const isScrolled = ref(false);
const isMobileMenuOpen = ref(false);

const navLinks = [
    { name: 'Beranda', href: '#hero' },
    { name: 'Layanan', href: '#layanan' },
    { name: 'Keunggulan', href: '#keunggulan' },
    { name: 'Portofolio', href: '#portofolio' },
    { name: 'Paket Harga', href: '#harga' },
    { name: 'Alur Kerja', href: '#alur' },
    { name: 'FAQ', href: '#faq' },
];

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
            'fixed top-0 left-0 right-0 z-50 transition-all duration-300',
            isScrolled
                ? 'bg-white/90 dark:bg-neutral-950/90 backdrop-blur-md shadow-sm border-b border-neutral-200/80 dark:border-neutral-800/80 py-3.5'
                : 'bg-transparent py-5',
        ]"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <!-- Brand Logo -->
                <a href="#hero" class="flex items-center gap-2">
                    <SwiftCodeLogo size="md" />
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden lg:flex items-center gap-1 xl:gap-2">
                    <a
                        v-for="link in navLinks"
                        :key="link.name"
                        :href="link.href"
                        class="px-3 py-2 text-sm font-medium text-neutral-700 dark:text-neutral-200 hover:text-brand-600 dark:hover:text-brand-400 rounded-lg transition-colors"
                    >
                        {{ link.name }}
                    </a>
                </nav>

                <!-- Actions: Theme toggle & CTA -->
                <div class="hidden lg:flex items-center gap-3">
                    <!-- Theme Toggle -->
                    <button
                        type="button"
                        @click="toggleDark"
                        class="p-2.5 text-neutral-600 dark:text-neutral-300 hover:text-brand-600 dark:hover:text-brand-400 rounded-xl hover:bg-neutral-100 dark:hover:bg-neutral-800/80 transition-colors"
                        :aria-label="isDark ? 'Ganti ke tema terang' : 'Ganti ke tema gelap'"
                    >
                        <!-- Sun Icon (when dark) -->
                        <svg
                            v-if="isDark"
                            class="w-5 h-5 text-amber-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <circle cx="12" cy="12" r="5" />
                            <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" />
                        </svg>
                        <!-- Moon Icon (when light) -->
                        <svg
                            v-else
                            class="w-5 h-5 text-neutral-700"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                        </svg>
                    </button>

                    <!-- CTA Button -->
                    <a
                        href="#kontak"
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
                        @click="toggleDark"
                        class="p-2 text-neutral-600 dark:text-neutral-300 rounded-lg hover:bg-neutral-100 dark:hover:bg-neutral-800"
                        aria-label="Toggle theme"
                    >
                        <svg v-if="isDark" class="w-5 h-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <circle cx="12" cy="12" r="5" stroke-width="2" />
                            <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" stroke-width="2" />
                        </svg>
                        <svg v-else class="w-5 h-5 text-neutral-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" stroke-width="2" />
                        </svg>
                    </button>

                    <button
                        type="button"
                        @click="isMobileMenuOpen = !isMobileMenuOpen"
                        class="p-2 text-neutral-700 dark:text-neutral-200 hover:text-brand-600 rounded-lg hover:bg-neutral-100 dark:hover:bg-neutral-800"
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
                class="lg:hidden mt-3 px-4 pt-2 pb-6 bg-white/95 dark:bg-neutral-900/95 backdrop-blur-xl border-b border-neutral-200 dark:border-neutral-800 shadow-xl"
            >
                <div class="flex flex-col space-y-2">
                    <a
                        v-for="link in navLinks"
                        :key="link.name"
                        :href="link.href"
                        @click="closeMobileMenu"
                        class="px-4 py-2.5 text-base font-medium text-neutral-800 dark:text-neutral-200 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-neutral-100 dark:hover:bg-neutral-800/60 rounded-xl transition-colors"
                    >
                        {{ link.name }}
                    </a>

                    <div class="pt-4 border-t border-neutral-200 dark:border-neutral-800">
                        <a
                            href="#kontak"
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
