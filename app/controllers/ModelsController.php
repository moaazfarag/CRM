<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 7/11/2015
 * Time: 12:09 AM
 */
class ModelsController extends BaseController
{

    /**
     * return view of add form
     * @return mixed
     */
    public function addModel()
    {
        $data = $this->modelData();
        $data['catActive'] = "active";
        return View::make('dashboard.product_models',$data);
    }

    /**
     * add new season to database
     */
    public function storeModel()
    {
        $model           = new Models ;
        $model->name     = Input::get('name'); //season name from input
        $model->co_id    = Auth::user()->co_id; // company id
        $model->user_id  = Auth::id();// user who add this record
        $model->save();
        return Redirect::route('addModel');
    }

    public function editModel($id)
    {
        //dd('saddsa');
        $data = $this->modelData();
        $data['catActive'] = "active";
        $data['editModel']  = Models::findOrFail($id);
        return View::make('dashboard.product_models',$data);

    }
    public function updateModel($id)
    {
        $model           = Models::findOrFail($id) ;
        $model->name = Input::get('name'); //season name from input
        $model->co_id    = Auth::user()->co_id; // company id
        $model->user_id  = Auth::id();// user who add this record
        $model->update();
        return Redirect::route('addModel');

    }

    /**
     * data will use in season
     * @return mixed
     */
    protected function modelData()
    {
        $itemCat                    =Lang::get('main.itemCat');
        $marka                      =Lang::get('main.marka');
        $data['title']              = $itemCat;
        $data['activeModelNav']     = "active";
        $data['catFunName']         = "editModel";
        $data['seasonInputName']    = "seasons";
        $data['asideOpen']          = 'open' ;
        $data['modelMini']          = "";
        $data['arabicName']         = $marka;
        $data['tablesData']         = Models::all();
        return $data;
    }
}