<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;

class MeService
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
		return response()->json($user);
	}
}
