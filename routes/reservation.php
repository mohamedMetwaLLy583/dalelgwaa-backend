<?php


use App\Http\Controllers\Reservation\ReservationController;
use Illuminate\Support\Facades\Route;

Route::post('reservations', [ReservationController::class, 'store']);


Route::prefix('dashboard/reservation')->middleware('hasPermission:reservation')->group(function () {
    Route::get('/history', [ReservationController::class, 'getHistory']);
    Route::get('/blocked-phones', [ReservationController::class, 'getBlockedPhoneNumbers']);
    Route::get('/', [ReservationController::class, 'index']);
    Route::get('/{reservation}', [ReservationController::class, 'show']);
    Route::delete('/{reservation}', [ReservationController::class, 'destroy']);
    Route::post('/{reservation}/completed', [ReservationController::class, 'completed']);
    Route::post('/{reservation}/cancel', [ReservationController::class, 'cancel']);
    Route::post('/block-phone', [ReservationController::class, 'blockPhone']);
    Route::post('/unblock-phone/{id}', [ReservationController::class, 'unblockPhone']);
});
