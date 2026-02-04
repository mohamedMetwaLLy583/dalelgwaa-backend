<?php

namespace App\Http\Resources\Banner;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsBannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        $title = 'title_' . app()->getLocale();
        $description = 'description_' . app()->getLocale();

        return [
            'title' => $this->$title,
            'description' => $this->$description,
        ];
    }
}
