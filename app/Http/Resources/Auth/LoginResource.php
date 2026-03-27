<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		$roles = $this->roles->map(fn($role) => [
			'id'   => $role->id,
			'name' => $role->name,
			'role_type' => $role->role_type
		])->values();

		$permissions = $this->getAllPermissions()
			->pluck('name')
			->values();

		if ($roles->isEmpty() && $permissions->isEmpty()) {
			$roles = [
				[
					'id'   => 0,
					'name' => 'Sin rol',
				]
			];
			$permissions = [
				'Sin permisos',
			];
		}

		return [
			'id'              => $this->id,
			'name'            => $this->name,
			'last_name'       => $this->last_name,
			'email'           => $this->email,
			'user'            => $this->user,
			'change_password' => $this->change_password,
			'birth_date'      => $this->birth_date,
			'active'          => $this->active,
			'roles'           => $roles,
			'permissions'     => $permissions,
		];
	}
}
