<?php

namespace App\Http\Responses\v2;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonApiResponse implements Responsable
{
    /**
     * Construct response class.
     */
    public function __construct(
        private int $statusCode = Response::HTTP_OK,
        private string $message = 'Ok',
        private mixed $data = null
    ) {
    }

    /**
     * Define to response method and format data.
     */
    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: [
                'status' => $this->statusCode,
                'message' => $this->message,
                'data' => $this->data,
            ],
            status: $this->statusCode,
        );
    }
}
