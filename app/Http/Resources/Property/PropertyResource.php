<?php

namespace App\Http\Resources\Property;

use App\Enums\Reservation\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
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
            'title' => $this->title,
            'address' => $this->address,
            'price' => $this->price,
            'image' => $this->getFirstMediaUrl('main_image'),
            'reservations_count' => $this->reservations->where('status', Status::Completed)->count(),
            'view_count' => $this->view_count ?? 0,
            'in_home' => $this->in_home,
            'type' => $this->type->name ?? 'UnKnown',
            'offer_type' => $this->offer_type,
            'is_available' => $this->is_available,
            'link' => $this->link,
        ];
    }
}
