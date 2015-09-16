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
			->whereRaw("`invoice_type` IN ( 'buy', 'settleAdd' )")
			->select(DB::raw('SUM(qty) as item_bal'), 'trans_details.item_id', 'items.*')
			->join('trans_details', 'trans_details.trans_header_id', '=', 'trans_header.id')
			->join('items', 'items.id', '=', 'trans_details.item_id')
			->groupBy('trans_details.item_id')
			->groupBy('trans_header.br_id');
		$itemBalance = DB::table('items_balances')
			->select(DB::raw('SUM(qty) as item_bal'), 'items_balances.item_id', 'items.*')
			->join('items', 'items.id', '=', 'items_balances.item_id')
			->groupBy('items_balances.br_id')
			->groupBy('items_balances.item_id');
		$discountQ = DB::table('trans_header')->whereRaw("`invoice_type` IN ( 'settleDiscount', 'sales' )")
			->join('trans_details', 'trans_details.trans_header_id', '=', 'trans_header.id')
			->join('items', 'items.id', '=', 'trans_details.item_id')
			->union($itemBalance)
			->union($addQ)
			->select(DB::raw('SUM(qty)*-1 as item_bal'), 'trans_details.item_id', 'items.*')
			->groupBy('trans_header.br_id')
			->groupBy('trans_details.item_id');
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
