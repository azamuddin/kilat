<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class MieinstanTableSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();
		$faker = Faker::create();

		// CONFIDE
		User::create([
			'username'=> 'superadmin',
			'email'=> 'superadmin@mieinstan.com',
			'password'=> 'bismillah',
			'password_confirmation'=> 'bismillah',
			'confirmation_code'=> md5(uniqid(mt_rand(), true))
		]);
		foreach(range(1, 10) as $index)
		{
			User::create([
				'username'=> $faker->username,
				'email'=> $faker->email,
				'password' => 'bismillah',
				'password_confirmation' => 'bismillah',
				'confirmation_code'=> md5(uniqid(mt_rand(), true)),
			]);
		}


		Permision::create([
			'name' => 'manage_users'
		]);

		Permission::create([
			'name' => 'manage_roles'
		])

		Permission::create([
			'name' => 'manage_permissions'
		]);


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