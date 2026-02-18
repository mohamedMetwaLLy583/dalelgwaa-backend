<?php

namespace App\Http\Resources\Reservation;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function Symfony\Component\Translation\t;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'data' => $this->date,
            'time' => Carbon::parse($this->time)->format('H:i'),
            'property' => $this->property->title,
            'property_id' => $this->property->id,
            'property_image' => $this->property->getFirstMediaUrl('main_image'),
            'offer_type' => $this->property->offer_type,
            'status' => $this->status,
            'owner_name' => $this->property->owner_name,
            'owner_phone' => $this->property->owner_phone,
            'owner_description' => $this->property->owner_description,
            'owner_address' => $this->property->owner_address,
            'partner' => $this->partner ? [
                'id' => $this->partner->id,
                'name' => $this->partner->name,
            ] : 'لم يتم اختيار شريك مميز',
        ];
    }
}
