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
            $table->integer('empCode');
            $table->dateTime('loanDate');
            $table->integer('loanVal');
            $table->dateTime('loanStart');
            $table->dateTime('loanEnd');
            $table->integer('userId');
            $table->integer('loanCurrBal');
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
