<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;

class LogoutService
{
	/**
	 * Create a new class instance.
	 */
	public function __construct()
	{
		//
	}

	public function execute()
	{
		$user = Auth::user();
		$user->currentAccessToken()->delete();
		return response()->json([
			'message' => 'Logout exitoso',
		]);
	}
}
