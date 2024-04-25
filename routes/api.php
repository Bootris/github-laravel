<?php

use App\Http\Controllers\PopularityScoreController;
use App\Http\Controllers\v2\PopularityScoreController as V2PopularityScoreController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('/v1')->group(function () {
    Route::get('/score', [PopularityScoreController::class, 'getScore']);
});

Route::middleware('auth:sanctum')->prefix('/v2')->group(function () {
    Route::get('/score', [V2PopularityScoreController::class, 'getScore']);
});
