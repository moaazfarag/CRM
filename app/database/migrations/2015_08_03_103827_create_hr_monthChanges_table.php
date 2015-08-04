<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrMonthChangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hr_monthChanges', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('empCode');
            $table->dateTime('transDate');
            $table->integer('transSerial');
            $table->integer('forYear');
            $table->integer('forMonth');
            $table->integer('desDedCode');
            $table->char('dayCost','25');
            $table->decimal('val',18,2);
            $table->char('cause','200');
            $table->integer('userId');
            $table->boolean('canceled');
            $table->char('cancelCause');
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
		Schema::drop('hr_monthChanges');
	}

}
