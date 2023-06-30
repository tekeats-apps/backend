<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\Response;

trait ApiResponse
{
    public function successResponse($data, $message = null, $code = Response::HTTP_OK)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function errorResponse($message, $code)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $code);
    }

    public function exceptionResponse(Exception $e, $message = null, $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        $response = [
            'success' => false,
            'message' => $message
        ];

        if (config('app.debug')) {
            $response['exception'] = $e->getMessage();
            $response['trace'] = $e->getTrace();
        }

        return response()->json($response, $code);
    }
}
