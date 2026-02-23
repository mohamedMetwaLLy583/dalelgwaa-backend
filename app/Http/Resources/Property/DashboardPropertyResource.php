<?php

namespace App\Http\Resources\Property;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardPropertyResource extends JsonResource
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
            'title_ar' => $this->translations->where('locale', 'ar')->first()->title ?? null,
            'title_en' => $this->translations->where('locale', 'en')->first()->title ?? null,
            'description_ar' => $this->translations->where('locale', 'ar')->first()->description ?? null,
            'description_en' => $this->translations->where('locale', 'en')->first()->description ?? null,
            'detailed_description_ar' => $this->translations->where('locale', 'ar')->first()->detailed_description ?? null,
            'detailed_description_en' => $this->translations->where('locale', 'en')->first()->detailed_description ?? null,
            'floor_ar' => $this->translations->where('locale', 'ar')->first()->floor ?? null,
            'floor_en' => $this->translations->where('locale', 'en')->first()->floor ?? null,
            'address_ar' => $this->translations->where('locale', 'ar')->first()->address ?? null,
            'address_en' => $this->translations->where('locale', 'en')->first()->address ?? null,
            'offer_type' => $this->offer_type,
            'furnishing_ar' => $this->translations->where('locale', 'ar')->first()->furnishing ?? null,
            'furnishing_en' => $this->translations->where('locale', 'en')->first()->furnishing ?? null,
            'finishing_ar' => $this->translations->where('locale', 'ar')->first()->finishing ?? null,
            'finishing_en' => $this->translations->where('locale', 'en')->first()->finishing ?? null,
            'price' => $this->price,
            'area' => $this->area,
            'rooms' => $this->rooms,
            'bathrooms' => $this->bathrooms,
            'is_available' => $this->is_available,
            'in_home' => $this->in_home,
            'view_count' => $this->view_count,
            'type_id' => $this->type_id ?? null,
            'type' => $this->type->name ?? 'UnKnown',
            'link' => $this->link,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'main_image' => $this->getFirstMediaUrl('main_image'),
            'gallery' => $this->getMedia('gallery')->map(function ($media) {
                return $media->getUrl();
            })->toArray(),
            'partners' => $this->partners->map(function ($partner) {
                return [
                    'id' => $partner->id,
                    'name' => $partner->name,
                    'offer' => $partner->offer,
                    'link' => $partner->link,
                    'image' => $partner->getFirstMediaUrl(),
                ];
            })->toArray(),
            'added_by' => $this->addedBy->name ?? null,
        ];
    }
}
