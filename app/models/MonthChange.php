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


    );

    public static $update_rules_with_cause = array(
        'employee_id'     => 'required',
        'ds_id'           => 'required',
        'trans_date'      => 'required|date',
        'for_year'        => 'required',
        'for_month'       => 'required',
        'day_cost'        => 'required',
        'val'             => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
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
    /**
     * return change  of this employee
     * base  on auth.company , input.for_month , input.for_year $type
     * @param $employee_id
     * @param $type استحقاق او استقطاع
     * @return mixed
     */
    public static function getMonthChange($employee_id,$type){
       $q =  self::where('hr_monthchanges.co_id',Auth::user()->co_id)
            ->where('hr_monthchanges.employee_id',$employee_id)
            ->where('hr_monthchanges.for_month',Input::get('for_month'))
            ->where('hr_monthchanges.for_year',Input::get('for_year'))
            ->join('hr_desded','hr_desded.id','=','hr_monthchanges.des_ded_id');
           if($type){
              return $q ->where('hr_desded.ds_type',$type);
           }else{
               return $q ;
           }
    }
    public static function getMonthAllChange($employee_id){
       $q =  self::getMonthChange($employee_id,'')
           ->where('employee_id',$employee_id)
           ->select('val', DB::raw('SUM(val) as total_val'),'hr_desded.name AS desded_name','ds_type','hr_monthchanges.*')
           ->groupBy('des_ded_id')
           ->groupBy('day_cost')
           ->groupBy('hr_desded.id')
           ->get();
               return $q ;

    }

}