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
//        $data['items']     = Items::company()->get(); //  get all item to view in table
        $data['co_info']   = CoData::thisCompany()->first();//select info models category seasons
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
            $newItem->true_id    = BaseController::maxId($newItem);
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
//        $data['items']     = Items::company()->get(); //  get all item to view in table
        $data['item']      = Items::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();//item will edit
//        dd($data['item']);
        if($data['item'])
        {
            $data['co_info']  = CoData::thisCompany()->first();//select info models category seasons
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
                $oldItem->has_serial       = isset($inputs['has_serial'])?$inputs['has_serial']:0;
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
    public function searchItemCard(){
        $data['type']           = "item";
        $data['title']           = "كارت الصنف";
        $data['TransOpen']   = 'open' ;
        $data['sum']            = NULL;
        $data['co_info']        = CoData::thisCompany()->first();
        $data['branch']         = $this->isAllBranch();
        $data['pay_type']       = array(''=>Lang::get('main.select_pay_type'),'cash'=>Lang::get('main.cash'),'visa'=>Lang::get('main.visa'),'on_account'=>Lang::get('main.on_account'));
        $data['items']          = Items::company()->get()->lists('item_name','id');
        $data['of_account']     = array( ''=>'أختر الحساب','customers'=>'العملاء','suppliers'=>'الموردين', 'partners' =>'جارى الشركاء', 'bank'  =>'البنك');
        $data['account_type']   = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'));
        return View::make('dashboard.products.items.report.report_search',$data);

    }
    public function reportResultItemCard (){

        $inputs = Input::all();
//        var_dump($inputs);die();

        if(Input::Has('account')){
            $ruels = TransHeader::$report_ruels_saels_with_account;
        }else{
            $ruels = TransHeader::$report_ruels_saels;
        }
//var_dump($ruels);die();

        $validation = Validator::make($inputs,$ruels,BaseController::$messages);
        if($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {
            $itemsTrans     = TransHeader::getItems($inputs,false);
            $items          = [];
            $balBefore      = [];
//            dd($itemsTrans->lists('item_id'));
            foreach(array_unique($itemsTrans->lists('item_id')) as $itemId ){
                $inputs['item_id']    = $itemId;
                $items[]              = TransHeader::getItems($inputs,false)->get();
                $balBefore[$itemId]['bal'] = array_sum(TransHeader::getItems($inputs,1)->lists('item_bal') );
            }
            $data['items']     = $items;
            $data['TransOpen']   = 'open' ;
            $data['balBefore'] = $balBefore;
            $data['co_info']   = CoData::thisCompany()->first();
            $data['date_from'] = $this->strToTime($inputs['date_from']);
            $data['date_to']   = $this->strToTime($inputs['date_to']);
            $data['title']     = "كارت  الصنف";
            return View::make('dashboard.products.items.report.report_result',$data);
        }
    }
}