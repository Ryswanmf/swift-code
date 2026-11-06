<script setup lang="ts">
import Navbar from '../Components/Public/Navbar.vue';
import Footer from '../Components/Public/Footer.vue';
import WhatsAppButton from '../Components/Public/WhatsAppButton.vue';

withDefaults(
    defineProps<{
        title?: string;
    }>(),
    {
        title: 'Swift Code Lampung - Jasa Pembuatan Website Profesional & Cepat',
    },
);
</script>

<template>
    <div class="min-h-screen flex flex-col bg-white dark:bg-neutral-950 text-neutral-900 dark:text-neutral-100 transition-colors duration-200 antialiased selection:bg-brand-600 selection:text-white">
        <!-- Main Navbar -->
        <Navbar />

        <!-- Page Content -->
        <main class="flex-grow">
            <slot />
        </main>

        <!-- Floating WhatsApp Assistant -->
        <WhatsAppButton />

        <!-- Footer -->
        <Footer />
    </div>
</template>
