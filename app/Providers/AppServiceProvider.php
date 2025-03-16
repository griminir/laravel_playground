<?php

namespace App\Providers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading();

        // a way to use example Bootstrap 5 pagination styles (requires bootstrap 5)
        // Pagination::useBootstrapFive();

        Gate::define('job-owner', function (User $user, Job $job) {
            return $job->employer->user->is($user);
        });
    }
}
