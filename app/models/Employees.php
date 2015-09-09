<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/5/2015
 * Time: 6:29 PM
 */
class Employees extends Eloquent {

    protected $table = 'hr_employees';
    public static $store_rules = array(

        'name'                  => 'required|min:3',
        'ins_no'                => 'integer',
        'employee_date'         => 'required|date',

        'card_no'               => 'required|min:14|max:14|unique:hr_employees',
        'cancel_cause'          => 'min:3|max:200',
        'address'               => 'min:3|max:200',
        'remark'                => 'min:3|max:200',
        'cancel_date'           => 'date',
        'birth_date'            => 'date',
        'cert_date'             => 'date',

        //selects
        'sex'                   => 'required',
        'marital'               => 'required',
        'religion'              => 'required',
        'military_service'      => 'required',
        'branch_id'             => 'required',
        'department_id'         => 'required',
        'job_id'                => 'required',
        'work_nature'           => 'required',

        //mony
        'salary'                => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/' ,
        'ins_salary'            => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/' ,
        'ins_val'               => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/' ,

    );
    public function updateRuels($id){

        $update_rules =  array(

        'name'                  => 'required|min:3',
        'ins_no'                => 'integer',
        'employee_date'         => 'required|date',
        'card_no'               => 'required|min:14|max:14|unique:hr_employees,id,'.$id,
        'cancel_cause'          => 'min:3|max:200',
        'address'               => 'min:3|max:200',
        'remark'                => 'min:3|max:200',
        'cancel_date'           => 'date',
        'birth_date'            => 'date',
        'cert_date'             => 'date',

        //selects
        'sex'                   => 'required',
        'marital'               => 'required',
        'religion'              => 'required',
        'military_service'      => 'required',
        'branch_id'             => 'required',
        'department_id'         => 'required',
        'job_id'                => 'required',
        'work_nature'           => 'required',

        //mony
        'salary'                => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/' ,
        'ins_salary'            => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/' ,
        'ins_val'               => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/' ,

        );

        return $update_rules;
    }
    public function departments()
    {
        return $this->belongsTO('Department','department_id','id');
    }
    public function jobs()
    {
        return $this->belongsTo('Job','job_id','id');
    }
    public function loans()
    {
        return $this->hasMany('Loans','employee_id','id');
    }
    public function loansValue()
    {

        $value = 0;

        foreach ($this->hasMany('Loans','employee_id','id')->get() as $loan ) {
            $endMonth   = date('m',strtotime($loan->loan_end));
            $endYear    = date('Y',strtotime($loan->loan_end));
            $startMonth = date('m',strtotime($loan->loan_start));
            $startyear  = date('Y',strtotime($loan->loan_start));
            if($endMonth >= Input::get('for_month') && $endYear >= Input::get('for_year')&& $startyear <= Input::get('for_year') && $startMonth <= Input::get('for_month') ){
                $value += $loan->loan_currBal;
            }
        }
        return $value ;
    }
    public function employeeDeds()
    {
        return $this->hasMany('EmployeeDeduction','employee_id','id');
    }
    public function employeeDudValue($type)
    {

        $value = 0;
        $employee_id = $this->id;
        $duds        = EmployeeDeduction::getDisDed($employee_id,$type)->get();
        $changes     = MonthChange::getMonthChange($employee_id,$type)->get();
//        dd($duds);
        foreach($duds as $dud ){
            $value += $dud->val;
        }
        foreach($changes as $change ){
            if($change->day_cost == "أيام")
            {
                $value += (($this->salary /30) * $change->val ) ;
            }elseif($change->day_cost == "مبلغ"){
                $value += $change->val;
            }
        }

        return $value;
    }
    public function monthchange()
    {
        return $this->hasMany('MonthChange','employee_id','id');
    }
    public function msheader()
    {
        return $this->belongsTO('MsHeader','id');
    }
public  function test(){

    $q = self::where('hr_employees.co_id',1)
        ->join('hr_empdesded','hr_empdesded.employee_id','=','hr_employees.id')
        ->join('hr_monthchanges','hr_monthchanges.employee_id','=','hr_employees.id')
        ->join('hr_desded','hr_desded.id','=','hr_empdesded.des_ded')
        ->join('hr_loans','hr_loans.id','=','hr_employees.id')
//            ->groupBy('hr_employees.id')
//        ->groupBy('day_cost')
//        ->groupBy('des_ded_id')
        ->select('hr_employees.name as emp_name',
            'hr_employees.salary',
            'hr_desded.name',
            'hr_desded.name AS des_ded_name',
            'hr_desded.ds_type',
            'hr_desded.ds_cat',
            'hr_monthchanges.for_year',
            'hr_monthchanges.for_month',
//            DB::raw('hr_monthchanges.for_year = 2017 AND hr_monthchanges.for_month = 9 as this_enter'),
//            'hr_desded.name AS name',
            'hr_monthchanges.day_cost',
            'hr_monthchanges.val AS month_change_value')


//            ->join('hr_desded','hr_desded.id','=','hr_monthchanges.des_ded_id')
////            ->where('hr_desded.ds_type',$type)
//            ->groupBy('des_ded_id')
//            ->groupBy('day_cost')
        ->get();
   return dd(DB::getQueryLog());
}
}