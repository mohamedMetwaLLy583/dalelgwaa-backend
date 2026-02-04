<?php

use App\Http\Controllers\OurSteps\OurStepsController;
use Illuminate\Support\Facades\Route;

Route::get('/our-steps', [OurStepsController::class, 'web_index']);

Route::prefix('dashboard/our-steps')->middleware('hasPermission:our-steps')->group(function () {
    Route::get('/', [OurStepsController::class, 'index']);
    Route::get('/{ourSteps}', [OurStepsController::class, 'show']);
    Route::post('/{ourSteps}', [OurStepsController::class, 'update']);
});

