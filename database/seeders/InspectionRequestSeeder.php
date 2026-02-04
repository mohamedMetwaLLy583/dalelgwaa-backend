<?php

namespace Database\Seeders;

use App\Enums\InspectionRequest\Status;
use App\Enums\Property\OfferType;
use App\Models\InspectionRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InspectionRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InspectionRequest::create([
            'name' => 'John Doe',
            'phone' => '1234567890',
            'address' => '123 Main St',
            'offer_type' => OfferType::Sale->value,
            'date' => '1446/07/10',
            'time' => now()->toTimeString(),
            'description' => 'Inspection request description',
            'requester_type' => 'Owner',
            'status' => Status::Pending->value
        ]);

        InspectionRequest::create([
            'name' => 'Jane Smith',
            'phone' => '0987654321',
            'address' => '456 Elm St',
            'offer_type' => OfferType::Rent->value,
            'date' => '1446/05/17',
            'time' => now()->addHours(1)->toTimeString(),
            'description' => 'Another inspection request description',
            'requester_type' => 'Agent',
            'status' => Status::Completed->value
        ]);

        InspectionRequest::create([
            'name' => 'Alice Johnson',
            'phone' => '5551234567',
            'address' => '789 Oak St',
            'offer_type' => OfferType::Sale->value,
            'date' => '1446/1/6',
            'time' => now()->addHours(2)->toTimeString(),
            'description' => 'Yet another inspection request description',
            'requester_type' => 'Buyer',
            'status' => Status::Cancelled->value
        ]);
    }
}
