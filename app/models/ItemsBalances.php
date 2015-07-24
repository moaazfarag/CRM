<?php


class ItemsBalances extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'items_balances';

	/**
	 * Store Rules
	 * @var array
	 */
    public static  $store_rules = array(

                                'item_id'          => 'integer',
                                'bar_code'         => 'min:3',
                                'qty'              => 'required|integer|min:1',
                                'cost'             => 'integer',
                                'serial_no'        => 'string'

                                        );

    /**
	 * Store Rules
	 * @var array
	 */
    public static  $update_rules = array(

                                'item_id'          => 'required|integer',
                                'bar_code'         => 'min:3',
                                'qty'              => 'required|integer|min:1',
                                'cost'             => 'integer',
                                'serial_no'        => 'string'

                                        );

}
