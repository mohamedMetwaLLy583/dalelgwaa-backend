<?php

use App\Http\Controllers\InspectionRequest\InspectionRequestController;
use Illuminate\Support\Facades\Route;

Route::post('inspection-requests', [InspectionRequestController::class, 'store']);

Route::prefix('dashboard/inspection-request')->middleware('hasPermission:inspection-request')->group(function () {
    Route::get('/history', [InspectionRequestController::class, 'getHistory']);
    Route::get('/', [InspectionRequestController::class, 'index']);
    Route::get('{inspectionRequest}', [InspectionRequestController::class, 'show']);
    Route::delete('{inspectionRequest}', [InspectionRequestController::class, 'destroy']);
    Route::post('{inspectionRequest}/completed', [InspectionRequestController::class, 'completed']);
    Route::post('/{inspectionRequest}/cancel', [InspectionRequestController::class, 'cancel']);
});
