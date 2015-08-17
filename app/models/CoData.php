<?php


class CoData extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'co_data';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
    public function formattedCreatedDate()
    {
        if ($this->created_at->diffInDays() > 15)
        {
            return  $this->created_at->toFormattedDateString();
        } else {
            return $this->created_at->diffForHumans();
        }
    }

    public function branches()
    {
        return $this->hasMany('Branches','co_id');
    }

    public function cat()
    {
        return $this->hasMany('Cat','co_id');
    }

    public function seasons()
    {
        return $this->hasMany('Seasons','co_id');
    }

    public function marks()
    {
        return $this->hasMany('Markes','co_id');
    }

    public function models()
    {
        return $this->hasMany('Models','co_id');
    }

    public function items()
    {
        return $this->hasMany('Items','co_id');
    }

    public function accounts()
    {
        return $this->hasMany('Accounts','co_id');
    }

    public function users()
    {
        return $this->hasMany('User','co_id');
    }

    public function employees()
    {
        return $this->hasMany('Employees','co_id');
    }

    public function departments()
    {
        return $this->hasMany('Dep','co_id');
    }

    public function jobs()
    {
        return $this->hasMany('Job','co_id');
    }
}
