<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GitHubPopularityScoreController;

Route::middleware('auth:sanctum')->get('/score', [GitHubPopularityScoreController::class, 'getScore']);
