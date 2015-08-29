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
			
			$table->string('acc_type')->nullable();
			$table->string('acc_name')->nullable();
			$table->string('acc_num')->nullable();
			$table->string('pricing')->nullable();
			$table->string('acc_address')->nullable();
			$table->string('acc_tel')->nullable();
			$table->string('acc_tel2')->nullable();
			$table->string('acc_commercial_registration')->nullable();
			$table->string('acc_tax_card')->nullable();
			$table->string('acc_email')->nullable();
			$table->integer('acc_limit')->nullable();
			$table->string('acc_notes')->nullable();
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
