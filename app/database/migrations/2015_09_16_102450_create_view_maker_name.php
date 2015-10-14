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
            ->whereRaw("`invoice_type` IN ( 'buy', 'settleAdd' ,'salesReturn')");
        $itemBalance = DB::table('items_balances')
            ->select(DB::raw('SUM(qty) AS item_bal'), 'items_balances.item_id','items_balances.cost AS unit_price','items_balances.qty', 'items_balances.br_id','branches.br_name AS br_name', 'items_balances.id AS invoice_no','items_balances.created_at AS date', DB::raw('"item_balance" as invoice_type'),'items_balances.serial_no', 'items.*')
            ->join('items', 'items.id', '=', 'items_balances.item_id')
            ->join('branches', 'branches.id', '=', 'items_balances.br_id')
            ->groupBy('items_balances.br_id','items_balances.co_id','items_balances.serial_no','items_balances.item_id');
        $discountQ = DB::table('trans_header')
            ->viewMake('*-1')
            ->whereRaw("`invoice_type` IN ( 'settleDown', 'sales','buyReturn' )")
            ->union($itemBalance)
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
