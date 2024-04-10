<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class GitHubPopularityScore extends PopularityScore
{
    protected $table = 'github_popularity_scores';

    protected $fillable = [];
    
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->fillable = array_merge($this->fillable, parent::$fillable);
    }
}