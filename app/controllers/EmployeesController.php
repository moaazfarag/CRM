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

        //$data['co_info']   = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons

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
            $newEmp           = new Employees;
//        dd($this->coAuth());
//        $newEmp->empCode = $this->coAuth();
        $newEmp->co_id              = $this->coAuth();
        $newEmp->empName            = Input::get('empName');
        $newEmp->branchCode         = Input::get('branchCode');
        $newEmp->empDate            = Input::get('empDate');
        $newEmp->workNature         = Input::get('workNature');
        $newEmp->depCode            = Input::get('depCode');
        $newEmp->jobCode            = Input::get('jobCode');
        $newEmp->salary             = Input::get('salary');
        $newEmp->insSalary          = Input::get('insSalary');
        $newEmp->insVal             = Input::get('insVal');
        $newEmp->insNo              = Input::get('insNo');
        $newEmp->idCardNo           = Input::get('idCardNo');
        $newEmp->cancelDate         = Input::get('cancelDate');
        $newEmp->cancelCause        = Input::get('cancelCause');
        $newEmp->sex                = Input::get('sex');
        $newEmp->marital            = Input::get('marital');
        $newEmp->religion           = Input::get('religion');
        $newEmp->militaryService    = Input::get('militaryService');
        $newEmp->tel                = Input::get('tel');
        $newEmp->address            = Input::get('address');
        $newEmp->birthDate          = Input::get('birthDate');
        $newEmp->certificate        = Input::get('certificate');
        $newEmp->certDate           = Input::get('certDate');
        $newEmp->certLocation       = Input::get('certLocation');
        $newEmp->remark             = Input::get('remark');
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
//        dd($data['employee']);
//        dd($data['employee']);
////        $data['employees']     =  ::where('co_id','=',$this->coAuth())->get(); //  get all emp to view in table
//        $data['employees']      = Employees::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();//item will edit
////        dd($data['item']);
//        if($data['employees'])
//        {
//            $data['empCode']  = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons
////            $data['accounts'] = Accounts::where('acc_type','=','suppliers')
////                ->where('co_id','=',Auth::user()->co_id)
////                ->get()
////                ->lists('acc_name','id');// suppliers from accounts table
          return View::make('dashboard.add_employee',$data);
//        }else{
//            return "item not here";
//        }
//
//
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
//            dd($oldEmp);
//           $oldEmp->empCode             =
            $oldEmp->co_id = $this->coAuth();
            $oldEmp->empName = Input::get('empName');
            $oldEmp->branchCode = Input::get('barCode');
            $oldEmp->empDate = Input::get('empDate');
            $oldEmp->workNature = Input::get('workNature');
            $oldEmp->depCode = Input::get('depCode');
            $oldEmp->jobCode = Input::get('jobCode');
            $oldEmp->salary = Input::get('salary');
            $oldEmp->insSalary = Input::get('insSalary');
            $oldEmp->insVal = Input::get('insVal');
            $oldEmp->insNo = Input::get('insNo');
            $oldEmp->idCardNo = Input::get('idCardNo');
            $oldEmp->cancelDate = Input::get('cancelDate');
            $oldEmp->cancelCause = Input::get('cancelCause');
            $oldEmp->sex = Input::get('sex');
            $oldEmp->marital = Input::get('marital');
            $oldEmp->religion = Input::get('religion');
            $oldEmp->militaryService = Input::get('militaryService');
            $oldEmp->tel = Input::get('tel');
            $oldEmp->address = Input::get('address');
            $oldEmp->birthDate = Input::get('birthDate');
            $oldEmp->certificate = Input::get('certificate');
            $oldEmp->certDate = Input::get('certDate');
            $oldEmp->certLocation = Input::get('certLocation');
            $oldEmp->remark = Input::get('remark');
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