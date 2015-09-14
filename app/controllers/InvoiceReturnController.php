<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 9/8/2015
 * Time: 1:12 PM
 */
class InvoiceReturnController extends BaseController
{
    public function returnsInvoiceData(){
        Input::all();

        $data['invoices'] =
            TransHeader::where('trans_header.co_id',$this->coAuth())->where('trans_header.id',Input::get('id'))
            ->join('trans_details','trans_header.id','=','trans_details.trans_header_id')
            ->join('items','items.id','=','trans_details.item_id')
            ->select('trans_header.*','items.item_name as item_name ','trans_header.invoice_type','trans_header.pay_type','trans_details.*')
            ->get();
        return $data;
    }
}