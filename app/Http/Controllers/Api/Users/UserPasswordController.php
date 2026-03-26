<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Services\Users\ResetPasswordService;
use App\Services\Users\ChangePasswordService;

class UserPasswordController extends Controller
{
	/**
	 * @OA\Post(	
	 *     path="/api/users/{user}/reset-password",
	 *     summary="Reinicia la contraseña",
	 *     tags={"Users"},
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
	public function resetPassword(User $user, ResetPasswordService $service)
	{
		return $service->execute($user->id);
	}

	/**
	 * @OA\Post(
	 *     path="/api/users/{user}/change-password",
	 *     summary="Cambia la contraseña",
	 *     tags={"Users"},
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
	public function changePassword(User $user, ChangePasswordRequest $request, ChangePasswordService $service)
	{
		return $service->execute($user->id, $request);
	}
}
