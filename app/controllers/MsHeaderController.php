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
        $data['title']     = 'التجهيزات الشهريه ';
        $data['employees'] = 'open';
        $data['co_info'] = CoData::thisCompany()->first();
        return View::make('dashboard.hr.msheader.index', $data);

    }

    public function storeMsHeader()
    {
        $data = $this->depData();
        $data['co_info'] = CoData::thisCompany()->first();
//        dd(Input::get('employee_id'));
        return View::make('dashboard.hr.msheader.index', $data);
    }
    public function readyToPay()
    {
        $data = $this->depData();
        $chosenEmployees   = Employees::company()->whereIn('id',Input::get('employeeId'))->get();
          foreach($chosenEmployees as $chosenEmployee){
              var_dump($chosenEmployee->employeeDudValue('استحقاق'));
          }
        die();
        return View::make('dashboard.hr.msheader.index', $data);
    }

    protected function depData()
    {
        $data['title']     = 'التجهيزات الشهريه ';
        $data['employees'] = 'open';
        if(Input::has('employee_id')){
            $data['net']   = Employees::where('id',Input::get('employee_id'))->company()->get();
        }else{
            $data['net']   = Employees::company()->get();
        }
        return $data;
    }

    public function prepMsHeader()
    {
        $validation = Validator::make(Input::all(), MsHeader::$store_rules);

//        if ($validation->fails()) {
//            //dd($validation->messages());
////            return Redirect::back()->withInput()->withErrors($validation->messages());
//        } else {
            $data = $this->depData();

            $data['co_info']   = CoData::thisCompany()->first();
            return View::make('dashboard.hr.msheader.index', $data);

//        }
//for_month for_year employee_id

    }
}


