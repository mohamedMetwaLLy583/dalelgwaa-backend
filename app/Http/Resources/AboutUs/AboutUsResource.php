<?php

namespace App\Http\Resources\AboutUs;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutUsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        $description_one = 'description_one_' . app()->getLocale();
        $description_two = 'description_two_' . app()->getLocale();
        $description_three = 'description_three_' . app()->getLocale();

        return [
            'description_one' => $this->$description_one,
            'description_two' => $this->$description_two,
            'description_three' => $this->$description_three,
            'image_one' => $this->getFirstMediaUrl('image_one'),
            'image_two' => $this->getFirstMediaUrl('image_two'),
        ];
    }
}
