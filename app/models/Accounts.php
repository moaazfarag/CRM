<?php


class Accounts extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'accounts';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

    public $account_rule = array(


    );
    public function co_data()
    {
        return $this->belongsTo('Co_data','co_id');
    }


    public static function ruels($type){

        $ruels              = array();
        $ruels['acc_name']  = 'required';
        $ruels['acc_email'] = 'email';
        $ruels['acc_limit'] = 'numeric';

        $account_group = array('customers','suppliers');

        if(in_array($type,$account_group)){

            $ruels['pricing'] = 'required';
        }
//        var_dump($ruels);die();
        return $ruels;
    }

    public static $store_direct_movement = array(

        "movement_date" =>"required",
        "of_account"    =>"required",
        "prise"         =>"required",
        "prise_type"    =>"required",
        "note"          =>"",

    );
}
