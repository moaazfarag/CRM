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
            $table->integer('employee_id');
            $table->integer('co_id');
            $table->integer('des_ded');
            $table->decimal('val',18 ,2);
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
		Schema::drop('hr_empDesDed');
	}

}
