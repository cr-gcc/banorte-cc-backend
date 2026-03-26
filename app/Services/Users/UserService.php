<?php

namespace App\Services\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
	/**
	 * Create a new class instance.
	 */
	public function __construct()
	{
		//
	}

	public function index()
	{
		return User::all();
	}

	public function store($data)
	{
		$password = config('auth.default_password');
		$data['password'] = Hash::make($password);
		return User::create($data);
	}

	public function update($data, $id)
	{
		$user = User::find($id);
		$user->update($data);
		return $user;
	}
}
