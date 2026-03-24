<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginUser;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	/**
	 * @OA\Get(
	 *     path="/api/version",
	 *     summary="Obtiene la versión de la API",
	 *     tags={"Auth"},
	 *     @OA\Response(
	 *         response=200,
	 *         description="Versión de la API",
	 *         @OA\JsonContent(
	 *             @OA\Property(property="system", type="string", example="Banorte CC API"),
	 *             @OA\Property(property="version", type="string", example="1.0.0")
	 *         )
	 *     )
	 * )
	 */
	public function version()
	{
		return response()->json([
			'system' => 'Banorte CC API',
			'version' => '1.0.0'
		]);
	}

	/**
	 * @OA\Get(
	 *     path="/api/auth/me",
	 *     summary="Obtiene el usuario autenticado",
	 *     tags={"Auth"},
	 *     security={{"sanctum":{}}},
	 *     @OA\Response(
	 *         response=200,
	 *         description="Usuario autenticado",
	 *         @OA\JsonContent(
	 *             @OA\Property(property="user", type="object",
	 *                 @OA\Property(property="id", type="integer", example=1),
	 *                 @OA\Property(property="name", type="string", example="John Doe"),
	 *                 @OA\Property(property="email", type="string", example="[EMAIL_ADDRESS]")
	 *             )
	 *         )
	 *     )
	 * )
	 */
	public function me()
	{
		$user = Auth::user();
		return response()->json($user);
	}

	/**
	 * @OA\Post(
	 *     path="/api/auth/login",
	 *     summary="Inicia sesión",
	 *     tags={"Auth"},
	 *     @OA\RequestBody(
	 *         required=true,
	 *         @OA\JsonContent(
	 *             required={"email", "password"},
	 *             @OA\Property(property="email", type="string", example="[EMAIL_ADDRESS]"),
	 *             @OA\Property(property="password", type="string", example="password")
	 *         )
	 *     ),
	 *     @OA\Response(
	 *         response=200,
	 *         description="Token de acceso",
	 *         @OA\JsonContent(
	 *             @OA\Property(property="access_token", type="string", example="1234567890"),
	 *             @OA\Property(property="token_type", type="string", example="Bearer")
	 *         )
	 *     )
	 * )
	 */
	public function login(LoginUser $request)
	{
		$identifier = $request->input('email');
		$password = $request->input('password');
		//	Primer intento de login con email
		$credentials = ['email' => $identifier, 'password' => $password];
		if (!Auth::attempt($credentials)) {
			// Si falla, intentar con el campo 'user' (RFC)
			$credentials = ['user' => $identifier, 'password' => $password];
			if (!Auth::attempt($credentials)) {
				return response()->json(['message' => 'Credenciales inválidas'], 401);
			}
		}
		$user = Auth::user();
		$token = $user->createToken('auth_token_bnt_cc')->plainTextToken;
		return response()->json([
			'user' => $user,
			'access_token' => $token,
			'token_type' => 'Bearer',
		]);
	}

	/**
	 * @OA\Post(
	 *     path="/api/auth/logout",
	 *     summary="Cierra sesión",
	 *     tags={"Auth"},
	 *     security={{"sanctum":{}}},
	 *     @OA\Response(
	 *         response=200,
	 *         description="Sesión cerrada correctamente",
	 *         @OA\JsonContent(
	 *             @OA\Property(property="message", type="string", example="Sesión cerrada correctamente")
	 *         )
	 *     )
	 * )
	 */
	public function logout()
	{
		Auth::user()->currentAccessToken()->delete();
		return response()->json([
			'message' => 'Sesión cerrada correctamente',
		]);
	}
}
