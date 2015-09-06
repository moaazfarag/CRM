<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrLoansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hr_loans', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('employee_id');
			$table->integer('co_id');
            $table->date('loan_date');
            $table->integer('loan_val');
            $table->date('loan_start');
            $table->date('loan_end');
            $table->integer('user_id');
            $table->integer('loan_currBal');
            $table->boolean('finish');
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
		Schema::drop('hr_loans');
	}

}
