<?php

namespace App\Services;

use App\Interface\PopularityServiceInterface;
use App\Models\PopularityScore;
use App\Support\Enums\ProviderType;
use GuzzleHttp\Client;

class GitHubPopularityService implements PopularityServiceInterface
{
    /**
     * Define http client.
     */
    protected $client;

    /**
     * Construct the class.
     */
    public function __construct()
    {
        // Instantiate Guzzle HTTP client
        $this->client = new Client([
            'base_uri' => 'https://api.github.com/',
        ]);
    }

    /**
     * Calculate popularity of provided term.
     */
    public function calculatePopularity(string $term): PopularityScore
    {
        // Define queries for "rocks" and "sucks" phrases
        $queries = [
            'rocks' => $term.' rocks',
            'sucks' => $term.' sucks',
        ];

        // Initialize counters
        $positiveResults = 0;
        $negativeResults = 0;

        // Loop through the queries
        foreach ($queries as $key => $query) {
            // Make the API request
            $response = $this->client->get('/search/issues', [
                'query' => [
                    'q' => $query,
                    'per_page' => 100, // Max results per page
                ],

            ]);

            // Decode the response to get the total count
            $data = json_decode($response->getBody(), true);
            $totalCount = $data['total_count'];

            // Update counters based on the key (rocks/sucks)
            if ($key === 'rocks') {
                $positiveResults = $totalCount;
            } else {
                $negativeResults = $totalCount;
            }
        }

        // Calculate total results
        $totalResults = $positiveResults + $negativeResults;

        // Calculate popularity score
        $score = ($totalResults > 0) ? ($positiveResults / $totalResults) * 10 : 0;

        // Save data to the database
        $popularityScore = new PopularityScore([
            'term' => $term,
            'positive_results' => $positiveResults,
            'negative_results' => $negativeResults,
            'total_results' => $totalResults,
            'score' => round($score, 2),
            'provider' => ProviderType::GITHUB,
        ]);

        $popularityScore->save();

        // Return the calculated score
        return $popularityScore;
    }
}
