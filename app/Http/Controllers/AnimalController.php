<?php

namespace App\Http\Controllers;

use App\Http\Responses\v2\ErrorResponse;
use App\Http\Responses\v2\JsonApiResponse;
use App\Models\Animal;
use App\Support\Enums\QuerySortDirection;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AnimalController extends Controller
{
    /**
     * Get top animals based on type and limit
     */
    public function getTopAnimals(Request $request): JsonApiResponse|ErrorResponse
    {
        $type = $request->query('type');
        $limit = $request->query('limit');

        // Validate the request
        if (! in_array($type, QuerySortDirection::names()) || ! is_numeric($limit) || $limit < 1 || $limit > 100) {
            return new ErrorResponse(
                title: 'Invalid Request',
                description: 'The provided type or limit is invalid.',
                statusCode: Response::HTTP_BAD_REQUEST
            );
        }

        // Determine the sort direction based on the type
        $sortDirection = $type === QuerySortDirection::names() ? 'DESC' : 'ASC';

        // Retrieve the top animals based on the type and limit
        $animals = Animal::orderBy('created_at', $sortDirection)
            ->limit($limit)
            ->get();

        return new JsonApiResponse(
            statusCode: Response::HTTP_OK,
            message: 'Data successfully returned.',
            data: $animals
        );
    }
}
