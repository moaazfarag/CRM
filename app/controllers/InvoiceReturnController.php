<?php
/**
 * Created by PhpStorm.
 * User: moaaz farag
 * Date: 9/8/2015
 * Time: 1:12 PM
 */
class InvoiceReturnController extends BaseController
{
    public function addReturnInvoice($type,$br_id){
        $branch =  Branches::company()->find($br_id);

        $types = ['salesReturn','buyReturn'];
        if(in_array($type,$types) && $branch)
        {
            $data['name']          = Lang::get('main.'.$type); // page title
            $data['title']         =  $data['name'] ; // page title
            $data['invoices_open'] = 'open' ;
            $data['co_info']       = CoData::thisCompany()->first();//select info models category seasons
            $data['branch']        = $branch;
            $data['type']          = $type;
            $data['br_id']         = $br_id;
            $data['pay_type']      = array('cash'=>Lang::get('main.cash'),'visa'=>Lang::get('main.visa'),'on_account'=>Lang::get('main.on_account'));
            $data['account_type']  = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'));
            if($type == "salesReturn"){
                return View::make('dashboard.invoices.return_invoice.one_invoice',$data);
            }else{
                return View::make('dashboard.invoices.return_invoice.one_invoice',$data);
            }
        }else{
            return "404 error";
        }
    }
    public function storeReturnInvoice($type,$br_id)
    {
    $branch =  Branches::company()->find($br_id);
    $trans =  TransHeader::company()->where('br_id',$br_id)->find(Input::get('trans_id'));
    $types = ['salesReturn','buyReturn'];
    $msg="";
    if(in_array($type,$types) && $branch && $trans)
    {

        $inputs = Input::all();
        $validation = Validator::make($inputs, TransDetails::ReturnRulesCreator($inputs));
        if($validation->fails())
        {
            $data['title']       = " تعديل تسوية اضافة " ; // page title
            $data['TransOpen']   = 'open' ;
            $data['type']        = 'type' ;
            $data['br_id']       = $br_id;
            $data['co_info']     = CoData::thisCompany()->first();//select info models category seasons
            $data['branch']      = $this->isAllBranch(); //
//                dd(Input::all());
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
                    $item       = Items::company()->findOrFail($inputs['id_'.$k]);
                    $serial_no  = ($item->has_serial)?$inputs['serial_'.$k]:null;
                    $unitPrice  = $this->unitPrice($trans,$item->id) ;//get price from details
                    $serialItem = Items::getSerialItemsWithBalanceByBrId($branch->id,$item->id,$serial_no);
                    $returnQty  = isset($inputs['return_'.$k])?$inputs['return_'.$k]:null;
                    if(!$this->isTrueReturn($trans,$returnQty,$item->id)){
                        dd($item);
                        continue;
                    }

                    if($item->has_serial){
                        if($serialItem && $type == "buyReturn"){
                        }elseif(!$serialItem && $type == "salesReturn"){
                        }else{
                            $msg .="لا يوجد صنف بهذا السيريال " .$serialItem[0]->serial_no ."<br>";

                            continue;
                        }
                    }elseif(@$serialItem[0]->balance < $returnQty && $type == "buyReturn"){
                        dd("sasad");
                        continue;
                    }
                    $newInvoiceItems[] =   array
                    (
                        'co_id'             => $this->coAuth(),
                        'trans_header_id'   => $newHeader->id,
                        'qty'               => $returnQty,
                        'item_id'           => $item->id,
                        'unit_price'        => $unitPrice,
                        'item_total'        => ($unitPrice)*($returnQty),
                        'avg_cost'          => $item->avg_cost,
                        'serial_no'         => $serial_no ,
                        'created_at'        => date('Y-m-d H:i:s'),
                        'updated_at'        => date('Y-m-d H:i:s')
                    );

                    $total +=  ($unitPrice)*($returnQty);


                }
                if(count($newInvoiceItems)>0){
                    $newHeader->in_total        = $total ;
                    $newHeader->discount        = $trans->discount;
                    $newHeader->tax             = $trans->tax;
                    $net                        = $total - ($total)*($trans->discount)/100;
                    $newHeader->net             = $net;


                    AccountTrans::saveAccountTrans($inputs,$newHeader->id,$type,$net,$branch->id);
                    //if select account save record into account_trans
                    $newHeader->save();
                    TransDetails::insert($newInvoiceItems);
                    $msg .='تم اضافة الفاتورة بنجاح'."<br>";
                    Session::flash('success',$msg);

                    return Redirect::route('viewInvoice',array($newHeader->id));
                }else{
                    $newHeader->delete();
                    return "الاتورة خالية من المنتجات";
                }

            }else{
                return "لقد قمت بادخال بعض المدخلات بشكل خطا ";
                //                dd(Input::all());
            }
        }
    }else{
        return "404 error";
    }
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
    public function isTrueReturn($trans,$returnQty,$itemId){
        $details =  $trans->details;
        foreach($details as $detail){
            if($detail->item_id == $itemId  ){
                if($detail->qty >= $returnQty){
                    return true;
                }else{
                    continue;
                }
            }
        }
    }
    //get unit price from trans details
    public function unitPrice($trans,$itemId){
        $details =  $trans->details;
        foreach($details as $detail){
            if($detail->item_id == $itemId){
                return $detail->unit_price;
            }
        }
    }
}