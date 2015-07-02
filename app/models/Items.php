<?php


class Items extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'items';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

    public function co_data()
    {
        return $this->belongsTo('Co_data','co_id');
    }

    public function cat()
    {
        return $this->belongsTo('Cat','cat_id');
    }

    public function seasons()
    {
        return $this->belongsTo('Seasons','seasons_id');
    }

    public function marks()
    {
        return $this->belongsTo('Marks','marks_id');
    }

    public function models()
    {
        return $this->belongsTo('Models','models_id');
    }

}
