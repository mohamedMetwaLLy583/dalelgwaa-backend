<?php

namespace App\Http\Controllers\Partner;

use App\Models\Partner;
use App\Traits\ApiTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Partner\CreatePartnerRequest;
use App\Http\Requests\Partner\UpdatePartnerRequest;
use App\Http\Resources\Partner\DashboardPartnerResource;

class DashboardPartnerController extends Controller
{
    use ApiTrait;

    public function index()
    {
        return DashboardPartnerResource::collection(Partner::paginate());
    }

    public function show(Partner $partner)
    {
        return new DashboardPartnerResource($partner);
    }

    public function create(CreatePartnerRequest $request)
    {
        try {
            $partner = Partner::create($request->validated());

            $partner->addMediaFromRequest('image')->toMediaCollection();
            if ($request->hasFile('sticker')) {
                $partner->addMediaFromRequest('sticker')->toMediaCollection('sticker');
            }

            return $this->sendSuccess(__('response.created'));
        } catch (\Throwable $th) {
            report($th);

            return $this->sendError(__('response.server_error'), [], 500);
        }
    }

    public function update(Partner $partner, UpdatePartnerRequest $request)
    {
        try {
            $partner->update($request->validated());

            if ($request->hasFile('image')) {
                $partner->clearMediaCollection();

                $partner->addMediaFromRequest('image')->toMediaCollection();
            }
            if ($request->hasFile('sticker')) {
                $partner->clearMediaCollection('sticker');

                $partner->addMediaFromRequest('sticker')->toMediaCollection('sticker');
            }



            return $this->sendSuccess(__('response.updated'));
        } catch (\Throwable $th) {
            return $this->sendError(__('response.error'), code: 500);
        }
    }

    public function delete(Partner $partner)
    {
        try {
            $partner->clearMediaCollection();
            $partner->delete();

            return $this->sendSuccess(__('response.deleted'));
        } catch (\Throwable $th) {
            return $this->sendError(__('response.error'), code: 500);
        }
    }
}
