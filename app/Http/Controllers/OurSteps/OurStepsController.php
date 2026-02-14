<?php

namespace App\Http\Controllers\OurSteps;

use App\Http\Controllers\Controller;
use App\Http\Requests\OurSteps\OurStepsRequest;
use App\Http\Resources\OurSteps\DashboardOurStepsResource;
use App\Http\Resources\OurSteps\OurStepsResource;
use App\Models\OurSteps;
use App\Traits\ApiTrait;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class OurStepsController extends Controller
{
    use ApiTrait;

    public function web_index()
    {
        return OurStepsResource::collection(OurSteps::all());
    }

    public function index()
    {
        return DashboardOurStepsResource::collection(OurSteps::all());
    }

    public function show(OurSteps $ourSteps)
    {
        return new DashboardOurStepsResource($ourSteps);
    }

    public function update(OurStepsRequest $request, OurSteps $ourSteps)
    {
        DB::beginTransaction();

        try {
            $ourSteps->update($request->only([
                'title_ar', 'title_en', 'description_ar', 'description_en'
            ]));

            if ($request->hasFile('icon')) {
                $ourSteps->clearMediaCollection('icon');
                $ourSteps->addMedia($request->file('icon'))->toMediaCollection('icon');
            }

            DB::commit();

            return $this->sendSuccess(__('response.updated'));
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);

            return $this->sendError(__('response.server_error'), [], 500);
        }
    }}
