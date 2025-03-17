<h2>
    {{ $job->title }} has been posted!
</h2>

<p>
    Congratulations! Your job has been posted successfully.
</p>

<p>
    <a href="{{ url('/jobs/'. $job->id) }}">View job listing</a>
</p>