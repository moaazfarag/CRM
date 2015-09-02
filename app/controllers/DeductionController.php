<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/15/2015
 * Time: 5:37 PM
 */
class DeductionController extends BaseController
{
    public function addDesded()
    {

        $data = $this->staticData() ;
        $data['title']     = 'اضف بند جديد '  ; // page title
        $data['employees'] = "open";
        $data['co_info']   = CoData::thisCompany()->first();
        return View::make('dashboard.hr.deduction.index',$data);

    }
    public function storeDesded()
    {
        $validation = Validator::make(Input::all(), Deduction::$store_rules, BaseController::$messages);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }
        else
        {
            $newDesded                             = new Deduction;
            $newDesded->co_id                      = $this->coAuth();
            $newDesded->name                       = Input::get('name');
            $newDesded->ds_type                    = Input::get('ds_type');
            $newDesded->ds_cat                     = Input::get('ds_cat');
            $newDesded->save();
            return Redirect::route('addDesded');
        }

    }
    public  function editDesded($id)
    {
        $data = $this->staticData() ;
        $data['title']     = 'تعديل فى بنود الاستحقاق'; // page title
        $data['employees'] = "open";
        $data['employee'] = Deduction::findOrFail($id);
        $data['co_info']   = CoData::thisCompany()->first();
        return View::make('dashboard.hr.deduction.index',$data);
    }
    public function updateDesded($id)
    {
        $validation = Validator::make(Input::all(), Deduction::$update_rules , BaseController::$messages);

        if($validation->fails())
        {
            //dd($validation->messages());
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {
            $newDesded  = Deduction::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();
            if($newDesded){
            $newDesded = Deduction::find($id);
            $newDesded->co_id                      = $this->coAuth();
            $newDesded->name                       = Input::get('name');
            $newDesded->ds_type                    = Input::get('ds_type');
            $newDesded->ds_cat                     = Input::get('ds_cat');

            $newDesded->update();
            return Redirect::route('addDesded');
        }else{
        return "this item snot found ";
    }

    }
    }

    public function staticData()
    {
        $data['employees']          = 'open' ;
        $data['tablesData']        = Deduction::company()->get();
        $data['ds_type'] = array(
            '' => '        النوع',
            'استحقاق' => '           استحقاق',
            'استقطاع' => '         استقطاع ');
        return $data;

    }

    public function deleteDesded($id)
    {

        $desded = Deduction::find($id);

        if (!empty($desded)) {
            $employee = EmployeeDeduction::where('des_ded',$id)->first();
              if (!empty($employee)) {

                  Session::flash('error', 'هذا البند مستخدم فى بنود استحقاقات الموظفين .. لا يمكن الحذف  ');
                  return Redirect::back();

              }else{

                  $desded->delete();

                  Session::flash('success', 'لقد تم حذف البند بنجاح ');
                  return Redirect::back();
              }
        }

    }


    }