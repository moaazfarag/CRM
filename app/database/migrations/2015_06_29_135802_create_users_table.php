<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('co_id');
			$table->integer('br_id')->nullable();
			$table->string('all_br')->nullable();
			$table->string('owner');
			$table->string('name');
			$table->string('username');
			$table->string('password');
			$table->string('management_password');
			$table->string('email')->nullable();
			$table->longText('permission');
			$table->string('photo');
			$table->boolean('deleted');
			$table->string('session_id');
			$table->rememberToken();
			$table->unique(array('username', 'co_id'));
			$table->timestamps();
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
