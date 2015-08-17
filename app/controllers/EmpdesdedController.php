<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/16/2015
 * Time: 4:29 PM
 */
class EmpdesdedController extends BaseController
{
    public function addEmpdesded()
    {

//        $data = $this->staticData();
        $data['title'] = 'اضف بند موظف جديد'; // page title
        $data['employees'] = "open";
        $data = $this->depData();

        $data['co_info'] = CoData::where('id', '=', $this->coAuth())->first();
        return View::make('dashboard.empdesded', $data);

    }

    public function storeEmpdesded()
    {
        $validation = Validator::make(Input::all(), Empdesded::$store_rules);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }
        else
        {
            $newEmpdesded                             = new Empdesded;
            $newEmpdesded->co_id                      = $this->coAuth();
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

        $data['employee'] = Empdesded::findOrFail($id);
        $data['co_info']   = CoData::where('id','=',$this->coAuth())->first();
        return View::make('dashboard.empdesded',$data);
    }
    public function updateDesded($id)
    {
        $validation = Validator::make(Input::all(), Empdesded::$update_rules);

        if($validation->fails())
        {
            //dd($validation->messages());
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {
            $newEmpdesded  = EmpdesDed::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();
            if($newEmpdesded){
                $newEmpdesded = Desded::find($id);
                $newEmpdesded->co_id                      = $this->coAuth();
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
        $data['tablesData']        = Empdesded::where('co_id','=',$this->coAuth())->get();
        return $data;
    }
}