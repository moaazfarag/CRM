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
			$table->string('true_id');
            $table->integer('co_id');
            $table->integer('user_id');
            $table->integer('br_id');
            $table->integer('invoice_no');
            $table->string('invoice_type');
            $table->integer('account')->nullable();
            $table->decimal('in_total',10,2)->nullable();
            $table->decimal('discount',10,2)->nullable();
            $table->decimal('tax',10,2)->nullable();
            $table->decimal('net',10,2)->nullable();
            $table->date('date');
            $table->string('pay_type')->nullable();
            $table->integer('deleted');
            $table->string('notes')->nullable();
            $table->string('cancel_cause')->nullable();
			$table->unique(array('invoice_no', 'invoice_type','co_id','br_id'));
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
