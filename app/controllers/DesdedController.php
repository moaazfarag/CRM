<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/15/2015
 * Time: 5:37 PM
 */
class DesdedController extends BaseController
{
    public function addDesded()
    {

        $data = $this->staticData() ;
        $data['title']     = 'اضف بند جديد '  ; // page title
        $data['employees'] = "open";
        $data['co_info']   = CoData::where('id','=',$this->coAuth())->first();
        return View::make('dashboard.desded',$data);

    }
    public function storeDesded()
    {
        $validation = Validator::make(Input::all(), Desded::$store_rules);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }
        else
        {
            $newDesded                             = new Desded;
            $newDesded->co_id                      = $this->coAuth();
            $newDesded->name                       = Input::get('name');
            $newDesded->ds_type                    = Input::get('ds_type');
            $newDesded->ds_cat                     = Input::get('ds_cat');
            $newDesded->save();
            return Redirect::route('addDesded');
        }

    }
    public  function editDesded($id)
    {
        $data = $this->staticData() ;
        $data['title']     = 'تعديل فى بنود الاستحقاق'; // page title
        $data['employees'] = "open";
        $data['employee'] = Desded::findOrFail($id);
        $data['co_info']   = CoData::where('id','=',$this->coAuth())->first();
        return View::make('dashboard.desded',$data);
    }
    public function updateDesded($id)
    {
        $validation = Validator::make(Input::all(), Desded::$update_rules);

        if($validation->fails())
        {
            //dd($validation->messages());
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {
            $newDesded  = DesDed::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();
            if($newDesded){
            $newDesded = Desded::find($id);
            $newDesded->co_id                      = $this->coAuth();
            $newDesded->name                       = Input::get('name');
            $newDesded->ds_type                    = Input::get('ds_type');
            $newDesded->ds_cat                     = Input::get('ds_cat');

            $newDesded->update();
            return Redirect::route('addDesded');
        }else{
        return "this item snot found ";
    }

    }
    }

    public function staticData()
    {
        $data['employees']          = 'open' ;
        $data['tablesData']        = Desded::where('co_id','=',$this->coAuth())->get();
        $data['ds_type'] = array(
            '' => '        النوع',
            'استحقاق' => '           استحقاق',
            'استقطاع' => '         استقطاع ');
        return $data;

    }
    }