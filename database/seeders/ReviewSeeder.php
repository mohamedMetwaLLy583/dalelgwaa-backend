<?php

namespace Database\Seeders;

use App\Enums\Review\Status;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::create([
            'name' => 'John Doe',
            'country' => 'USA',
            'review' => 'Highly recommend! The website is user-friendly and offers a great selection of properties.',
            'rating' => 5,
            'status' => Status::Active->value,
        ]);

        Review::create([
            'name' => 'Jane Smith',
            'country' => 'Canada',
            'review' => 'Good value for the price. The property listings are detailed and accurate.',
            'rating' => 4,
            'status' => Status::Active->value,
        ]);

        Review::create([
            'name' => 'Alice Johnson',
            'country' => 'UK',
            'review' => 'Average experience, could be better. The website could use some improvements in navigation.',
            'rating' => 3,
            'status' => Status::Inactive->value,
        ]);

        Review::create([
            'name' => 'Bob Brown',
            'country' => 'Australia',
            'review' => 'Poor service. The website is slow and the property listings are outdated.',
            'rating' => 2,
            'status' => Status::Inactive->value,
        ]);
    }
}
