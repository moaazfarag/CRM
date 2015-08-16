<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrDesDedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hr_desDed', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('ds_id');
            $table->integer('co_id');
            $table->char('name','50');
            $table->char('ds_type','50');
            $table->char('ds_cat','50');
            $table->boolean('deleted');
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
		Schema::drop('hr_desDed');
	}

}
