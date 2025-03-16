<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
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

        // way of creating custom gates if not using policies
        //        Gate::define('job-owner', function (User $user, Job $job) {
        //            return $job->employer->user->is($user);
        //        });
    }
}
