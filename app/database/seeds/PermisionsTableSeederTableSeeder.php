<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PermisionsTableSeederTableSeeder extends Seeder {

	public function run()
	{
			Permision::create([
				'name' => 'manage_users'
			]);

			Permission::create([
				'name' => 'manage_roles'
			])

			Permission::create([
				'name' => 'manage_permissions'
			]);
	}

}