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
       $inputs = Input::all();
        $data['title']              = 'التجهيزات الشهريه ';
        $data['employees']          = 'open' ;
        $data['tablesData']        = MsHeader::where('co_id','=',$this->coAuth())->get();
        $q               =  DB::table('hr_msheader')
            ->join('hr_employees', 'hr_msheader.id', '=', 'hr_employees.id')
            ->join('hr_empdesded', 'hr_msheader.id', '=', 'hr_empdesded.id')
            ->join('hr_monthchanges', 'hr_msheader.id', '=', 'hr_monthchanges.id')
            ->join('hr_loans', 'hr_msheader.id', '=', 'hr_loans.id')
            ->select('hr_msheader.id','hr_msheader.for_year','hr_msheader.for_month', 'hr_employees.name AS EmpName', 'hr_employees.salary As Fixed_Salary', 'hr_empdesded.val As Deserves', 'hr_monthchanges.val As deduction', 'hr_loans.loan_val As Loans');
        if(Input::has('employee_id')) {
            $data['net'] = $q->where('hr_employees.id', $inputs['employee_id'])
                ->where('hr_msheader.for_month', @$inputs['for_month'])
                ->where('hr_msheader.for_year',@$inputs['for_year'])->get();
        }elseif(Input::has('for_month')){
            $data['net'] = $q->where('hr_msheader.for_month', @$inputs['for_month'])
                ->where('hr_msheader.for_year', @$inputs['for_year'])->get();
        }else{
            $data['net'] = $q->get();

        }


        return $data;
    }
 }

