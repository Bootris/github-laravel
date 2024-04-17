<?php
namespace App\Http\Controllers;

use App\Services\GitHubPopularityService;
use Illuminate\Http\Request;

class PopularityController 
{
    protected $service;

    public function __construct(GitHubPopularityService $service)
    {
        // Assign the passed service to the class property
        $this->service = $service;
    }

    public function getScore(Request $request)
    {
        // Access the 'term' query parameter from the request
        $term = $request->query('term');

        // Calculate the popularity score using the service
        $result = $this->service->calculatePopularity($term);

        // Return the result as a JSON response
        return response()->json($result);
       
    }
}
