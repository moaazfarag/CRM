<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/24/2015
 * Time: 1:00 PM
 */
class MsHeader extends Eloquent
{

    protected $table = 'hr_ms_header';

    public function employees()
    {
        return $this->belongsTo('Employees','employee_id');
    }



   public static $store_rules = array(

        'for_month'=>'required',
        'for_year'=>'required',
        'employee_id'=>'required',

        );

    /**
     *
     * @return mixed
     * return   got salary for
     * base on entered year and month
     */
    public static function hasSalary(){
        return self::company()->where('for_month',Input::get('for_month'))
            ->where('for_year',Input::get('for_year'));
    }
    public function details(){
        return $this->hasMany('MsDetails','ms_header_id','ms_trans_id');
    }
    public function employee(){
        return $this->hasOne('Employees','id','employee_id');
    }

}