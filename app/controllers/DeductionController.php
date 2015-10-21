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
        $data['title']     = Lang::get('main.add_new_clause'); // page title
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

            if($newDesded->save()){

                Session::flash('success',BaseController::addSuccess('البند'));
            }else{

                Session::flash('error',BaseController::addError('البند'));
            }

            return Redirect::route('addDesded');
        }

    }
    public  function editDesded($id)
    {
        $data = $this->staticData() ;
        $data['title']     = Lang::get('main.edit_clause_debt'); // page title
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

            if($newDesded->update()){
                Session::flash('success',BaseController::editSuccess('البند'));
            }else{
                Session::flash('error',BaseController::editError('البند'));
            }

                return Redirect::route('addDesded');
        }else{
                $data['error'] = 'عفواً هذا الصنف غير موجود ';
                return View::make('errors.missing');
    }

    }
    }

    public function staticData()
    {
        $data['employees']          = 'open' ;
        $data['tablesData']        = Deduction::company()->get();
        $data['ds_type'] = array(
            '' => Lang::get('main.clause_type'),
            Lang::get('main.debt') =>  Lang::get('main.debt'),
            Lang::get('main.credit')=>  Lang::get('main.credit'));
        return $data;

    }

    public function deleteDesded($id)
    {

        $desded = Deduction::find($id);

        if (!empty($desded)) {
            $employee = EmployeeDeduction::where('des_ded',$id)->first();
              if (!empty($employee)) {

                  Session::flash('error',Lang::get('main.delete_clause_error_msg'));
                  return Redirect::back();

              }else{

                  $desded->delete();

                  Session::flash('success', Lang::get('main.delete_clause_success_msg'));
                  return Redirect::back();
              }
        }

    }


    }