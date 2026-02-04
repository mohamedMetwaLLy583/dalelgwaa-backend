<?php

namespace App\Http\Resources\ChooseUs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChooseUsResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->$title,
            'description' => $this->$description,
            'image' => $this->getFirstMediaUrl('image'),
        ];
    }
}
