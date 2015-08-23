<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/10/2015
 * Time: 6:01 PM
 */
class Job extends Eloquent
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hr_jobs';

    public function departments()
    {
        return $this->belongsTo('Department','cat_id','id');
    }
    public function employees()
    {
        return $this->belongsTo('Employees','job_id');
    }


}