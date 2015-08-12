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
//        $data['catActive'] = "active";
        return View::make('dashboard.jobs',$data);
    }

    /**
     * add new season to database
     */
    public function storeJob()
    {
        $jop           = new Job ;
        $jop->jobName     = Input::get('jobName');
        $jop->co_id    = Auth::user()->co_id;
//        $dep->user_id  = Auth::id();
        $jop->save();
        return Redirect::route('addJob');
    }

    public function editJob($id)
    {
        //dd('saddsa');
        $data = $this->JobData();
//        $data['catActive'] = "active";
        $data['editJob']  = Job::findOrFail($id);
        return View::make('dashboard.jobs',$data);

    }
    public function updateJob($id)
    {
        $job           = Job::findOrFail($id) ;
        $job->jobName = Input::get('jobName'); //season name from input
        $job->co_id    = Auth::user()->co_id; // company id
//        $dep->user_id  = Auth::id();// user who add this record
        $job->update();
        return Redirect::route('addJob');

    }

    /**
     * data will use in season
     * @return mixed
     */
    protected function JobData()
    {
        $Jop =Lang::get('main.Jop');
        $addJop =Lang::get('main.addJop');

        $data['title']              = $Jop;
//        $data['activeModelNav']     = "active";
//        $data['catFunName']         = "editJob";
//        $data['seasonInputName']    = "seasons";
        $data['employees']          = 'open' ;
        $data['modelMini']          = "";
        $data['arabicName']         = $addJop;
        $data['tablesData']         = Job::all();
        return $data;
    }
}