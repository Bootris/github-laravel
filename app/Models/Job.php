<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_listings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 
        'salary', 
        'employer_id'
    ];

    /**
     * Get the employeer that owns the job.
     */
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    /**
     * Search for course title or subject name
     * @param $query
     * @param $searchTerm Course Title or Subject Name
     * @return mixed
     */
    public function scopeSearch($query, $searchTerm) {
        return $query
            ->where('title', 'like', "%" . $searchTerm . "%")
            ->orWhere('salary', 'like', "%" . $searchTerm . "%");
    }

}
