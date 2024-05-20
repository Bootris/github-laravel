<?php

use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(EnsureTokenIsValid::class);
    })
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        api: __DIR__.'/../routes/api.php',
        then: function ($router) {
            Route::prefix('/v1')
                ->middleware('api')
                ->name('api.v1.')
                ->group(base_path('routes/api.php'));

            Route::prefix('/v2')
                ->middleware('api')
                ->name('api.v2.')
                ->group(base_path('routes/api.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
