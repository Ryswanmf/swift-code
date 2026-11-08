<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'site_name' => 'Swift Code Lampung',
            'tagline' => 'Jasa Pembuatan Website Profesional & Cepat di Lampung',
            'whatsapp' => '62895325852575',
            'email' => 'halo@swiftcode.id',
            'address' => 'Bandar Lampung, Lampung, Indonesia',
            'instagram' => 'https://instagram.com/swiftcode.lpg',
            'meta_title' => 'Jasa Pembuatan Website Profesional Lampung | Swift Code',
            'meta_description' => 'Swift Code Lampung melayani pembuatan landing page, company profile, website sekolah, toko online, dan sistem custom yang cepat, elegan, dan terjangkau di Lampung.',
            'owner_name' => 'Muhammad Riswan Mufid',
            'owner_role' => 'Founder & Lead Software Engineer',
            'owner_bio' => 'Praktisi software engineer dan pendiri Swift Code Lampung. Berfokus pada pembangunan sistem website modern dengan arsitektur kode bersih, performa loading kilat, dan solusi digital yang terbukti membantu bisnis berkembang secara konsisten.',
            'owner_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=800&auto=format&fit=crop',
            'owner_linkedin' => 'https://linkedin.com',
            'owner_github' => 'https://github.com/Ryswanmf',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }
    }
}
