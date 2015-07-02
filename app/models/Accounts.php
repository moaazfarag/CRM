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
    public function co_data()
    {
        return $this->belongsTo('Co_data','co_id');
    }

}
