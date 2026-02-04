<?php

namespace Database\Seeders;

use App\Models\HomeBanner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeBanner::create([
            'title_ar' => 'ابحث عن عقارك المفضل مع مكتب دليل الجواء العقاري',
            'description_ar' => 'نحن هنا لتوفير أفضل الحلول العقارية لك',
            'title_en' => 'Find your favorite property with the real estate office of the weather guide',
            'description_en' => 'We are here to provide you with the best real estate solutions',
        ]);
    }
}
