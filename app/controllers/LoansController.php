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
        $data['title']     = 'طلب قرض'  ; // page title
        $data = $this->depData();
        $data['employees'] = "open";
        $data['co_info']   = CoData::where('id','=',$this->coAuth())->first();
        return View::make('dashboard.loans',$data);

    }
    public function storeLoans()
    {
        $validation = Validator::make(Input::all(), Loans::$store_rules);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {
            $inputs = Input::all();
            $newLoans                         = new Loans;
            $newLoans->co_id                  = $this->coAuth();
            $newLoans->loan_date              = $this->strToTime($inputs['loan_date']);
            $newLoans->employee_id            = $inputs['employee_id'];
            $newLoans->loan_val               = $inputs['loan_val'];
            $newLoans->loan_start             = $this->strToTime($inputs['loan_start']);
            $newLoans->loan_end               = $this->strToTime($inputs['loan_end']);
            $newLoans->loan_currBal           = $inputs['loan_currBal'];
//            $newLoans->user_id                    = Auth::id();
            $newLoans->save();
            return Redirect::route('addLoans');
        }
    }

    public  function editLoans($id)
    {
        $data['title']     = 'تعديل فى بيانات القروض   '; // page title
        $data['employees'] = "open";
        $data = $this->depData();
        $data['employee'] = Loans::findOrFail($id);
       $data['co_info']   = CoData::where('id','=',$this->coAuth())->first();
        return View::make('dashboard.loans',$data);
    }

    public function updateLoans($id)
    {
        $validation = Validator::make(Input::all(), Loans::$update_rules);

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
                $oldLoans->loan_end               = $this->strToTime($inputs['loan_end']);
                $oldLoans->loan_currBal           = $inputs['loan_currBal'];
//                $oldLoans->user_id                    = Auth::id();
                $oldLoans->update();
                return Redirect::route('addLoans');
            }
            else
            {
                return "this item not found ";
            }
        }
    }
    protected function depData()
    {
        $data['title']              = 'القروض';
        $data['employees']          = 'open' ;
        $data['tablesData']        = Loans::where('co_id','=',$this->coAuth())->get();
        return $data;
    }


}