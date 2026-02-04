<?php

namespace App\Http\Controllers\Banner;

use App\Http\Controllers\Controller;
use App\Http\Resources\Banner\AboutUsBannerResource;
use App\Http\Resources\Banner\ContactUsBannerResource;
use App\Http\Resources\Banner\HomeBannerResource;
use App\Models\AboutUsBanner;
use App\Models\ContactUsBanner;
use App\Models\HomeBanner;
use App\Models\PageBanner;

class BannerController extends Controller
{

    private function getLocalizedDescription($banner, $field)
    {
        $locale = app()->getLocale();
        $localizedField = $locale === 'ar' ? $field . '_ar' : $field . '_en';

        return $banner->{$localizedField} ?? null;
    }

    public function homeBanner()
    {
        return new HomeBannerResource(HomeBanner::first());
    }

    public function contactUsBanner()
    {
        $banner = PageBanner::first();
        if (!$banner) {
            return response()->json(['error' => 'Banner not found'], 404);
        }

        return response()->json([
            'data' => [
                'title' => $this->getLocalizedDescription($banner, 'contact_us_title'),
                'description' => $this->getLocalizedDescription($banner, 'contact_us_desc'),
            ]
        ]);
    }

    public function aboutUsBanner()
    {
        $banner = PageBanner::first();
        if (!$banner) {
            return response()->json(['error' => 'Banner not found'], 404);
        }

        return response()->json([
            'data' => [
                'title' => $this->getLocalizedDescription($banner, 'about_us_title'),
                'description' => $this->getLocalizedDescription($banner, 'about_us_desc'),
            ]
        ]);
    }
}
