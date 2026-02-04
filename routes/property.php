<?php

use App\Http\Controllers\Property\DashboardPropertyController;
use App\Http\Controllers\Property\PropertyController;
use App\Http\Controllers\Type\TypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('properties')->group(function () {
    Route::get('/home/sale', [PropertyController::class, 'propertiesForSale']);
    Route::get('/home/rent', [PropertyController::class, 'propertiesForRent']);
    Route::get('/', [PropertyController::class, 'index']);
    Route::get('/{property}', [PropertyController::class, 'show']);
    Route::get('/related/{property}', [PropertyController::class, 'relatedProperties']);

});

Route::prefix('dashboard/property')->middleware('hasPermission:property')->group(function () {
    Route::get('/', [DashboardPropertyController::class, 'index']);
    Route::get('/{property}', [DashboardPropertyController::class, 'show']);
    Route::post('/', [DashboardPropertyController::class, 'create']);
    Route::post('/{property}', [DashboardPropertyController::class, 'update']);
    Route::delete('/{property}', [DashboardPropertyController::class, 'destroy']);
});


Route::get('types', [TypeController::class, 'web_index']);

Route::prefix('dashboard/type')->middleware('hasPermission:type')->group(function () {
    Route::get('/', [TypeController::class, 'index']);
    Route::post('/', [TypeController::class, 'store']);
    Route::delete('/{type}', [TypeController::class, 'destroy']);
});

