<?php

use App\Http\Controllers\PopularityScoreController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('/v1')->group(function () {
    Route::get('/score', [PopularityScoreController::class, 'getScore']);
});
