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
			$table->integer('co_id');
            $table->integer('employee_id');
            $table->dateTime('trans_date');
            $table->integer('trans_serial');
            $table->integer('for_year');
            $table->integer('for_month');
            $table->integer('desDed_id');
            $table->char('day_cost','25');
            $table->decimal('val','10',2);
            $table->char('cause','200')->nullable();
            $table->integer('user_id');
            $table->boolean('canceled');
            $table->char('cancel_cause')->nullable();;
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
