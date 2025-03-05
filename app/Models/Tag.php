<?php

namespace App\Models;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<TagFactory> */
    use HasFactory;

    public function jobs()
    {
        return $this->belongsToMany(Job::class,
            relatedPivotKey: 'job_listing_id');
    }

    // we can attach tags to a job(relatedPivotKey key) by using the method attach
    // finding the tag and then running $tag->jobs()->attach($jobId) this works the other way around as well
}
