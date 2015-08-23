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

//        'co_id'           => 'required|integer',
        'name'                  => 'required|min:3',
        'branch_id'             => 'required',
        'department_id'         => 'required',
        'ins_no'                => 'required|integer',
        'certificate'           => 'required',
        'cert_location'         => 'required',
        'tel'                   => 'required',
        'card_no'               => 'required|min:14|max:14',
        'cancel_cause'          => 'required|min:3|max:200',
        'address'               => 'required|min:3|max:200',
        'remark'                => 'required|min:3|max:200',
        'employee_date'         => 'required|date',
        'cancel_date'           => 'required|date',
        'birth_date'            => 'required|date',
        'cert_date'             => 'required|date',
        'work_nature'           => 'required',
        'sex'                   => 'required',
        'marital'               => 'required',
        'religion'              => 'required',
        'military_service'      => 'required',
        'salary'                => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/' ,
        'ins_salary'            => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/' ,
        'ins_val'               => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/' ,

    );
    public static  $update_rules = array(

//        'co_id'           => 'required|integer',
        'name'                  => 'required|min:3',
        'branch_id'             => 'required',
        'department_id'         => 'required',
        'ins_no'                => 'required|integer',
        'certificate'           => 'required',
        'cert_location'         => 'required',
        'tel'                   => 'required',
        'card_no'               => 'required|min:14|max:14',
        'cancel_cause'          => 'required|min:3|max:200',
        'address'               => 'required|min:3|max:200',
        'remark'                => 'required|min:3|max:200',
        'employee_date'         => 'required|date',
        'cancel_date'           => 'required|date',
        'birth_date'            => 'required|date',
        'cert_date'             => 'required|date',
        'work_nature'           => 'required',
        'sex'                   => 'required',
        'marital'               => 'required',
        'religion'              => 'required',
        'military_service'      => 'required',
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
        return $this->hasOne('Loans','id','employee_id');
    }
    public function employee_ded()
    {
        return $this->hasOne('EmployeeDeduction','id','employee_id');
    }
    public function monthchange()
    {
        return $this->belongsTO('MonthChange','id');
    }

}