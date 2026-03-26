<?php

namespace App\Services\Auth;

use App\Http\Resources\Auth\LoginResource;
use Illuminate\Support\Facades\Auth;

class LoginService
{
	/**
	 * Create a new class instance.
	 */
	public function __construct()
	{
		//
	}

	public function execute($request)
	{
		$email = $request->input('email');
		$password = $request->input('password');
		$credentials = [
			'email' => $email,
			'password' => $password
		];
		if (!Auth::attempt($credentials)) {
			// Si falla, intentar con el campo 'user' (RFC)
			$credentials = [
				'user' => $email,
				'password' => $password
			];
			if (!Auth::attempt($credentials)) {
				return response()->json(['message' => 'Credenciales inválidas'], 401);
			}
		}
		//	Obtiene el usuario y creación de token
		$user = Auth::user();
		$token = $user->createToken('auth_token_bnt_cc')->plainTextToken;
		//	Creacion de cookie
		$cookie = cookie(
			'access_token',
			$token,
			60 * 24,
			'/',
			null,
			false,
			true,
			false,
			'Lax'
		);
		return response()->json(['user' => new LoginResource($user)])->cookie($cookie);
	}
}
