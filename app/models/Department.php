<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/10/2015
 * Time: 3:49 PM
 */
class Department extends Eloquent
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hr_departments';

    public static $ruels = array(

        'name'=>'required'
    );
    public function employee()
    {
        return $this->hasMany('Employees','cat_id','id');
    }
    public function employees()
    {
        return $this->belongsTo('Employees','department_id');
    }
    public function hr_jobs()
    {
        return $this->hasMany('Job','cat_id','id');
    }


}