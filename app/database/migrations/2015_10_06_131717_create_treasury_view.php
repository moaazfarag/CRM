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
           account_trans.deleted       AS deleted,
           account_trans.notes       AS notes,
           account_trans.date       AS date
           FROM account_trans
           WHERE trans_type IN ('catch', 'pay')
           AND deleted = '0'
           UNION
           SELECT
           trans_header.co_id        AS co_id,
           trans_header.br_id        AS br_id,
           trans_header.net          AS credit,
           trans_header.net          AS debit,
           trans_header.invoice_type AS type,
           trans_header.deleted      AS deleted,
           trans_header.notes AS notes,
           trans_header.date AS date

           FROM trans_header
           WHERE pay_type = 'cash'
            AND deleted = '0' ";


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
