<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopularityScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'term',
        'positive_results',
        'negative_results',
        'total_results',
        'score',
        'provider',
        'updated_at',
        'created_at',
    ];


    /**
     * Scope a query to only include scores from a specific provider.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $provider
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByProvider($query, $provider)
    {
        return $query->where('provider', $provider);
    }
}
