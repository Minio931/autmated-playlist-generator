<?php

namespace App\Http\Controllers;

use App\Services\SpotifyService;
use App\Services\SpotifyUserService;
use Illuminate\Http\Request;



class SpotifyController extends Controller
{
    public function __construct(
        private readonly SpotifyService $service,
        private readonly SpotifyUserService $userService
    ) {}

    /**
     * @OA\Get(
     *     path="/api/spotify/login",
     *     summary="Login to Spotify",
     *     description="Login to Spotify",
     *     operationId="login",
     *     tags={"Spotify"},
     *     security={
     *         {"sanctum": {}}
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="url",
     *                 type="string",
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *             )
     *         )
     *     ),
     * )
     */
    public function login()
    {
        return response()->json([
            'url' => $this->service->login()
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/spotify/callback",
     *     summary="Callback from Spotify",
     *     description="Callback from Spotify",
     *     operationId="callback",
     *     tags={"Spotify"},
     *          security={
     *          {"sanctum": {}}
     *      },
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="code",
     *                 type="string",
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="token",
     *                 type="string",
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *             )
     *         )
     *     ),
     * )
     */

    public function callback(Request $request)
    {
        $token = $this->service->callback($request);
        return response()->json($token);
    }

    /**
     * @OA\Get(
     *     path="/api/spotify/user/tracks",
     *     summary="Get user's top tracks",
     *     description="Get user's top tracks",
     *     operationId="getUserTracks",
     *     security={
     *          {"sanctum": {}}
     *      },
     *     tags={"Spotify"},
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="tracks",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="track_id",
     *                         type="string",
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *             )
     *         )
     *     ),
     * )
     */
    public function getUserTracks(Request $request)
    {
        $tracks = $this->userService->getUsersTopTracks();
        return $tracks;
    }

    /**
     * @OA\Get(
     *     path="/api/spotify/user/saved-tracks",
     *     summary="Get user's saved tracks",
     *     description="Get user's saved tracks",
     *     operationId="getUserSavedTracks",
     *     security={
     *          {"sanctum": {}}
     *      },
     *     tags={"Spotify"},
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="tracks",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="track_id",
     *                         type="string",
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *             )
     *         )
     *     ),
     * )
     */

    public function getUserSavedTracks(Request $request)
    {
        $tracks = $this->userService->getUserSavedTracks();
        return $tracks;
    }

    /**
     * @OA\Get(
     *     path="/api/spotify/user/playlists",
     *     summary="Get user's playlists",
     *     description="Get user's playlists",
     *     operationId="getUserPlaylists",
     *     security={
     *          {"sanctum": {}}
     *      },
     *     tags={"Spotify"},
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="playlists",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="playlist_id",
     *                         type="string",
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *             )
     *         )
     *     ),
     * )
     */
    public function getUserTracksFromPlaylists(Request $request): array
    {
        $tracks = $this->userService->getUserTracksFromPlaylists();
        return $tracks;
    }

    /**
     * @OA\Get(
     *     path="/api/spotify/user/update-artists-genres",
     *     summary="Get user's artists genres",
     *     description="Get user's artists genres",
     *     operationId="getUserArtistsGenres",
     *     security={
     *          {"sanctum": {}}
     *      },
     *     tags={"Spotify"},
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="artists",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="artist_id",
     *                         type="string",
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *             )
     *         )
     *     ),
     * )
     */

    public function updateArtistsGenres(Request $request): \Illuminate\Http\JsonResponse
    {
        $artists = $this->userService->updateArtistsGenres();
        return response()->json($artists);
    }
}