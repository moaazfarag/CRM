<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hr_jobs', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('jobCode');
            $table->char('jobName','50');
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
		Schema::drop('hr_jobs');
	}

}