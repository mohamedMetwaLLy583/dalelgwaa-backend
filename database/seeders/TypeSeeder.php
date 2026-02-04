<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::create([
            'en' => ['name' => 'Apartment'],
            'ar' => ['name' => 'شقة'],
        ]);

        Type::create([
            'en' => ['name' => 'Villa'],
            'ar' => ['name' => 'فيلا'],
        ]);

        Type::create([
            'en' => ['name' => 'Townhouse'],
            'ar' => ['name' => 'تاون هاوس'],
        ]);
    }
}
