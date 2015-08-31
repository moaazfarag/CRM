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
        'trans_date'      => 'required|date',
//        'trans_serial'    => 'required',
        'for_year'        => 'required',
        'for_month'       => 'required',
        'day_cost'        => 'required',
        'val'             => 'required|integer',
        'cause'           => 'required',
        'cancel_cause'    => 'required',


    );
    public static $update_rules = array(
        'trans_date'      => 'required|date',
//        'trans_serial'    => 'required',
        'for_year'        => 'required',
        'for_month'       => 'required',
        'day_cost'        => 'required',
        'val'             => 'required|integer',
        'cause'           => 'required',
        'cancel_cause'    => 'required',


    );
    public function loans()
    {
        return $this->belongsTo('Loans','co_id','id');
    }
    public function desded()
    {
        return $this->belongsTo('Deduction','desded_id');
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