<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('co_data', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('co_name');
			$table->string('co_logo');
			$table->mediumText('co_address');
			$table->integer('co_tel');
			$table->integer('co_mobile_1');
			$table->integer('co_mobile_2');
			$table->string('co_currency');
			$table->string('co_print_size');
			$table->boolean('co_use_serial');
			$table->boolean('co_supplier_must');
			$table->boolean('co_use_season');
			$table->boolean('co_use_markes_models');
			$table->string('co_statues');
			$table->string('co_expiration_date');
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
		Schema::drop('co_data');
	}

}
