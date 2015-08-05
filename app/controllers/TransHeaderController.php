<?php
/**
 * Created by PhpStorm.
 *
 * User: Mohamed Hafez
 * Date: 22/7/2015
 * Time: 3:49 PM
 */

class TransHeaderController extends BaseController {



    /**
     * @return mixed
     * add Items Balances
     */
    public function addTransHeader($type)
    {
        if($type == 'add')
            {
                $name = 'اضافة';
            }

        $data['title']    = " تسوية $name " ; // page title
        $data['TransOpen']   = 'open' ;
        $data['branch']   = $this->isAllBranch();
        $data['co_info']  = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons
        $data['items']    = ItemsBalances::where('co_id','=',$this->coAuth())->get(); //  get all item to view in table

        return View::make('dashboard.trans_header',$data,compact('type'));
    }


    /**
     * @return mixed
     * store Items Balances
     */

    public function storeTransHeader($type)
    {
        $validation = Validator::make(Input::all(), TransHeader::$store_rules);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {

            $transHeader = new TransHeader;

            $transHeader->co_id         = $this->coAuth();
            $transHeader->user_id       = Auth::id();
            $transHeader->br_code       = Auth::user()->br_code;
            $new_num                    = $transHeader->max('invoice_no') ;
            $transHeader->invoice_no    = $new_num + 1; //.'max nun in this colmun and then +1';
            $transHeader->invoice_type  = $type;
            $transHeader->account       = 'from account model group select in li like supplier and csts';
            $transHeader->in_total      = 'a';
            $transHeader->discount      = Input::get('discount');
            $transHeader->tax           = Input::get('tax');
            $transHeader->net           = 'total after -tax and - discount and - in total';
            $transHeader->pay_type      = 'a ';
            $transHeader->deleted       = '1';// Input::get('deleted');

            $transHeader->save();

                return Redirect::route('addTransHeader',array('add'));
            }
        
    }



    /**
     * @return mixed
     * edit Items Balances
     */
    public  function editTransHeader($id)
    {
        $data['title']     = " تعديل  رصيد صنف"; // page title
        $data['items']     = ItemsBalances::where('co_id','=',$this->coAuth())->get(); //  get all item to view in table
        $data['item']      = ItemsBalances::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();//item will edit
//        dd($data['item']);
        if($data['item'])
        {
            $data['co_info']  = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons

            return View::make('dashboard.items_balances',$data);
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


    public function transJson()
    {
        Request::header('application/json');
        if (Request::format() == 'json')
        {
            dd(Input::all());

        }
//        dd(Input::all());


        return Response::json(array('success' => true));

    }

} 