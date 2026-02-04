<?php


use App\Http\Controllers\Statistics\StatisticsController;
use Illuminate\Support\Facades\Route;

Route::get('statistics', [StatisticsController::class, 'web_index']);

Route::prefix('dashboard/statistics')->middleware('hasPermission:statistics')->group(function () {
    Route::get('/', [StatisticsController::class, 'index']);
    Route::post('/', [StatisticsController::class, 'update']);
});
