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
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }
    }
}
