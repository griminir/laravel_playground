<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/jobs', function () {
    // this is eager loading the employer to reduce the number of queries
    // to avoid the N+1 problem
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    // from least to most performance:
    // paginate -> simplePaginate(just previous next button) -> cursorPaginate(does not let you use urls like ?page=2)

    return view('/jobs.index', [
        'jobs' => $jobs,
    ]);
});

Route::get('/jobs/create', function () {
    return view('jobs.create');
});

Route::get('/jobs/{id}', function ($id) {
    return view('jobs.show', ['job' => Job::find($id)]);
});

Route::post('/jobs', function () {
    request()->validate([
        'title' => ['required', 'min:3', 'max:255'],
        'salary' => ['required'],
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);

    return redirect('/jobs')
        ->with('success', 'Job created successfully');
});

Route::get('/contact', function () {
    return view('contact');
});
