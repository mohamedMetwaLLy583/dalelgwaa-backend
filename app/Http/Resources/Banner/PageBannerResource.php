<?php

namespace App\Http\Resources\Banner;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageBannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'about_us_title_ar' => $this->about_us_title_ar,
            'about_us_title_en' => $this->about_us_title_en,
            'about_us_desc_ar' => $this->about_us_desc_ar,
            'about_us_desc_en' => $this->about_us_desc_en,
            'contact_us_title_ar' => $this->contact_us_title_ar,
            'contact_us_title_en' => $this->contact_us_title_en,
            'contact_us_desc_ar' => $this->contact_us_desc_ar,
            'contact_us_desc_en' => $this->contact_us_desc_en,
        ];
    }
}
