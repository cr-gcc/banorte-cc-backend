<?php

namespace Database\Seeders;

use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		app()[PermissionRegistrar::class]->forgetCachedPermissions();

		$permissions = [
			//	Perfil
			'ver-perfil',
			//	Usuarios
			'ver-usuarios',
			'crear-usuarios',
			'editar-usuarios',
			'borrar-usuarios',
			'reset-password',
			//	Accesos (Roles y Permisos)
			'ver-accesos',
			'ver-roles',
			'crear-roles',
			'editar-roles',
			'borrar-roles',
			'ver-permisos',
			'crear-permisos',
			'editar-permisos',
			'borrar-permisos',
		];

		foreach ($permissions as $permission) {
			Permission::firstOrCreate([
				'name' => $permission,
				'guard_name' => 'sanctum',
			]);
		}
	}
}
