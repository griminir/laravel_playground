<?php

namespace App\Models;

use Database\Factories\EmployerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    /** @use HasFactory<EmployerFactory> */
    use HasFactory;

    /**
     * jobs all the jobs that belong to the employer
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
