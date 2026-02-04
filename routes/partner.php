<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Partner\PartnerController;
use App\Http\Controllers\Partner\DashboardPartnerController;

Route::get('partner', [PartnerController::class, 'index']);
Route::get('partner/select', [PartnerController::class, 'select']);

Route::prefix('dashboard/partner')->middleware('hasPermission:admin')->group(function () {
    Route::get('/', [DashboardPartnerController::class, 'index']);
    Route::get('{partner}', [DashboardPartnerController::class, 'show']);
    Route::post('/', [DashboardPartnerController::class, 'create']);
    Route::post('{partner}', [DashboardPartnerController::class, 'update']);
    Route::delete('{partner}', [DashboardPartnerController::class, 'delete']);
});

