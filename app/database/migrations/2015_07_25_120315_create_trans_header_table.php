<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransHeaderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trans_header', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('co_id');
            $table->integer('user_id');
            $table->integer('br_code');
            $table->integer('invoice_no');
            $table->string('invoice_type');
            $table->integer('account');
            $table->float('in_total');
            $table->float('discount');
            $table->float('tax');
            $table->float('net');
            $table->date('date');
            $table->string('pay_type');
            $table->integer('deleted');
			$table->unique(array('invoice_no', 'invoice_type','co_id'));
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
		Schema::drop('trans_header');
	}

}
