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
        'empName'         => 'required|min:3|alpha',
        'branchCode'      => 'required',
        'depCode'         => 'required',
        'insNo'           => 'required',
        'certificate'     => 'required',
        'certLocation'    => 'required',
        'tel'             => 'required|integer',
        'idCardNo'        => 'required|min:14|max:14',
        'cancelCause'     => 'required|min:3|max:200',
        'address'         => 'required|min:3|max:200',
        'remark'          => 'required|min:3|max:200',
        'empDate'         => 'required|date',
        'cancelDate'      => 'required|date',
        'birthDate'       => 'required|date',
        'certDate'        => 'required|date',
        'workNature'      => 'required',
        'sex'             => 'required',
        'marital'         => 'required',
        'religion'        => 'required',
        'militaryService' => 'required',
        'salary'          => 'required|integer' ,
        'insSalary'       => 'regex:/^\d*(\.\d{2})?$/|integer',
        'insVal'          => 'regex:/^\d*(\.\d{2})?$/|integer',

    );
    public static  $update_rules = array(

//        'co_id'           => 'required|integer',
        'empName'         => 'required|min:3|alpha',
        'branchCode'      => 'required',
        'depCode'         => 'required',
        'insNo'           => 'required',
        'certificate'     => 'required',
        'certLocation'    => 'required',
        'tel'             => 'required|integer',
        'idCardNo'        => 'required|min:14|max:14',
        'cancelCause'     => 'required|min:3|max:200',
        'address'         => 'required|min:3|max:200',
        'remark'          => 'required|min:3|max:200',
        'empDate'         => 'required|date',
        'cancelDate'      => 'required|date',
        'birthDate'       => 'required|date',
        'certDate'        => 'required|date',
        'workNature'      => 'required',
        'sex'             => 'required',
        'marital'         => 'required',
        'religion'        => 'required',
        'militaryService' => 'required',
        'salary'          => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/' ,
        'insSalary'       => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/' ,
        'insVal'          => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/' ,
        );

    public function departments()
    {
        return $this->belongsTo('Dep','co_id','id');
    }
    public function jobs()
    {
        return $this->belongsTo('Job','co_id','id');
    }
    public function loans()
    {
//        die('sddsd');
        return $this->belongsTo('Loans','id','id');
    }

}