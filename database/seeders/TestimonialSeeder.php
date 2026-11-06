<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Bambang Irawan',
                'role' => 'Direktur Operasional',
                'company' => 'CV Dinamika Konstruksi Lampung',
                'quote' => 'Setelah dibuatkan website oleh Swift Code, klien tender kami lebih percaya. Tampilannya rapi, cepat dibuka, dan pelayanannya sangat sabar membantu.',
                'rating' => 5,
                'avatar' => null,
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Ustadz Ahmad Fauzi',
                'role' => 'Kepala Madrasah',
                'company' => 'MA Darun Najah',
                'quote' => 'Pendaftaran PPDB tahun ini naik signifikan karena calon wali murid bisa lihat profil sekolah dan formulir langsung dari HP. Sangat direkomendasikan!',
                'rating' => 5,
                'avatar' => null,
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Dian Permatasari',
                'role' => 'Owner',
                'company' => 'Souvnela Craft Lampung',
                'quote' => 'Suka banget sama desainnya yang clean dan elegan. Sekarang kalau ada pembeli tanya katalog tinggal kasih link website. Pesanan masuk rapi ke WhatsApp.',
                'rating' => 5,
                'avatar' => null,
                'is_published' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(
                ['name' => $t['name'], 'company' => $t['company']],
                $t
            );
        }
    }
}
