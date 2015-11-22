<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('offer', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('co_id');
            $table->string('name');
            $table->integer('offer');
            $table->date('from');
            $table->date('to');
            $table->integer('user_id');
            $table->boolean('deleted');
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
        Schema::drop('offer');
	}

}
