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
            $table->integer('dsCode');
            $table->char('dsName','50');
            $table->char('dsType','50');
            $table->char('dsCat','50');
            $table->boolean('deleted');
            $table->integer('userId');
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
