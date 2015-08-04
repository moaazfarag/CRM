<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmpDesDedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hr_empDesDed', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('empCode');
            $table->integer('desDed');
            $table->decimal('val',18 ,2);
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
		Schema::drop('hr_empDesDed');
	}

}
