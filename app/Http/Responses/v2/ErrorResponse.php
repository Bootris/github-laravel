<?php

namespace App\Http\Responses\v2;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ErrorResponse implements Responsable
{
    /**
     * Construct response class.
     */
    public function __construct(
        private string $title,
        private string $description,
        private int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR,
    ) {
    }

    /**
     * Define to response method and format data.
     */
    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: [
                'title' => $this->title,
                'description' => $this->description,
                'status' => $this->statusCode,
            ],
            status: $this->statusCode,
        );
    }
}
