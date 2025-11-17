<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponser
{
    protected function success(
        $data = [],
        int $code = 200,
        string $message = 'success'
    ): JsonResponse
    {
        return response()->json([
            "status" => "Success",
            'message' => $message,
            "code" => $code,
            'data' => $data
        ]);
    }

    protected function error(
        string $message,
        int $code = 400,
        array | string $trace = null,
        string $error = 'error',
        $data = []
    ): JsonResponse
    {
        $response = [
            "status" => "Error",
            "message" => $message,
            'code' => $code,
            "data" => $data,
        ];
        if(app()->environment() !== 'production'){
            $response['trace'] = $trace;
        }
        return  response()->json($response);
    }

}
