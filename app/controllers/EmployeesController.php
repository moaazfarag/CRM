<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/4/2015
 * Time: 2:08 PM
 */
class EmployeesController extends BaseController
{

    public function addEmp()
    {

        $data['title']     =  Lang::get('main.addEmployee')  ; // page title
        $data['employees'] = "open";
        return View::make('dashboard.add_employees',$data);

    }
    //Function Store Employee In Data Base
    public function storeEmp()
    {
        $validation = Validator::make(Input::all(), Emps::$store_rules);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {
            $newEmp = new Emps;
            $newEmp->empCode             = $this->coAuth();
            $newEmp->co_id               =Input::get('co_id');
            $newEmp->empName             =Input::get('empName');
            $newEmp->branchCode           =Input::get('branchCode');
            $newEmp->empDate             =Input::get('empDate');
            $newEmp->workNature          =Input::get('workNature');
            $newEmp->depCode             =Input::get('depCode');
            $newEmp->jobCode             =Input::get('jobCode');
            $newEmp->salary              =Input::get('salary');
            $newEmp->insSalary           =Input::get('insSalary');
            $newEmp->insVal              =Input::get('insVal');
            $newEmp->insNo               =Input::get('insNo');
            $newEmp->idCardNo            =Input::get('idCardNo');
            $newEmp->cancelDate          =Input::get('cancelDate');
            $newEmp->cancelCause         =Input::get('cancelCause');
            $newEmp->sex                 =Input::get('sex');
            $newEmp->marital             =Input::get('marital');
            $newEmp->religion            =Input::get('religion');
            $newEmp->militaryService     =Input::get('militaryService');
            $newEmp->tel                 =Input::get('tel');
            $newEmp->address             =Input::get('address');
            $newEmp->birthDate           =Input::get('birthDate');
            $newEmp->certificate         =Input::get('certificate');
            $newEmp->certDate            =Input::get('certDate');
            $newEmp->certLocation        =Input::get('certLocation');
            $newEmp->remark              =Input::get('remark');
            $newEmp->userID              = Auth::id();
            $newEmp->pic                 =Input::get('pic');
            $newEmp->fingerId            =Input::get('fingerId');
            $newEmp->dHours              =Input::get('dHours');
            $newEmp->comm1               =Input::get('comm1');
            $newEmp->comm2               =Input::get('comm2');

            $newEmp->save();
            return Redirect::route('addEmp');



        }
    }
    //Function Update Employee In Data Base
    public function updateEmp($id)
    {
        $validation = Validator::make(Input::all(), Emps::$update_rules);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {
            $oldEmp  = Items::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();
            if($oldEmp){

                $oldEmp = Emps::find($id);
                $oldEmp->empCode             = $this->coAuth();
                $oldEmp->co_id               =Input::get('co_id');
                $oldEmp->empName             =Input::get('empName');
                $oldEmp->barCode             =Input::get('barCode');
                $oldEmp->empDate             =Input::get('empDate');
                $oldEmp->workNature          =Input::get('workNature');
                $oldEmp->depCode             =Input::get('depCode');
                $oldEmp->jobCode             =Input::get('jobCode');
                $oldEmp->salary              =Input::get('salary');
                $oldEmp->insSalary           =Input::get('insSalary');
                $oldEmp->insVal              =Input::get('insVal');
                $oldEmp->insNo               =Input::get('insNo');
                $oldEmp->idCardNo            =Input::get('idCardNo');
                $oldEmp->cancelDate          =Input::get('cancelDate');
                $oldEmp->cancelCause         =Input::get('cancelCause');
                $oldEmp->sex                 =Input::get('sex');
                $oldEmp->marital             =Input::get('marital');
                $oldEmp->religion            =Input::get('religion');
                $oldEmp->militaryService     =Input::get('militaryService');
                $oldEmp->tel                 =Input::get('tel');
                $oldEmp->address             =Input::get('address');
                $oldEmp->birthDate           =Input::get('birthDate');
                $oldEmp->certificate         =Input::get('certificate');
                $oldEmp->certDate            =Input::get('certDate');
                $oldEmp->certLocation        =Input::get('certLocation');
                $oldEmp->remark              =Input::get('remark');
                $oldEmp->userID              = Auth::id();
                $oldEmp->pic                 =Input::get('pic');
                $oldEmp->fingerId            =Input::get('fingerId');
                $oldEmp->dHours              =Input::get('dHours');
                $oldEmp->comm1               =Input::get('comm1');
                $oldEmp->comm2               =Input::get('comm2');

                $oldEmp->update();
            return Redirect::route('addEmp');

            }

        }
    }

}