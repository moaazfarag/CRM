<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/17/2015
 * Time: 4:48 PM
 */
class MonthChange extends Eloquent {

    protected $table = 'hr_monthchange';
    public static $store_rules = array(
        'trans_date'      => 'required|date',
        'trans_serial'    => 'required',
        'for_year'        => 'required',
        'for_month'       => 'required',
        'day_cost'        => 'required',
        'val'             => 'required|integer',
        'cause'           => 'required',
        'cancel_cause'    => 'required',


    );
    public static $update_rules = array(
        'trans_date'      => 'required|date',
        'trans_serial'    => 'required',
        'for_year'        => 'required',
        'for_month'       => 'required',
        'day_cost'        => 'required|integer',
        'val'             => 'required|integer',
        'cause'           => 'required',
        'cancel_cause'    => 'required',


    );
    public function loans()
    {
        return $this->belongsTo('Loans','co_id','id');
    }
}