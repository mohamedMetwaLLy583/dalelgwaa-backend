<?php

namespace App\Http\Controllers\Reservation;

use App\Enums\Reservation\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\StoreReservationRequest;
use App\Http\Resources\Reservation\ReservationResource;
use App\Mail\ReservationMail;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function store(StoreReservationRequest $request)
    {
        $validatedData = $request->validated();

        $isBlocked = DB::table('blocked_phones')->where('phone', $validatedData['phone'])->exists();
        if ($isBlocked) {
            return response()->json([
                'message' => __('response.phone_banned'),
            ], 403);
        }

        if ($this->hasPendingReservation($validatedData['phone'])) {
            return response()->json([
                'message' => __('response.pending_reservation'),
            ], 403);
        }

        if ($this->hasExceededCancelledReservations($validatedData['phone'])) {
            $this->handleBanLogic($validatedData['phone']);
            return response()->json([
                'message' => __('response.exceeded_cancellations'),
            ], 403);
        }

        if ($this->isDateFullyBooked($validatedData['property_id'], $validatedData['date'])) {
            return response()->json([
                'message' => __('response.date_fully_booked'),
            ], 422);
        }

        if ($this->isTimeBlocked($validatedData['property_id'], $validatedData['date'], $validatedData['time'])) {
            return response()->json([
                'message' => __('response.time_blocked'),
            ], 422);
        }

        $reservation = Reservation::create($validatedData);
        try {
            Mail::to(config('mail.from.address'))->send(new ReservationMail($reservation));
        } catch (\Exception $e) {

            Log::error('Failed to send reservation email: ' . $e->getMessage());
        }

        return response()->json([
            'message' => __('response.reservation_created'),
        ], 201);
    }

    public function index()
    {
        return ReservationResource::collection(Reservation::where('status', Status::Pending->value)->get());
    }

    public function show(Reservation $reservation)
    {
        return new ReservationResource($reservation);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return response()->json([
            'message' => __('response.reservation_deleted'),
        ]);
    }

    public function getHistory()
    {
        return ReservationResource::collection(Reservation::whereIn(
            'status',
            [Status::Completed->value, Status::Cancelled->value]
        )
            ->get());
    }

    public function getBlockedPhoneNumbers()
    {
        $blockedPhones = DB::table('blocked_phones')->get(['id', 'phone']);

        return response()->json([
            'data' => $blockedPhones,
        ]);
    }

    public function completed(Reservation $reservation)
    {
        $reservation->status = Status::Completed->value;
        $reservation->save();

        return response()->json([
            'message' => __('response.reservation_completed'),
        ]);
    }

    public function cancel(Reservation $reservation)
    {
        $reservation->status = Status::Cancelled->value;
        $reservation->save();

        return response()->json([
            'message' => __('response.reservation_cancelled'),
        ]);
    }

    public function blockPhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        $phone = $request->input('phone');

        $isAlreadyBanned = DB::table('blocked_phones')
            ->where('phone', $phone)
            ->exists();

        if ($isAlreadyBanned) {
            return response()->json([
                'message' => __('response.phone_already_banned'),
            ], 200);
        }

        DB::table('blocked_phones')->insert(['phone' => $phone]);

        return response()->json([
            'message' => __('response.phone_blocked'),
        ], 201);
    }

    public function unblockPhone($id)
    {
        $blockedPhone = DB::table('blocked_phones')->where('id', $id)->first();

        if (!$blockedPhone) {
            return response()->json([
                'message' => __('response.blocked_phone_not_found'),
            ], 404);
        }

        DB::table('blocked_phones')->where('id', $id)->delete();

        return response()->json([
            'message' => __('response.phone_unblocked'),
        ], 200);
    }

    private function handleBanLogic($phone)
    {
        $cancelledCount = Reservation::where('phone', $phone)
            ->where('status', Status::Cancelled->value)
            ->count();

        if ($cancelledCount >= 3) {
            DB::table('blocked_phones')->insertOrIgnore(['phone' => $phone]);
        }
    }

    private function hasPendingReservation(string $phone): bool
    {
        return Reservation::where('phone', $phone)
            ->where('status', Status::Pending->value)
            ->exists();
    }

    private function hasExceededCancelledReservations(string $phone): bool
    {
        $cancelledCount = Reservation::where('phone', $phone)
            ->where('status', Status::Cancelled->value)
            ->count();

        return $cancelledCount >= 3;
    }

    private function isDateFullyBooked(int $propertyId, string $date): bool
    {
        $reservationCount = DB::table('reservations')
            ->where('property_id', $propertyId)
            ->whereDate('date', $date)
            ->where('status', Status::Pending)
            ->count();

        return $reservationCount >= 3;
    }

    private function isTimeBlocked(int $propertyId, string $date, string $time): bool
    {
        $existingReservations = DB::table('reservations')
            ->where('property_id', $propertyId)
            ->whereDate('date', $date)
            ->where('status', Status::Pending)
            ->get();

        $requestedTime = Carbon::parse($time);

        foreach ($existingReservations as $reservation) {
            $reservedStartTime = Carbon::parse($reservation->time);
            $reservedEndTime = $reservedStartTime->copy()->addMinutes(59);

            if ($requestedTime->between($reservedStartTime, $reservedEndTime)) {
                return true;
            }
        }

        return false;
    }
}
