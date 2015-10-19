<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/16/2015
 * Time: 4:29 PM
 */
class EmployeeDeductionController extends BaseController
{
    /**
     * @return mixed
     */
    public function addEmpdesded()
    {

//        $data = $this->staticData();
        $data['title'] = Lang::get('add_new_employee_clause'); // page title
        $data['employees'] = "open";
        $data = $this->depData();
        $data['deduction'] = Deduction::company()->first();
        $data['co_info']   = CoData::thisCompany()->first();
        return View::make('dashboard.hr.employee_deduction.index', $data);

    }

    public function storeEmpdesded()
    {
        $validation = Validator::make(Input::all(), EmployeeDeduction::$rules,BaseController::$messages);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }
        else
        {
            $newEmpdesded               = new EmployeeDeduction;
            $newEmpdesded->co_id        = $this->coAuth();
            $newEmpdesded->employee_id  = Input::get('employee_id');
            $newEmpdesded->des_ded      = Input::get('ds_id');
            $newEmpdesded->val          = Input::get('val');
            $newEmpdesded->user_id      = Auth::id();
            $newEmpdesded->save();
            return Redirect::route('addEmpdesded');
        }

    }

    public  function editEmpdesded($id)
    {
//        $data = $this->staticData() ;
        $data['title']     = Lang::get('main.edit_debt_employee_clause'); // page title
        $data['employees'] = "open";
        $data = $this->depData();

//        $data['employee'] = EmployeeDeduction::findOrFail($id);
        $data['deduction']   = Deduction::company()->first();
        $data['co_info']     = CoData::thisCompany()->first();

        return View::make('dashboard.hr.employee_deduction.index',$data);
    }
    public function updateDesded($id)
    {
        $validation = Validator::make(Input::all(), EmployeeDeduction::$rules,BaseController::$messages);

        if($validation->fails())
        {
            //dd($validation->messages());
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {
            $newEmpdesded  = EmployeeDeduction::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();
            if($newEmpdesded){
                $newEmpdesded = Deduction::find($id);
                $newEmpdesded->co_id        = $this->coAuth();
                $newEmpdesded->employee_id  = Input::get('employee_id');
                $newEmpdesded->des_ded      = Input::get('ds_id');
                $newEmpdesded->val          = Input::get('val');
                $newEmpdesded->user_id      = Auth::id();
                $newEmpdesded->update();
                return Redirect::route('addDesded');
            }else{
                return "this item snot found ";
            }

        }
    }
    /*
     * add  form add employee pop up
     */
    public function storeEmpdesdedPop()
    {
//dd('sad');
        $validation = Validator::make(Input::all(), EmployeeDeduction::$rules);

        if($validation->fails())
        {
            return Response::json(array('success'=>false));
        }
        else
        {
            $newEmpdesded               = new EmployeeDeduction;
            $newEmpdesded->co_id        = $this->coAuth();
            $newEmpdesded->employee_id  = Input::get('empId');
            $newEmpdesded->des_ded      = Input::get('ds_id');
            $newEmpdesded->val          = Input::get('val');
            $newEmpdesded->user_id      = Auth::id();
            $newEmpdesded->save();
            return Response::json(array('success'=>true));
        }

    }
    protected function depData()
    {
        $data['title']              = Lang::get('main.employee_clause');
        $data['employees']          = 'open' ;
        $data['tablesData']         = EmployeeDeduction::company()->get();
        return $data;
    }

    public function deleteEmpdesded($id)
    {

        $Empdesded = EmployeeDeduction::where('co_id',$this->coAuth())
            ->where('id',$id)
            ->first();

        if (!empty($Empdesded)) {

                 $Empdesded->delete();

                Session::flash('success', Lang::get('main.delete_clause_success_msg'));
                return Redirect::back();
            }
        }
    public function deleteEmpdesdedPop($id){
        $Empdesded = EmployeeDeduction::where('co_id',$this->coAuth())
                                       ->where('id',$id)
                                       ->first();
        if (!empty($Empdesded)) {

            $Empdesded->delete();

            Session::flash('success', Lang::get('main.delete_clause_success_msg'));
            return Response::json(array('success'=>true));
        }else{
            return Response::json(array('success'=>false));

        }
    }

}