<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;

class SettingDatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contact = Setting::create($this->articles());

        $contact->addMedia(__DIR__ . '/setting_img/dark_logo.svg')->preservingOriginal()->toMediaCollection('dark_logo');
        $contact->addMedia(__DIR__ . '/setting_img/light_logo.svg')->preservingOriginal()->toMediaCollection('light_logo');

    }

    public function articles(): array
    {
        return [
            'address:ar' => 'المملكة العربية السعودية - القصيم',
            'address:en' => 'Saudi Arabia - Qassim',
            'primary_phone' => '0535150222',
            'secondary_phone' => '0537180774',
            'email' => 'exmaple@gmail.com',
            'whatsapp' => '+201019113472',
            'facebook' => 'https://facebook.com',
            'instagram' => 'https://instegram.com',
            'x' => 'https://x.com',
            'linkedin' => 'https://linkedin.com',

            'footer_description:en' => 'Real Estate Guide offers you the best real estate solutions with experience and professionalism to meet all your needs in sales and rentals, with a guarantee of a comfortable and reliable experience',
            'footer_description:ar' => 'دليل الجواء العقاري يقدم لك أفضل الحلول العقارية بخبرة واحترافية لتلبية كافة احتياجاتك في البيع والإيجار، مع ضمان تجربة مريحة وموثوقة',
        ];
    }
}
