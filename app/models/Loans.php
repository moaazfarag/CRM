<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/11/2015
 * Time: 4:43 PM
 */
class Loans extends Eloquent
{

    protected $table = 'hr_loans';
    public static $store_rules = array(
        'loan_date'       => 'required|date',
        'loan_start'      => 'required|date',
        'loan_end'        => 'required|date',
        'loan_val'        => 'required|integer',
        'loan_currBal'    => 'required|integer',
    );

    public static $update_rules = array(
        'loan_date'       => 'required|date',
        'loan_start'      => 'required|date',
        'loan_end'        => 'required|date',
        'loan_val'        => 'required|integer',
        'loan_currBal'    => 'required|integer',
    );
    public function employees()
    {
//        die('sddsd');
        return $this->belongsTo('Employees','employee_id');
    }
}