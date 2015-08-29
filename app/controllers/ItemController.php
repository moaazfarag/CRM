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

        $data['title']     =  Lang::get('main.addItem')  ; // page title
        $data['asideOpen']      = "open";
//        $data['items']     = Items::where('co_id','=',$this->coAuth())->get(); //  get all item to view in table
        $data['co_info']   = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons
//        $data['accounts']  = Accounts::where('acc_type','=','suppliers')
//                                        ->where('co_id','=',Auth::user()->co_id)
//                                        ->get()
//                                        ->lists('acc_name','id');// suppliers from accounts table
        return View::make('dashboard.products.items.index',$data);
    }
    public  function storeItem()
    {
        $inputs = Input::all();
        $validation = Validator::make($inputs, Items::$store_rules);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {
            $newItem = new Items;

            $newItem->co_id = $this->coAuth();

            $newItem->cat_id           = $inputs['cat_id'];
            $newItem->item_name        = $inputs['item_name'];
            $newItem->unit             = $inputs['unit'];
            $newItem->supplier_id      = isset($inputs['supplier_id'])?$inputs['supplier_id']:0;
            $newItem->seasons_id       = isset($inputs['seasons_id'])?$inputs['seasons_id']:0;
            $newItem->models_id        = isset($inputs['models_id'])?$inputs['models_id']:0;
            $newItem->marks_id         = isset($inputs['marks_id'])?$inputs['marks_id']:0;
            $newItem->bar_code         = isset($inputs['bar_code'])?$inputs['bar_code']:0;
            $newItem->buy              = $inputs['buy'];
            $newItem->sell_users       = $inputs['sell_users'];
            $newItem->sell_nos_gomla   = $inputs['sell_nos_gomla'];
            $newItem->sell_gomla       = $inputs['sell_gomla'];
            $newItem->sell_gomla_gomla = $inputs['sell_gomla_gomla'];
            $newItem->limit            = $inputs['limit'];
            $newItem->notes            = $inputs['notes'];
            $newItem->has_serial       = isset($inputs['has_serial'])?$inputs['has_serial']:0;

            $newItem->user_id          = Auth::id();

            $newItem->save();
            return Redirect::route('addItem');
        }
    }
    public  function editItem($id)
    {
        $data['title']     = Lang::get('main.editItem'); // page title
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
            return View::make('dashboard.products.items.index',$data);
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
    public function select_mark()
{

    if ( Session::token() !== Input::get( '_token' ) ) {

        return 'عفوا هذه الطريقة غير مسموح بها ';

    }

    if(intval(Input::get('id')) != 0 ) {
        $models = Models::where('co_id', $this->coAuth())->where('marks_id', Input::get('id'))->get();

        if (@$models->first()->name) {



            foreach ($models as $model) {

                $select =   '<option value="'.$model->id.'">' . $model->name . '</option> ';
            }

            return $select;
        }else{
            return '<option value=""  style="color: red">لا يوجد موديلات لهذه الماركة </option>';

        }
    }

}

    public function select_mark_json()
    {

        if ( Session::token() !== Input::get( '_token' ) ) {

            $msg = array( 'عفوا هذه الطريقة غير مسموح بها ');
            return Response::json($msg);

        }

        $models = Models::where('co_id', $this->coAuth())->where('marks_id', Input::get('id'))->get();

            if (!empty($models)) {

              return Response::json($models);


        }else{

            return Response::json(array('CCCC'));
        }
    }
    public function deleteItems($id){

        $item = Items::find($id);

        if(!empty($item)){

           $item->deleted = 1;
           $item->save();

            Session::flash('success','تم إلغاء الصنف بنجاح');
            return Redirect::route('addItem','#all-items');



        }// end if item

        return 'ok';
    }
}