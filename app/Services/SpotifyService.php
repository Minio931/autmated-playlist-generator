<?php

namespace App\Services;

use App\Exceptions\InvalidSpotifyStateException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;

class SpotifyService
{
    protected Session $session;
    protected SpotifyWebAPI $spotifyAPI;
    protected $generatedState;
    protected $accessToken;
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

        $this->accessToken = $this->session->getAccessToken();
        $refreshToken = $this->session->getRefreshToken();

        return response()->json([
            'access_token' => $this->accessToken,
            'refresh_token' => $refreshToken,
        ]);
    }

    public function getInfromationAboutUser()
    {
        $this->spotifyAPI->setAccessToken($this->accessToken);
        return $this->spotifyAPI->me();
    }

}