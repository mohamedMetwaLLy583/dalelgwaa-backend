<?php

use App\Http\Controllers\Banner\BannerController;
use App\Http\Controllers\Banner\DashboardBannerController;
use Illuminate\Support\Facades\Route;

Route::prefix('banner')->group(function () {
    Route::get('/home', [BannerController::class, 'homeBanner']);
    Route::get('/contact-us', [BannerController::class, 'contactUsBanner']);
    Route::get('/about-us', [BannerController::class, 'aboutUsBanner']);
});


Route::prefix('dashboard/banner')->middleware('hasPermission:home_banner')->group(function () {
    Route::get('/home', [DashboardBannerController::class, 'homeBanner']);
    Route::post('/home', [DashboardBannerController::class, 'updateHomeBanner']);
});

Route::prefix('dashboard/banner')->middleware('hasPermission:pages_banner')->group(function () {
    Route::get('/pages', [DashboardBannerController::class, 'getBanners']);
    Route::post('/pages', [DashboardBannerController::class, 'updateBanners']);
});

