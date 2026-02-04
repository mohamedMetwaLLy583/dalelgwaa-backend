<?php

namespace App\Http\Resources\Statistics;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardStatisticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'happy_clients' => $this->happy_clients,
            'sold_homes' => $this->sold_homes,
            'rented_homes' => $this->rented_homes,
            'reviews' => $this->reviews,
        ];
    }
}
