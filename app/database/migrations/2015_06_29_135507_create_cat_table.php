<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCatTable extends Migration {

	/**
	 * Run the migrations.
	 *	$table->string('user_id');
	 * @return void
	 */
	public function up()
	{
		Schema::create('cat', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('co_id');
			$table->string('cat_name');			
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
		Schema::drop('cat');
	}

}
