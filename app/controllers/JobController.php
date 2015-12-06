<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/10/2015
 * Time: 3:46 PM
 */
class JobController extends BaseController
{

    /**
     * return view of add form
     * @return mixed
     */
    public function addJob()
    {
        $data = $this->JobData();
        return View::make('dashboard.hr.jobs.index',$data);
    }

    public function storeJob()
    {
        $inputs = Input::all();
        $validation = Validator::make($inputs,Job::$ruels,BaseController::$messages);
        if($validation->fails()){

            return Redirect::back()->withInput()->withErrors($validation->messages());

        }else {
        $job           = new Job ;
        $job->true_id  = BaseController::maxId($job);
        $job->name     = Input::get('name');
        $job->co_id    = Auth::user()->co_id;
        $job->user_id  = Auth::user()->id;
        if($job->save()){

            Session::flash('success',BaseController::addSuccess('الوظيفة'));
        }else{

            Session::flash('error',BaseController::addError('الوظيفة'));
        }
        return Redirect::route('addJob');
        }
    }

    public function editJob($id)
    {
        //dd('saddsa');
        $data = $this->JobData();
        $data['editJob']  = Job::findOrFail($id);
        return View::make('dashboard.hr.jobs.index',$data);

    }
    public function updateJob($id)
    {
        $job              = Job::findOrFail($id) ;
        $job->name        = Input::get('name'); //season name from input
        $job->co_id       = Auth::user()->co_id; // company id
        $job->user_id  = Auth::user()->id;
        if($job->update()){
            Session::flash('success',BaseController::editSuccess('الوظيفة '));
        }else{
            Session::flash('error',BaseController::editError('الوظيفة'));
        }
        return Redirect::route('addJob');

    }

    protected function JobData()
    {
        $Jop =Lang::get('main.Jop');
        $addJop =Lang::get('main.addJop');
        $data['title']              = $Jop;
        $data['employees']          = 'open' ;
        $data['modelMini']          = "";
        $data['arabicName']         = $addJop;
        $data['tablesData']         = Job::company()->get();
        return $data;
    }

    public function deleteJob($id)
    {
        $job = Job::find($id);
        if(!empty($job)){

            $employees = Employees::where('job_id',$id)->company()->first();
//            var_dump($employees); die();
            if(!empty($employees)){

                Session::flash('error',Lang::get('main.delete_job_error_msg'));
                return Redirect::back();
            }else{

                $job->delete();

              $edit_ids = BaseController::editIds('hr_jobs','Job','true_id');
                if($edit_ids) {
                    Session::flash('success', Lang::get('main.delete_job_success_msg'));
                    return Redirect::back();
                }
            }//end else employees


        }// end if dep
    }

    public function multiDeleteJob(){
        $inputs = Input::all();

        // if user not select any check box
        if (!isset($inputs['checkbox'])) {
            Session::flash('error', 'لم يتم تحديد بيانات لحذفها ');
            return Redirect::back();
        }

        $count_of_deleted  = 0;
        $cant_delete_group = [];
        $want_to_delete    = count($inputs['checkbox']);

        foreach ($inputs['checkbox'] as $id) {

            $employees = Employees::company()->where('job_id',$id)->first();
            if(!$employees){
                Job::company()->find($id)->delete();
                $count_of_deleted++;
            }else{
                $cant_delete_group[] =  Job::company()->where('id', $id)->first()->name;
            }
        }

        if($count_of_deleted > 0 && $count_of_deleted  == $want_to_delete){
            $type_of_msg = 'success';
            $msg = $this->deleteSuccess('الوظائف');
        }else{
            $type_of_msg = 'error';
            $msg = $this->multiDeleteHrMsg($want_to_delete,$count_of_deleted,'الوظائف',$cant_delete_group);
        }

        Session::flash($type_of_msg,$msg);
        return Redirect::back();

    }
}