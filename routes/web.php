<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// index
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

// create
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

// show
Route::get('/jobs/{job}', function (Job $job) {
    return view('jobs.show', ['job' => $job]);
});

// store
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

// edit
Route::get('/jobs/{job}/edit', function (Job $job) {
    return view('jobs.edit', ['job' => $job]);
});

// update
Route::patch('/jobs/{job}', function (Job $job) {
    // authorize

    request()->validate([
        'title' => ['required', 'min:3', 'max:255'],
        'salary' => ['required'],
    ]);

    // update
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    // redirect to jobs page
    return redirect('/jobs/'.$job->id);
});

// destroy
Route::delete('/jobs/{job}', function (Job $job) {
    // authorize

    // delete
    $job->delete();

    // redirect to jobs page
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});
