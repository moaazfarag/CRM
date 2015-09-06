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

    $data['pay_type']     = array(Lang::get('main.cash'),Lang::get('main.visa'),Lang::get('main.on_account'));
    $data['account_type'] = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'));
    return View::make('dashboard.invoices.index',$data);
}

    /**
     * return accounts base on type ajax drop menu
     * @return mixed
     *
     */

    public function allInvoices(){

        $data['title']      = "فواتير المبيعات" ; // page title
        $data['name']       = "فواتير المبيعات "; // page title
        $data['invoices']  = 'open' ;
        $data['co_info']    = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons
        $data['branch']     = $this->isAllBranch();
        $data['tablesData'] = TransHeader::where('co_id', '=', $this->coAuth())->get();
//        $data['invoices_id'] = TransHeader::where('co_id', '=', $this->coAuth())->get()->lists('id');

//        $data['pay_type']     = array(Lang::get('main.cash'),Lang::get('main.visa'),Lang::get('main.on_account'));
//        $data['account_type'] = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'));

        return View::make('dashboard.invoices.all_invoices',$data);
    }
    public function salesReturns(){

        $data['title']      = "مرتجعات المبيعات " ; // page title
        $data['name']       = "تعديل بيانات فاتورة رقم "; // page title
        $data['invoices']  = 'open' ;
        $data['co_info']    = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons
        $data['branch']     = $this->isAllBranch();

        $data['pay_type']     = array(Lang::get('main.cash'),Lang::get('main.visa'),Lang::get('main.on_account'));
        $data['account_type'] = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'));
        return View::make('dashboard.invoices.returns',$data);
    }
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