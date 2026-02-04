<?php


use App\Http\Controllers\ChooseUs\ChooseUsController;
use Illuminate\Support\Facades\Route;

Route::get('/choose-us', [ChooseUsController::class, 'web_index']);

Route::prefix('dashboard/choose-us')->middleware('hasPermission:choose-us')->group(function () {
    Route::get('/', [ChooseUsController::class, 'index']);
    Route::get('/{choose_us}', [ChooseUsController::class, 'show']);
    Route::post('/{choose_us}', [ChooseUsController::class, 'update']);
});
