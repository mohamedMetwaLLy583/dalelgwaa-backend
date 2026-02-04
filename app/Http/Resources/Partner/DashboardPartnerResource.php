<?php

namespace App\Http\Resources\Partner;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardPartnerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'offer' => $this->offer,
            'link' => $this->link,
            'image' => $this->getFirstMediaUrl(),
            'sticker' => $this->getFirstMediaUrl('sticker') ?: null,
        ];
    }
}
