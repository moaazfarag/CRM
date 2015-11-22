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
			$table->string('true_id');
			$table->integer('co_id');
			$table->string('name');
			$table->integer('user_id');
			$table->timestamps();
		});
        Schema::create('offer', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('co_id');
            $table->string('name');
            $table->integer('offer');
            $table->date('from');
            $table->date('to');
            $table->integer('user_id');
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
		Schema::drop('cat');
		Schema::drop('offer');
	}

}
