<?php

namespace App\Http\Controllers;

use App\Http\Requests\PopularityScoreRequest;
use App\Http\Resources\PopularityScoreResource;
use App\Interface\PopularityServiceInterface;
use App\Models\PopularityScore;

class PopularityScoreController extends Controller
{
    /**
     * Construct controller class.
     */
    public function __construct(private PopularityServiceInterface $popularityService)
    {
    }

    /**
     * Return popularity score of provided term.
     */
    public function getScore(PopularityScoreRequest $request): PopularityScoreResource
    {
        // Retrieve the search term from the request
        $term = $request->input('term');

        // Perform a database query to retrieve the popularity score for the term
        $score = PopularityScore::where('term', $term)->first();

        // If no score is found
        if ($score === null) {
            // Call service to return populatity score
            $score = $this->popularityService->calculatePopularity($term);
        }

        // Return the response in JSON format
        return new PopularityScoreResource($score);
    }
}
