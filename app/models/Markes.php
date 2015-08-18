<?php

/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/16/2015
 * Time: 4:32 PM
 */
class Markes extends Eloquent
{

    protected $table = 'marks';



    public function model_rel()
    {
        return $this->hasMany('Models','marks_id','id');
    }
}