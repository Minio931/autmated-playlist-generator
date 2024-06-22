<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class InvalidPasswordException extends Exception
{
    protected $message;

    public function __construct($message = "Password Incorrect", $code = 0, Exception $previous = null) {
        $this->message = $message;
        parent::__construct($message, $code, $previous);
    }

    public function render(): JsonResponse {
        return response()->json([
            'message' => $this->message,
        ], 400);
    }
}
