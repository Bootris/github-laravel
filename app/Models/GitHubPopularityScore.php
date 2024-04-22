<?php

namespace App\Models;

class GitHubPopularityScore extends PopularityScore
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'git_hub_popularity_scores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'term',
        'positive_results',
        'negative_results',
        'total_results',
        'score',
        'updated_at',
        'created_at',
    ];
}
