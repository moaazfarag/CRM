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

        $data['branch']     = $this->isAllBranch();

        $addItemsBalances =Lang::get('main.addItemsBalances');
        $data['title']     = $addItemsBalances; // page title
        $data['sideOpen']   = 'open' ;
        $data['co_info']  = CoData::thisCompany()->first();//select info models category seasons
        return View::make('dashboard.items_balances.index',$data);
    }


    /**
     * @return mixed
     * store Items Balances
     */

    public function storeItemsBalances()
    {
        $inputs = Input::all();
        $br_id =  isset($inputs['br_id'])?$inputs['br_id']:0;
        $branch =  Branches::company()->find($br_id);
        if ($branch) {
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
                        'cost'         => $inputs['cost_'.$k],
                        'serial_no'    => isset($inputs['serial_'.$k])?$inputs['serial_'.$k]:0,
                        'br_id'        => isset($inputs['br_id'])?$inputs['br_id']:0,
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

        }else{
            return "الفرع غير موجود ";
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





    public function viewItemsBalances (){

        $all_item_balances = ItemsBalances::company()->select(DB::raw('SUM(qty) AS sum_qty'),DB::raw('AVG(cost) AS avg_cost'),'items_balances.*')->groupBy('item_id')->get();
        if($all_item_balances){
            $data['title']       = "أرصدة الأصناف الافتتاحية " ; // page title
            $data['TransOpen']   = 'open' ;
            $data['balances']    = $all_item_balances;
            return View::make('dashboard.items_balances.view_balances',$data);

        }else{

            return "that's not correct page : type check fail";

        }

    }

    public function deleteItemsBalances($id){

        $item_balance = ItemsBalances::where('item_id',$id)->get();

        if($item_balance) {

            foreach($item_balance as $item ) {
                $item = $item->items->item_name;
            }

            $delete_item_balance = DB::table('items_balances')->where('item_id', $id)->delete();
            if($delete_item_balance){

                Session::flash('success', "تم حذف الرصيد الإفتتاحى للصنف ". $item);
                return Redirect::back();
            }
        }
    }

}
