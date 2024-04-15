<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class GitHubPopularityScore extends PopularityScore
{
    protected $table = 'git_hub_popularity_scores';

    protected $fillable = [
        'term',
        'positive_results',
        'negative_results',
        'total_results',
        'score',
    ];
}