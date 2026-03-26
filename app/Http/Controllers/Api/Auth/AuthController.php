<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Services\Auth\MeService;
use App\Services\Auth\LoginService;
use App\Services\Auth\LogoutService;
use App\Services\Auth\ResetPasswordService;
use App\Services\Auth\ChangePasswordService;

class AuthController extends Controller
{

	public function __construct() {}

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
	public function me(MeService $service)
	{
		return $service->execute();
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
	public function login(LoginRequest $request, LoginService $service)
	{
		return $service->execute($request);
	}

	/**
	 * @OA\Post(
	 *     path="/api/auth/reset-password",
	 *     summary="Reinicia la contraseña",
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
	 *         description="Contraseña reiniciada correctamente",
	 *         @OA\JsonContent(
	 *             @OA\Property(property="message", type="string", example="Contraseña reiniciada correctamente")
	 *         )
	 *     )
	 * )
	 */
	public function resetPassword(ResetPasswordRequest $request, ResetPasswordService $service)
	{
		return $service->execute($request);
	}

	/**
	 * @OA\Post(
	 *     path="/api/auth/change-password",
	 *     summary="Cambia la contraseña",
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
	 *         description="Contraseña cambiada correctamente",
	 *         @OA\JsonContent(
	 *             @OA\Property(property="message", type="string", example="Contraseña cambiada correctamente")
	 *         )
	 *     )
	 * )
	 */
	public function changePassword(ChangePasswordRequest $request, ChangePasswordService $service)
	{
		return $service->execute($request);
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
	public function logout(LogoutService $service)
	{
		return $service->execute();
	}
}
