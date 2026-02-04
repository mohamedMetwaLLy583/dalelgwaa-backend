<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use App\Http\Requests\Statistics\StatisticsRequest;
use App\Http\Resources\Statistics\DashboardStatisticsResource;
use App\Http\Resources\Statistics\StatisticsResource;
use App\Models\Statistics;
use App\Traits\ApiTrait;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    use ApiTrait;

    public function web_index()
    {
        return new StatisticsResource(Statistics::first());
    }

    public function index()
    {
        return new DashboardStatisticsResource(Statistics::first());
    }

    public function update(StatisticsRequest $request)
    {
        try {
            DB::beginTransaction();
            $statistics = Statistics::first();

            $statistics->update([
                'title_ar' => $request['title_ar'] ?? $statistics->title_ar,
                'title_en' => $request['title_en'] ?? $statistics->title_en,
                'description_ar' => $request['description_ar'] ?? $statistics->description_ar,
                'description_en' => $request['description_en'] ?? $statistics->description_en,
                'happy_clients' => $request['happy_clients'] ?? $statistics->happy_clients,
                'sold_homes' => $request['sold_homes'] ?? $statistics->sold_homes,
                'rented_homes' => $request['rented_homes'] ?? $statistics->rented_homes,
                'reviews' => $request['reviews'] ?? $statistics->reviews,
            ]);

            DB::commit();
            return $this->sendSuccess(__('response.updated'));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new HttpResponseException(response()->json(['status' => false,  'message' => $th->getMessage()], 500));
        }
    }
}
