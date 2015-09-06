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
		Schema::create('hr_ms_header', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('co_id');
            $table->integer('ms_trans_id');
            $table->integer('employee_id');
            $table->integer('for_year');
            $table->integer('for_month');
            $table->decimal('fixed_salary',18,2);
            $table->decimal('deserves',18,2);
            $table->decimal('deductions',18,2);
            $table->decimal('loan',18,2);
            $table->decimal('net',18,2);
            $table->boolean('got_sal');
            $table->dateTime('sel_date');
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
		Schema::drop('hr_ms_header');
	}

}
