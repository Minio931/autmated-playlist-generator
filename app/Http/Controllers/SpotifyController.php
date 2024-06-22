<?php

namespace App\Http\Controllers;

use App\Services\SpotifyService;
use Illuminate\Http\Request;

class SpotifyController extends Controller
{
    public function __construct(private readonly SpotifyService $service) {}

    /**
     * @OA\Get(
     *     path="/api/spotify/login",
     *     summary="Login to Spotify",
     *     description="Login to Spotify",
     *     operationId="login",
     *     tags={"spotify"},
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
     *     tags={"spotify"},
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
     *     path="/api/spotify/me",
     *     summary="Get user information",
     *     description="Get user information",
     *     operationId="me",
     *     tags={"spotify"},
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="id",
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
    public function getUserInfo()
    {
        return response()->json($this->service->getInfromationAboutUser());
    }

}