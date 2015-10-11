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
			->select(DB::raw('SUM(qty) as item_bal'), 'trans_details.item_id','trans_details.unit_price','trans_details.qty','trans_header.br_id','branches.br_name AS br_name', 'trans_header.invoice_no','trans_header.date','trans_header.invoice_type','trans_details.serial_no', 'items.*')
			->join('trans_details', 'trans_details.trans_header_id', '=', 'trans_header.id')
			->join('items', 'items.id', '=', 'trans_details.item_id')
			->join('branches', 'branches.id', '=', 'trans_header.br_id')
			->whereRaw("`invoice_type` IN ( 'buy', 'settleAdd' ,'salesReturn')")
			->groupBy('trans_details.serial_no')
			->groupBy('trans_details.item_id')
			->groupBy('trans_header.br_id')
			->groupBy('trans_header.invoice_type')
			->groupBy('trans_header.co_id');
		$itemBalance = DB::table('items_balances')
			->select(DB::raw('SUM(qty) AS item_bal'), 'items_balances.item_id','items_balances.cost AS unit_price','items_balances.qty', 'items_balances.br_id','branches.br_name AS br_name', 'items_balances.id AS invoice_no','items_balances.created_at AS date', DB::raw('"item_balance" as invoice_type'),'items_balances.serial_no', 'items.*')
			->join('items', 'items.id', '=', 'items_balances.item_id')
			->join('branches', 'branches.id', '=', 'items_balances.br_id')
			->groupBy('items_balances.br_id')
			->groupBy('items_balances.co_id')
			->groupBy('items_balances.serial_no')
			->groupBy('items_balances.item_id')
		;
		$discountQ = DB::table('trans_header')
			->select(DB::raw('SUM(qty)*-1 as item_bal'), 'trans_details.item_id','trans_details.unit_price','trans_details.qty','trans_header.br_id','branches.br_name AS br_name', 'trans_header.invoice_no','trans_header.date','trans_header.invoice_type','trans_details.serial_no', 'items.*')
			->join('trans_details', 'trans_details.trans_header_id', '=', 'trans_header.id')
			->join('items', 'items.id', '=', 'trans_details.item_id')
			->join('branches', 'branches.id', '=', 'trans_header.br_id')
			->whereRaw("`invoice_type` IN ( 'settleDiscount', 'sales','buyReturn' )")
			->groupBy('trans_details.serial_no')
			->groupBy('trans_details.item_id')
			->groupBy('trans_header.br_id')
			->groupBy('trans_header.invoice_type')
			->groupBy('trans_header.co_id')
			->union($itemBalance)
			->union($addQ)->orderBy('date');
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
