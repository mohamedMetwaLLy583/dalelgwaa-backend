<?php

namespace Database\Seeders;

use App\Models\PageBanner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PageBanner::create([
            'about_us_title_ar' => 'من نحن',
            'about_us_title_en' => 'About Us',
            'about_us_desc_ar' => 'شريكك الموثوق في تحقيق أفضل الفرص العقارية',
            'about_us_desc_en' => 'Your trusted partner in achieving the best real estate opportunities',
            'contact_us_title_ar' => 'تواصل معنا',
            'contact_us_title_en' => 'Contact Us',
            'contact_us_desc_ar' => 'تواصل معنا الآن للحصول على أفضل الاستشارات العقارية',
            'contact_us_desc_en' => 'Contact us now for the best real estate consultations',
        ]);
    }
}
