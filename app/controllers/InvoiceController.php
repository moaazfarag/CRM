<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 8/26/2015
 * Time: 3:43 PM
 */
class InvoiceController extends BaseController
{


    public function reportSearchInvoice($type, $sum = NULL)
    {

//            var_dump($sum);die();
        if ($sum == NULL) {

            $data['title'] = Lang::get("main.$type" . '_report');
            $data['sum'] = NULL;

        } elseif ($sum == 'sum') {

            $data['title'] = Lang::get("main.$type" . '_report_sum');
            $data['sum'] = 'sum';

        }


        $types = array('sales', 'salesReturn', 'buy', 'buyReturn', 'sales-earnings');


        if (in_array($type, $types)) {

            $data['type'] = $type;
            $data['co_info'] = CoData::thisCompany()->first();
            $data['branch'] = $this->isAllBranch();
            $data['pay_type'] = array('' => Lang::get('main.select_pay_type'), 'cash' => Lang::get('main.cash'), 'visa' => Lang::get('main.visa'), 'on_account' => Lang::get('main.on_account'));
            $data['items'] = Items::company()->get()->lists('item_name', 'id');
            $data['of_account'] = array('' => 'أختر الحساب', 'customers' => 'العملاء', 'suppliers' => 'الموردين', 'partners' => 'جارى الشركاء', 'bank' => 'البنك');
            $data['account_type'] = array('customers' => Lang::get('main.customers_'), 'suppliers' => Lang::get('main.suppliers_'), 'partners' => Lang::get('main.partners_'));
            return View::make('dashboard.invoices.report.report_search', $data);

        } else {

            return 'no result about this type';
        }


    } // end function searchReportInvoice

    /*
             cat_id
             item

             */
    public function reportResultInvoice()
    {

        $inputs = Input::all();

        if (Input::Has('account')) {
            $ruels = TransHeader::$report_ruels_saels_with_account;
        } else {
            $ruels = TransHeader::$report_ruels_saels;
        }

        $validation = Validator::make($inputs, $ruels, BaseController::$messages);
        if ($validation->fails()) {

            return Redirect::back()->withInput()->withErrors($validation->messages());

        } else {

            $invoice_type = $inputs['invoice_type'];

            $types = array('sales', 'salesReturn', 'buy', 'buyReturn', 'sales-earnings');

            if (in_array($invoice_type, $types)) {


                $sum = $inputs['sum'];
                $date_from = $this->strToTime($inputs['date_from']);
                $date_to = $this->strToTime($inputs['date_to']);
                $cat_id = (!empty($inputs['cat_id'])) ? $inputs['cat_id'] : "";
                $br_id = (!empty($inputs['br_id'])) ? $inputs['br_id'] : "";
                $account_id = (!isset($inputs['account_id'])) ? $inputs['account_id'] : "";
                $pay_type = (!empty($inputs['pay_type'])) ? $inputs['pay_type'] : "";
                $item_id = (!empty($inputs['item_id'])) ? $inputs['item_id'] : "";


                $invoices = TransHeader::company()->dateBetween('date', $date_from, $date_to)
                    ->where('deleted', 0);

                if ($invoice_type == 'sales-earnings') {

                    $invoices->whereIn('invoice_type', ['salesReturn', 'sales']);
                } else {

                    $invoices->where('invoice_type', $invoice_type);


                }

                if ($this->isHaveBranch()) {

                    if ($br_id != '') {
                        $invoices->where('br_id', $br_id);
                    }
                } else {
                    $invoices->where('br_id', Auth::user()->br_id);
                }

                if ($account_id != '') {
                    $invoices->where('account', $account_id);
                }

                if ($pay_type != '') {
                    $invoices->where('pay_type', $pay_type);
                }

                $invoices_data = $invoices->get();

            }


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

            if ($invoice_type == 'sales-earnings') {

                return View::make('dashboard.invoices.report.report_result_sales_earnings', $data);

            } else {

                return View::make('dashboard.invoices.report.report_result', $data);

            }
        }

    }

}