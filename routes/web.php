<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/contact', function () {
    return view('contact');
});

Route::get('/jobs', [jobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::get('/jobs/{job}', [jobController::class, 'show']);
Route::post('/jobs', [jobController::class, 'store']);
Route::get('/jobs/{job}/edit', [jobController::class, 'edit']);
Route::patch('/jobs/{job}', [jobController::class, 'update']);
Route::delete('/jobs/{job}', [jobController::class, 'destroy']);
