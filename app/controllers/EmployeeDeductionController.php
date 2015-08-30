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
        $data['title'] = 'اضف بند موظف جديد'; // page title
        $data['employees'] = "open";
        $data = $this->depData();
        $data['deduction'] = Deduction::where('co_id', '=', $this->coAuth())->first();
        $data['co_info'] = coData::where('id', '=', $this->coAuth())->first();
        return View::make('dashboard.hr.employee_deduction.index', $data);

    }

    public function storeEmpdesded()
    {
        $validation = Validator::make(Input::all(), EmployeeDeduction::$store_rules);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }
        else
        {
            $newEmpdesded                             = new EmployeeDeduction;
            $newEmpdesded->co_id                      = $this->coAuth();
            $newEmpdesded->employee_id                      = $this->coAuth();
            $newEmpdesded->des_ded                      = $this->coAuth();
            $newEmpdesded->val                       = Input::get('val');

            $newEmpdesded->save();
            return Redirect::route('addEmpdesded');
        }

    }

    public  function editEmpdesded($id)
    {
//        $data = $this->staticData() ;
        $data['title']     = 'تعديل فى بنود الاستحقاق للموظف'; // page title
        $data['employees'] = "open";
        $data = $this->depData();

//        $data['employee'] = EmployeeDeduction::findOrFail($id);
        $data['deduction']   = Deduction::where('co_id','=',$this->coAuth())->first();
        $data['co_info'] = coData::where('id', '=', $this->coAuth())->first();

        return View::make('dashboard.hr.employee_deduction.index',$data);
    }
    public function updateDesded($id)
    {
        $validation = Validator::make(Input::all(), EmployeeDeduction::$update_rules);

        if($validation->fails())
        {
            //dd($validation->messages());
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {
            $newEmpdesded  = EmployeeDeduction::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();
            if($newEmpdesded){
                $newEmpdesded = Deduction::find($id);
                $newEmpdesded->co_id                     = $this->coAuth();
                $newEmpdesded->employee_id               = $this->coAuth();
                $newEmpdesded->des_ded                   = $this->coAuth();
                $newEmpdesded->val                       = Input::get('val');
                $newEmpdesded->update();
                return Redirect::route('addDesded');
            }else{
                return "this item snot found ";
            }

        }
    }

    protected function depData()
    {
        $data['title']              = 'بنود الموظف';
        $data['employees']          = 'open' ;
        $data['tablesData']         = EmployeeDeduction::where('co_id','=',$this->coAuth())->get();
        return $data;
    }

    public function deleteEmpdesded($id)
    {

        $Empdesded = EmployeeDeduction::find($id);

        if (!empty($Empdesded)) {

                 $Empdesded->delete();

                Session::flash('success', 'لقد تم حذف البند بنجاح ');
                return Redirect::back();
            }
        }


}