<?php
/**
 * Created by PhpStorm.
 * User: ahmed
     * Date: 8/24/2015
 * Time: 12:07 PM
 */
class MsHeaderController extends BaseController
{
    public function addMsHeader()
    {
        $data = $this->depData();
        $data['title'] = 'تجهيزات المرتبات الشهريه'; // page title
        $data['employees'] = "open";
        $data['co_info'] = CoData::where('id', '=', $this->coAuth())->first();
        return View::make('dashboard.hr.msheader.index', $data);

    }

    public function storeMsHeader()
    {
        $data = $this->depData();
        $data['title'] = 'تجهيزات المرتبات الشهريه'; // page title
        $data['employees'] = "open";
        $data['co_info'] = CoData::where('id', '=', $this->coAuth())->first();
//        dd(Input::get('employee_id'));
        return View::make('dashboard.hr.msheader.index', $data);
    }

    protected function depData()
    {
        $data['title']     = 'التجهيزات الشهريه ';
        $data['employees'] = 'open';
        $data['net']       = Employees::where('co_id',$this->coAuth())->get();
        return $data;
    }

    public function searchMsHeader()
    {
        $validation = Validator::make(Input::all(), MsHeader::$store_rules);

        if ($validation->fails()) {
            //dd($validation->messages());
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {
            $for_month = Input::get('for_month');
            $for_year = Input::get('for_year');
            $employee_id = Input::get('employee_id');


        }
//for_month for_year employee_id

    }
}


