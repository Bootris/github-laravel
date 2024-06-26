<?php

namespace Tests\Unit;

use App\Services\GitHubPopularityService;
use Tests\TestCase;

class PopularityCalculatorServiceTest extends TestCase
{
    // Test to check popularity score calculation
    public function testCalculatePopularity()
    {
        // Instantiate the service
        $service = new GitHubPopularityService();

        // Define test input
        $term = 'php';
        $positiveResults = 10; // Sample positive results
        $negativeResults = 5; // Sample negative results

        // Calculate the expected score
        $expectedScore = ($positiveResults / ($positiveResults + $negativeResults)) * 10;

        // Calculate the actual score using the service
        $actualScore = $service->calculatePopularity($term);

        // Assert that the actual score matches the expected score
        $this->assertEquals($expectedScore, $actualScore);
    }
}
