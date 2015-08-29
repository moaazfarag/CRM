<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsBalancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('items_balances', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('co_id');
            $table->integer('branch_id');
            $table->integer('item_id');
            $table->integer('user_id');
            $table->string('bar_code');
            $table->integer('qty');
            $table->float('cost');
            $table->string('serial_no');
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
		Schema::drop('items_balances');
	}

}
