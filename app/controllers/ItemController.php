<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 7/13/2015
 * Time: 1:54 PM
 */
class ItemController extends BaseController
{
    /**
     * add new item to database
     * @return mixed
     */
    public  function addItem()
    {
        $data['title']     = "اضف منتج جديد"; // page title
        $data['asideOpen']      = "open";
//        $data['items']     = Items::where('co_id','=',$this->coAuth())->get(); //  get all item to view in table
        $data['co_info']   = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons
//        $data['accounts']  = Accounts::where('acc_type','=','suppliers')
//                                        ->where('co_id','=',Auth::user()->co_id)
//                                        ->get()
//                                        ->lists('acc_name','id');// suppliers from accounts table
        return View::make('dashboard.product_product',$data);
    }

    public  function storeItem()
    {
        $validation = Validator::make(Input::all(), Items::$store_rules);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {
            $newItem = new Items;

            $newItem->co_id = $this->coAuth();

            $newItem->cat_id           = Input::get('cat_id');
            $newItem->item_name        = Input::get('item_name');
            $newItem->unit             = Input::get('unit');
            $newItem->supplier_id      = Input::get('supplier_id');
            $newItem->seasons_id       = Input::get('seasons_id');
            $newItem->models_id        = Input::get('models_id');
            $newItem->bar_code         = Input::get('bar_code');
            $newItem->buy              = Input::get('buy');
            $newItem->sell_users       = Input::get('sell_users');
            $newItem->sell_nos_gomla   = Input::get('sell_nos_gomla');
            $newItem->sell_gomla       = Input::get('sell_gomla');
            $newItem->sell_gomla_gomla = Input::get('sell_gomla_gomla');
            $newItem->limit            = Input::get('limit');
            $newItem->notes            = Input::get('notes');
            $newItem->user_id          = Auth::id();
            $newItem->has_serial       =Input::get('has_serial');

            $newItem->save();
            return Redirect::route('addItem');
        }
    }

    public  function editItem($id)
    {
        $data['title']     = " تعديل  منتج"; // page title
        $data['mainasideOpen']      = "open";
//        $data['items']     = Items::where('co_id','=',$this->coAuth())->get(); //  get all item to view in table
        $data['item']      = Items::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();//item will edit
//        dd($data['item']);
        if($data['item'])
        {
            $data['co_info']  = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons
//            $data['accounts'] = Accounts::where('acc_type','=','suppliers')
//                ->where('co_id','=',Auth::user()->co_id)
//                ->get()
//                ->lists('acc_name','id');// suppliers from accounts table
            return View::make('dashboard.product_product',$data);
        }else{
            return "item not here";
        }


    }

    public  function updateItem($id)
    {
        $validation = Validator::make(Input::all(), Items::$update_rules);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {
            $oldItem  = Items::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();
            if($oldItem) {
                $oldItem->co_id = $this->coAuth();

                $oldItem->cat_id           = Input::get('cat_id');
                $oldItem->item_name        = Input::get('item_name');
                $oldItem->unit             = Input::get('unit');
                $oldItem->supplier_id      = Input::get('supplier_id');
                $oldItem->seasons_id       = Input::get('seasons_id');
                $oldItem->models_id        = Input::get('models_id');
                $oldItem->bar_code         = Input::get('bar_code');
                $oldItem->buy              = Input::get('buy');
                $oldItem->sell_users       = Input::get('sell_users');
                $oldItem->sell_nos_gomla   = Input::get('sell_nos_gomla');
                $oldItem->sell_gomla       = Input::get('sell_gomla');
                $oldItem->sell_gomla_gomla = Input::get('sell_gomla_gomla');
                $oldItem->limit            = Input::get('limit');
                $oldItem->notes            = Input::get('notes');
                $oldItem->user_id          = Auth::id();

                $oldItem->update();
                return Redirect::route('addItem');
            }else{
                return "this item snot found ";
            }
        }
    }


}