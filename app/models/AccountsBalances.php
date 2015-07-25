<?php


class AccountsBalances extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    
	protected $table = 'accounts_balances';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */


    /**
     * Store Rules
     * @var array
     */
    public static  $store_rules = array
                (
                    'debit'          => 'integer',
                    'credit'         => 'integer'
                );

    /**
     * update Rules
     * @var array
     */
    public static  $update_rules = array
                (
                    'debit'          => 'integer',
                    'credit'         => 'integer'
                );


}
