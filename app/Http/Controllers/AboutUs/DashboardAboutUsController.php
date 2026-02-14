<?php

namespace App\Http\Controllers\AboutUs;

use App\Models\AboutUs;
use App\Traits\ApiTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\AboutUs\AboutUsRequest;
use App\Http\Resources\AboutUs\AboutUsResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Resources\AboutUs\DashboardAboutUsResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardAboutUsController extends Controller
{
    use ApiTrait;


    public function web_index()
    {
        return new AboutUsResource(AboutUs::first());
    }

    public function index()
    {
        return new DashboardAboutUsResource(AboutUs::first());
    }

    public function update(AboutUsRequest $request)
    {
        try {
            DB::beginTransaction();
            $about_us = AboutUs::first();

            $about_us->update([
                'description_one_ar' => $request['description_one_ar'] ?? $about_us->description_one_ar,
                'description_one_en' => $request['description_one_en'] ?? $about_us->description_one_en,
                'description_two_ar' => $request['description_two_ar'] ?? $about_us->description_two_ar,
                'description_two_en' => $request['description_two_en'] ?? $about_us->description_two_en,
                'description_three_ar' => $request['description_three_ar'] ?? $about_us->description_three_ar,
                'description_three_en' => $request['description_three_en'] ?? $about_us->description_three_en,
            ]);

            if ($request->hasFile('image_one')) {
                $about_us->clearMediaCollection('image_one');
                $about_us->addMedia($request->file('image_one'))->toMediaCollection('image_one');
            }

            if ($request->hasFile('image_two')) {
                $about_us->clearMediaCollection('image_two');
                $about_us->addMedia($request->file('image_two'))->toMediaCollection('image_two');
            }

            DB::commit();
            return $this->sendSuccess(__('response.updated'));
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);

            return response()->json(['message' => __('response.server_error')], 500);
        }
    }
}
