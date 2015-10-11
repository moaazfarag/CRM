<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreasuryView extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
  $query =  "SELECT
           account_trans.co_id      AS co_id,
           account_trans.br_id      AS br_id,
           account_trans.credit     AS credit,
           account_trans.debit      AS debit,
           account_trans.trans_type AS type,
           account_trans.date AS date
           FROM account_trans
           WHERE trans_type IN ('catch', 'pay')
           UNION
           SELECT
           trans_header.co_id        AS co_id,
           trans_header.br_id        AS br_id,
           trans_header.in_total     AS credit,
           trans_header.in_total     AS debit,
           trans_header.invoice_type AS type,
           trans_header.date AS date

           FROM trans_header
           WHERE pay_type = 'cash'";

//		$account_trans = DB::table('account_trans')
//
//				->select(
//				'co_id as co_id',
//				'br_id as br_id',
//				'credit as credit',
//				'debit as dedit',
//				'trans_type as type',
//				'date as date'
//			);
//
//		$trans_header =  DB::table('trans_header')
//
//
//			->select(
//
//				'co_id as co_id',
//				'br_id as br_id',
//				'in_total as credit',
//				'id as dedit',
//				'invoice_type as type',
//				'date as date'
//			)
//			->union($account_trans);
//
//
//	}
		DB::statement( 'CREATE OR REPLACE VIEW treasury_view AS ' .$query );
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
