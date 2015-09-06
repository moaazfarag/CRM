<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/15/2015
 * Time: 6:06 PM
 */
class Deduction extends Eloquent {

    protected $table = 'hr_desded';
    public static $store_rules = array(
        'name'                  => 'required|min:3',
        'ds_type'               => 'required',
        'ds_cat'                => 'required'

    );
    public static $update_rules = array(
        'name'                  => 'required|min:3',
        'ds_type'               => 'required',
        'ds_cat'                => 'required'

    );
    public function employee_ded()
    {
        return $this->belongsTO('EmployeeDeduction','ds_id','id');
    }
    public function month_change()
    {
        return $this->belongsTO('MonthChange','des_ded_id');
    }

}