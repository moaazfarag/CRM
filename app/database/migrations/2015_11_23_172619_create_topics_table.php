<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('topics', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('co_id');
			$table->string('title');
			$table->longText('content');
			$table->string('type');
			$table->integer('user_id');
			$table->string('statues');
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
		//
		Schema::drop('topics');

	}

}
