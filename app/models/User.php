<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');



    public function branch()

    {
        return $this->hasMany('Branches','user_id');
    }

    public function cat()

    {
        return $this->hasMany('Cat','user_id');
    }

    public function seasons()

    {
        return $this->hasMany('Seasons','user_id');
    }

    public function marks()

    {
        return $this->hasMany('Marks','user_id');
    }

    public function models()

    {
        return $this->hasMany('Models','user_id');
    }

    public function items()

    {
        return $this->hasMany('Items','user_id');
    }
    public function accounts()

    {
        return $this->hasMany('Accounts','user_id');
    }


}
