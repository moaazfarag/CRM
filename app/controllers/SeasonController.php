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
        return View::make('dashboard.product_seasons',$data);
    }

    /**
     * add new season to database
     */
    public function storeSeason()
    {
        $season           = new Seasons ;
        $season->name = Input::get('name'); //season name from input
        $season->co_id    = Auth::user()->co_id; // company id
        $season->user_id  = Auth::id();// user who add this record
        $season->save();
        return Redirect::route('addSeason');
    }

    public function editSeason($id)
    {
        //dd('saddsa');
        $data = $this->seasonData();
        $data['catActive'] = "active";
        $data['editSeason']  = Seasons::findOrFail($id);
        return View::make('dashboard.product_seasons',$data);

    }
    public function updateSeason($id)
    {
        $season           = Seasons::findOrFail($id) ;
        $season->name = Input::get('name'); //season name from input
        $season->co_id    = Auth::user()->co_id; // company id
        $season->user_id  = Auth::id();// user who add this record
        $season->update();
        return Redirect::route('addSeason');

    }

    /**
     * data will use in season
     * @return mixed
     */
    protected function seasonData()
    {

        $data['title'] = "فئات الاصناف";
        $data['catFunName'] = "editSeason";
        $data['activeSeasonNav'] = "active";
        $data['seasonInputName'] = "seasons";
        $data['seasonMini'] = "";
        $data['arabicName'] = "الموسم";
        $data['tablesData'] = Seasons::all();
        return $data;
    }
}