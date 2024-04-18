<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GitHubPopularityScore;

class GitHubPopularityScoreController 
{
    public function getScore(Request $request)
    {
        // Validate the incoming request parameters

        // dd($request);
        
        $request->validate([
            'term' => 'required|string',
        ]);

        // Retrieve the search term from the request
        $term = $request->input('term');

        // Perform a database query to retrieve the popularity score for the term
        $score = GitHubPopularityScore::where('term', $term);

        // If no score is found, return a default score of 0
        if ($score === null) {
            $score = 0;
        }

        // Prepare the response
        $response = [
            'term' => $term,
            'score' => $score,
        ];

        // Return the response in JSON format
        return response()->json($response);
    }
}

