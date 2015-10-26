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
			$table->boolean('co_id');
			$table->integer('br_id');
			$table->string('all_br');
			$table->string('owner');
			$table->string('name');
			$table->string('username');
			$table->string('password',255);
			$table->string('email')->unique();
			$table->string('permission');
			$table->string('photo');
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
