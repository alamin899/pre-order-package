<?php

namespace PreOrder\PreOrderBackend\Helpers;

class JsonResponder
{
    public static function response($message = 'Success', array $errors = [], array $data = [], int $statusCode = 200): \Illuminate\Http\JsonResponse
    {
        $errorData = [];
        if ($errors) {
            foreach ($errors as $index => $error) {
                $errorData[$index]['name'] = $index;
                $errorData[$index]['message'] = $error[0] ?? $error;
            }
        }
        return self::respond(message: $message, status: $statusCode, data: $data, errors: collect($errorData)->values()->toArray());
    }

    private static function respond(string $message, string|int $status = 200, array $data = [], array $errors = []): \Illuminate\Http\JsonResponse
    {
        $responseData = [
            'message' => $message,
            'data' => $data,
            'errors' => $errors,
        ];

        if($status == 0){
            $status = 200;
        }
        return response()->json($responseData, $status, [], JSON_PRESERVE_ZERO_FRACTION);
    }
}