<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function successResponse(array $data): \Illuminate\Http\JsonResponse
    {
        return response()->json($data, 200);
    }
    protected function errorResponse(string $message, int $code): \Illuminate\Http\JsonResponse
    {
        return response()->json(['error' => $message], $code);
    }
}
