<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 7/11/2015
 * Time: 12:09 AM
 */
class SeasonController extends BaseController
{

    /**
     * return view of add form
     * @return mixed
     */
    public function addSeason()
    {
        $data = $this->seasonData();
        $data['catActive'] = "active";
        $data['table_name']= 'seasons';
        return View::make('dashboard.products.seasons.index',$data);
    }

    /**
     * add new season to database
     */
    public function storeSeason()
    {
        $season           = new Seasons ;
        $season->true_id  = BaseController::maxId($season);
        $season->name     = Input::get('name'); //season name from input
        $season->co_id    = Auth::user()->co_id; // company id
        $season->user_id  = Auth::id();// user who add this record

        if($season->save()){

            Session::flash('success',BaseController::addSuccess('الموسم'));
        }else{

            Session::flash('error',BaseController::addError('الموسم'));
        }
        return Redirect::route('addSeason');
    }

    public function editSeason($id)
    {
        //dd('saddsa');
        $data = $this->seasonData();
        $data['table_name']= 'seasons';
        $data['catActive'] = "active";
        $data['editSeason']  = Seasons::findOrFail($id);
        return View::make('dashboard.products.seasons.index',$data);

    }
    public function updateSeason($id)
    {
        $season           = Seasons::findOrFail($id) ;
        $season->name = Input::get('name'); //season name from input
        $season->co_id    = Auth::user()->co_id; // company id
        $season->user_id  = Auth::id();// user who add this record

        if($season->update()){
            Session::flash('success',BaseController::editSuccess('الموسم'));
        }else{
            Session::flash('error',BaseController::editError('الموسم'));
        }


        return Redirect::route('addSeason');

    }

    /**
     * data will use in season
     * @return mixed
     */
    protected function seasonData()
    {
        $itemCat     = Lang::get('main.itemCat');
        $season      = Lang::get('main.season');
        $data['title'] = $itemCat;
        $data['catFunName'] = "editSeason";
        $data['activeSeasonNav'] = "active";
        $data['asideOpen']   = 'open' ;
        $data['seasonInputName'] = "seasons";
        $data['seasonMini'] = "";
        $data['arabicName'] = $season;
        $data['tablesData'] = Seasons::company()->get();
//        dd($data['tablesData']);
        return $data;
    }

    public function deleteSeason($id)
    {


        $season = Seasons::company()->find($id);
        $items = Items::where('seasons_id', '=', $id)->company()->first();


        if (!empty($season)) {

            if (!empty($items)) {
//            die(var_dump($items));
                Session::flash('error', 'لا يمكن الحذف ...   هناك أصناف تحمل اسم هذا الموسم');
                return Redirect::back();
            } else {

                $season->delete();
                $edit_ids = BaseController::editIds('models', 'Models', 'true_id');
                if ($edit_ids) {
                    Session::flash('success', 'تم حذف الموسم بنجاح');
                    return Redirect::back();
                }
            }//end else employees

        }
    }


}