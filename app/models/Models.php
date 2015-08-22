<?php


class Models extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'models';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

//    public function co_data()
//    {
//        return $this->belongsTo('CoData','co_id');
//    }

    public function getMarkName(){

        $mark_name = Markes::where('id','=',$this->marks_id)->first();
        if(!empty($mark_name))
        return $mark_name->name;
        else
        return "no name ";
    }


    public function markes()
    {
        return $this->belongsTo('Markes','id');
    }




}
