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
        $validation = Validator::make(Input::all(), MsHeader::$store_rules);

        if ($validation->fails()) {
            //dd($validation->messages());
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

//            $inputs = Input::all();
            $newMsHeader = new MsHeader;
            $newMsHeader->co_id = $this->coAuth();
            $newMsHeader->for_year = Input::get('for_year');
            $newMsHeader->for_month = Input::get('for_month');
            $newMsHeader->save();
            return Redirect::route('addMsHeader');
        }

    }
    protected function depData()
    {
        $data['title']              = 'التجهيزات الشهريه ';
        $data['employees']          = 'open' ;
        $data['tablesData']        = MsHeader::where('co_id','=',$this->coAuth())->get();
        $data['net']               =  DB::table('hr_msheader')
            ->join('hr_employees', 'hr_msheader.id', '=', 'hr_employees.id')
            ->join('hr_empdesded', 'hr_msheader.id', '=', 'hr_empdesded.id')
            ->join('hr_monthchanges', 'hr_msheader.id', '=', 'hr_monthchanges.id')
            ->join('hr_loans', 'hr_msheader.id', '=', 'hr_loans.id')
            ->select('hr_msheader.id','hr_msheader.for_year','hr_msheader.for_month', 'hr_employees.name AS EmpName', 'hr_employees.salary As Fixed_Salary', 'hr_empdesded.val As Deserves', 'hr_monthchanges.val As deduction', 'hr_loans.loan_val As Loans')
            ->get();

        return $data;
    }
    public function searchMsHeader()
    {
        $validation = Validator::make(Input::all(), MsHeader::$store_rules);

        if ($validation->fails()) {
            //dd($validation->messages());
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {
            $for_month   = Input::get('for_month');
            $for_year    = Input::get('for_year');
            $employee_id = Input::get('employee_id');


        }
//for_month for_year employee_id

    }
}