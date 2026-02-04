<?php

namespace App\Http\Resources\Partner;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
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
            'offer' => $this->offer,
            'link' => $this->link,
            'image' => $this->getFirstMediaUrl() ?? null,
            'sticker' => $this->getFirstMediaUrl('sticker') ?? null,
        ];
    }
}
