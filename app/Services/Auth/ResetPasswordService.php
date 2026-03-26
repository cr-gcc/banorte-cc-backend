<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordService
{
	/**
	 * Create a new class instance.
	 */
	public function __construct()
	{
		//
	}

	public function execute($user_id)
	{
		$user = User::find($user_id);
		if (!$user) {
			return response()->json(['message' => 'Usuario no encontrado'], 404);
		}
		$password = config('auth.default_password');
		$user->password = Hash::make($password);
		$user->change_password = false;
		$user->save();
		return response()->json([
			'message' => 'Contraseña reiniciada correctamente.',
			'user' => $user
		]);
	}
}
