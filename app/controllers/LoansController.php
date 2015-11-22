<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/11/2015
 * Time: 4:28 PM
 */
class LoansController extends BaseController
{
    public function addLoans()
    {
        $data['title']     = Lang::get('main.loan_request'); // page title
        $data = $this->depData();
        $data['employees'] = "open";
        $data['co_info']   = CoData::thisCompany()->first();
        return View::make('dashboard.hr.loans.index',$data);

    }
    public function storeLoans()
    {
        $validation = Validator::make(Input::all(), Loans::$rules,BaseController::$messages);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {
            $inputs = Input::all();
            $newLoans                         = new Loans;
            $newLoans->true_id                = BaseController::maxId($newLoans);
            $newLoans->co_id                  = $this->coAuth();
            $newLoans->loan_date              = $this->strToTime($inputs['loan_date']);
            $newLoans->employee_id            = $inputs['employee_id'];
            $newLoans->loan_val               = $inputs['loan_val'];
            $newLoans->loan_start             = $this->strToTime($inputs['loan_start']);


            $months = ceil($inputs['loan_val'] /  $inputs['loan_currBal'] )-1;


            $newLoans->loan_end =date('Y-m-d', strtotime($newLoans->loan_start ."+$months months"));

//            $test = date('Y-m-d', strtotime($newLoans->loan_start ."+$months months"));
//            var_dump($test); die();
            $newLoans->loan_currBal           = $inputs['loan_currBal'];
//            $newLoans->user_id                    = Auth::id();
            if($newLoans->save()){

                Session::flash('success',BaseController::addSuccess('القرض'));
            }else{

                Session::flash('error',BaseController::addError('القرض'));
            }
            return Redirect::route('addLoans');
        }
    }

    public  function editLoans($id)
    {
        $data['title']     = Lang::get('main.loan_edit');// page title
        $data['employees'] = "open";
        $data = $this->depData();
        $data['employee'] = Loans::findOrFail($id);
       $data['co_info']   = CoData::thisCompany()->first();
        return View::make('dashboard.hr.loans.index',$data);
    }

    public function updateLoans($id)
    {
        $validation = Validator::make(Input::all(), Loans::$rules,BaseController::$messages);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }
        else
        {
            $oldLoans  = Loans::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();
            if($oldLoans)
            {
                $inputs = Input::all();

                $oldLoans = Loans::find($id);
                $oldLoans->co_id              = $this->coAuth();
                $oldLoans->co_id                  = $this->coAuth();
                $oldLoans->loan_date              = $this->strToTime($inputs['loan_date']);
                $oldLoans->employee_id            = $inputs['employee_id'];
                $oldLoans->loan_val               = $inputs['loan_val'];


                $oldLoans->loan_start             = $this->strToTime($inputs['loan_start']);

                $months = ceil($inputs['loan_val'] /  $inputs['loan_currBal'] )-1;
                $oldLoans->loan_end = date('Y-m-d', strtotime($oldLoans->loan_start ."+$months months"));;

                $oldLoans->loan_currBal           = $inputs['loan_currBal']; // القسط الشهرى
                $oldLoans->user_id                    = Auth::id();

                if($oldLoans->update()){
                    Session::flash('success',BaseController::editSuccess('القرض'));
                }else{
                    Session::flash('error',BaseController::editError('القرض'));
                }
                return Redirect::route('addLoans');
            }
            else
            {
                return View::make('errors.missing');              }
        }
    }
    protected function depData()
    {
        $data['title']              = Lang::get('main.loans');
        $data['employees']          = 'open' ;
        $data['tablesData']        = Loans::company()->get();
        return $data;
    }


}