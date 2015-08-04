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
		Schema::create('hr_MSDetails', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('empCode');
            $table->integer('forYear');
            $table->integer('forMonth');
            $table->integer('desDedCode');
            $table->char('desDedType','50');
            $table->decimal('desDedVal',18,2);

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
		Schema::drop('hr_MSDetails');
	}

}
