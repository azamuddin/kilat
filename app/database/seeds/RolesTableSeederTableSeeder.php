<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class RolesTableSeederTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Role::create([
			'name' => 'Super Administrator'
		]);
		Role::create([
			'name' => 'Administrator'
		]);
		Role::create([
			'name' => 'User'
		]);
	}

}