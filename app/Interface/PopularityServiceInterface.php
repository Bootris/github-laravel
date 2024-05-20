<?php

namespace App\Interface;

use App\Models\PopularityScore;

interface PopularityServiceInterface
{
    /**
     * Calculate popularity of provided term.
     */
    public function calculatePopularity(string $term): PopularityScore;
}
