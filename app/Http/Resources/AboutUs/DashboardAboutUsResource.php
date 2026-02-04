<?php

namespace App\Http\Resources\AboutUs;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardAboutUsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'description_one_ar' => $this->description_one_ar,
            'description_one_en' => $this->description_one_en,
            'description_two_ar' => $this->description_two_ar,
            'description_two_en' => $this->description_two_en,
            'description_three_ar' => $this->description_three_ar,
            'description_three_en' => $this->description_three_en,
            'image_one' => $this->getFirstMediaUrl('image_one'),
            'image_two' => $this->getFirstMediaUrl('image_two'),
        ];
    }
}
