<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 7/7/2015
 * Time: 3:15 PM
 */
class BranchController extends  BaseController
{
    /**
     * create add branch view
     * @return mixed
     *
     */
    public  function addBranch()
    {
        $data = $this->settingData();
        $data['miniBranch']  = "" ;
        return View::make('dashboard.setting', $data);
    }
        /**
     * store new  branch into database
     * @return mixed
     *
     */
    public  function storeBranch()
    {
    //d(Input::get('branch_name') );
        $branch = new Branches;
        $branch->br_name    = Input::get('branch_name');
        $branch->br_address = Input::get('branch_address');
        $branch->user_id    = Auth::id();
        $branch->co_id      = Auth::user()->co_id;
        $branch->save();
        return Redirect::route('addBranch');
    }
    /**
     * create edit branch view
     * @return mixed
     *
     */
    public  function editBranch()
    {
        $id = Input::get('branch_id');
        $data = $this->settingData();
        $data['branch'] = Branches::find($id);
        $data['miniBranch']  = "" ;
        return View::make('dashboard.setting', $data);
    }
    public  function updateBranch($id)
    {
        //d(Input::get('branch_name') );
        $branch =  Branches::findOrFail($id);
        $branch->br_name    = Input::get('branch_name');
        $branch->br_address = Input::get('branch_address');
        $branch->user_id    = Auth::id();
        $branch->co_id      = Auth::user()->co_id;
        $branch->update();
        return Redirect::route('addBranch');
//        return Redirect::route('editBranch',array("branch_id"=>$branch->id));
    }
}