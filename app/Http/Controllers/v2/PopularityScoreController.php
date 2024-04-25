<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\PopularityScoreRequest;
use App\Http\Resources\PopularityScoreResource;
use App\Http\Responses\v2\ErrorResponse;
use App\Http\Responses\v2\JsonApiResponse;
use App\Interface\PopularityServiceInterface;
use App\Models\PopularityScore;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

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
    public function getScore(PopularityScoreRequest $request): JsonApiResponse|ErrorResponse
    {
        // Retrieve the search term from the request
        $term = $request->input('term');

        // Perform a database query to retrieve the popularity score for the term
        $score = PopularityScore::where('term', $term)->first();

        // If no score is found
        if ($score === null) {
            try {
                // Start database transaction
                DB::transaction();

                // Call service to return populatity score
                $score = $this->popularityService->calculatePopularity($term);

                // Commit database changes
                DB::commit();
            } catch (Exception $ex) {
                // Rollback database transaction.
                DB::rollBack();

                // Return error response.
                return new ErrorResponse(
                    title: 'Bad request',
                    description: 'Error occured.',
                    statusCode: Response::HTTP_BAD_REQUEST
                );
            }
        }

        // Return the response in JSON format
        return new JsonApiResponse(
            statusCode: Response::HTTP_OK,
            message: 'Data successfully returned.',
            data: new PopularityScoreResource($score)
        );
    }
}
