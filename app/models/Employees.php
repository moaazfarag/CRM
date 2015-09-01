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

        'card_no'               => 'required|min:14|max:14|unique:card_no',
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
    public static  $update_rules = array(

        'name'                  => 'required|min:3',
        'ins_no'                => 'integer',
        'employee_date'         => 'required|date',

        'card_no'               => 'required|min:14|max:14|unique:card_no',
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
            $value += $loan->loan_val;
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
        $duds = EmployeeDeduction::where('hr_empdesded.employee_id',$this->id)
            ->where('hr_empdesded.co_id',Auth::user()->co_id)
            ->join('hr_desded','hr_desded.id','=','hr_empdesded.des_ded')
           ->where('hr_desded.ds_type',$type)
            ->get();
        $changes = MonthChange::where('hr_monthchanges.employee_id',2)
            ->where('hr_monthchanges.co_id',Auth::user()->co_id)
            ->join('hr_desded','hr_desded.id','=','hr_monthchanges.desded_id')
           ->where('hr_desded.ds_type',$type)->where('hr_monthchanges.for_month',5)
            ->get();

        foreach($duds as $dud ){
            $value += $dud->val;
        }
        foreach($changes as $change ){
            if($change->daycost = "ايام")
            {
                $value += (($this->salary /30) * $change->val ) ;
            }elseif($change->daycost = "مبلغ"){
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

}