<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_listings';

    //    protected $fillable = ['employer_id', 'title', 'salary'];
    protected $guarded = ['id'];

    /**
     * Get the employer that owns the job.
     * we do this by not calling the method employer() but by using the property employer
     * this can be chained or get the properties of the employer like employer->name
     */
    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class,
            foreignPivotKey: 'job_listing_id');
    }
}
