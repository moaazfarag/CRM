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
        $data['title']       = Lang::get('add_new_employee_clause'); // page title
        $data['employees']   = "open";
        $data = $this->depData();
        $data['deduction'] = Deduction::company()->where('deleted',0)->where('ds_cat',Lang::get('main.fixed'))->lists('name','id');
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

            if($newEmpdesded->save()){

                Session::flash('success',BaseController::addSuccess('إستحقاق الموظف'));
            }else{

                Session::flash('error',BaseController::addError('إستحقاق الموظف'));
            }
            return Redirect::route('addEmpdesded');
        }

    }

    public  function editEmpdesded($id)
    {
//        $data = $this->staticData() ;
        $data['title']     = Lang::get('main.edit_debt_employee_clause'); // page title
        $data['employees'] = "open";
        $data = $this->depData();

        $data['employee'] = EmployeeDeduction::findOrFail($id);
        $data['deduction']   = Deduction::company()->where('deleted',0)->first();
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

                if($newEmpdesded->update()){
                    Session::flash('success',BaseController::editSuccess('إستحقاق الموظف'));
                }else{
                    Session::flash('error',BaseController::editError('إستحقاق الموظف'));
                }

                return Redirect::route('addDesded');
            }else{
                return View::make('errors.missing');             }

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

    public function multiDeleteEmpdesded()
    {
        $inputs = Input::all();

        // if user not select any check box
        if (!isset($inputs['checkbox'])) {
            Session::flash('error', 'لم يتم تحديد بيانات لحذفها ');
            return Redirect::back();
        }

        $count_of_deleted = 0;
        $cant_delete_group = [];
        $want_to_delete = count($inputs['checkbox']);

        foreach ($inputs['checkbox'] as $id) {

                $delete =  EmployeeDeduction::company()->find($id);
                if($delete){

                    $delete->delete();
                    $count_of_deleted++;
                }

            }
        if($want_to_delete != $count_of_deleted){
            $msg = Lang::get('main.delete_is_done').' ('.$count_of_deleted.' )'.Lang::get('main.from_rows').' ('.$want_to_delete.' )';
            $type_of_msg = 'error';

        }else{
            $msg         = Lang::get('main.the_delete_is_done').Lang::get('main.with_success');
            $type_of_msg = 'success';
        }
        Session::flash($type_of_msg, $msg);
        return Redirect::back();

    }

}