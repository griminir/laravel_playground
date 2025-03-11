<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/jobs', function () {
    // this is eager loading the employer to reduce the number of queries
    // to avoid the N+1 problem
    $jobs = Job::with('employer')->paginate(3);
    // from least to most performance:
    // paginate -> simplePaginate(just previous next button) -> cursorPaginate(does not let you use urls like ?page=2)

    return view('jobs', [
        'jobs' => $jobs,
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    return view('job', ['job' => Job::find($id)]);
});

Route::get('/contact', function () {
    return view('contact');
});
