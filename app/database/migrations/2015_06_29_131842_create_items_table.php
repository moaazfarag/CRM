<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('items', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->string('co_id');
			$table->string('cat_code');
			$table->string('item_name');
			$table->string('unit');
			$table->string('supplier');
			$table->string('season');
			$table->string('mark');
			$table->string('model');
			$table->string('bar_code');
			$table->float('buy');
			$table->float('sell_users');
			$table->float('sell_nos_gomla');
			$table->float('sell_gomla');
			$table->float('sell_gomla_gomla');
			
			$table->string('limit');
			$table->longText('notes');
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
		Schema::drop('items');
	}

}
