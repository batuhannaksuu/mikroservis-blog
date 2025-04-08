<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function success($data, string $message = "", int $statusCode = 200)
    {
        return [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];
    }

    public static function error(string $message, int $statusCode = 400, array $errors = [])
    {
        return [
            'success' => false,
            'message' => $message,
            'data' => null,
            'error' => $errors ?: null
        ];
    }
}
