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
			$table->integer('co_id');
			
			$table->string('acc_type');
			$table->string('acc_name');
			$table->string('acc_num');
			$table->string('acc_address');
			$table->string('acc_tel');
			$table->string('acc_commercial_registration');
			$table->string('acc_tax_card');
			$table->string('acc_email');
			$table->integer('acc_limit');
			$table->string('acc_notes');
			$table->integer('user_id');
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
