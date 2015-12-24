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
    public static $rules = array(
        'employee_id'     => 'required',
        'loan_date'       => 'required|date',
        'loan_start'      => 'required|date',
        'loan_currBal'    => 'required|date',
        'loan_val'        => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        'loan_currBal'    => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
    );

    public function employees()
    {
//        die('sddsd');
        return $this->belongsTo('Employees','employee_id');
    }
}