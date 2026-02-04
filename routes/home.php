<?php


use App\Http\Controllers\Home\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('home', [HomeController::class, 'web_index']);

Route::prefix('dashboard/home')->middleware('hasPermission:home')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::post('/', [HomeController::class, 'update']);
});
