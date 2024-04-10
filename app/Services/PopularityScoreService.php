<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\PopularityScore;

class PopularityCalculatorService
{
    public function calculatePopularity(string $word): float
    {
        // Search GitHub issues for occurrences of the word
        $positiveResults = $this->searchGitHub('"' . $word . ' rocks"')['total_count'];
        $negativeResults = $this->searchGitHub('"' . $word . ' sucks"')['total_count'];
        
        // Calculate total results
        $totalResults = $positiveResults + $negativeResults;
        
        // Calculate the popularity score
        $score = $totalResults > 0 ? ($positiveResults / $totalResults) * 10 : 0;
        
        // Store the result in the database
        $this->storeScore($word, $positiveResults, $negativeResults, $totalResults, $score);

        return $score;
    }

    protected function searchGitHub(string $query): array
    {
        $response = Http::get('https://api.github.com/search/issues', [
            'q' => $query,
        ]);

        return $response->json();
    }

    protected function storeScore(string $word, int $positiveResults, int $negativeResults, int $totalResults, float $score): void
    {
        PopularityScore::updateOrCreate(
            ['term' => $word],
            [
                'positive_results' => $positiveResults,
                'negative_results' => $negativeResults,
                'total_results' => $totalResults,
                'score' => $score,
                'provider' => 'GitHub',
            ]
        );
    }
}
