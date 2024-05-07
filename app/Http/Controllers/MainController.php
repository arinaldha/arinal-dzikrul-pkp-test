<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * @OA\Info(title="Arinal Dzikrul - PKP Test", version="0.1")
 */

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="User Login",
     *     @OA\RequestBody(
     *         required=true,
     *         description="User credentials",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="email", type="string", example="user1@gmail.com", description="User email"),
     *                 @OA\Property(property="password", type="string", example="123456", description="User password"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized - Invalid credentials"
     *     )
     * )
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => [
                'token' => $token,
                'user' => $user
            ]
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     summary="User Register",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Create User",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="name", type="string", example="User App", description="User name"),
     *                 @OA\Property(property="email", type="string", example="user1@gmail.com", description="User email"),
     *                 @OA\Property(property="password", type="string", example="123456", description="User password"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful register"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     )
     * )
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => [
                'token' => $token,
                'user' => $user
            ]
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/auth/verify",
     *     summary="verify user",
     *     security={{ {"bearerAuth":{}} }},
     *     @OA\Response(response=200, description="Successful"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     *
     * @OA\SecurityScheme(
     *     type="http",
     *     securityScheme="bearerAuth",
     *     scheme="bearer",
     *     bearerFormat="JWT"
     * )
     */

    public function verify(Request $request)
    {
        $user = Auth::user();
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => [
                'user' => ['id' => $user->id, 'name' => $user->name, 'email' => $user->email]
            ]
        ]);
    }
}
