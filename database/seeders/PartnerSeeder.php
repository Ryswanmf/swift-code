<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name' => 'Dinas Pendidikan Lampung',
                'category' => 'Instansi Pemerintah',
                'color' => 'from-blue-600 to-indigo-700',
                'icon' => 'education',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'PT Sinar Agro Lampung',
                'category' => 'Agrobisnis & Ekspor',
                'color' => 'from-emerald-600 to-teal-700',
                'icon' => 'leaf',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'RS Medika Bunda Lampung',
                'category' => 'Layanan Kesehatan',
                'color' => 'from-rose-600 to-pink-700',
                'icon' => 'clinic',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Kopi Robusta Lampung Barat',
                'category' => 'Produsen & Roastery',
                'color' => 'from-amber-600 to-orange-700',
                'icon' => 'coffee',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'SMA Negeri Unggulan Lampung',
                'category' => 'Institusi Sekolah',
                'color' => 'from-cyan-600 to-blue-700',
                'icon' => 'education',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'PT Mandiri Logistik Sumatera',
                'category' => 'Transportasi & Logistik',
                'color' => 'from-neutral-700 to-neutral-900',
                'icon' => 'truck',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Bumi Ruwa Jurai Tour',
                'category' => 'Travel & Pariwisata',
                'color' => 'from-purple-600 to-indigo-700',
                'icon' => 'travel',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'CV Tapis Mas Nusantara',
                'category' => 'Kerajinan UMKM',
                'color' => 'from-amber-500 to-brand-600',
                'icon' => 'shop',
                'sort_order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::updateOrCreate(
                ['name' => $partner['name']],
                $partner
            );
        }
    }
}
