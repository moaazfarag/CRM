<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 10/12/2015
 * Time: 12:03 PM
 */
class TransController extends BaseController
{

    public function addTrans($type,$br_id){
//        $q = new CreateViewMakerName;
//        $q->up();
        $branch =  Branches::company()->find($br_id);
        $types = ['sales','buy','salesReturn','buyReturn','settleAdd','settleDown','itemBalance'];
        if(in_array($type,$types) && $branch)
        {
            $data['branch'] = $branch;
            return $this->returnView($type, $data);
        }else{
            return View::make('errors.missing');
        }
    }

    public function storeTrans($type,$br_id,$inputs= NULL,$delete_branch = NULL)
    {
        $branch =  Branches::company()->find($br_id);
        $types = ['sales','buy','salesReturn','buyReturn','settleAdd','settleDown','itemBalance'];
        if(in_array($type,$types) || $delete_branch == 1 )
        {
            if(!$inputs){
                $inputs = Input::all();
            }
            $inputs['type'] = $type;
            $inputs['br_id'] = $branch->id;
            if($delete_branch != 1){
               $validation = Validator::make($inputs, TransDetails::rulesCreator($inputs));
                 if($validation->fails()) {
               $data['newArray'] = $this->itemsToJsonForError($inputs, $validation->messages());
               $data['branch'] = $branch;
                Session::flash('error', ' <strong>فشل في العملية</strong> بعض المدخلات تم ادخالها على نحو غير صحيح  ');
                return $this->returnView($type, $data);
            }
        }

                if ($this->IsItemsBelongToCompany() && $this->IsAccountBelongToCompany() ) {
                    $payType                    = isset($inputs['pay_type'])?$inputs['pay_type']:null;
                    $accountId                  = isset($inputs['account_id'])?intval($inputs['account_id']):null;
                    $newHeader                  = new TransHeader;
                    $newHeader->co_id           = $this->coAuth();
                    $newHeader->user_id         = Auth::id();
                    $newHeader->br_id           = $branch->id;
                    $newHeader->pay_type        = $payType;
                    $newHeader->account         = $accountId;
                    $invoice_no                 = $newHeader->company()->where('invoice_type',$type)->where('br_id',$br_id)->max('invoice_no')+1;
                    $newHeader->invoice_no      = $invoice_no;
                    $newHeader->invoice_type    = $type;
                    $newHeader->date            = ($delete_branch == 1)?$inputs['date']:$this->strToTime($inputs['date']) ;
                    $newHeader->save();
                    $newInvoiceItems = [];//create array to insert into database on save
                    $total=0;

                    foreach (TransDetails::countOfInputs($inputs) as $k=>$v)
                    {
                        $item      = Items::findOrFail($inputs['id_'.$k]);
                        $serial_no = ($item->has_serial)?$inputs['serial_'.$k]:null;
                        $quantity  = ($item->has_serial)?1:$inputs['quantity_'.$k];
                        if(isset($inputs['cost_'.$k]) && intval($inputs['cost_'.$k]) > 0 && $type == "buy"){
                            $unitPrice =  intval($inputs['cost_'.$k] );// get price from input
                        }else{
                            if(self::isSettle($type)) {
                                $unitPrice = null;
                                $itemTotal = null;
                            }else{
                                $unitPrice = $this->priceBaseOnAccount(@$inputs['account_id'], $item,$type);// get price base in account price system
                            }
                        }if(!self::isSettle($type) || $delete_branch == 1 ){
                            $itemTotal = ($unitPrice)*($quantity);
                        }
                        $newInvoiceItems[] =   array
                        (
                            'co_id'             => $this->coAuth(),
                            'trans_header_id'   => $newHeader->id,
                            'qty'               => $quantity,
                            'item_id'           => $item->id,
                            'unit_price'        => $unitPrice,
                            'item_total'        => $itemTotal,
                            'avg_cost'          => $item->avg_cost,
                            'serial_no'         => $serial_no ,
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        if(self::isSettle($type) || $delete_branch == 1) {
                            $total =   null;
                        }else{
                            $total +=   $newInvoiceItems[$k]['item_total'];
                        }
                    }//end foreach of set details

                    if(count($newInvoiceItems)>0){//if no details delete invoice and send error

                        if(PerC::isShow('invoices','discount','add')){

                           $discount = isset($inputs['discount'])?$inputs['discount']:0;
                       }else{
                            $discount = 0;
                        }
                        if(PerC::isShow('invoices','tax','add')){

                           $tax = isset($inputs['tax'])?$inputs['tax']:0;
                       }else{
                            $tax = 0;
                        }

                        $newHeader->in_total        = $total ;
                        $newHeader->discount        = $discount;
                        $newHeader->tax             = $tax;
                        $net_after_descount         = $total - ($total)*($discount)/100;
                        $net                        = $net_after_descount - ($net_after_descount)*($tax)/100;

                        $newHeader->net             = $net;
                        //if select account save record into account_trans
                        if(!self::isSettle($type) || $delete_branch != 1){//save account base on type
                            if ($type != 'itemBalance') {
                                //save account trans if user select account id
                                AccountTrans::saveAccountTrans(Input::all(),$newHeader->id,$type,$net,$branch->id);
                            }
                        }
                        if($type == 'buy' || $type == 'buyReturn'|| $type == 'itemBalance'){//set avg cost base on type
                            $qtyPerItem = $this->getQty($newInvoiceItems);//get  item  qty base on item id
                            $this->setAvgCost($qtyPerItem); // set avg cost base on invoice details
                            foreach($newInvoiceItems as $k => $invoiceItem ){//set new avg cost for details  array "$newInvoiceItems"
                                $i = Items::find($invoiceItem['item_id']);
                                $newInvoiceItems[$k]['avg_cost']  = $i->avg_cost;
                            }
                        }


                        $newHeader->save();// save header
                        TransDetails::insert($newInvoiceItems); // insert details into trans_detail table
                        if($delete_branch == 1 ){
                          return 1;
                        }
                        Session::flash('success','تم اضافة الفاتورة بنجاح');
                        return Redirect::route('viewTransaction',array($type,$branch->id,$invoice_no));
                        //redirect to invoice to print
                    }else{
                        $newHeader->delete();
                        return "الاتورة خالية من المنتجات";
                    }//end if

                }else{
                    $data['error']      ="لقد قمت بادخال بعض المدخلات بشكل خطا ";
                    return View::make('errors.missing',$data);
                }

        }else{
            return View::make('errors.missing');
        }
    }

    /**
     * return price baseon account pricing and offer and trans type
     * @param null $accountId
     * @param $item
     * @return mixed
     */
    public function priceBaseOnAccount($accountId = null,$item,$type)
    {

        if (isset($accountId)) {
            $account = Accounts::company()->find($accountId);
            if($account && $account->acc_type == 'customers'){
                if ($account->pricing == "sell_nos_gomla" && $item->sell_nos_gomla > 0) {
                    return $item->sell_nos_gomla;
                }elseif ($account->pricing == "sell_gomla" && $item->sell_gomla > 0) {
                    return $item->sell_gomla;
                }elseif ($account->pricing == "sell_gomla_gomla" && $item->sell_gomla_gomla > 0) {
                    return $item->sell_gomla_gomla;
                }else{
                    return $this->itemAfterOffer($item);
                }
            }elseif($type == "buy" ||($account && $account->acc_type == 'suppliers')){
                return $item->buy;
            }else{
                return $this->itemAfterOffer($item);
            }

        } else {
            return $this->itemAfterOffer($item);
        }

    }

    /**
     * return price base on offer
     * @param $item
     * @return mixed
     */
    public function itemAfterOffer($item)
    {
        if($item->offer_id){
            $date = new DateTime();
            $today = $date->format('Y-m-d');
            if ($today >= $item->offer->from && $today  <= $item->offer->to ) {
                return $item->sell_users - ($item->sell_users)*($item->offer->offer)/100;
            }
        }
        return $item->sell_users;
    }
    private function itemsToJsonForError($inputs,$errors)
    {
        $count = TransDetails::countOfInputs($inputs);
        $newArray = [];
        foreach($count as $k =>$v ){
            $serialNo = isset($inputs['serial_'.$k])?$inputs['serial_'.$k]:null;
           $item = Items::getItemByBrId(intval($inputs['id_'.$k]),$serialNo,$inputs['br_id']);
           $realItem = Items::company()->find($inputs['id_'.$k]);

            if(!$item){
                $item = $realItem;
                if(!$item){
                    continue;
                }
            }
            $newArray[] = array
            (
                'item_name'        => $item->item_name,
                'id'               => intval($inputs['id_'.$k]),
                'id_error'         => $errors->first('id_'.$k),
                'quantity'         => intval($inputs['quantity_'.$k]),
                'qty_error'         => $errors->first('quantity_'.$k),
                'cost'             => isset($inputs['cost_'.$k])?$inputs['cost_'.$k]:null,
                'serial'           => isset($inputs['serial_'.$k])?$inputs['serial_'.$k]:null,
                'serial_error'     => isset($inputs['serial_'.$k])? $errors->first('serial_'.$k):null,
                'has_serial'       => $item->has_serial,
                'bar_code'         => $item->bar_code,
                'buy'              => $item->buy,
                'sell_users'       => $item->sell_users,
                'unit_price'       => $item->sell_users,
                'sell_nos_gomla'   => $item->sell_nos_gomla,
                'sell_gomla'       => $item->sell_gomla,
                'sell_gomla_gomla' => $item->sell_gomla_gomla,
                'limit'            => $item->limit,
                'balance'          => @$item->balance,
            ) ;
        }
        return $newArray;
    }

    public function viewTransactions($type,$br_id)
    {

        $branch =  Branches::company()->find($br_id);
        $types = ['sales','buy','salesReturn','buyReturn','settleAdd','settleDown','itemBalance'];
        if(in_array($type,$types) && $branch){
            $data['title']         = "فواتير " .Lang::get('main.'.$type); // page title
            $data['invoices_open'] = 'open' ;
            $data['branch']        = $branch ;
            $data['type']        = $type ;
            $data['transactions']  = TransHeader::company()->where('invoice_type',$type)->where('br_id',$branch->id)->get();
            return View::make('dashboard.transaction.view_transactions',$data);
        }else{
            return View::make('errors.missing');
        }
    }
    public function viewTransaction($type,$br_id,$invoice_no)
    {
        $trans = TransHeader::company()
            ->where('invoice_no',$invoice_no)
            ->where('br_id',$br_id)
            ->where('invoice_type',$type)->first();
        if($trans){
            $data['title']       = " فاتورة " ; // page title
            $data['invoices_open']   = 'open' ;
            $data['co_info']     = CoData::thisCompany()->first();//select info models category seasons
            $data['invoice']     = $trans;
            $data['type']        = $data['invoice']->invoice_type;
        return  View::make('dashboard.transaction.transaction',$data);

        }else{
            $data['error']      ="  لا توجد فاتورة بهذا الرقم  ";
            return View::make('errors.missing',$data);
        }
    }
    public function accountsData()
    {
        $request = Request::all();
        $data['accounts']  =  Accounts::company()->where('acc_type',$request['type'])
            ->where('co_id',$this->coAuth())
            ->get();
        return Response::json($data);
    }
    public function accountById()
    {
        $request = Request::all();
        $data['selectedAccount']  =  Accounts::company()->where('id',$request['id'])
            ->first();
        return Response::json($data);
    }
    /**
     * return items base on company and branch
     * @return mixed
     *
     */
    public function itemsData()
    {
        $data['items']  = Items::getItemsWithBalanceByBrId(Input::get('br_id')) ;
        return Response::json($data);
    }
    /**
     * return items base on company and branch
     * @return mixed
     *
     */
    public function serialItemsData()
    {
        $data['items']  = Items::getSerialItemsWithBalanceByBrId(Input::get('br_id'),Input::get('item_id')) ;
        return Response::json($data);
    }
    /**
     * return items base on company and branch
     * @return mixed
     *
     */
    public function items()
    {
        $data['items']  = Items::company()->get() ;
        return Response::json($data);
    }
    /**
     * @param $type
     * @return bool
     */
    public static function isSettle($type)
    {
        return $type == "settleAdd" || $type == "settleDown";
    }
    public function returnsInvoiceData(){
        $type = str_replace("Return","",Input::get('invoiceType'));
        $q = TransHeader::where('trans_header.co_id',$this->coAuth())
            ->where('trans_header.invoice_type',$type)
            ->where('trans_header.br_id',Input::get('brId'));
        $detailsQ =
            TransHeader::where('trans_header.co_id',$this->coAuth())

                ->where('trans_header.invoice_type',$type)
                ->where('trans_header.br_id',Input::get('brId'))
                ->join('trans_details','trans_header.id','=','trans_details.trans_header_id')
                ->join('items','items.id','=','trans_details.item_id')
                ->select('items.item_name as item_name ','trans_details.*');
        if(Input::get('invoiceNoAcc')&&Input::get('invoiceNoAcc')>0){
            $data['details'] =$detailsQ->where('trans_header.account',Input::get('acc'))->where('trans_header.invoice_no',Input::get('invoiceNoAcc'))->get();
            $data['header']  =$q->where('trans_header.account',Input::get('acc'))->where('trans_header.invoice_no',Input::get('invoiceNoAcc'))->first();

        }else{
            $data['details'] = $detailsQ->where('trans_header.invoice_no',Input::get('invoiceNo'))->get();
            $data['header']  = $q->where('trans_header.invoice_no',Input::get('invoiceNo'))->first() ;
        }

        return $data;
    }

    /**
     * @param $newInvoiceItems
     * @return array
     */
    private function getQty($newInvoiceItems)
    {
        $qtyPerItem = array();
        foreach ($newInvoiceItems as $detail) {
            if (!isset($qtyPerItem[$detail['item_id']])) {
                $qtyPerItem[$detail['item_id']]['qty'] = 0;

            }
            $qtyPerItem[$detail['item_id']]['qty'] += $detail['qty'];
            $qtyPerItem[$detail['item_id']]['unit_price'] = $detail['unit_price'];
        }

        return $qtyPerItem;
    }

    public function cancelTrans()
    {

        $inputs = Input::all();
        $ruels =  TransHeader::$delete_ruels;

//        if ($this->isHaveBranch() == 1) {
//            $ruels["br_id"] = "required";
//        }
        $validation = Validator::make($inputs, TransHeader::$delete_ruels);

        if ($validation->fails()) {

            return Redirect::back()->withErrors($validation->messages());
        }else{

            $invoice_no   = $inputs['invoice_no'];
            $invoice_type = $inputs['invoice_type'];
            $cancel_cause = $inputs['cancel_cause'];

            $invoice      = TransHeader::company()
                ->where('invoice_no',$invoice_no)
                ->where('invoice_type',$invoice_type);

            if(Auth::user()->all_br != 1){

                $invoice->where('br_id',Auth::user()->br_id);
            }

            $trans = $invoice->first();

            if(!empty($trans)){

                $trans->deleted = 1;
                $trans->user_id = Auth::id();
                $trans->cancel_cause   = $cancel_cause;
                $trans->save();

                $msg = 'تم إلغاء الفاتورة بنجاح ';

                Session::flash('success',$msg);
                Return Redirect::back();
            }else{
                $msg = 'عفواً لم يتم إلغاء الفاتورة';

                Session::flash('error',$msg);
                Return Redirect::back();
            }
        }
    }
    /**
     * @param $qtyPerItem
     * @param $newHeader
     */
    private function setAvgCost($qtyPerItem)
    {
        foreach ($qtyPerItem as $k => $detail) {
            $invoiceItem = Items::getItem($k);
            $updateItem = Items::company()->find($k);
            if ($updateItem && $updateItem->avg_cost>0 && $invoiceItem ) {
                $new_avg = (($invoiceItem->balance * $invoiceItem->avg_cost) + ($detail['qty'] * $detail['unit_price'])) / ($detail['qty'] + $invoiceItem->balance);
                $updateItem->avg_cost = $new_avg;
            } else {
                $updateItem->avg_cost = $detail['unit_price'];
            }
            $updateItem->update();

        }
    }

    /**
     * @param $type
     * @param $data
     * @return mixed
     */
    private function returnView($type, $data)
    {
        $data['name']          = Lang::get('main.'.$type); // page title
        $data['title']         = " فاتورة " .$data['name'] ; // page title
        $data['co_info']       = CoData::thisCompany()->first();//select info models category seasons

        $data['type']          = $type;
        $data['br_id']          = $data['branch'] ->id;
        $data['pay_type']      = array('cash'=>Lang::get('main.cash'),'visa'=>Lang::get('main.visa'),'on_account'=>Lang::get('main.on_account'));
        $data['account_type']  = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'));
        if ($type == "sales") {
            $data['invoices_open'] = 'open';
            return View::make('dashboard.transaction.discount-index', $data);
        } elseif ($type == "buy" || $type == "itemBalance") {
            if (!$type == "itemBalance") {
                $data['invoices_open'] = 'open';
            }
            $data['itemBalance'] = 'open';
            return View::make('dashboard.transaction.add-index', $data);
        } elseif ($type == "settleAdd") {
            $data['TransOpen'] = 'open';
            return View::make('dashboard.transaction.settle-add-index', $data);
        } elseif ($type == "settleDown") {
            $data['TransOpen'] = 'open';
            return View::make('dashboard.transaction.settle-discount-index', $data);
        } elseif ($type == "buyReturn" || $type == "salesReturn") {
            return View::make('dashboard.transaction.return-index', $data);
        } else {
            return View::make('errors.missing');

        }
    }
    public function viewLabel($invoiceId){
        $data['title'] = "طباعة الباركود";
        $data['items'] =  TransDetails::where('trans_header_id',$invoiceId)
           ->join('items','items.id','=','trans_details.item_id')->where('has_label',1)->get();
        return View::make('dashboard.transaction.print-label', $data);
    }
}