<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' => [
            [
                'id' => 1, 'title' => 'Software Engineer',
                'salary' => '$120,000',
            ],
            [
                'id' => 2, 'title' => 'Data Scientist',
                'salary' => '$130,000',
            ],
            [
                'id' => 3, 'title' => 'Product Manager',
                'salary' => '$140,000',
            ],
        ],
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    $jobs = [
        [
            'id' => 1, 'title' => 'Software Engineer',
            'salary' => '$120,000',
        ],
        [
            'id' => 2, 'title' => 'Data Scientist',
            'salary' => '$130,000',
        ],
        [
            'id' => 3, 'title' => 'Product Manager',
            'salary' => '$140,000',
        ],
    ];

    $job = Arr::first($jobs, fn ($job) => $job['id'] == $id);

    return view('job', ['job' => $job]);

});

Route::get('/contact', function () {
    return view('contact');
});
