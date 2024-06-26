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

    /**
     * @OA\Get(
     *     path="/api/playlists/create-playlist-for-working",
     *     summary="Create a playlist for working",
     *     description="Create a playlist for working",
     *     operationId="createPlaylistForWorking",
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
    public function createPlaylistForWorking()
    {
        return $this->spotifyPlaylistService->createPlaylistForWorking();
    }

    /**
     * @OA\Get(
     *     path="/api/playlists/create-playlist-for-reading",
     *     summary="Create a playlist for reading",
     *     description="Create a playlist for reading",
     *     operationId="createPlaylistForReading",
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
    public function createPlaylistForReading()
    {
        return $this->spotifyPlaylistService->createPlaylistForReading();
    }

    /**
     *  @OA\Get(
     *     path="/api/playlists/create-playlist-for-workout",
     *     summary="Create a playlist for workout",
     *     description="Create a playlist for workout",
     *     operationId="createPlaylistForWorkout",
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
    public function createPlaylistForWorkout()
    {
        return $this->spotifyPlaylistService->createPlaylistForWorkout();
    }

    /**
     * @OA\Get(
     *     path="/api/playlists/create-playlist-from-recommendations",
     *     summary="Create a playlist from recommendations",
     *     description="Create a playlist from recommendations",
     *     operationId="createPlaylistFromRecommendations",
     *     security={
     *          {"sanctum": {}}
     *      },
     *     tags={"Spotify Playlist"},
     *     @OA\Parameter(
     *         name="recommendations",
     *         in="query",
     *         description="Recommendations type",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             enum={"driving", "workout", "reading", "work"}
     *         )
     *     ),
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
    public function createPlaylistFromRecommendations()
    {
        return $this->spotifyPlaylistService->createPlaylistFromRecommendations();
    }

}