<?php
/**
 * Created by PhpStorm.
 * User: Mohamed Hafez
 * Date: 22/7/2015
 * Time: 3:49 PM
 */

class ItemsBalancesController extends BaseController {

    public function addItemsBalances()
    {
        $data['title']     = "اضف جديد بارصدة الاصناف  "; // page title
        $data['co_info']  = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons
        $data['items']    = ItemsBalances::where('co_id','=',$this->coAuth())->get(); //  get all item to view in table

        return View::make('dashboard.items_balances',$data);
    }

    public function storeItemsBalances()
    {
        $validation = Validator::make(Input::all(), ItemsBalances::$store_rules);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {
//            die('hi');
                $itemsBalances = new ItemsBalances;

                $itemsBalances->co_id        = $this->coAuth();
                $itemsBalances->user_id      = Auth::id();

                $itemsBalances->item_id      = Input::get('item_id');
                $itemsBalances->bar_code     = Input::get('bar_code');
                $itemsBalances->qty          = Input::get('qty');
                $itemsBalances->cost         = Input::get('cost');
                $itemsBalances->serial_no    = Input::get('serial_no');

                $itemsBalances->save();

                return Redirect::route('addItemsBalances');
            }
        
    }





} 