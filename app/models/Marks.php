<?php


class Marks extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'marks';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

    public function co_data()
    {
        return $this->belongsTo('Co_data','co_id');
    }

//    public function marks()
//    {
//        return $this->hasMany('Models','marks_id');
//    }

}
