<?php

namespace App\Http\Resources\Setting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardSettingResource extends JsonResource
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
            'primary_phone' => $this->primary_phone,
            'secondary_phone' => $this->secondary_phone,
            'email' => $this->email,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'whatsapp' => $this->whatsapp,
            'x' => $this->x,
            'dark_logo' => $this->getFirstMediaUrl('dark_logo'),
            'light_logo' => $this->getFirstMediaUrl('light_logo'),
            'footer_description_en' => $this->getTranslation('en')->footer_description,
            'footer_description_ar' => $this->getTranslation('ar')->footer_description,
            'address_en' => $this->getTranslation('en')->address,
            'address_ar' => $this->getTranslation('ar')->address,
        ];
    }
}
