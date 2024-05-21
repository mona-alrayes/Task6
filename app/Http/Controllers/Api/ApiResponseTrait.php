<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait 
{
    /**
     * Standardize API responses.
     *
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function apiResponse($data=null, string $message, int $status): JsonResponse
    {

        $array = [
            'data' => $data,
            'message' => $message,
            'status' => $status,
        ];

        return response()->json($array, $status);
    }
}
