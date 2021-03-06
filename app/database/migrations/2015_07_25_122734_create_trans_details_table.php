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
			$table->integer('co_id');
			$table->integer('trans_header_id');
            $table->integer('item_id');
            $table->integer('qty');
            $table->decimal('unit_price',10,2)->nullable();
            $table->decimal('item_total',10,2)->nullable();
            $table->decimal('avg_cost',10,2);
            $table->string('serial_no')->nullable();

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
