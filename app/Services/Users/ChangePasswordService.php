<?php

namespace App\Services\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ChangePasswordService
{
	public function __construct()
	{
		//
	}

	public function execute($user_id, $request)
	{
		$user = User::find($user_id);
		if (!$user) {
			return response()->json(['message' => 'Usuario no encontrado'], 404);
		}
		$user->password = Hash::make($request->password);
		$user->change_password = true;
		$user->save();
		return response()->json([
			'message' => 'Contraseña cambiada correctamente.',
			'user' => $user
		]);
	}
}
