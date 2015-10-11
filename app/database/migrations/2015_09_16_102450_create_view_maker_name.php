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
			->select(DB::raw('SUM(qty) as item_bal'), 'trans_details.item_id','trans_header.br_id','trans_details.serial_no', 'items.*')
			->join('trans_details', 'trans_details.trans_header_id', '=', 'trans_header.id')
			->join('items', 'items.id', '=', 'trans_details.item_id')
			->whereRaw("`invoice_type` IN ( 'buy', 'settleAdd' ,'salesReturn')")
			->groupBy('trans_details.serial_no')
			->groupBy('trans_details.item_id')
			->groupBy('trans_header.br_id');
		$itemBalance = DB::table('items_balances')
			->select(DB::raw('SUM(qty) AS item_bal'), 'items_balances.item_id','items_balances.br_id','items_balances.serial_no', 'items.*')
			->join('items', 'items.id', '=', 'items_balances.item_id')
			->groupBy('items_balances.br_id')
			->groupBy('items_balances.serial_no')
			->groupBy('items_balances.item_id')
		;
		$discountQ = DB::table('trans_header')
			->select(DB::raw('SUM(qty)*-1 as item_bal'), 'trans_details.item_id','trans_header.br_id','trans_details.serial_no', 'items.*')
			->join('trans_details', 'trans_details.trans_header_id', '=', 'trans_header.id')
			->join('items', 'items.id', '=', 'trans_details.item_id')
			->whereRaw("`invoice_type` IN ( 'settleDiscount', 'sales','buyReturn' )")
			->groupBy('trans_details.serial_no')
			->groupBy('trans_details.item_id')
			->groupBy('trans_header.br_id')
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
