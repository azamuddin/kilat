<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();
		$faker = Faker::create();
		User::create([
			'username'=> 'azamuddin',
			'email'=> 'azamuddin@live.com',
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
	}

}