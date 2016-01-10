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

        $data['unit']  = array('piece'=>Lang::get('main.piece'), 'kilo'=>Lang::get('main.kilo'), 'ton'=>Lang::get('main.ton') , 'meter'=>Lang::get('main.meter'), 'galon'=>Lang::get('main.galon') );
        $data['account_type']  = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'));
        $data['title']     =  Lang::get('main.addItem')  ; // page title
        $data['asideOpen']      = "open";
        $data['co_info']   = CoData::thisCompany()->first();//select info models category seasons
        return View::make('dashboard.products.items.index',$data);
    }
    public  function storeItem()
    {
        $inputs = Input::all();
        $validation = Validator::make($inputs, Items::$store_rules,BaseController::$messages);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());

        }else {
            $newItem = new Items;
            $newItem->co_id = $this->coAuth();
            $newItem->cat_id           = $inputs['cat_id'];
            $newItem->item_name        = $inputs['item_name'];
            $newItem->unit             = $inputs['unit'];
            if(PermissionController::isShow('main_info','offer','add')){
                $newItem->offer_id         = isset($inputs['offer_id'])?$inputs['offer_id']:null;
            }
            $true_id                   = Items::company()->max('true_id')+1;
            $newItem->true_id          = $true_id;
            $newItem->supplier_id      = isset($inputs['supplier_id'])?$inputs['supplier_id']:0;
            $newItem->seasons_id       = isset($inputs['seasons_id'])?$inputs['seasons_id']:0;
            $newItem->models_id        = isset($inputs['models_id'])?$inputs['models_id']:0;
            $newItem->marks_id         = isset($inputs['marks_id'])?$inputs['marks_id']:0;
            $newItem->bar_code         = ($inputs['bar_code'])?$inputs['bar_code']:intval("100".$true_id);
            $newItem->buy              = $inputs['buy'];
            $newItem->sell_users       = $inputs['sell_users'];
            $newItem->sell_nos_gomla   = $inputs['sell_nos_gomla'];
            $newItem->sell_gomla       = $inputs['sell_gomla'];
            $newItem->sell_gomla_gomla = $inputs['sell_gomla_gomla'];
            $newItem->limit            = $inputs['limit'];
            $newItem->notes            = $inputs['notes'];
            $newItem->has_serial       = isset($inputs['has_serial'])?$inputs['has_serial']:0;
            $newItem->has_label       = isset($inputs['has_label'])?$inputs['has_label']:0;

            $newItem->user_id          = Auth::id();

            if($newItem->save()){

                Session::flash('success',BaseController::addSuccess('الصنف'));
            }else{

                Session::flash('error',BaseController::addError('الصنف'));
            }
            return Redirect::route('addItem');
        }
    }
    public  function editItem($id)
    {
        $data['account_type']  = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'));
        $data['unit']  = array('piece'=>Lang::get('main.piece'), 'kilo'=>Lang::get('main.kilo'), 'ton'=>Lang::get('main.ton') , 'meter'=>Lang::get('main.meter') , 'galon'=>Lang::get('main.galon'));
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
            $data['error'] = 'لا يوجد صنف بهذا الاسم ';
            return View::make('errors.missing',$data);          }
    }


    public  function updateItem($id)
    {
        $validation = Validator::make(Input::all(), Items::$update_rules,BaseController::$messages);
        $inputs = Input::all();
        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {
            $oldItem  = Items::where('id','=',$id)->company()->first();
            if($oldItem) {
//                dd($inputs['has_serial']);
                $oldItem->co_id = $this->coAuth();
                $oldItem->cat_id           = $inputs['cat_id'];
                $oldItem->item_name        = $inputs['item_name'];
                $oldItem->unit             = $inputs['unit'];
                if(PermissionController::isShow('main_info','offer','add')){
                    $oldItem->offer_id         = isset($inputs['offer_id'])?$inputs['offer_id']:null;
                }
                $oldItem->supplier_id      = isset($inputs['supplier_id'])?$inputs['supplier_id']:0;
                $oldItem->seasons_id       = isset($inputs['seasons_id'])?$inputs['seasons_id']:0;
                $oldItem->models_id        = isset($inputs['models_id'])?$inputs['models_id']:0;
                $oldItem->marks_id         = isset($inputs['marks_id'])?$inputs['marks_id']:0;
                $oldItem->bar_code         = isset($inputs['bar_code'])?$inputs['bar_code']:intval("100".$oldItem->true_id);
                $oldItem->buy              = $inputs['buy'];
                $oldItem->sell_users       = $inputs['sell_users'];
                $oldItem->sell_nos_gomla   = $inputs['sell_nos_gomla'];
                $oldItem->sell_gomla       = $inputs['sell_gomla'];
                $oldItem->sell_gomla_gomla = $inputs['sell_gomla_gomla'];
                $oldItem->limit            = $inputs['limit'];
                $oldItem->notes            = $inputs['notes'];
                $oldItem->has_serial       = isset($inputs['has_serial'])?$inputs['has_serial']:0;
                $oldItem->has_label        = isset($inputs['has_label'])?$inputs['has_label']:0;
                $oldItem->user_id          = Auth::id();

                if($oldItem->update()){
                    Session::flash('success',BaseController::editSuccess('الصنف'));
                }else{
                    Session::flash('error',BaseController::editError('الصنف'));
                }

                return Redirect::route('addItem');
            }else{

                $data['error'] = '';
                return View::make('errors.missing',$data);              }
            }
    }
    public function showItem($id){
        $data['title']     = Lang::get('main.editItem');
        $data['mainasideOpen']      = "open";
        $data['item']      = Items::company()->where('id','=',$id)->first();
        if($data['item'])
        {
            $data['co_info']  = CoData::thisCompany()->first();
            return View::make('dashboard.products.items.show_item',$data);
        }else{
            $data['error'] = 'لا يوجد صنف بهذا الاسم ';
            return View::make('errors.missing',$data);
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

        $models = Models::company()->where('marks_id', Input::get('id'))->get();

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
        $data['report_open'] = "open";
        $data['stores'] = "open";
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
        if(Input::Has('account')){
            $ruels = TransHeader::$report_ruels_saels_with_account;
        }else{
            $ruels = TransHeader::$report_ruels_saels;
        }
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
            $data['report_open'] = "open";
            $data['stores'] = "open";
            $data['balBefore'] = $balBefore;
            $data['co_info']   = CoData::thisCompany()->first();
            $data['date_from'] = $this->strToTime($inputs['date_from']);
            $data['date_to']   = $this->strToTime($inputs['date_to']);
            $data['title']     = "كارت  الصنف";
            return View::make('dashboard.products.items.report.report_result',$data);
        }
    }

    public function searchTheBalanceOfTheStores ($type){

        if(in_array($type,['balance_stores','evaluation_stores','inventory_store'])){

            $data['report_open']    = "open";
            $data['stores']         = "open";
            $data['type']           = $type;
            $data['title']          = Lang::get('main.'.$type);
            $data['co_info']        = CoData::thisCompany()->first();
            $data['branch']         = $this->isAllBranch();

            return View::make('dashboard.products.items.balance_report.balance_search',$data);

        }else{

            return View::make('errors.missing');
        }


    }

    public function resultTheBalanceOfTheStores($type){


        if(in_array($type,['balance_stores','evaluation_stores','inventory_store'])){

            $data['type']        = $type;
            $data['title']       = Lang::get('main.'.$type);
            $data['report_open'] = "open";
            $data['stores']      = "open";
            $balances            =  DB::table('items_balance')
                ->company()
                ->groupBy('br_id')
                ->groupBy('item_id')
                ->where('br_deleted',0)
                ->where('trans_deleted',0);
            if(Input::get('cat_id') != ''){

                $balances->where('cat_id',Input::get('cat_id'));
            }
            if ($this->isHaveBranch()) {
                if (Input::get('br_id') != '') {
                    $balances->where('br_id', Input::get('br_id'));
                }
            } else{
                $balances->where('br_id',Auth::user()->br_id);
            }


                $balances->select(DB::raw('SUM(item_bal) AS balance') ,'items_balance.*');

            if(Input::get('no_zero_results') != ''){

                $zero_results       = Items::company()->whereNotIn('id',$balances->lists('item_id'));

                if(Input::get('cat_id') != ''){

                    $zero_results->where('cat_id',Input::get('cat_id'));
                }



                $data['show_zero_results']  = 'no';

                $data['zero_results']       = $zero_results->get();
                $data['zero_result_title']  = 'أرصدة المخازن الصفرية ';

            }else {

                $data['show_zero_results']  ='yes';
            }

                $data['balances'] = $balances->get();

            return View::make('dashboard.products.items.balance_report.balance_result',$data);

        }else{

            return View::make('errors.missing');
        }


    }

    public function inventoryResult(){

        $inputs         = Input::all();
        $all_item       = explode('|',$inputs['all_item']);
//        dd($all_item);
//        $all_item       = array_slice($all_item, 0, -1);

        $inventory_data = array();
         $i             = 0 ;

        foreach($all_item as $item_id){

          if($inputs['inventory_'.$item_id] != ''){

              $inventory_data[$i]['branch_name']   = $inputs['branchName_'.$item_id];
              $inventory_data[$i]['cat_name']      = $inputs['catName_'.$item_id];
              $inventory_data[$i]['item_name']     = $inputs['itemName_'.$item_id];
              $inventory_data[$i]['balance_num']   = $inputs['balance_'.$item_id];
              $inventory_data[$i]['inventory_num'] = $inputs['inventory_'.$item_id];
              $inventory_data[$i]['item_id']       = $inputs['itemId_'.$item_id];
          }

            $i++;
        }
        $data['report_open'] = "open";
        $data['stores'] = "open";
        $data['show_zero_results']   ='yes';
        $data['balances']            = $inventory_data;
        $data['type']                = 'inventory_result';
        $data['title']               = Lang::get('main.inventory_result');

        return View::make('dashboard.products.items.balance_report.balance_result',$data);

    }

    /**
     * print  barcode  base on ch
     * @return mixed
     */
    public  function barcode()
    {
        $data['title']     =  Lang::get('main.has_label')  ; // page title
        $data['asideOpen']      = "open";
        $data['co_info']   = CoData::thisCompany()->first();//select info models category seasons
        return View::make('dashboard.products.items.barcode.index',$data);
    }
    /**
     * print  barcode  base on ch
     * @return mixed
     */
    public  function barcodeSearch()
    {

        $items = Items::company()->where('has_label',1);
        if(Input::has('item_id')){
            $items->where('id',Input::get('item_id'));
        }
        if(Input::has('cat_id')) {
            $items->where('cat_id', Input::get('cat_id'));
        }
        if(Input::has('seasons_id')){
            $items->where('seasons_id',Input::get('seasons_id'));
        }
//dd(Input::get('cat_id'));
        $data['items'] = $items->get();
        $data['asideOpen']      = "open";
        $data['title']     =  Lang::get('main.has_label')  ; // page title
        $data['co_info']   = CoData::thisCompany()->first();//select info models category seasons
        return View::make('dashboard.products.items.barcode.result',$data);
    }
    /**
     * print  barcode  base on ch
     * @return mixed
     */
    public function showAllItems(){
        $data['categories'] = Category::company()->get();
        $data['title'] = 'أصناف الشركة';

        return View::make('dashboard.products.items.report.show_all_items_report',$data);
    }
    public  function printBarcode()
    {
        foreach(Input::all() as $k => $v)
        {
            if(preg_match('/^qty_/', $k))
            {
                $after = [];
                if (Input::has($k)) {
                    $after = explode('_',$k);
                    $idAndQty[] = ['id'=>intval($after[1]),'qty'=>$v];
                    $ids[]    =intval($after[1]);
                }
            }
        }
        $items  = Items::company()->whereIn('id',$ids)->get();

        $data['title']     =  Lang::get('main.has_label')  ; // page title
        $data['items']     = $items;
        $data['idAndQty']  = $idAndQty;
        return View::make('dashboard.transaction.print-label',$data);
    }
    public function multiStopItems()
    {
        $inputs = Input::all();

        // if user not select any check box
        if (!isset($inputs['checkbox'])) {
            Session::flash('error', 'لم يتم تحديد بيانات لحذفها ');
            return Redirect::back();
        }

        $count_of_deleted = 0;
        $want_to_delete   = count($inputs['checkbox']);

        foreach ($inputs['checkbox'] as $id) {
            $item = Items::where('id',$id)->company()->first();
           if($item){
               $item->deleted = 1 ;
               $item->update();
               $count_of_deleted++;
           }
        }
        Session::flash('success','تم إيقاف '.'('.$count_of_deleted .') صنف '.'بنجاح');
        return Redirect::back();
    }
}