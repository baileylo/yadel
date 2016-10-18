<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Teapot\StatusCode\Http;

class ErrorResponse extends JsonResponse
{
    /**
     * ErrorResponse constructor.
     *
     * @param array  $errors
     * @param int    $status_code
     * @param string $message
     */
    public function __construct(
        array $errors = [],
        int $status_code = Http::BAD_REQUEST,
        string $message = '',
        array $headers = []
    ) {
        $response_data = ['status' => 'failure'];

        if ($errors) {
            $response_data['errors'] = $errors;
        }

        if ($message) {
            $response_data['message'] = $message;
        }

        parent::__construct($response_data, $status_code, $headers);
    }
}
