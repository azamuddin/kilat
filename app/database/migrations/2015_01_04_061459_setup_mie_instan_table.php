<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class SetupMieInstanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//CONFIDE
		// Creates the users table
        Schema::create('users', function ($table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('confirmation_code');
            $table->string('remember_token')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->timestamps();
        });

        // Creates password reminders table
        Schema::create('password_reminders', function ($table) {
            $table->string('email');
            $table->string('token');
            $table->timestamp('created_at');
        });

        //ENTRUST
        // Creates the roles table
        Schema::create('roles', function ($table) {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Creates the assigned_roles (Many-to-Many relation) table
        Schema::create('assigned_roles', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles');
        });

        // Creates the permissions table
        Schema::create('permissions', function ($table) {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->timestamps();
        });

        // Creates the permission_role (Many-to-Many relation) table
        Schema::create('permission_role', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on('permissions'); // assumes a users table
            $table->foreign('role_id')->references('id')->on('roles');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('password_reminders');
        Schema::drop('users');
	}

}
