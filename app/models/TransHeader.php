<?php


class TransHeader extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    
	protected $table = 'trans_header';

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
                    'discount'       => 'integer',
                    'tax'            => 'integer'
                );
//
//    /**
//     * update Rules
//     * @var array
//     */
//    public static  $update_rules = array
//                (
//                    'debit'          => 'integer',
//                    'credit'         => 'integer'
//                );


}
