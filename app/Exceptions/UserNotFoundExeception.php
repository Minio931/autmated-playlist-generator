<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserNotFoundExeception extends \Exception
{
    protected $message;

    public function __construct($message = "User Not Found")
    {
        $this->message = $message;
        parent::__construct($message);
    }


    public function render(Request $request): JsonResponse {
        return response()->json([
            'error' => $this->message,
        ], 404);
    }
}