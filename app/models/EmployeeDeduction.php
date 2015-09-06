<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/16/2015
 * Time: 4:36 PM
 */
class EmployeeDeduction extends Eloquent {

    protected $table = 'hr_empdesded';
    public static $rules = array(
        'val'          => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
//        'employee_id'  => 'required',
        'ds_id'        => 'required',

    );

    public function employees()
    {
        return $this->hasOne('Employees','id','employee_id');
    }
    public function desded()
    {
        return $this->hasMany('Deduction','id','des_ded');
    }

    /**
     * return des dud of this employee
     * @param $employee_id
     * @param $type استحقاق او استقطاع
     * @return mixed
     */
    public static function getDisDed($employee_id,$type)
    {
       $q =  self::where('hr_empdesded.co_id',Auth::user()->co_id)
            ->where('hr_empdesded.employee_id',$employee_id)
            ->join('hr_desded','hr_desded.id','=','hr_empdesded.des_ded');
        if($type){
                return $q ->where('hr_desded.ds_type',$type);
            }else{
                return $q ;
            }

    }
    public static function getAllDisDed($employee_id)
    {
        $q =  self::getDisDed($employee_id,'')
            ->where('employee_id',$employee_id)
            ->select('val', DB::raw('SUM(val) as total_val'),'hr_desded.name AS desded_name','ds_type','hr_empdesded.*')
            ->groupBy('hr_desded.id')
            ->groupBy('hr_desded.name')
            ->get();
        return $q;
    }
}