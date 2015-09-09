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
//        $dep->user_id  = Auth::id();
        $job->save();
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
//        $dep->user_id  = Auth::id();// user who add this record
        $job->update();
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
        $data['tablesData']         = Job::all();
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
}