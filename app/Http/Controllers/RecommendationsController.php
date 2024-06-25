<?php

namespace App\Http\Controllers;

use App\Services\RecommendationsService;

class RecommendationsController extends Controller
{
    public function __construct(
        private RecommendationsService $recommendationsService
    ){}

    /**
     * @OA\Get(
     *     path="/api/recommendations/base-recommendations",
     *     summary="Get recommendations",
     *     description="Get recommendations",
     *     operationId="getRecommendations",
     *     security={
     *          {"sanctum": {}}
     *      },
     *     tags={"Recommendations"},
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="recommendations",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="seed_genres",
     *                         type="array",
     *                         @OA\Items(
     *                             type="string",
     *                         ),
     *                     ),
     *                     @OA\Property(
     *                         property="seed_artists",
     *                         type="array",
     *                         @OA\Items(
     *                             type="string",
     *                         ),
     *                     ),
     *                     @OA\Property(
     *                         property="target_genres",
     *                         type="array",
     *                         @OA\Items(
     *                             type="string",
     *                         ),
     *                     ),
     *                 )
     *             ),
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
    public function getRecommendations()
    {
        return $this->recommendationsService->getRecommendations();
    }


}