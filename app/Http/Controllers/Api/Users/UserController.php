<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Services\Users\UserService;

class UserController extends Controller
{
	public function __construct(private UserService $userService) {}

	public function index()
	{
		return $this->userService->index();
	}

	public function store(StoreRequest $request)
	{
		return $this->userService->store($request->validated());
	}

	public function update(UpdateRequest $request, $id)
	{
		return $this->userService->update($request->validated(), $id);
	}
}
