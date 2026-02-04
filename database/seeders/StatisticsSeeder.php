<?php

namespace Database\Seeders;

use App\Models\Statistics;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatisticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Statistics::create([
                'title_ar' => 'أيجاد عقار مناسب هو هدفنا',
                'title_en' => 'Finding a suitable property is our goal',
                'description_ar' => 'دليل الجواء العقاري يقدم لك أفضل الحلول العقارية بخبرة واحترافية لتلبية كافة احتياجاتك في البيع والإيجار، مع ضمان تجربة مريحة وموثوقة',
                'description_en' => 'The Real Estate Guide offers you the best real estate solutions with experience and professionalism to meet all your needs in sales and rentals, with a guarantee of a comfortable and reliable experience',
                'happy_clients' => +25000,
                'sold_homes' => +5000,
                'rented_homes' => +1000,
                'reviews' => 40,
        ]);
    }
}
