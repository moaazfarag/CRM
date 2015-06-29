<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accounts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('co_id');
			
			$table->string('acc_type');
			$table->string('acc_name');
			$table->string('acc_address');
			$table->string('acc_tel');
			$table->string('acc_mobile_1');
			$table->string('acc_mobile_2');
			$table->string('acc_email');
			$table->string('acc_limit');
	
			$table->string('user_id');
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
		Schema::drop('accounts');
	}

}
