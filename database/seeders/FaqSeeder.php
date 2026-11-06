<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Berapa lama proses pengerjaan website?',
                'answer' => 'Untuk paket landing page berkisar 3-5 hari kerja. Website company profile atau sekolah membutuhkan 7-14 hari kerja tergantung kesiapan konten teks dan foto dari Anda.',
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'question' => 'Apakah saya bisa update teks dan foto sendiri setelah website jadi?',
                'answer' => 'Tentu saja! Kami menyediakan panel admin yang sangat mudah dipelajari bahkan bagi yang belum pernah menyentuh website sebelumnya. Kami juga menyediakan video panduan pemakaian.',
                'sort_order' => 2,
                'is_published' => true,
            ],
            [
                'question' => 'Apakah sudah termasuk domain dan hosting?',
                'answer' => 'Ya, seluruh paket pembuatan website di Swift Code Lampung sudah termasuk biaya sewa domain dan server hosting berkecepatan tinggi gratis selama 1 tahun pertama.',
                'sort_order' => 3,
                'is_published' => true,
            ],
            [
                'question' => 'Bagaimana sistem pembayaran di Swift Code?',
                'answer' => 'Kami menerapkan sistem aman dengan DP (Down Payment) sebesar 50% di awal sebelum pengerjaan, dan sisa pelunasan 50% dibayarkan setelah website selesai diuji dan siap online.',
                'sort_order' => 4,
                'is_published' => true,
            ],
            [
                'question' => 'Apakah website saya akan muncul di Google?',
                'answer' => 'Semua website kami dirancang ramah SEO dengan meta tags lengkap, sitemap otomatis, dan didaftarkan ke Google Search Console agar cepat diindeks oleh mesin pencari Google.',
                'sort_order' => 5,
                'is_published' => true,
            ],
        ];

        foreach ($faqs as $f) {
            Faq::updateOrCreate(
                ['question' => $f['question']],
                $f
            );
        }
    }
}
