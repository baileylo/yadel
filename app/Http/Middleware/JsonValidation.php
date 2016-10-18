<?php

namespace App\Http\Middleware;

use App\Http\Responses\ErrorResponse;
use Illuminate\Http\{Request, Response};
use Symfony\Component\HttpFoundation\ParameterBag;
use Teapot\StatusCode;

class JsonValidation
{
    const STATUS_CODE = StatusCode::BAD_REQUEST;

    public function handle(Request $request, \Closure $next)
    {
        if (!$request->isJson()) {
            return $next($request);
        }

        $body = $request->getContent();
        $data = json_decode($body, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return new ErrorResponse([], StatusCode\Http::BAD_REQUEST, json_last_error_msg());
        }

        // Update the Request's json property
        $property = new \ReflectionProperty($request, 'json');
        $property->setAccessible(true);
        $property->setValue($request, new ParameterBag((array)$data));

        return $next($request);
    }
}
