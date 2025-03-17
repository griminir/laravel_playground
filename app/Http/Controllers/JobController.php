<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Job;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index()
    {
        // this is eager loading the employer to reduce the number of queries
        // to avoid the N+1 problem
        $jobs = Job::with('employer')->latest()->simplePaginate(3);
        // from least to most performance:
        // paginate -> simplePaginate(just previous next button) -> cursorPaginate(does not let you use urls like ?page=2)

        return view('/jobs.index', [
            'jobs' => $jobs,
        ]);
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'salary' => ['required'],
        ]);

        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1,
        ]);

        // could give them the email address but Laravel will automatically grab it off the user model
        Mail::to($job->employer->user)->queue(new JobPosted($job));
        // since this is now queued it will be sent in the background, but we need to run: php artisan queue:work

        return redirect('/jobs')
            ->with('success', 'Job created successfully');
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        // authorize

        request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'salary' => ['required'],
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        return redirect('/jobs/'.$job->id);
    }

    public function destroy(Job $job)
    {
        // authorize

        $job->delete();

        return redirect('/jobs');
    }
}
