<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

Route::get('test', function () {
    $job = Job::first();
    TranslateJob::dispatch($job);

    return 'Done';
});

Route::controller(JobController::class)->group(function () {
    Route::get('/jobs', 'index');
    Route::get('/jobs/create', 'create');
    Route::get('/jobs/{job}', 'show');
    Route::post('/jobs', 'store')->middleware('auth');

    Route::get('/jobs/{job}/edit', 'edit')
        ->middleware('auth')
        ->can('edit', 'job');

    Route::patch('/jobs/{job}/', 'update');
    Route::delete('/jobs/{job}/', 'destroy');
});

Route::view('/contact', 'contact');

Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::get('/links/create', [LinkController::class, 'create'])->name('links.create');
Route::post('/links', [LinkController::class, 'store'])->name('links.store');

Route::get('/search', [SearchController::class, 'index']);
