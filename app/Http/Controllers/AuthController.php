<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidPasswordException;
use App\Exceptions\UserNotFoundExeception;
use App\Http\Requests\UserRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService){ }

    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     operationId="registerUser",
     *     tags={"Auth"},
     *     summary="Register a new user",
     *     description="User Registration Endpoint",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"name","email","password","password_confirmation"},
     *                 @OA\Property(property="name",type="text"),
     *                 @OA\Property(property="email",type="text"),
     *                 @OA\Property(property="password",type="password"),
     *                 @OA\Property(property="password_confirmation",type="password"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="User Registered Successfully",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *       response="200",
     *       description="Registered Successfull",
     *       @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Bad Request",
     *         @OA\JsonContent()
     *     ),
     * )
     */

    public function register(UserRequest $request): JsonResponse
    {
        $user = $this->authService->register($request->all());

        return response()->json([
            'message' => 'Registered successfully',
            'user' => $user
        ]);
    }

    /**
    * @OA\Post(
     *     path="/api/auth/login",
     *     operationId="loginUser",
     *     tags={"Auth"},
     *     summary="Login to the system",
     *     description="Login to the system",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"email","password"},
     *                 @OA\Property(property="email",type="text"),
     *                 @OA\Property(property="password",type="password"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="User logged in successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *             ),
     *             @OA\Property(
     *                 property="user",
     *                 type="object",
     *            ),
     *         )
     *     ),
     * )
     */
    public function login(UserRequest $request): JsonResponse
    {
        $user = $this->authService->login($request->input('email'), $request->input('password'));

        return response()->json([
            'message' => 'User logged in successfully',
            'user' => $user
        ]);
    }

}