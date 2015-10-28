<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/10/2015
 * Time: 3:46 PM
 */
class DepartmentController extends BaseController
{
    public function addDep()
    {
        $data = $this->depData();
            return View::make('dashboard.hr.departments.index', $data);
    }

    public function storeDep()
    {
        $inputs = Input::all();
        $validation = Validator::make($inputs,Department::$ruels,BaseController::$messages);
        if($validation->fails()){

            return Redirect::back()->withInput()->withErrors($validation->messages());

        }else {


            $dep = new Department;
            $dep->true_id    = BaseController::maxId($dep);
            $dep->name = Input::get('name');
            $dep->co_id = Auth::user()->co_id; // company id
            $dep->user_id = Auth::id();// user who add this record
            if($dep->save()){

                Session::flash('success',BaseController::addSuccess('القسم'));
            }else{

                Session::flash('error',BaseController::addError('القسم'));
            }
            return Redirect::route('addDep');
        }

    }

    public function editDep($id)
    {
        $data = $this->depData();
        $data['editDep'] = Department::findOrFail($id);
        return View::make('dashboard.hr.departments.index', $data);

    }

    public function updateDep($id)
    {
        $dep = Department::findOrFail($id);
        $dep->name = Input::get('name'); //season name from input
        $dep->co_id = Auth::user()->co_id; // company id
        $dep->user_id = Auth::id();// user who add this record
        if($dep->update()){
            Session::flash('success',BaseController::editSuccess('القسم'));
        }else{
            Session::flash('error',BaseController::editError('القسم'));
        }
        return Redirect::route('addDep');

    }

    protected function depData()
    {
        $parts = Lang::get('main.dep_name');
        $data['title'] = $parts;
        $data['employees'] = 'open';
        $data['modelMini'] = "";
        $data['arabicName'] = $parts;
        $data['holder']     = Lang::get('main.dep_holder');
        $data['tablesData'] = Department::company()->get();
        return $data;
    }

    public function deleteDep($id)
    {
        $dep = Department::find($id);
        if(!empty($dep)){

            $employees = Employees::where('department_id',$id)->first();
//            var_dump($employees); die();
            if(!empty($employees)){

                Session::flash('error',Lang::get('main.delete_department_error_msg'));
            return Redirect::back();
        }else{

                $dep->delete();
                $edit_ids = BaseController::editIds('hr_departments','Department','true_id');
                if($edit_ids) {
                    Session::flash('success', Lang::get('main.delete_department_success_msg'));
                    return Redirect::back();
                }
            }//end else employees

        }// end if dep



    }
}