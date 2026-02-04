<?php

namespace App\Http\Resources\Statistics;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatisticsResource extends JsonResource
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
            'happy_clients' => $this->happy_clients,
            'sold_homes' => $this->sold_homes,
            'rented_homes' => $this->rented_homes,
            'reviews' => $this->reviews,
        ];
    }
}
