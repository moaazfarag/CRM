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
			$table->mediumText('co_address');
			$table->string('co_tel');
			$table->string('co_mobile_1');
			$table->string('co_mobile_2');
			$table->string('co_carrency');
			$table->string('co_print_size');
			$table->string('co_use_seireal');
			$table->string('co_supplier_must');
			$table->string('co_use_season');
			$table->string('co_use_markes_models');
			$table->string('co_statues');
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
		Schema::drop('co_data');
	}

}
