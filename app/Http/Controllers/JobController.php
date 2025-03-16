<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Support\Facades\Gate;

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

        Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1,
        ]);

        return redirect('/jobs')
            ->with('success', 'Job created successfully');
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function edit(Job $job)
    {
        Gate::authorize('edit-job', $job);

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
