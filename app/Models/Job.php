<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_listings';

    protected $fillable = ['title', 'salary'];

    /**
     * Get the employer that owns the job.
     * we do this by not calling the method employer() but by using the property employer
     * this can be chained or get the properties of the employer like employer->name
     */
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,
            foreignPivotKey: 'job_listing_id');
    }
}
