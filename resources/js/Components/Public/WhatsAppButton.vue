<script setup lang="ts">
import { computed } from 'vue';

const props = withDefaults(
    defineProps<{
        phone?: string;
        message?: string;
    }>(),
    {
        phone: '62895325852575',
        message: 'Halo Swift Code Lampung, saya ingin berkonsultasi mengenai pembuatan website.',
    },
);

const whatsappUrl = computed(() => {
    const cleanPhone = props.phone.replace(/[^0-9]/g, '');
    const encodedMessage = encodeURIComponent(props.message);
    return `https://wa.me/${cleanPhone}?text=${encodedMessage}`;
});
</script>

<template>
    <aside aria-label="Bantuan WhatsApp" class="fixed bottom-5 right-5 sm:bottom-6 sm:right-6 z-40">
        <a
            :href="whatsappUrl"
            target="_blank"
            rel="noopener noreferrer"
            class="group relative flex items-center gap-3 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white p-2.5 sm:py-2.5 sm:px-4 rounded-full shadow-lg shadow-emerald-700/30 hover:shadow-xl hover:shadow-emerald-700/40 transition-all duration-300 hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-emerald-400/40"
            aria-label="Konsultasi cepat melalui WhatsApp"
        >
            <!-- WhatsApp SVG Icon & pulsing status dot -->
            <div class="relative flex items-center justify-center shrink-0">
                <div class="w-10 h-10 rounded-full bg-white/15 flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 fill-current text-white" viewBox="0 0 24 24">
                        <path
                            d="M12.031 2C6.495 2 2 6.494 2 12.031c0 1.84.498 3.567 1.365 5.064L2 22l5.053-1.326a9.98 9.98 0 004.978 1.357h.005c5.534 0 10.029-4.494 10.029-10.031A10.015 10.015 0 0012.031 2zm0 18.232c-1.57 0-3.102-.42-4.437-1.213l-.318-.189-3.298.865.881-3.214-.207-.33a8.212 8.212 0 01-1.258-4.321c0-4.542 3.696-8.237 8.243-8.237 2.203 0 4.273.858 5.829 2.416a8.196 8.196 0 012.412 5.825c0 4.544-3.696 8.239-8.245 8.239zm4.518-6.177c-.248-.124-1.465-.723-1.692-.806-.228-.083-.394-.124-.56.124-.166.248-.642.806-.787.972-.145.166-.29.186-.538.062-.248-.124-1.047-.386-1.995-1.231-.738-.658-1.236-1.472-1.381-1.72-.145-.248-.016-.382.108-.506.112-.111.248-.29.373-.435.124-.145.166-.248.248-.415.083-.166.042-.311-.021-.435-.062-.124-.56-1.35-.767-1.849-.202-.486-.407-.42-.56-.428l-.477-.008c-.166 0-.435.062-.663.311-.228.248-.871.851-.871 2.075s.892 2.406 1.016 2.572c.124.166 1.755 2.68 4.252 3.758.594.257 1.058.41 1.42.525.597.19 1.14.163 1.57.099.479-.071 1.465-.6 1.672-1.179.207-.58.207-1.077.145-1.179-.062-.102-.228-.166-.476-.29z"
                        />
                    </svg>
                </div>
                <!-- Green pulsing active dot -->
                <span class="absolute -top-0.5 -right-0.5 flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-300 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-300 border-2 border-emerald-600"></span>
                </span>
            </div>

            <!-- Text Details (visible on sm screen and above) -->
            <div class="hidden sm:flex flex-col text-left pr-1 leading-tight">
                <span class="text-xs font-bold tracking-tight text-white">Konsultasi WhatsApp</span>
                <span class="text-[10px] text-emerald-100 font-medium">Online &bull; Respon Cepat</span>
            </div>
        </a>
    </aside>
</template>
