<?php

namespace Database\Seeders;

use App\Models\Home;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Home::create([
            'title_ar' => 'شريكك الموثوق في سوق العقارات',
            'title_en' => 'Your trusted partner in the real estate market',
            'description_ar' => 'في دليل الجواء العقاري، نسعى لتقديم أفضل الحلول العقارية التي تناسب احتياجاتك. فريقنا المتخصص يعمل بجد لضمان الجودة والمصداقية في كل خطوة، لتجربة عقارية موثوقة ومريحة',
            'description_en' => 'At the real estate office of the weather guide, we strive to provide the best real estate solutions that suit your needs. Our specialized team works hard to ensure quality and credibility at every step, for a reliable and comfortable real estate experience',
        ]);
    }
}
