<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewMakerName extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        $addQ = DB::table('trans_header')
            ->viewMake()
            ->whereRaw("`invoice_type` IN ( 'buy', 'settleAdd' ,'salesReturn','itemBalance')");
        $discountQ = DB::table('trans_header')
            ->viewMake('*-1')
            ->whereRaw("`invoice_type` IN ( 'settleDown', 'sales','buyReturn' )")
            ->union($addQ);
        DB::statement('CREATE OR REPLACE VIEW items_balance AS' . $discountQ->toSql());

	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
