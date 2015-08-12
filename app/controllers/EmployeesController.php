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
        $data['co_info']   = CoData::where('id','=',$this->coAuth())->first();
        return View::make('dashboard.add_employee',$data);

    }
    //Function Store Employee In Data Base
    public function storeEmp()
    {
        $validation = Validator::make(Input::all(), Employees::$store_rules);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {

//        dd($this->coAuth());
//        $newEmp->employee_id = $this->coAuth();
        $newEmp                             = new Employees;
        $newEmp->co_id                      = $this->coAuth();
        $newEmp->name                       = Input::get('name');
        $newEmp->branch_id                  = Input::get('branch_id');
        $newEmp->employee_date              = Input::get('employee_date');
        $newEmp->work_nature                = Input::get('work_nature');
        $newEmp->department_id              = Input::get('department_id');
        $newEmp->job_id                     = Input::get('job_id');
        $newEmp->salary                     = Input::get('salary');
        $newEmp->ins_salary                 = Input::get('ins_salary');
        $newEmp->ins_val                    = Input::get('ins_val');
        $newEmp->ins_no                     = Input::get('ins_no');
        $newEmp->card_no                    = Input::get('card_no');
        $newEmp->cancel_date                = Input::get('cancel_date');
        $newEmp->cancel_cause               = Input::get('cancel_cause');
        $newEmp->sex                        = Input::get('sex');
        $newEmp->marital                    = Input::get('marital');
        $newEmp->religion                   = Input::get('religion');
        $newEmp->military_service           = Input::get('military_service');
        $newEmp->tel                        = Input::get('tel');
        $newEmp->address                    = Input::get('address');
        $newEmp->birth_date                 = Input::get('birth_date');
        $newEmp->certificate                = Input::get('certificate');
        $newEmp->cert_date                  = Input::get('cert_date');
        $newEmp->cert_location              = Input::get('cert_location');
        $newEmp->remark                     = Input::get('remark');
//        $newEmp->userID             = Auth::id();
//        $newEmp->pic = Input::get('pic');
//        $newEmp->fingerId = Input::get('fingerId');
//        $newEmp->dHours = Input::get('dHours');
//        $newEmp->comm1 = Input::get('comm1');
//        $newEmp->comm2 = Input::get('comm2');

        $newEmp->save();
        return Redirect::route('addEmp');


   }
    }

   public  function editEmp($id)
    {
       $data['title']     = 'تعديل فى بيانات الموظف'; // page title
       $data['employees'] = "open";
        $data['employee'] = Employees::findOrFail($id);
        $data['co_info']   = CoData::where('id','=',$this->coAuth())->first();
          return View::make('dashboard.add_employee',$data);
  }

    //Function Update Employee In Data Base
    public function updateEmp($id)
    {
        $validation = Validator::make(Input::all(), Employees::$update_rules);

        if($validation->fails())
        {

            dd($validation->messages());
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {
            $oldEmp  = Employees::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();
            if($oldEmp){
                $oldEmp = Employees::find($id);
                $oldEmp->co_id                      = $this->coAuth();
                $oldEmp->name                       = Input::get('name');
                $oldEmp->branch_id                  = Input::get('branch_id');
                $oldEmp->employee_date              = Input::get('employee_date');
                $oldEmp->work_nature                = Input::get('work_nature');
                $oldEmp->department_id              = Input::get('department_id');
                $oldEmp->job_id                     = Input::get('job_id');
                $oldEmp->salary                     = Input::get('salary');
                $oldEmp->ins_salary                 = Input::get('ins_salary');
                $oldEmp->ins_val                    = Input::get('ins_val');
                $oldEmp->ins_no                     = Input::get('ins_no');
                $oldEmp->card_no                    = Input::get('card_no');
                $oldEmp->cancel_date                = Input::get('cancel_date');
                $oldEmp->cancel_cause               = Input::get('cancel_cause');
                $oldEmp->sex                        = Input::get('sex');
                $oldEmp->marital                    = Input::get('marital');
                $oldEmp->religion                   = Input::get('religion');
                $oldEmp->military_service           = Input::get('military_service');
                $oldEmp->tel                        = Input::get('tel');
                $oldEmp->address                    = Input::get('address');
                $oldEmp->birth_date                 = Input::get('birth_date');
                $oldEmp->certificate                = Input::get('certificate');
                $oldEmp->cert_date                  = Input::get('cert_date');
                $oldEmp->cert_location              = Input::get('cert_location');
                $oldEmp->remark                     = Input::get('remark');
//                $oldEmp->userID              = Auth::id();
//                $oldEmp->pic                 =Input::get('pic');
//                $oldEmp->fingerId            =Input::get('fingerId');
//                $oldEmp->dHours              =Input::get('dHours');
//                $oldEmp->comm1               =Input::get('comm1');
//                $oldEmp->comm2               =Input::get('comm2');

            $oldEmp->update();
            return Redirect::route('addEmp');
        }else{
        return "this item snot found ";
    }

        }

        }


}