<?php

namespace Database\Seeders;

use App\Enums\Reservation\Status;
use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservation::insert([
            [
                'property_id' => 1,
                'name' => 'John Doe',
                'phone' => '1234567890',
                'date' => '1446/07/10',
                'time' => now()->format('H:i'),
                'status' => Status::Pending->value,
            ],
            [
                'property_id' => 2,
                'name' => 'Jane Smith',
                'phone' => '0987654321',
                'date' => '1446/05/17',
                'time' => now()->addDay()->format('H:i'),
                'status' => Status::Completed->value,
            ],
            [
                'property_id' => 3,
                'name' => 'John Smith',
                'phone' => '1234567890',
                'date' => '1446/1/6',
                'time' => now()->addDays(2)->format('H:i'),
                'status' => Status::Pending->value,
            ],
            [
                'property_id' => 3,
                'name' => 'Jane Doe',
                'phone' => '0987654321',
                'date' => '1446/9/5',
                'time' => now()->addDays(3)->format('H:i'),
                'status' => Status::Completed->value,
            ],
        ]);
    }
}
