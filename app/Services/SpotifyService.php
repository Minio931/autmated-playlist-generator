<?php

namespace App\Services;

use App\Exceptions\InvalidSpotifyStateException;
use App\Exceptions\SpotifyAccessTokenNotSetException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;

class SpotifyService
{
    protected Session $session;
    protected SpotifyWebAPI $spotifyAPI;
    protected $generatedState;
    public function __construct()
    {
        $this->session = new Session(
            config('spotify.client_id'),
            config('spotify.client_secret'),
            config('spotify.redirect_uri')
        );

        $this->spotifyAPI = new SpotifyWebAPI();
    }

    public function login()
    {
        $this->generatedState = $this->session->generateState();
        $options = [
            'scope'=> [
                'playlist-read-private',
                'playlist-modify-public',
                'user-follow-read',
                'user-follow-modify',
                'user-read-private',
                'user-read-recently-played',
                'user-top-read',
                'user-library-read',
            ]
        ];
        return $this->session->getAuthorizeUrl($options);
    }

    public function callback(Request $request): JsonResponse
    {
        $state = $request->get('state');
        if($state !== $this->generatedState) {
            throw new InvalidSpotifyStateException();
        }

        $this->session->requestAccessToken($request->get('code'));

        $accessToken = $this->session->getAccessToken();
        $refreshToken = $this->session->getRefreshToken();

        session([
            'spotify_access_token' => $accessToken,
            'spotify_refresh_token' => $refreshToken,
        ]);

        return response()->json([
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
        ]);
    }

    public function getApi(): SpotifyWebAPI
    {
        $this->spotifyAPI = new SpotifyWebAPI();
        if(!session()->has('spotify_access_token')) {
            throw new SpotifyAccessTokenNotSetException();
        }
        $this->spotifyAPI->setAccessToken(session('spotify_access_token'));
        return $this->spotifyAPI;
    }

    public function getUser()
    {
        return $this->getApi()->me();
    }
}