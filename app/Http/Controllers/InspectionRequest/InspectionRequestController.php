<?php

namespace App\Http\Controllers\InspectionRequest;

use App\Enums\InspectionRequest\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\InspectionRequest\StoreInspectionRequest;
use App\Http\Resources\InspectionRequest\InspectionRequestResource;
use App\Models\InspectionRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InspectionRequestController extends Controller
{
    public function store(StoreInspectionRequest $request)
    {
        $validatedData = $request->validated();

        $isBlocked = DB::table('blocked_phones')->where('phone', $validatedData['phone'])->exists();
        if ($isBlocked) {
            return response()->json([
                'message' => __('response.blocked_phone'),
            ], 403);
        }

        if ($this->hasPendingRequest($validatedData['phone'])) {
            return response()->json([
                'message' => __('response.pending_request'),
            ], 403);
        }

        if ($this->isTimeBlocked($validatedData['date'], $validatedData['time'])) {
            return response()->json([
                'message' => __('response.time_blocked'),
            ], 422);
        }

        $inspectionRequest = InspectionRequest::create($validatedData);

        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $inspectionRequest->addMedia($image)->toMediaCollection('images');
            }
        }

        return response()->json([
            'message' => __('response.inspection_created'),
        ], 201);
    }

    public function index()
    {
        $inspectionRequests = InspectionRequest::where('status', Status::Pending->value)->get();

        return response()->json([
            'message' => __('response.inspection_retrieved'),
            'data' => InspectionRequestResource::collection($inspectionRequests),
        ], 200);
    }

    public function show(InspectionRequest $inspectionRequest)
    {
        return response()->json([
            'message' => __('response.inspection_show'),
            'data' => new InspectionRequestResource($inspectionRequest),
        ], 200);
    }

    public function destroy(InspectionRequest $inspectionRequest)
    {
        $inspectionRequest->delete();

        return response()->json([
            'message' => __('response.inspection_deleted'),
        ]);
    }

    public function completed(InspectionRequest $inspectionRequest)
    {
        $inspectionRequest->status = Status::Completed->value;
        $inspectionRequest->save();

        return response()->json([
            'message' => __('response.inspection_completed'),
        ]);
    }

    public function cancel(InspectionRequest $inspectionRequest)
    {
        $inspectionRequest->status = Status::Cancelled->value;
        $inspectionRequest->save();

        return response()->json([
            'message' => __('response.inspection_cancelled'),
        ]);
    }

    public function getHistory()
    {
        return InspectionRequestResource::collection(InspectionRequest::whereIn('status', [
            Status::Completed->value,
            Status::Cancelled->value,
        ])->get());
    }

    private function hasPendingRequest(string $phone): bool
    {
        return InspectionRequest::where('phone', $phone)
            ->where('status', Status::Pending->value)
            ->exists();
    }

    private function isTimeBlocked(string $date, string $time): bool
    {
        $existingRequests = DB::table('inspection_requests')
            ->whereDate('date', $date)
            ->where('status', Status::Pending)
            ->get();

        $requestedTime = Carbon::parse($time);

        foreach ($existingRequests as $request) {
            $reservedStartTime = Carbon::parse($request->time);
            $reservedEndTime = $reservedStartTime->copy()->addMinutes(59);

            if ($requestedTime->between($reservedStartTime, $reservedEndTime)) {
                return true;
            }
        }

        return false;
    }
}
