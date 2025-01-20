<?php

namespace App\Traits;

trait ApiResponseTrait{

    /**
     * Send success response
     */
    public function sendSuccess(mixed $data, $message, int $code = 200){
        
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Send error response
     */
    public function sendError($message, int $code = 400, mixed $data = null){
        
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function sendValidationError($message, int $code = 422, array $errors){
        
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}