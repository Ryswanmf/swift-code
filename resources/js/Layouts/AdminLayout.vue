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
    { name: 'Dashboard', href: '/admin', id: 'dashboard' },
    { name: 'Kontak & Leads', href: '/admin/leads', id: 'leads' },
    { name: 'Portofolio Proyek', href: '/admin/projects', id: 'projects' },
    { name: 'Artikel & Blog', href: '/admin/articles', id: 'articles' },
    { name: 'Layanan', href: '/admin/services', id: 'services' },
    { name: 'Paket Harga', href: '/admin/packages', id: 'packages' },
    { name: 'Testimoni', href: '/admin/testimonials', id: 'testimonials' },
    { name: 'FAQ', href: '/admin/faqs', id: 'faqs' },
    { name: 'Pengaturan Situs', href: '/admin/settings', id: 'settings' },
];

const isCurrentUrl = (url: string) => {
    if (url === '/admin') {
        return page.url === '/admin' || page.url === '/admin/';
    }
    if (url === '/admin/leads') {
        return page.url.startsWith('/admin/leads') || page.url.startsWith('/admin/kontak');
    }
    if (url === '/admin/articles') {
        return page.url.startsWith('/admin/articles') || page.url.startsWith('/admin/artikel');
    }
    if (url === '/admin/packages') {
        return page.url.startsWith('/admin/packages') || page.url.startsWith('/admin/paket');
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
                    <!-- Clean SVG Icons -->
                    <svg v-if="item.id === 'dashboard'" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <svg v-else-if="item.id === 'leads'" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <svg v-else-if="item.id === 'projects'" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <svg v-else-if="item.id === 'articles'" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <svg v-else-if="item.id === 'services'" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <svg v-else-if="item.id === 'packages'" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <svg v-else-if="item.id === 'testimonials'" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <svg v-else-if="item.id === 'faqs'" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <svg v-else-if="item.id === 'settings'" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

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
                        <svg class="w-4 h-4 shrink-0 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
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
                    <div class="flex items-center gap-3 pl-3">
                        <div class="hidden sm:block text-right">
                            <p class="text-xs font-bold text-neutral-900 dark:text-white">{{ $page.props.auth?.user?.name || 'Admin' }}</p>
                            <span class="text-[10px] font-semibold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">Online</span>
                        </div>
                        <Link
                            href="/logout"
                            method="post"
                            as="button"
                            class="px-3 py-1.5 text-xs font-semibold text-rose-600 hover:text-white hover:bg-rose-600 border border-rose-200 dark:border-rose-900/50 rounded-lg transition-colors cursor-pointer"
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
                        <button @click="isSidebarOpen = false" class="p-1.5 text-neutral-500 hover:text-neutral-800 dark:hover:text-white">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
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
                            <span>{{ item.name }}</span>
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Flash Message Banner -->
            <div v-if="flashSuccess" class="bg-emerald-600 text-white px-6 py-3 text-sm font-semibold flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ flashSuccess }}</span>
                </div>
            </div>

            <!-- Page Body -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto">
                <slot />
            </main>
        </div>
    </div>
</template>
