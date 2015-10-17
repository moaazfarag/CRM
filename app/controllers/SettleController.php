<?php
/**
 * Created by PhpStorm.
 *
 * User: Moaaz farag
 * Date: 22/7/2015
 * Time: 3:49 PM
 */

class SettleController extends BaseController {

    public  function reportSettleSearch($type){

        $types = array('settleDiscount','settleAdd');

        if(in_array($type, $types)){

            $data['type']    = $type;
            $data['title']   =  Lang::get("main.$type".'_statement') ;
            return View::make('dashboard.settle.report.report_search',$data);

        }else {

            return "that's not correct page : type check fail";

        }


    }
    public function reportSettleResult(){

        $inputs = Input::all();

        $validation = Validator::make($inputs,TransHeader::$settle_report_ruels,BaseController::$messages);
        if($validation->fails()) {

            return Redirect::back()->withInput()->withErrors($validation->messages());

        }else {

            $type = $inputs['invoice_type'];
            $types = array('settleDiscount', 'settleAdd');

            if (in_array($type, $types)) {


                $date_from = $this->strToTime($inputs['date_from']);
                $date_to = $this->strToTime($inputs['date_to']);

                $trans = TransHeader:: dateBetween('created_at', $date_from, $date_to)
                    ->company()
                    ->where('invoice_type', $type)
                    ->where('deleted', 0)->get();

                if ($trans) {

                    $data['title']       = Lang::get("main.$type" . '_statement'); // page title
                    $data['date_from']   = $date_from;
                    $data['date_to']     = $date_to;
                    $data['invoices']     = $trans;

                    return View::make('dashboard.settle.report.report_result', $data);

                } else {

                    return "that's not correct page : type check fail";

                }// end else

            } else {

                return "that's not correct page : type check fail";

            }// end else

        }
    }
}