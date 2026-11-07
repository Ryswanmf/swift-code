<script setup lang="ts">
export interface PackageItem {
    id?: number;
    name: string;
    price: number | null;
    price_note?: string;
    features: string[];
    is_highlighted?: boolean;
}

const props = withDefaults(
    defineProps<{
        pkg: PackageItem;
        actionHref?: string;
        actionText?: string;
        isExternal?: boolean;
    }>(),
    {
        actionHref: '#kontak',
        actionText: 'Konsultasikan Paket Ini',
        isExternal: false,
    }
);

const formatRupiah = (val: number | null) => {
    if (val === null || val === undefined) return 'Hubungi Kami';
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0,
    }).format(val);
};
</script>

<template>
    <div
        :class="[
            'relative rounded-2xl p-7 sm:p-8 flex flex-col justify-between transition-all duration-300',
            pkg.is_highlighted
                ? 'bg-neutral-950 text-white ring-2 ring-brand-600 shadow-xl shadow-brand-600/15 lg:-translate-y-2'
                : 'bg-white dark:bg-neutral-900 border border-neutral-200/90 dark:border-neutral-800 shadow-xs hover:shadow-lg',
        ]"
    >
        <!-- Highlighted Badge: Restrained & Informative -->
        <div
            v-if="pkg.is_highlighted"
            class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-3.5 py-1 rounded-full bg-brand-600 text-white text-[11px] font-extrabold uppercase tracking-wider shadow-md"
        >
            Paling Banyak Dipilih
        </div>

        <div>
            <!-- Header -->
            <div class="mb-6">
                <h3
                    :class="[
                        'text-xl font-extrabold mb-1.5',
                        pkg.is_highlighted ? 'text-white' : 'text-neutral-900 dark:text-white',
                    ]"
                >
                    {{ pkg.name }}
                </h3>
                <p
                    :class="[
                        'text-xs leading-relaxed',
                        pkg.is_highlighted ? 'text-neutral-400' : 'text-neutral-500 dark:text-neutral-400',
                    ]"
                >
                    {{ pkg.price_note || 'Solusi terarah untuk pertumbuhan bisnis dan kredibilitas brand Anda.' }}
                </p>
            </div>

            <!-- Price -->
            <div class="mb-6 pb-6 border-b border-neutral-200/80 dark:border-neutral-800">
                <div class="flex items-baseline gap-1">
                    <span
                        :class="[
                            'text-3xl sm:text-4xl font-extrabold tracking-tight',
                            pkg.is_highlighted ? 'text-white' : 'text-neutral-900 dark:text-white',
                        ]"
                    >
                        {{ formatRupiah(pkg.price) }}
                    </span>
                </div>
                <p
                    :class="[
                        'text-[11px] mt-1.5 flex items-center gap-1',
                        pkg.is_highlighted ? 'text-neutral-400' : 'text-neutral-500 dark:text-neutral-400',
                    ]"
                >
                    <span class="text-emerald-500 font-bold">✓</span>
                    <span>Biaya transparan • Termasuk setup domain &amp; hosting</span>
                </p>
            </div>

            <!-- Feature list with clear checkmarks -->
            <div class="space-y-3 mb-8">
                <p
                    :class="[
                        'text-xs font-bold uppercase tracking-wider',
                        pkg.is_highlighted ? 'text-neutral-300' : 'text-neutral-700 dark:text-neutral-300',
                    ]"
                >
                    Fitur &amp; Spesifikasi:
                </p>
                <ul class="space-y-2.5">
                    <li
                        v-for="(feat, fIdx) in pkg.features"
                        :key="fIdx"
                        class="flex items-start gap-2.5 text-xs sm:text-sm"
                    >
                        <svg
                            class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        <span
                            :class="[
                                pkg.is_highlighted ? 'text-neutral-200' : 'text-neutral-700 dark:text-neutral-300',
                            ]"
                        >
                            {{ feat }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Action Button -->
        <a
            :href="actionHref"
            :target="isExternal ? '_blank' : undefined"
            :rel="isExternal ? 'noopener noreferrer' : undefined"
            :class="[
                'w-full py-3.5 px-4 rounded-xl font-bold text-center text-xs sm:text-sm transition-all duration-200 shadow-sm block cursor-pointer',
                pkg.is_highlighted
                    ? 'bg-brand-600 hover:bg-brand-700 active:bg-brand-800 text-white shadow-brand-600/30 hover:-translate-y-0.5'
                    : 'bg-neutral-100 hover:bg-neutral-200 dark:bg-neutral-800 dark:hover:bg-neutral-700 text-neutral-900 dark:text-white',
            ]"
        >
            {{ actionText }}
        </a>
    </div>
</template>
