<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\AboutUs;


class HomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $about_us = AboutUs::first();
        $title = 'title_' . app()->getLocale();
        $description = 'description_' . app()->getLocale();

        return [
            'title' => $this->$title,
            'description' => $this->$description,
            'image_one' => $about_us->getFirstMediaUrl('image_one'),
            'image_two' => $about_us->getFirstMediaUrl('image_two'),
        ];
    }
}
