<?php


class Branches extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'branches';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public static $store_rules = array(
		'branch_name'	 =>'required',
		'branch_address' =>'required',
	);
    public function co_data()
    {
        return $this->belongsTo('Co_data','co_id');
    }

}
