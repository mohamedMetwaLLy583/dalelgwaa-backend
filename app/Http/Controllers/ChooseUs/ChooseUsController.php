<?php

namespace App\Http\Controllers\ChooseUs;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChooseUs\ChooseUsRequest;
use App\Http\Resources\ChooseUs\DashboardChooseUsResource;
use App\Http\Resources\ChooseUs\ChooseUsResource;
use App\Models\ChooseUs;
use App\Traits\ApiTrait;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class ChooseUsController extends Controller
{
    use ApiTrait;

    public function web_index()
    {
        return ChooseUsResource::collection(ChooseUs::all());
    }

    public function index()
    {
        return DashboardChooseUsResource::collection(ChooseUs::all());
    }

    public function show(ChooseUs $chooseUs)
    {
        return new DashboardChooseUsResource($chooseUs);
    }

    public function update(ChooseUsRequest $request, ChooseUs $chooseUs)
    {
        DB::beginTransaction();

        try {
            $chooseUs->update($request->only([
                'title_ar', 'title_en', 'description_ar', 'description_en'
            ]));

            if ($request->hasFile('image')) {
                $chooseUs->clearMediaCollection('image');
                $chooseUs->addMedia($request->file('image'))->toMediaCollection('image');
            }

            DB::commit();

            return $this->sendSuccess(__('response.updated'));
        } catch (\Throwable $th) {
            DB::rollBack();

            return $this->sendError($th->getMessage());
        }
    }
}
