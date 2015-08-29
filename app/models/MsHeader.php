<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/24/2015
 * Time: 1:00 PM
 */
class MsHeader extends Eloquent
{

    protected $table = 'hr_msheader';

    public function employees()
    {
        return $this->belongsTo('Employees','employee_id');
    }



   public static $store_rules = array(

        'for_month'=>'required',
        'for_year'=>'required',
        'employee_id'=>'required',

        );


    public function net()
    {
//        $join = DB::table('hr_msheader')
//            ->join('hr_employees', 'hr_msheader.id', '=', 'hr_employees.id')
//            ->join('hr_empdesded', 'hr_msheader.id', '=', 'hr_empdesded.id')
//            ->join('hr_monthchanges', 'hr_msheader.id', '=', 'hr_monthchanges.id')
//            ->join('hr_loans', 'hr_msheader.id', '=', 'hr_loans.id')
//            ->select('hr_msheader.id', 'hr_employees.name', 'hr_employees.salary As Fixed_Salary', 'hr_empdesded.val As Deserves', 'hr_monthchanges.val As deduction', 'hr_loans.loan_val As Loan')
//            ->get();
//            return $join;
////        dd($join);
    }

    public function search($employee_id,$year,$month){

        $employee_data = Employees::where('id',$employee_id)->get();
        if(!empty($employee_data)){


        }

//        $join = DB::table('hr_msheader')
//            ->join('hr_employees', 'hr_msheader.id', '=', 'hr_employees.id')
//            ->join('hr_empdesded', 'hr_msheader.id', '=', 'hr_empdesded.id')
//            ->join('hr_monthchanges', 'hr_msheader.id', '=', 'hr_monthchanges.id')
//            ->join('hr_loans', 'hr_msheader.id', '=', 'hr_loans.id')
//            ->select('hr_msheader.id', 'hr_employees.name', 'hr_employees.salary As Fixed_Salary', 'hr_empdesded.val As Deserves', 'hr_monthchanges.val As deduction', 'hr_loans.loan_val As Loan')
//            ->get();
//            return $join;
////        dd($join);
        }

}