<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 8/26/2015
 * Time: 3:43 PM
 */
class InvoiceController extends BaseController
{
public function addSalesInvoice(){
    $data['title']      = " تسوية  " ; // page title
    $data['name']       = "sd"; // page title
    $data['invoices']  = 'open' ;
    $data['co_info']    = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons
    $data['branch']     = $this->isAllBranch();
    $data['pay_type']     = array('نقدى ','فيزا','اجل');
    $data['account_type'] = array('customers'=>'العملاء','suppliers'=>'الموردين','partners'=>'جارى الشركاء');
    return View::make('dashboard.invoices.index',$data);
}

    /**
     * return accounts base on type ajax drop menu
     * @return mixed
     *
     */
    public function accountsData()
        {
          $request = Request::all();
          $data['accounts']  =  Accounts::where('acc_type',$request['type'])
                                ->where('co_id',$this->coAuth())
                                ->get();
          return Response::json($data);
        }
    /**
     * return items base on company
     * @return mixed
     *
     */
    public function itemsData()
        {
          $data['items']  =  Items::where('co_id',$this->coAuth())
                                ->get();
          return Response::json($data);
        }
}