<?php

namespace App\Traits;

trait ApiResponse
{
    protected function success($statusCode = 200, $message = 'Success', $data = [])
    {
        return response()->json([
            'status code' => $statusCode,
            'error' => false,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    protected function error($statusCode = 500, $message = 'Error')
    {
        return response()->json([
            'status code' => $statusCode,
            'error' => true,
            'message' => $message,
        ], $statusCode);
    }
}