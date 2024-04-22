<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class IncorrectProviderException extends HttpResponseException
{
    /**
     * Construct the parent and child class.
     */
    public function __construct()
    {
        parent::__construct(self::createResponse());
    }

    /**
     * Generate custom response.
     */
    public function createResponse(): Response
    {
        return response()->json([
            'data' => [
                'status' => $this->getStatusCode(),
                'message' => $this->getExceptionMessage(),
                'errors' => [],
            ],
        ], $this->getStatusCode());
    }

    /**
     * Return status code.
     */
    public function getStatusCode(): int
    {
        return Response::HTTP_UNAVAILABLE_FOR_LEGAL_REASONS;
    }

    /**
     * Define exception message.
     */
    public function getExceptionMessage(): string
    {
        return 'Incorrect provider detected by system.';
    }
}
