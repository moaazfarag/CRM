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
        $jop           = new Job ;
        $jop->name     = Input::get('name');
        $jop->co_id    = Auth::user()->co_id;
//        $dep->user_id  = Auth::id();
        $jop->save();
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

                Session::flash('error','لا يمكن حذف هذه الوظيفة لوجود موظفين بها ');
                return Redirect::back();
            }else{
                $job->delete();
                Session::flash('success','لقد تم حذف الوظيفة بنجاح ');
                return Redirect::back();

            }//end else employees

        }// end if dep
    }
}