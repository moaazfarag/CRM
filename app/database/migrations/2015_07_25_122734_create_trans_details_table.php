<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trans_details', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('trans_header_id');
            $table->integer('item_id');
            $table->integer('qty');
            $table->integer('unit_price');
            $table->integer('item_total');
            $table->integer('avg_cost');
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
		Schema::drop('trans_details');
	}

}
