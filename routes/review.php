<?php

use App\Http\Controllers\Review\ReviewController;
use Illuminate\Support\Facades\Route;

Route::prefix('reviews')->group(function () {
    Route::get('/', [ReviewController::class, 'web_index']);
    Route::post('/', [ReviewController::class, 'store']);
});

Route::prefix('dashboard/review')->middleware('hasPermission:review')->group(function () {
    Route::get('/', [ReviewController::class, 'index']);
    Route::post('/{review}/toggle', [ReviewController::class, 'toggleStatus']);
    Route::delete('/{review}', [ReviewController::class, 'destroy']);
});

