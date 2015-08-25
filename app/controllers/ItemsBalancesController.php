<?php
/**
 * Created by PhpStorm.
 * User: moaaz farag
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
        $get_type = DB::table('trans_details')
        ->join('trans_header','trans_header.id','=','trans_details.trans_header_sid')
        ->join('items','items.id','=','trans_details.item_id')
        ->select('trans_details.trans_header_id AS invoice_id',
            'trans_header.invoice_type AS invoice_type',
            'trans_details.qty AS qty',
            'item_name AS item_name',
            'trans_header.date AS date'
        )
//            ->join('trans_header','trans_ditals.trans_header_id','=','trans_header.id')
            ->get();
        dd($get_type);
        $addItemsBalances =Lang::get('main.addItemsBalances');
        $data['title']     = $addItemsBalances; // page title
        $data['sideOpen']   = 'open' ;
        $data['co_info']  = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons
        return View::make('dashboard.items_balances.index',$data);
    }


    /**
     * @return mixed
     * store Items Balances
     */

    public function storeItemsBalances()
    {
        $inputs = Input::all();

        $validation = Validator::make($inputs, ItemsBalances::rulesCreator($inputs));

        if($validation->fails())
        {
            echo "fail";
            dd(ItemsBalances::rulesCreator($inputs));

        }else {
            $newData = array();//create array to insert into database on  one query
            foreach(TransDetails::countOfInputs($inputs) as $k => $v){
                $item           =  Items::findOrFail($inputs['id_'.$k]);
                $item->avg_cost = $inputs['cost_'.$k];
                $item->update();//update avg cost of item
//              echo $inputs['id_'.$k];
                $newData[]= array
                (
                    'co_id'        => $this->coAuth(),
                    'user_id'      => Auth::id(),
                    'item_id'      => $inputs['id_'.$k],
//                  'bar_code'     => $inputs['bar_code'],
                    'qty'          => $inputs['quantity_'.$k],
                    'cost'         => $inputs['cost_'.$k] * $inputs['quantity_'.$k],
                    'serial_no'    => isset($inputs['serial_'.$k])?$inputs['serial_'.$k]:0,
                    'created_at'   => date('Y-m-d H:i:s'),
                    'updated_at'   => date('Y-m-d H:i:s')
                );//end of array

            }//end foreach
//           die("finish");
            ItemsBalances::insert($newData);//insert  data

            Session::flash('success','تم اضافة الرصيد الافتتاحي بنجاح');
            return Redirect::back();

//                return Redirect::route('addItemsBalances');
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
        $data['sideOpen']   = 'open' ;
        $data['items']     = ItemsBalances::where('co_id','=',$this->coAuth())->get(); //  get all item to view in table
        $data['item']      = ItemsBalances::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();//item will edit
//        dd($data['item']);
        if($data['item'])
        {
            $data['co_info']  = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons

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