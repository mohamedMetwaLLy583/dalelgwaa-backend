<?php

namespace App\Http\Resources\InspectionRequest;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InspectionRequestResource extends JsonResource
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
            'address' => $this->address,
            'offer_type' => $this->offer_type,
            'date' => $this->date,
            'time' => $this->time,
            'description' => $this->description,
            'requester_type' => $this->requester_type,
            'status' => $this->status,
            'images' => $this->getMedia('images')->map(function ($media) {
                return $media->getUrl();
            })->toArray(),
        ];
    }
}
