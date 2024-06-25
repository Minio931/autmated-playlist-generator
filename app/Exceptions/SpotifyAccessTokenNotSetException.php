<?php

namespace App\Exceptions;

class SpotifyAccessTokenNotSetException extends \Exception
{
    protected $message;

    public function __construct($message = "Spotify Access Token Not Set")
    {
        $this->message = $message;
        parent::__construct($message);
    }

    public function render(): string {
        return response()->json([
            'error' => $this->message,
        ], 401);
    }

}