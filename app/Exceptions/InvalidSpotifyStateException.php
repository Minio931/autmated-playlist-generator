<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InvalidSpotifyStateException extends \Exception
{
    protected $message;

    public function __construct($message = "State is invalid")
    {
        $this->message = $message;
        parent::__construct($message);
    }


    public function render(Request $request): JsonResponse {
        return response()->json([
            'error' => $this->message,
        ], 400);
    }
}