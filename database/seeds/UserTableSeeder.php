<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		try {
			Model::unguard();

			$this->createUsers();
		}
		catch (\Exception $e) {
			\App\Lib\Debug::p('Line: '.$e->getLine()."\nmessage: ".$e->getMessage());
		}
	}

	public function createUsers()
	{
		DB::table('users')->delete();
		DB::select('ALTER TABLE users AUTO_INCREMENT = 1');

		$roles = \App\DB\Role::all()->toArray();

		if (! $roles) {
			$roles = [0];
		}

		$faker = Faker\Factory::create();

		for ($i=0; $i < 10; $i++) {
			$user = \App\DB\User::create([
				'id' => null,
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'password' => Hash::make('test1234'),
				'email' => $faker->email,
				'role_id' => $roles[rand(0, count($roles) -1)]['id'],
			]);
		}

		// Create each of the test users (user, admin, super_admin)
		foreach ($roles as $role) {
			\App\DB\User::create([
				'first_name' => $role['title'],
				'last_name' => '',
				'password' => Hash::make(strtolower($role['title'])),
				'email' => strtolower(str_replace(' ','', $role['title'])).'@example.com',
				'role_id' => $role['id'],
			]);
		}
	}

}
