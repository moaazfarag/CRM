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
			$table->string('true_id');
			$table->integer('co_id');
			$table->integer('cat_id');
			$table->string('item_name');
			$table->string('unit');
			$table->integer('supplier_id');
			$table->integer('seasons_id');
			$table->integer('models_id');
			$table->integer('marks_id');
			$table->string('bar_code');
			$table->decimal('buy',10,2);
			$table->decimal('sell_users',10,2);
			$table->decimal('sell_nos_gomla',10,2);
			$table->decimal('sell_gomla',10,2);
			$table->decimal('sell_gomla_gomla',10,2);
			$table->string('limit');
			$table->longText('notes');
			$table->integer('user_id');
            $table->decimal('avg_cost',10,2);
            $table->boolean('has_serial');
            $table->boolean('has_label');
			$table->boolean('deleted');

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
