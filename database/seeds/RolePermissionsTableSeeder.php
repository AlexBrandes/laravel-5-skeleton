<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolePermissionsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		try {
			Model::unguard();

			DB::table('roles')->delete();
			DB::select('ALTER TABLE roles AUTO_INCREMENT = 1');

			DB::table('permissions')->delete();
			DB::select('ALTER TABLE permissions AUTO_INCREMENT = 1');

			DB::table('permissions_roles')->delete();
			DB::select('ALTER TABLE permissions_roles AUTO_INCREMENT = 1');

			$roles = $this->createRoles();
			$permissions = $this->createPermissions();
			$this->linkRolesPermissions($roles, $permissions);
		}
		catch (\Exception $e) {
			\App\Lib\Debug::p('Line: '.$e->getLine()."\nmessage: ".$e->getMessage());
		}
	}

	protected function createRoles()
	{
		$roles = [
			[
				'id' => 1,
				'title' => 'Super Admin',
				'slug' => 'super_admin'
			],
			[
				'id' => 2,
				'title' => 'Admin',
				'slug' => 'admin'
			],
			[
				'id' => 3,
				'title' => 'User',
				'slug' => 'user'
			],
		];

		$role_arr = [];
		foreach ($roles as $role) {
			$role_arr[] = \App\DB\Role::create($role);
		}

		return $role_arr;
	}

	protected function createPermissions()
	{
		$permissions = [
			'users.create' => 'Create Users',
			'users.delete' => 'Delete Users',
			'users.edit' => 'Edit Users',
			'users.edit_role' => 'Edit User Roles',
			'admin.view' => 'View Admin Section'
		];

		$perms = [];
		foreach ($permissions as $slug => $title) {
			$perms[] = \App\DB\Permission::create([
				'slug' => $slug,
				'title' => $title
			]);
		}

		return $perms;
	}

	/**
	 * Create the links between roles and permissions
	 **/
	protected function linkRolesPermissions($roles, $perms)
	{
		$roles_perms = [
			'super_admin' => [
				'users.create',
				'users.delete',
				'users.edit',
				'users.edit_role',
				'admin.view'
			],
			'admin' => [
				'users.create',
				'users.delete',
				'users.edit',
				'users.edit_role',
				'admin.view'
			],
			'user' => [
				
			]
		];

		foreach ($roles as $role) {
			$allowed_perms = $roles_perms[$role->slug];

			foreach ($perms as $perm) {
				if (in_array($perm->slug, $allowed_perms)) {
					$role->permissions()->save($perm);
				}
			}
		}
	}
}
