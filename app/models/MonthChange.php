<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/17/2015
 * Time: 4:48 PM
 */
class MonthChange extends Eloquent {

    protected $table = 'hr_monthchanges';
    public static $store_rules = array(
//        employee_id ds_id trans_date for_month for_year day_cost val

        'employee_id'     => 'required',
        'ds_id'           => 'required',
        'trans_date'      => 'required|date',
        'for_year'        => 'required',
        'for_month'       => 'required',
        'day_cost'        => 'required',
        'val'             => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
    );
    public static $update_rules = array(
        'employee_id'     => 'required',
        'ds_id'           => 'required',
        'trans_date'      => 'required|date',
        'for_year'        => 'required',
        'for_month'       => 'required',
        'day_cost'        => 'required',
        'val'             => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'cause'           => 'required',
        'cancel_cause'    => 'required',


    );
    public function loans()
    {
        return $this->belongsTo('Loans','co_id','id');
    }
    public function desded()
    {
        return $this->belongsTo('Deduction','des_ded_id');
    }
    public function employees()
    {
        return $this->belongsTo('Employees','employee_id');
    }
    public function users()
    {
        return $this->belongsTo('User','user_id');
    }
}