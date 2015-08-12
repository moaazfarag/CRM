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
        'loanDate'       => 'required|date',
        'loanStart'      => 'required|date',
        'loanEnd'        => 'required|date',
        'loanVal'        => 'required|integer',
        'loanCurrBal'    => 'required|integer',
    );
    public static $update_rules = array(
        'loanDate'       => 'required|date',
        'loanStart'      => 'required|date',
        'loanEnd'        => 'required|date',
        'loanVal'        => 'required|integer',
        'loanCurrBal'    => 'required|integer',
    );
    public function employees()
    {
//        die('sddsd');
        return $this->belongsTo('Employees','id','id');
    }
}