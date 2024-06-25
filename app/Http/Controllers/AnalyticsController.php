<?php

namespace App\Http\Controllers;

use App\Services\AnalyticsService;
use Illuminate\Http\JsonResponse;

class AnalyticsController extends Controller
{

    public function __construct(
        private AnalyticsService $analyticsService
    ){}

    /**
     * @OA\Get(
     *     path="/api/analytics/user-analytics",
     *     summary="Get user's analytics",
     *     description="Get user's analytics",
     *     operationId="getUserAnalytics",
     *     security={
     *          {"sanctum": {}}
     *      },
     *     tags={"Analytics"},
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="average_duration",
     *                 type="float",
     *             ),
     *             @OA\Property(
     *                 property="most_listened_genres",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="genre",
     *                         type="string",
     *                     ),
     *                     @OA\Property(
     *                         property="count",
     *                         type="integer",
     *                     ),
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="average_acousticness",
     *                 type="float",
     *             ),
     *             @OA\Property(
     *                 property="average_danceability",
     *                 type="float",
     *             ),
     *             @OA\Property(
     *                 property="average_energy",
     *                 type="float",
     *             ),
     *             @OA\Property(
     *                 property="most_listened_key",
     *                 type="float",
     *             ),
     *             @OA\Property(
     *                  property="average_loudness",
     *                   type="float",
     *              ),
     *             @OA\Property(
     *                 property="most_listened_mode",
     *                 type="float",
     *             ),
     *             @OA\Property(
     *                 property="average_tempo",
     *                 type="float",
     *             ),
     *             @OA\Property(
     *                 property="most_listened_time_signature",
     *                 type="float",
     *             ),
     *
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
    public function __invoke() : JsonResponse
    {
        $userAnalytics = $this->analyticsService->gatherUserAnalyticsData();
        return response()->json($userAnalytics);
    }
}