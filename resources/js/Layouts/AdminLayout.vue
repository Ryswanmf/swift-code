<script setup lang="ts">
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import SwiftCodeLogo from '../Components/SwiftCodeLogo.vue';

withDefaults(
    defineProps<{
        title?: string;
    }>(),
    {
        title: 'Panel Admin - Swift Code',
    },
);

const page = usePage();
const isSidebarOpen = ref(false);

const flashSuccess = computed(() => {
    return (page.props as any).flash?.success;
});

const navigation = [
    { name: 'Dashboard', href: '/admin', icon: '📊' },
    { name: 'Manajemen Leads', href: '/admin/leads', icon: '📬' },
    { name: 'Portofolio Proyek', href: '/admin/projects', icon: '💼' },
    { name: 'Layanan', href: '/admin/services', icon: '🚀' },
    { name: 'Paket Harga', href: '/admin/packages', icon: '🏷️' },
    { name: 'Testimoni', href: '/admin/testimonials', icon: '⭐' },
    { name: 'FAQ', href: '/admin/faqs', icon: '❓' },
    { name: 'Pengaturan Situs', href: '/admin/settings', icon: '⚙️' },
];

const isCurrentUrl = (url: string) => {
    if (url === '/admin') {
        return page.url === '/admin' || page.url === '/admin/';
    }
    return page.url.startsWith(url);
};
</script>

<template>
    <div class="min-h-screen bg-neutral-100 dark:bg-neutral-950 text-neutral-900 dark:text-neutral-100 flex transition-colors duration-200">
        <!-- Sidebar for Desktop -->
        <aside class="hidden lg:flex flex-col w-64 bg-white dark:bg-neutral-900 border-r border-neutral-200 dark:border-neutral-800 shrink-0">
            <!-- Sidebar Header -->
            <div class="h-16 flex items-center px-6 border-b border-neutral-200 dark:border-neutral-800">
                <Link href="/admin">
                    <SwiftCodeLogo size="sm" />
                </Link>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 py-6 px-4 space-y-1 overflow-y-auto">
                <div class="px-3 pb-2 text-[10px] font-bold text-neutral-400 uppercase tracking-widest">
                    Menu Utama
                </div>
                <Link
                    v-for="item in navigation"
                    :key="item.name"
                    :href="item.href"
                    :class="[
                        'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all',
                        isCurrentUrl(item.href)
                            ? 'bg-brand-600 text-white shadow-sm shadow-brand-600/30'
                            : 'text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white hover:bg-neutral-100 dark:hover:bg-neutral-800/60',
                    ]"
                >
                    <span class="text-base">{{ item.icon }}</span>
                    <span>{{ item.name }}</span>
                </Link>
            </div>

            <!-- Sidebar Footer: View Public Website -->
            <div class="p-4 border-t border-neutral-200 dark:border-neutral-800">
                <a
                    href="/"
                    target="_blank"
                    class="flex items-center justify-between px-3 py-2 text-xs font-semibold text-neutral-600 dark:text-neutral-400 hover:text-brand-600 dark:hover:text-brand-400 rounded-lg hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors"
                >
                    <span class="flex items-center gap-2">
                        <span>🌐</span>
                        <span>Lihat Website Publik</span>
                    </span>
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Topbar -->
            <header class="h-16 bg-white dark:bg-neutral-900 border-b border-neutral-200 dark:border-neutral-800 flex items-center justify-between px-4 sm:px-6 lg:px-8">
                <!-- Left: Hamburger (mobile) -->
                <div class="flex items-center gap-3">
                    <button
                        type="button"
                        @click="isSidebarOpen = !isSidebarOpen"
                        class="lg:hidden p-2 text-neutral-600 dark:text-neutral-300 rounded-lg hover:bg-neutral-100 dark:hover:bg-neutral-800"
                        aria-label="Toggle menu"
                    >
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-base sm:text-lg font-bold text-neutral-900 dark:text-white truncate">
                        {{ title }}
                    </h1>
                </div>

                <!-- Right: Profile & Logout -->
                <div class="flex items-center gap-3">
                    <!-- User Account / Logout -->
                    <div class="flex items-center gap-3 pl-3">
                        <div class="hidden sm:block text-right">
                            <p class="text-xs font-bold text-neutral-900 dark:text-white">{{ $page.props.auth?.user?.name || 'Admin' }}</p>
                            <span class="text-[10px] font-semibold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">Online</span>
                        </div>

                        <Link
                            href="/logout"
                            method="post"
                            as="button"
                            class="px-3 py-1.5 text-xs font-semibold text-rose-600 hover:text-white hover:bg-rose-600 border border-rose-200 dark:border-rose-900/50 rounded-lg transition-colors"
                        >
                            Keluar
                        </Link>
                    </div>
                </div>
            </header>

            <!-- Mobile Drawer Backdrop & Menu -->
            <div
                v-if="isSidebarOpen"
                class="fixed inset-0 z-40 lg:hidden flex"
            >
                <div @click="isSidebarOpen = false" class="fixed inset-0 bg-neutral-900/50 backdrop-blur-xs"></div>
                <div class="relative w-64 bg-white dark:bg-neutral-900 flex-1 flex flex-col max-w-xs z-50">
                    <div class="h-16 flex items-center justify-between px-6 border-b border-neutral-200 dark:border-neutral-800">
                        <SwiftCodeLogo size="sm" />
                        <button @click="isSidebarOpen = false" class="p-1 text-neutral-500 hover:text-neutral-800">
                            ✕
                        </button>
                    </div>
                    <div class="flex-1 py-4 px-4 space-y-1 overflow-y-auto">
                        <Link
                            v-for="item in navigation"
                            :key="item.name"
                            :href="item.href"
                            @click="isSidebarOpen = false"
                            :class="[
                                'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all',
                                isCurrentUrl(item.href)
                                    ? 'bg-brand-600 text-white'
                                    : 'text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800',
                            ]"
                        >
                            <span>{{ item.icon }}</span>
                            <span>{{ item.name }}</span>
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Flash Message Banner -->
            <div v-if="flashSuccess" class="bg-emerald-500 text-white px-6 py-3 text-sm font-semibold flex items-center justify-between">
                <span>✓ {{ flashSuccess }}</span>
            </div>

            <!-- Page Body -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto">
                <slot />
            </main>
        </div>
    </div>
</template>
