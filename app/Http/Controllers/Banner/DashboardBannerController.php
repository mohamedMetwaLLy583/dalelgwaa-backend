<?php

namespace App\Http\Controllers\Banner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\PageBannerRequest;
use App\Http\Requests\Banner\HomeBannerRequest;
use App\Http\Resources\Banner\DashboardHomeBannerResource;
use App\Http\Resources\Banner\PageBannerResource;
use App\Models\HomeBanner;
use App\Models\PageBanner;
use App\Traits\ApiTrait;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class DashboardBannerController extends Controller
{
    use ApiTrait;

    public function homeBanner()
    {
        return new DashboardHomeBannerResource(HomeBanner::first());
    }

    public function getBanners()
    {
        return new PageBannerResource(PageBanner::first());
    }


    public function updateHomeBanner(HomeBannerRequest $request)
    {
       try {
            DB::beginTransaction();
            $homeBanner = HomeBanner::first();

            $homeBanner->update([
                'title_ar' => $request['title_ar'] ?? $homeBanner->title_ar,
                'title_en' => $request['title_en'] ?? $homeBanner->title_en,
                'description_ar' => $request['description_ar'] ?? $homeBanner->description_ar,
                'description_en' => $request['description_en'] ?? $homeBanner->description_en,
            ]);

            DB::commit();
            return $this->sendSuccess(__('response.updated'));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new HttpResponseException(response()->json(['status' => false, 'message' => $th->getMessage()], 500));
        }
    }

    public function updateBanners(PageBannerRequest $pageBannerRequest)
    {
        try {
            DB::beginTransaction();

            $PageBanner = PageBanner::first();

            $PageBanner->update([
                'about_us_title_ar' => $pageBannerRequest['about_us_title_ar'] ?? $PageBanner->about_us_title_ar,
                'about_us_title_en' => $pageBannerRequest['about_us_title_en'] ?? $PageBanner->about_us_title_en,
                'about_us_desc_ar' => $pageBannerRequest['about_us_desc_ar'] ?? $PageBanner->about_us_desc_ar,
                'about_us_desc_en' => $pageBannerRequest['about_us_desc_en'] ?? $PageBanner->about_us_desc_en,
                'contact_us_title_ar' => $pageBannerRequest['contact_us_title_ar'] ?? $PageBanner->contact_us_title_ar,
                'contact_us_title_en' => $pageBannerRequest['contact_us_title_en'] ?? $PageBanner->contact_us_title_en,
                'contact_us_desc_ar' => $pageBannerRequest['contact_us_desc_ar'] ?? $PageBanner->contact_us_desc_ar,
                'contact_us_desc_en' => $pageBannerRequest['contact_us_desc_en'] ?? $PageBanner->contact_us_desc_en,
            ]);

            DB::commit();
            return $this->sendSuccess(__('response.updated'));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new HttpResponseException(response()->json(['status' => false, 'message' => $th->getMessage()], 500));
        }
    }

}
