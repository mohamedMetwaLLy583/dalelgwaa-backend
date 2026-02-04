<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\HomeRequest;
use App\Http\Resources\Home\DashboardHomeResource;
use App\Http\Resources\Home\HomeResource;
use App\Models\Home;
use App\Traits\ApiTrait;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use ApiTrait;


    public function web_index()
    {
        return new HomeResource(Home::first());
    }

    public function index()
    {
        return new DashboardHomeResource(Home::first());
    }

    public function update(HomeRequest $request)
    {
        try {
            DB::beginTransaction();
            $home = Home::first();

            $home->update([
                'title_ar' => $request['title_ar'] ?? $home->title_ar,
                'title_en' => $request['title_en'] ?? $home->title_en,
                'description_ar' => $request['description_ar'] ?? $home->description_ar,
                'description_en' => $request['description_en'] ?? $home->description_en,
            ]);

            DB::commit();
            return $this->sendSuccess(__('response.updated'));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new HttpResponseException(response()->json(['status' => false,  'message' => $th->getMessage()], 500));
        }
    }
}
