<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrMSHeaderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hr_MSHeader', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('empCode');
            $table->integer('forYear');
            $table->integer('forMonth');
            $table->decimal('fixedSalary',18,2);
            $table->decimal('deserves',18,2);
            $table->decimal('deductions',18,2);
            $table->decimal('loan',18,2);
            $table->decimal('net',18,2);
            $table->boolean('gotSal');
            $table->dateTime('selDate');
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
		Schema::drop('hr_MSHeader');
	}

}
