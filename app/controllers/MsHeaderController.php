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
        $data['title'] = Lang::get('main.monthly_salary_equipment'); // page title
        $data['co_info'] = CoData::thisCompany()->first();
        return View::make('dashboard.hr.msheader.index', $data);

    }

    public function storeMsHeader()
    {
        $data = $this->depData();

        $data['title'] = Lang::get('main.monthly_salary_equipment');  // page title
        $data['employees'] = "open";
        $data['co_info'] = CoData::thisCompany()->first();
//        dd(Input::get('employee_id'));
        return View::make('dashboard.hr.msheader.index', $data);
    }
    public function readyToPay()
    {
        $haveSalary = MsHeader::hasSalary()->lists('employee_id');

        $chosenEmployees = Employees::whereNotIn('id', $haveSalary)->whereIn('id', Input::get('employeeId'))->get();
        if ($chosenEmployees->isEmpty()) {

            return 'برجاء اختيار الموظفيت المراد الصرف لهم ';

        } else {
            foreach ($chosenEmployees as $chosenEmployee) {

                $allDis = $chosenEmployee->employeeDudValue('استقطاع') ;

                $allDud = $chosenEmployee->employeeDudValue('استحقاق');
                $loan = $chosenEmployee->loansValue();
                $salary = $chosenEmployee->salary;
                
                $newHeader = new  MsHeader;
                $newHeader->co_id = $this->coAuth();
                $msHeaderId = $newHeader->company()->max('ms_header_id') + 1;
                $newHeader->ms_header_id = $msHeaderId;
                $newHeader->employee_id = $chosenEmployee->id;
                $newHeader->for_year = Input::get('for_year');
                $newHeader->for_month = Input::get('for_month');
                $newHeader->fixed_salary = $salary;
                $newHeader->deserves = $allDud;
                $newHeader->deductions = $allDis;
                $newHeader->loan = $loan;
                $newHeader->net = ($salary + $allDud) - ($allDis + $loan);
                $newHeader->user_id = Auth::id();
                $monthChanges = MonthChange::getMonthAllChange($chosenEmployee->id);
                $fixDesDuds   = EmployeeDeduction::getAllDisDed($chosenEmployee->id);
                foreach ($monthChanges as $monthChange) {
                    if($monthChange->day_cost == "ايام"){
                        $day_cost = ($salary/30)*$monthChange->total_val;
                    }else{
                        $day_cost = $monthChange->total_val;
                    }
                    $newDetails[] = array(
                        'ms_header_id' => $msHeaderId,
                        'employee_id'  => $chosenEmployee->id,
                        'for_year'     => Input::get('for_year'),
                        'for_month'    => Input::get('for_month'),
                        'des_ded_id'   => $monthChange->des_ded_id,
                        'des_ded_type' => $monthChange->ds_type,
                        'des_ded_val'  => $day_cost,
                        'created_at'   => date('Y-m-d H:i:s'),
                        'updated_at'   => date('Y-m-d H:i:s')
                    );

                }
                foreach ($fixDesDuds as $fixDesDud) {
                    $newDetails[] = array(
                        'ms_header_id' => $msHeaderId,
                        'employee_id'  => $chosenEmployee->id,
                        'for_year'     => Input::get('for_year'),
                        'for_month'    => Input::get('for_month'),
                        'des_ded_id'   => $fixDesDud->des_ded,
                        'des_ded_type' => $fixDesDud->ds_type,
                        'des_ded_val'  => $fixDesDud->total_val,
                        'created_at'   => date('Y-m-d H:i:s'),
                        'updated_at'   => date('Y-m-d H:i:s')
                    );
                }

                $newHeader->save();
        }
            if(isset($newDetails)){
                MsDetails::insert($newDetails);
            }else{
            }
            isset($newDetails)? MsDetails::insert($newDetails):null;
            $data['headers'] = MsHeader::company()->whereIn('employee_id',Input::get('employeeId'))
                ->where('for_month',Input::get('for_month'))
                ->where('for_year' ,Input::get('for_year'))->get();
            return View::make('dashboard.hr.msheader.employee_receipt',$data);
        }

    }
    protected function depData()
    {
        $data['title']     = Lang::get('main.salary_equipment');
        $data['employees'] = 'open';
        $haveSalary           = MsHeader::hasSalary()->get();
        $data['haveSalary']   = MsHeader::hasSalary()->whereIn('employee_id',$haveSalary->lists('employee_id'))->get();
        if(Input::has('employee_id')){
            $data['net']   = Employees::company()->where('id',Input::get('employee_id'))->get();
        }else{
//            dd(  $data['haveSalary']);
            $data['net']          = Employees::company()->whereNotIn('id',$haveSalary->lists('employee_id'))->get();
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


