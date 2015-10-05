<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 8/26/2015
 * Time: 3:43 PM
 */
class InvoiceController extends BaseController
{
    public function addInvoice($type,$br_id){

        $branch =  Branches::company()->find($br_id);
        $types = ['sales','buy'];
        if(in_array($type,$types) && $branch)
        {
            $data['name']          = Lang::get('main.'.$type); // page title
            $data['title']         = " فاتورة " .$data['name'] ; // page title
            $data['invoices_open'] = 'open' ;
            $data['co_info']       = CoData::thisCompany()->first();//select info models category seasons
            $data['branch']        = $branch;
            $data['type']          = $type;
            $data['br_id']          = $br_id;
            $data['pay_type']      = array('cash'=>Lang::get('main.cash'),'visa'=>Lang::get('main.visa'),'on_account'=>Lang::get('main.on_account'));
            $data['account_type']  = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'));
            if($type == "sales"){
                return View::make('dashboard.invoices.sales-index',$data);
            }else{
                return View::make('dashboard.invoices.buy-index',$data);
            }
        }else{
            return "404 error";
        }
    }
    public function storeInvoice($type,$br_id)
    {
        $branch =  Branches::company()->find($br_id);
        $types = ['sales','buy'];

        if(in_array($type,$types) && $branch)
        {
            $inputs = Input::all();

            $validation = Validator::make($inputs, TransDetails::rulesCreator($inputs));

            if($validation->fails())
            {

                $data['title']       = " تعديل تسوية اضافة " ; // page title
                $data['TransOpen']   = 'open' ;
                $data['type']        = 'type' ;
                $data['br_id']       = $br_id;
                $data['co_info']     = CoData::thisCompany()->first();//select info models category seasons
                $data['branch']      = $this->isAllBranch(); //
                dd($validation->messages());
                die();
                $data['newArray']    = $this->itemsToJsonForError($inputs);
                $data['errors']      = $validation->messages();


                Session::flash('error',' <strong>فشل في العملية</strong> بعض المدخلات تم ادخالها على نحو غير صحيح  ');
                return View::make('dashboard.settle.index',$data);

            }else {
                if ($this->IsItemsBelongToCompany() && $this->IsAccountBelongToCompany() ) {
                    $newHeader                  = new TransHeader;
                    $newHeader->co_id           = $this->coAuth();
                    $newHeader->user_id         = Auth::id();
                    $newHeader->br_id           = $branch->id;
                    $newHeader->pay_type        = $inputs['pay_type'];
                    $newHeader->account         = $inputs['account_id'];
                    $invoice_no                 = $newHeader->company()->where('invoice_type',$type)->max('invoice_no')+1;
                    $newHeader->invoice_no      = $invoice_no;
                    $newHeader->invoice_type    = $type;
                    $newHeader->date            = $this->strToTime($inputs['date']) ;
                    $newHeader->save();
                    $newInvoiceItems = [];//create array to insert into database on save
                    $total=0;
                    foreach (TransDetails::countOfInputs($inputs) as $k=>$v)
                    {
                        $item      = Items::findOrFail($inputs['id_'.$k]);
                        $serial_no = ($item->has_serial)?$inputs['serial_'.$k]:null;
                        $unitPrice = $this->priceBaseOnAccount($inputs['account_id'],$item);// get price base in account price system
                        $quantity  = ($item->has_serial)?1:$inputs['quantity_'.$k];
                        $serialItem = Items::getSerialItemsWithBalanceByBrId($branch->id,$item->id,$serial_no);
//                        dd($serialItem);
                        if($item->has_serial){
                            if($serialItem && $type == "sales"){
                            }elseif(!$serialItem && $type == "buy"){
                            }else{
                                continue;
                            }
                        }elseif(@$serialItem[0]->balance < $quantity && $type == "sales"){
//                            dd($serialItem);
                            continue;
                        }
                        $newInvoiceItems[] =   array
                        (
                            'co_id'             => $this->coAuth(),
                            'trans_header_id'   => $newHeader->id,
                            'qty'               => $quantity,
                            'item_id'           => $item->id,
                            'unit_price'        =>  $unitPrice,
                            'item_total'        => ($unitPrice)*($quantity),
                            'avg_cost'          => $item->avg_cost,
                            'serial_no'         => $serial_no ,
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $total +=   $newInvoiceItems[$k]['item_total'];
                    }
                    $discount = isset($inputs['discount'])?$inputs['discount']:0;
                    $tax      = isset($inputs['tax'])?$inputs['tax']:0;
                    $newHeader->in_total        = $total ;
                    $newHeader->discount        = $discount;
                    $newHeader->tax             = $tax;
                    $net                        = $total - ($total)*($discount)/100;
                    $newHeader->net             = $net;

                    //if select account save record into account_trans
                    AccountTrans::saveAccountTrans(Input::all(),$newHeader->id,$type,$net,$branch->id);
                    $newHeader->save();
                    TransDetails::insert($newInvoiceItems);
                    Session::flash('success','تم اضافة الفاتورة بنجاح');
                    return Redirect::route('viewInvoice',array($newHeader->id));
                }else{
                    return "لقد قمت بادخال بعض المدخلات بشكل خطا ";
                    //                dd(Input::all());
                }
            }
        }else{
            return "404 error";
        }
    }
    public function storeSalesInvoice($type,$br_id)
    {
        $branch =  Branches::company()->find($br_id);
        $types = ['sales','buy'];

        if(in_array($type,$types) && $branch)
        {
            $inputs = Input::all();

            $validation = Validator::make($inputs, TransDetails::rulesCreator($inputs));

            if($validation->fails())
            {

                $data['title']       = " تعديل تسوية اضافة " ; // page title
                $data['TransOpen']   = 'open' ;
                $data['type']        = 'type' ;
                $data['br_id']       = $br_id;
                $data['co_info']     = CoData::thisCompany()->first();//select info models category seasons
                $data['branch']      = $this->isAllBranch(); //
                dd($validation->messages());
                die();
                $data['newArray']    = $this->itemsToJsonForError($inputs);
                $data['errors']      = $validation->messages();


                Session::flash('error',' <strong>فشل في العملية</strong> بعض المدخلات تم ادخالها على نحو غير صحيح  ');
                return View::make('dashboard.settle.index',$data);

            }else {
                if ($this->IsItemsBelongToCompany() && $this->IsAccountBelongToCompany() ) {
                    $newHeader                  = new TransHeader;
                    $newHeader->co_id           = $this->coAuth();
                    $newHeader->user_id         = Auth::id();
                    $newHeader->br_id           = $branch->id;
                    $newHeader->pay_type        = $inputs['pay_type'];
                    $newHeader->account         = $inputs['account_id'];
                    $invoice_no                 = $newHeader->company()->where('invoice_type',$type)->max('invoice_no')+1;
                    $newHeader->invoice_no      = $invoice_no;
                    $newHeader->invoice_type    = $type;
                    $newHeader->date            = $this->strToTime($inputs['date']) ;
                    $newHeader->save();
                    $newInvoiceItems = [];//create array to insert into database on save
                    $total=0;
                    foreach (TransDetails::countOfInputs($inputs) as $k=>$v)
                    {
                        $item      = Items::findOrFail($inputs['id_'.$k])->first();
                        dd($item->has_serial);
                        $unitPrice = $this->priceBaseOnAccount($inputs['account_id'],$item);// get price base in account price system
                        $quantity  = isset($inputs['serial_'.$k])?1:$inputs['quantity_'.$k];
                        $serial_no = isset($inputs['serial_'.$k])?$inputs['serial_'.$k]:0;
                        $newInvoiceItems[] =   array
                        (
                            'co_id'             => $this->coAuth(),
                            'trans_header_id'   => $newHeader->id,
                            'qty'               => $quantity,
                            'item_id'           => $inputs['id_'.$k],
                            'unit_price'        =>  $unitPrice,
                            'item_total'        => ($unitPrice)*($quantity),
                            'avg_cost'          => $item->avg_cost,
                            'serial_no'         => $serial_no,
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $total +=   $newInvoiceItems[$k]['item_total'];
                    }
                    $discount = isset($inputs['discount'])?$inputs['discount']:0;
                    $tax      = isset($inputs['tax'])?$inputs['tax']:0;
                    $newHeader->in_total        = $total ;
                    $newHeader->discount        = $discount;
                    $newHeader->tax             = $tax;
                    $net                        = $total - ($total)*($discount)/100;
                    $newHeader->net             = $net;

                    //if select account save record into account_trans
                    AccountTrans::saveAccountTrans(Input::all(),$newHeader->id,$type,$net,$branch->id);
                    $newHeader->save();
                    TransDetails::insert($newInvoiceItems);
                    Session::flash('success','تم اضافة الفاتورة بنجاح');
                    return Redirect::route('viewInvoice',array($newHeader->id));
                }else{
                    return "لقد قمت بادخال بعض المدخلات بشكل خطا ";
                    //                dd(Input::all());
                }
            }
        }else{
            return "404 error";
        }
    }

    public function viewInvoice($invoiceId)
    {

        $trans = TransHeader::company()->where('id',$invoiceId)->whereIn('invoice_type',['sales','buy','buyReturn','salesReturn'])->first();
        if($trans){
            $data['title']       = " فاتورة " ; // page title
            $data['invoices_open']   = 'open' ;
            $data['co_info']     = CoData::thisCompany()->first();//select info models category seasons
            $data['invoice']     = $trans;
            $data['type']        = $data['invoice']->invoice_type;
            return View::make('dashboard.invoices.invoice',$data);

        }else{

            return "that's not correct page : type check fail";

        }
    }

    /**
     * return accounts base on type ajax drop menu
     * @return mixed
     *
     */
    public function viewInvoices()
    {
        $trans = TransHeader::company()->where('invoice_type',Input::get('type'))->get();
        if($trans){
            $data['title'] = "فواتير " .Lang::get('main.'.Input::get('type')); // page title
            $data['invoices_open']   = 'open' ;
            $data['invoices']    = $trans;
            return View::make('dashboard.invoices.view_invoices',$data);
        }else{

            return "that's not correct page : type check fail";
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
//            dd($data['items']);
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

    public function cancelInvoice()
    {

        $inputs = Input::all();

        $validation = Validator::make($inputs, TransHeader::$delete_ruels);

        if ($validation->fails()) {

            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else{
            $invoice_no   = $inputs['invoice_no'];
            $invoice_type = $inputs['invoice_type'];
            $cancel_cause = $inputs['cancel_cause'];

            $invoice    = TransHeader::company()
                ->where('invoice_no',$invoice_no)
                ->where('invoice_type',$invoice_type)->first();
            if(!empty($invoice)){

                $invoice->deleted = 1;
                $invoice->notes   = $cancel_cause;
                $invoice->update();

                $msg = 'تم إلغاء الفاتورة بنجاح ';

                Session::flash('success',$msg);
                Return Redirect::back();
            }
        }
    }


    public function reportSearchInvoice ($type,$sum = NULL){

//            var_dump($sum);die();
            if($sum == NULL) {

                $data['title']   = Lang::get("main.$type".'_report');
                $data['sum']     = NULL;

            }elseif($sum == 'sum'){
                $data['title'] = Lang::get("main.$type" . '_report_sum');
                $data['sum']   = 'sum';

            }// end else





        $types = array('sales','sales-return','buy','buy-return','sales-earnings');

        if(in_array($type,$types)){

            $data['type']           = $type;
            $data['co_info']        = CoData::thisCompany()->first();
            $data['branch']         = $this->isAllBranch();
            $data['pay_type']       = array(''=>Lang::get('main.select_pay_type'),'cash'=>Lang::get('main.cash'),'visa'=>Lang::get('main.visa'),'on_account'=>Lang::get('main.on_account'));
            $data['items']          = Items::company()->get()->lists('item_name','id');
            $data['of_account']     = array( ''=>'أختر الحساب','customers'=>'العملاء','suppliers'=>'الموردين', 'partners' =>'جارى الشركاء', 'bank'  =>'البنك');
            $data['account_type']   = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'));
            return View::make('dashboard.invoices.report.report_search',$data);

        }else{

            return 'no result about this type';
        }


    } // end function searchReportInvoice
    /*
             cat_id
             item

             */
    public function reportResultInvoice (){

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

        }else{

            $invoice_type    =  $inputs['invoice_type'];

            $types = array('sales','sales-return','buy','buy-return','sales-earnings');

            if(in_array($invoice_type,$types)) {

                if($invoice_type == 'sales-earnings') {
                    $type = 'sales';
                }else{
                    $type    =  $inputs['invoice_type'];
                }

                $sum         = $inputs['sum'];
                $date_from   = $this->strToTime($inputs['date_from']);
                $date_to     = $this->strToTime($inputs['date_to']);
                $cat_id      = (!empty($inputs['cat_id'])) ? $inputs['cat_id'] : "";
                $br_id       = (!empty($inputs['br_id'])) ? $inputs['br_id'] : "";
                $account_id  = (!isset($inputs['account_id'])) ? $inputs['account_id'] : "";
                $pay_type    = (!empty($inputs['pay_type'])) ? $inputs['pay_type'] : "";
                $item_id     = (!empty($inputs['item_id'])) ? $inputs['item_id'] : "";

                $invoices = TransHeader::company()->dateBetween('date', $date_from, $date_to)
                    ->where('invoice_type', $type)
                    ->where('deleted', 0);
                if ($br_id != '') {
                    $invoices->where('br_id', $br_id);
                }

                if ($account_id != '') {
                    $invoices->where('account', $account_id);
                }

                if ($pay_type != '') {
                    $invoices->where('pay_type', $pay_type);
                }

                $invoices_data = $invoices->get();


                if ($sum == NULL) {

                    $data['title'] = Lang::get("main.$invoice_type" . '_report');
                    $data['sum'] = 'no';

                } elseif ($sum == 'sum') {
                    $data['title'] = Lang::get("main.$invoice_type" . '_report_sum');
                    $data['sum'] = 'sum';

                }// end else

                $data['cat_id'] = $cat_id;
                $data['item_id'] = $item_id;
                $data['invoices'] = $invoices_data;
                $data['co_info'] = CoData::thisCompany()->first();
                $data['date_from'] = $date_from;
                $data['date_to'] = $date_to;
                $data['type'] = $invoice_type;

                if($invoice_type == 'sales-earnings'){

                    return View::make('dashboard.invoices.report.report_result_sales_earnings', $data);

                }else{

                    return View::make('dashboard.invoices.report.report_result', $data);

                }
            }

        }
    }
}