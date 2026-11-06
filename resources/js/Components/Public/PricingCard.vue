<script setup lang="ts">
export interface PackageItem {
    id?: number;
    name: string;
    price: number | null;
    price_note?: string;
    features: string[];
    is_highlighted?: boolean;
}

defineProps<{
    pkg: PackageItem;
}>();

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
            'relative rounded-3xl p-8 flex flex-col justify-between transition-all duration-300',
            pkg.is_highlighted
                ? 'bg-neutral-900 text-white dark:bg-neutral-900 ring-2 ring-brand-500 shadow-2xl shadow-brand-500/20 lg:-translate-y-2'
                : 'bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-xl',
        ]"
    >
        <!-- Highlighted Badge -->
        <div
            v-if="pkg.is_highlighted"
            class="absolute -top-4 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-brand-600 text-white text-xs font-bold uppercase tracking-wider shadow-md"
        >
            Paling Populer & Hemat
        </div>

        <div>
            <!-- Header -->
            <div class="mb-6">
                <h3
                    :class="[
                        'text-xl font-bold mb-2',
                        pkg.is_highlighted ? 'text-white' : 'text-neutral-900 dark:text-white',
                    ]"
                >
                    {{ pkg.name }}
                </h3>
                <p
                    :class="[
                        'text-xs',
                        pkg.is_highlighted ? 'text-neutral-400' : 'text-neutral-500 dark:text-neutral-400',
                    ]"
                >
                    {{ pkg.price_note || 'Investasi terbaik pengembangan bisnis Anda' }}
                </p>
            </div>

            <!-- Price -->
            <div class="mb-8 pb-6 border-b border-neutral-200/60 dark:border-neutral-800">
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
                <span
                    :class="[
                        'text-xs font-medium',
                        pkg.is_highlighted ? 'text-neutral-400' : 'text-neutral-500',
                    ]"
                >
                    * Pembayaran bertahap DP & pelunasan
                </span>
            </div>

            <!-- Feature list -->
            <ul class="space-y-3.5 mb-8">
                <li
                    v-for="(feat, fIdx) in pkg.features"
                    :key="fIdx"
                    class="flex items-start gap-3 text-sm"
                >
                    <svg
                        class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5"
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

        <!-- Action Button -->
        <a
            href="#kontak"
            :class="[
                'w-full py-3.5 px-4 rounded-xl font-bold text-center text-sm transition-all duration-200 shadow-md block',
                pkg.is_highlighted
                    ? 'bg-brand-600 hover:bg-brand-700 text-white shadow-brand-600/30 hover:scale-102'
                    : 'bg-neutral-100 hover:bg-neutral-200 dark:bg-neutral-800 dark:hover:bg-neutral-700 text-neutral-900 dark:text-white',
            ]"
        >
            Pilih Paket Ini
        </a>
    </div>
</template>
