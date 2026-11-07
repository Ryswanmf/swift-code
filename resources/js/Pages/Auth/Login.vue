<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import SwiftCodeLogo from '@/Components/SwiftCodeLogo.vue';

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const showPassword = ref(false);

const fillDefaultAdmin = () => {
    form.email = 'admin@swiftcode.id';
    form.password = 'password';
};

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <Head title="Login Administrator - Swift Code Lampung" />

    <div class="min-h-screen flex items-center justify-center bg-neutral-950 text-neutral-100 p-4 sm:p-6 relative overflow-hidden select-none">
        <!-- Ambient Glowing Background Lights -->
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-brand-600/25 rounded-full blur-[140px] pointer-events-none"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-rose-600/20 rounded-full blur-[140px] pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-brand-700/10 rounded-full blur-[160px] pointer-events-none"></div>

        <!-- Subtle Dot Grid Matrix -->
        <div
            class="absolute inset-0 bg-[radial-gradient(#ffffff08_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none opacity-50"
        ></div>

        <!-- Main Card Container -->
        <div class="max-w-md w-full relative z-10">
            <!-- Back to Home Floating Link -->
            <div class="mb-6 flex items-center justify-between">
                <Link
                    href="/"
                    class="inline-flex items-center gap-2 text-xs font-semibold text-neutral-400 hover:text-white transition-colors py-1 px-3 rounded-lg hover:bg-white/5 border border-transparent hover:border-neutral-800"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Website Utama</span>
                </Link>

                <div class="flex items-center gap-1.5 text-[11px] font-mono text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2.5 py-0.5 rounded-full">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Admin Panel v2.0</span>
                </div>
            </div>

            <div class="rounded-3xl bg-neutral-900/90 backdrop-blur-2xl border border-neutral-800/90 shadow-2xl p-7 sm:p-9">
                <!-- Branding & Header -->
                <div class="text-center space-y-3 mb-8">
                    <div class="inline-flex justify-center mb-1">
                        <Link href="/">
                            <SwiftCodeLogo size="lg" :showText="true" :inverted="true" />
                        </Link>
                    </div>

                    <div class="pt-2">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-500/10 border border-brand-500/25 text-brand-400 text-xs font-semibold mb-2">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <span>Portal Khusus Administrator</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                            Selamat Datang
                        </h1>
                        <p class="text-xs sm:text-sm text-neutral-400 mt-1 max-w-sm mx-auto leading-relaxed">
                            Masuk untuk mengelola portofolio, layanan, harga paket, dan data leads klien.
                        </p>
                    </div>
                </div>

                <!-- Session Status Alert -->
                <div
                    v-if="status"
                    class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs sm:text-sm flex items-center gap-3"
                >
                    <svg class="w-5 h-5 shrink-0 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ status }}</span>
                </div>

                <!-- Form Login -->
                <form @submit.prevent="submit" class="space-y-5">
                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-neutral-300 uppercase tracking-wider mb-2">
                            Email Administrator
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-neutral-500">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="admin@swiftcode.id"
                                :class="[
                                    'w-full pl-11 pr-4 py-3 rounded-xl bg-neutral-950/80 border text-sm text-white placeholder-neutral-500 outline-none transition-all',
                                    form.errors.email
                                        ? 'border-rose-500 focus:ring-2 focus:ring-rose-500/20'
                                        : 'border-neutral-800 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20',
                                ]"
                            />
                        </div>
                        <p v-if="form.errors.email" class="mt-1.5 text-xs text-rose-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ form.errors.email }}</span>
                        </p>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-xs font-bold text-neutral-300 uppercase tracking-wider">
                                Kata Sandi
                            </label>
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-xs text-brand-400 hover:text-brand-300 transition-colors font-medium"
                            >
                                Lupa sandi?
                            </Link>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-neutral-500">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input
                                id="password"
                                v-model="form.password"
                                :type="showPassword ? 'text' : 'password'"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                                :class="[
                                    'w-full pl-11 pr-11 py-3 rounded-xl bg-neutral-950/80 border text-sm text-white placeholder-neutral-500 outline-none transition-all',
                                    form.errors.password
                                        ? 'border-rose-500 focus:ring-2 focus:ring-rose-500/20'
                                        : 'border-neutral-800 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20',
                                ]"
                            />
                            <!-- Toggle Visibility Button -->
                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-neutral-500 hover:text-neutral-300 transition-colors cursor-pointer"
                                :title="showPassword ? 'Sembunyikan sandi' : 'Tampilkan sandi'"
                            >
                                <svg v-if="!showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg v-else class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                        <p v-if="form.errors.password" class="mt-1.5 text-xs text-rose-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ form.errors.password }}</span>
                        </p>
                    </div>

                    <!-- Remember Me Option -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input
                                v-model="form.remember"
                                type="checkbox"
                                class="w-4 h-4 rounded bg-neutral-950 border-neutral-700 text-brand-600 focus:ring-brand-500 focus:ring-offset-neutral-900 cursor-pointer"
                            />
                            <span class="text-xs text-neutral-300 font-medium">Ingat saya di perangkat ini</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full py-3.5 px-6 rounded-xl font-bold text-white bg-brand-600 hover:bg-brand-700 active:bg-brand-800 shadow-lg shadow-brand-600/30 transition-all duration-200 flex items-center justify-center gap-2 hover:-translate-y-0.5 disabled:opacity-50 cursor-pointer"
                    >
                        <template v-if="form.processing">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Memverifikasi Akun...</span>
                        </template>
                        <template v-else>
                            <span>Masuk ke Panel Admin</span>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </template>
                    </button>
                </form>

                <!-- Dev Quick Fill Helper (Useful for local testing) -->
                <div class="mt-6 pt-5 border-t border-neutral-800/80 flex items-center justify-between text-[11px] text-neutral-400">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-neutral-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Akun admin default terpasang</span>
                    </span>
                    <button
                        type="button"
                        @click="fillDefaultAdmin"
                        class="text-brand-400 hover:text-brand-300 font-semibold underline underline-offset-2 transition-colors cursor-pointer"
                    >
                        Isi otomatis
                    </button>
                </div>
            </div>

            <!-- Security Footer Note -->
            <div class="mt-6 text-center text-xs text-neutral-500 flex items-center justify-center gap-2">
                <svg class="w-3.5 h-3.5 text-neutral-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <span>Dilindungi Enkripsi SSL 256-bit • Swift Code Lampung</span>
            </div>
        </div>
    </div>
</template>
