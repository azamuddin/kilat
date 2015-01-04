<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class MieInstanTableSeeder extends Seeder {

	public function run()
	{

		$this->command->info('Nyiapin peralatan masak mie instan dulu, panci, kompor, dll');
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
		$this->command->info('Nyiapin mie mentah...');
		$this->command->info('Lalu racik bumbu biar mantab mie nya');

		$superAdmin = new Role();
		$superAdmin->name = 'Super Administrator';
		$superAdmin->save();

		$admin = new Role();
		$admin->name = 'Administrator';
		$admin->save();

		$user = new Role();
		$user->name = 'User';
		$user->save();

		$this->command->info('Masukin semua bahan-bahan.. ');
		$userSuperAdmin = User::where('username', 'superadmin')->first();
		$userSuperAdmin->attachRole( $superAdmin );

		$manage_users = new Permission;
		$manage_users->name = 'manage_users';
		$manage_users->display_name = 'Manage User';
		$manage_users->save();

		$manage_roles = new Permission;
		$manage_roles->name = 'manage_roles';
		$manage_roles->display_name = 'Manage Roles';
		$manage_roles->save();

		$manage_permissions = new Permission;
		$manage_permissions->name = 'manage_permissions';
		$manage_permissions->display_name = 'Manage Permissions';
		$manage_permissions->save();

		$this->command->info('Mie hampir siap');

		$superAdmin->perms()->sync(array($manage_permissions->id, $manage_users->id, $manage_roles->id));

		$this->command->info('Alhamdulillah, mie instan siap saji.. silahkan..');

	}

}