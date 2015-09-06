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
            $dep->name = Input::get('name');
            $dep->co_id = Auth::user()->co_id; // company id
            $dep->user_id = Auth::id();// user who add this record
            $dep->save();
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
        $dep->update();
        return Redirect::route('addDep');

    }

    protected function depData()
    {
        $parts = Lang::get('main.parts');
        $data['title'] = $parts;
        $data['employees'] = 'open';
        $data['modelMini'] = "";
        $data['arabicName'] = $parts;
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
                  Session::flash('success',Lang::get('main.delete_department_success_msg'));
                  return Redirect::back();

            }//end else employees

        }// end if dep



    }
}