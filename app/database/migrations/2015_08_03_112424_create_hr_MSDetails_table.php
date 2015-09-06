<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrMSDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hr_ms_details', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('trans_header_id');
            $table->integer('employee_id');
            $table->integer('for_year');
            $table->integer('for_month');
            $table->integer('des_ded_id');
            $table->char('des_ded_type','50');
            $table->decimal('des_ded_val',18,2);

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
		Schema::drop('hr_ms_details');
	}

}
