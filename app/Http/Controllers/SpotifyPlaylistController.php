<?php

namespace App\Http\Controllers;

use App\Services\SpotifyPlaylistService;

class SpotifyPlaylistController
{
    public function __construct(
        private readonly SpotifyPlaylistService $spotifyPlaylistService
    ){}

    /**
     * @OA\Get(
     *     path="/api/playlists/create-playlist-for-driving",
     *     summary="Create a playlist for driving",
     *     description="Create a playlist for driving",
     *     operationId="createPlaylistForDriving",
     *     security={
     *          {"sanctum": {}}
     *      },
     *     tags={"Spotify Playlist"},
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="playlist",
     *                 type="object",
     *                 @OA\Property(
     *                     property="id",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                 ),
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
    public function createPlaylistForDriving()
    {
        return $this->spotifyPlaylistService->createPlaylistForDriving();
    }

}