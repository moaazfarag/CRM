<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Category extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cat';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
    public function co_data()
    {
        return $this->belongsTo('Co_data','co_id');
    }
	public static $store_rules = ['name'=>'required'];
    public function items()
    {
        return $this->hasMany('Items','cat_id','id');
    }


}
