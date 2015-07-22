<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountsBalancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accounts_balances', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('co_id');
            $table->integer('debit');
            $table->integer('credit');
            $table->integer('user_id');

            $table->string('notes');
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
		Schema::drop('accounts_balances');
	}

}
