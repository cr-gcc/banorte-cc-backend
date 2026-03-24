<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		app()[PermissionRegistrar::class]->forgetCachedPermissions();

		$roles = [
			'Super-Admin',
			'Gerente-OP',
			'Coordinador-QA/VAL',
			'Analista-QA/VAL'
		];

		foreach ($roles as $rol) {
			Role::firstOrCreate([
				'name' => $rol,
				'guard_name' => 'sanctum',
			]);
		}

		$superAdmin = Role::where('name', 'Super-Admin')->first();
		$superAdmin->givePermissionTo(Permission::all());
	}
}
