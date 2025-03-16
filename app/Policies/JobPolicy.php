<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;

class JobPolicy
{
    public function owner(User $user, Job $job): bool
    {
        return $job->employer->user->is($user);
    }
}
