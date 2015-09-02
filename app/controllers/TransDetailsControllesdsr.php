<?php
/**
 * Created by PhpStorm.
 * User: Mohamed Hafez
 * Date: 22/7/2015
 * Time: 3:49 PM
 */

class ItemsBalancesController extends BaseController {

    /**
     * @return mixed
     * add Items Balances
     */

    public function addItemsBalances()
    {

        $addItemsBalances  =Lang::get('main.addItemsBalances');
        $data['title']     =$addItemsBalances; // page title
        $data['TransOpen']   = 'open' ;

        $data['co_info']  = CoData::thisCompany()->first();//select info models category seasons
        $data['items']    = ItemsBalances::company()->get(); //  get all item to view in table

        return View::make('dashboard.items_balances.index',$data);
    }


    /**
     * @return mixed
     * store Items Balances
     */

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



    /**
     * @return mixed
     * edit Items Balances
     */
    public  function editItemsBalances($id)
    {
        $editItemsBalances =Lang::get('main.editItemsBalances');
        $data['title']     = $editItemsBalances; // page title
        $data['TransOpen']   = 'open' ;

        $data['items']     = ItemsBalances::company()->get(); //  get all item to view in table
        $data['item']      = ItemsBalances::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();//item will edit
//        dd($data['item']);
        if($data['item'])
        {
            $data['co_info']  = CoData::thisCompany()->first();//select info models category seasons

            return View::make('dashboard.items_balances.index',$data);
        }else{
            return "item not here";
        }


    }

    /**
     * @return mixed
     * update Items Balances
     */
    public  function updateItemsBalances($id)
    {
        $validation = Validator::make(Input::all(), ItemsBalances::$update_rules);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {

            $itemsBalances  = ItemsBalances::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();

            if($itemsBalances) {

                $itemsBalances->user_id      = Auth::id();
                $itemsBalances->item_id      = Input::get('item_id');
                $itemsBalances->bar_code     = Input::get('bar_code');
                $itemsBalances->qty          = Input::get('qty');
                $itemsBalances->cost         = Input::get('cost');
                $itemsBalances->serial_no    = Input::get('serial_no');

                $itemsBalances->update();

                return Redirect::route('addItemsBalances');
            }else{
                return "This Items Balances Not Found ";
            }
        }
    }





} 