<?php
declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Teapot\StatusCode\Http;

class SuccessResponse extends JsonResponse
{
    public function __construct(
        array $data = [],
        int $status_code = Http::OK,
        string $message = '',
        array $headers = []
    ) {
        $response_data = ['status' => 'success'];

        if ($data) {
            $response_data['data'] = $data;
        }

        if ($message) {
            $response_data['message'] = $message;
        }

        parent::__construct($response_data, $status_code, $headers);
    }
}
