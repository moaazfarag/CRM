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
        return View::make('dashboard.products.models.index',$data);
    }

    /**
     * add new season to database
     */
    public function storeModel()
    {
        $model           = new Models ;
        $model->true_id    = BaseController::maxId($model);
        $model->name     = Input::get('name'); //season name from input
        $model->marks_id = Input::get('marks_id'); // mark id from input
        $model->co_id    = Auth::user()->co_id; // company id
        $model->user_id  = Auth::id();// user who add this record
        if($model->save()){

            Session::flash('success',BaseController::addSuccess('الموديل'));
        }else{

            Session::flash('error',BaseController::addError('الموديل'));
        }
        return Redirect::route('addModel');
    }

    public function editModel($id)
    {
        //dd('saddsa');
        $data = $this->modelData();
        $data['catActive'] = "active";
        $data['editModel']  = Models::findOrFail($id);
        return View::make('dashboard.products.models.index',$data);

    }
    public function updateModel($id)
    {
        $model           = Models::findOrFail($id) ;
        $model->name = Input::get('name'); // name from input
        $model->marks_id = Input::get('marks_id'); //marks_id from input
        $model->co_id    = Auth::user()->co_id; // company id
        $model->user_id  = Auth::id();// user who update this record

        if($model->update()){
            Session::flash('success',BaseController::editSuccess('الموديل'));
        }else{
            Session::flash('error',BaseController::editError('الموديل'));
        }

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
        $data['tablesData']         = Models::company()->get();
        $data['arabicName']         = $marka;
        $data['co_info']             = CoData::thisCompany()->first();
        return $data;
    }
    public function deleteModel($id){

        $model = Models::company()->first();
        $items  = Items::where('models_id','=',$id)->company()->first();


       if(!empty($model)){

        if(!empty($items)) {
//            die(var_dump($items));
           Session::flash('error', 'لا يمكن الحذف ...   هناك أصناف تحمل اسم هذا الموديل ');
           return Redirect::back();
       }else{

                $model->delete();
            $edit_ids = BaseController::editIds('models','Models','true_id');
            if($edit_ids) {
                Session::flash('success', 'تم حذف الموديل بنجاح ');
                return Redirect::back();
                }
            }//end else employees

        }// model
    }
}