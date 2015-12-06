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
        $data['currency'] = BaseController::$currency;
        $data['print_size_types'] = array(

            "A3"=>"A3",
            "A4"=>"A4",
            "A5"=>"A5",

        );
        return View::make('dashboard.company.index', $data);
    }
        /**
     * store new  branch into database
     * @return mixed
     *
     */
    public  function storeBranch()
    {
    //d(Input::get('branch_name') );
        $branch             = new Branches; //object from branch will add
        $branch->true_id    = BaseController::maxId($branch);
        $branch->br_name    = Input::get('branch_name');
        $branch->br_address = Input::get('branch_address');
        $branch->user_id    = Auth::id();  // id of user  who add  this branch
        $branch->co_id      = Auth::user()->co_id;// id of company related this branch

       if($branch->save()){

           Session::flash('success_br',BaseController::addSuccess('الفرع'));

       }else{
           Session::flash('error_br',BaseController::addError('الفرع'));

       }
//        return Redirect::back();
        

        return Redirect::route('addBranch');
    }
    /**
     * create edit branch view
     * @return mixed
     *
     */
    public  function editBranch()
    {
        $id                  = Input::get('br_id');
        $data                = $this->settingData(); //company info data
        $data['print_size_types'] = array(

            "A3"=>"A3",
            "A4"=>"A4",
            "A5"=>"A5",

        );
        $data['currency'] = BaseController::$currency;
        $data['branch']      = Branches::findOrFail($id); //get branch will update
        $data['miniBranch']  = "" ; //to maxmize  branch card in view
        return View::make('dashboard.company.index', $data);
    }

    /**
     * update branch into database
     * @param $id of branch
     * @return mixed
     */
    public  function updateBranch($id)
    {
        //d(Input::get('branch_name') );
        $branch             =  Branches::findOrFail($id); //object from branch will update
        $branch->br_name    = Input::get('branch_name');
        $branch->br_address = Input::get('branch_address');
        $branch->user_id    = Auth::id(); // id of user  who update this branch
        $branch->co_id      = Auth::user()->co_id; // id of company related this branch
        if($branch->update()){

            Session::flash('success_br',BaseController::editSuccess('الفرع'));
        }else{
            Session::flash('error_br',BaseController::editError('الفرع'));

        }
        return Redirect::route('addBranch');
//        return Redirect::route('editBranch',array("br_id"=>$branch->id));
    }
}