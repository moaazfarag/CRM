<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrreateHrDepartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hr_departments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('co_id');
            $table->integer('depCode');
            $table->char('depName','50');
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
		Schema::drop('hr_departments');
	}

}
