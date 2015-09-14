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
    public function detailsDes(){
        return $this->hasMany('MsDetails','ms_header_id','ms_header_id')
            ->where('des_ded_type','استحقاق')
            ->join('hr_desded','hr_desded.id','=','hr_ms_details.des_ded_id')
            ->select('des_ded_val', DB::raw('SUM(des_ded_val) as total_val'),'hr_ms_details.*','hr_desded.name','hr_desded.ds_cat')
            ->groupBy('des_ded_id');

    }


    public function detailsDed(){
        return $this->hasMany('MsDetails','ms_header_id','ms_header_id')
            ->where('des_ded_type','استقطاع')
            ->join('hr_desded','hr_desded.id','=','hr_ms_details.des_ded_id')
            ->select('des_ded_val', DB::raw('SUM(des_ded_val) as total_val'),'hr_ms_details.*','hr_desded.name','hr_desded.ds_cat')
            ->groupBy('des_ded_id');
    }

//    public function sumDesded ($employee_id){
//
//       $all_desded_array = array()
//        $i               = 0;
//        $all_desded = Deduction::all();
//
//    foreach($all_desded as $desded ) {
//
//        $result = DB::table('hr_monthChanges')
//            ->where('des_ded_id', $desded->id)
//            ->where('employee_id', $employee_id)
//            ->where('for_month', Input::get('for_month'))
//            ->where('for_year', Input::get('for_year'));
//        if (!empty($result)) {
//            $all_desded_array [$i] = $result;
//        }
//    }
//
//        return $all_desded_array;
//
//}
    public function employee(){
        return $this->hasOne('Employees','id','employee_id');
    }

    public function job(){

        return $this->hasOne('Job','id','employee_id');
    }

    public function department(){

        return $this->hasOne('Department','id','employee_id');
    }

}