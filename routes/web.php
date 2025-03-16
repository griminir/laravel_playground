<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// shorthand for serving static pages
Route::view('/', 'index');
Route::view('/contact', 'contact');

// if you want to see the routes cmd:php artisan route:list --except-vendor
Route::controller(JobController::class)->group(function () {
    Route::get('/jobs', 'index');

    Route::get('/jobs/create', 'create')
        ->middleware('auth');

    Route::get('/jobs/{job}', 'show');

    Route::post('/jobs', 'store')
        ->middleware('auth');

    Route::get('/jobs/{job}/edit', 'edit')
        ->middleware('auth')
        ->can('job-owner', 'job');

    Route::patch('/jobs/{job}', 'update')
        ->middleware('auth')
        ->can('job-owner', 'job');

    Route::delete('/jobs/{job}', 'destroy')
        ->middleware('auth')
        ->can('job-owner', 'job');
});

// super shorthand for the above but requires correct naming convention
// can use except() to exclude routes or only() to include specific routes
// Route::resource('jobs', JobController::class);

// auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy']);
