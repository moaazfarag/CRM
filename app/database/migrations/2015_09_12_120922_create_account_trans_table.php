<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTransTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('account_trans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('co_id');
			$table->integer('br_id');
			$table->integer('user_id');
			$table->integer('account_id');
			$table->integer('trans_id');
			$table->string('trans_type');
			$table->decimal('debit',10,2);
			$table->decimal('credit',10,2);
//			$table->decimal('trans_val',10,2);
			$table->date('date');
			$table->string('pay_type');
			$table->string('account');
			$table->string('type');
			$table->string('notes');
			$table->boolean('deleted');
//			$table->unique(array('co_id', 'invoice_type','co_id'));
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
		Schema::drop('account_trans');
	}

}
