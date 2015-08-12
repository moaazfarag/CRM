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
            $newLoans                     = new Loans;
            $newLoans->co_id              = $this->coAuth();
            $newLoans->loanDate           = $this->strToTime($inputs['loanDate']);
            $newLoans->empCode            = $inputs['empCode'];
            $newLoans->loanVal            = $inputs['loanVal'];
            $newLoans->loanStart          = $this->strToTime($inputs['loanStart']);
            $newLoans->loanEnd            = $this->strToTime($inputs['loanEnd']);
            $newLoans->loanCurrBal        = $inputs['loanCurrBal'];
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
                $oldLoans = Loans::find($id);
                $oldLoans->co_id              = $this->coAuth();
                $oldLoans->loanDate           = Input::get('loanDate');
                $oldLoans->loanVal            = Input::get('loanVal');
                $oldLoans->loanStart          = Input::get('loanStart');
                $oldLoans->loanEnd            = Input::get('loanEnd');
                $oldLoans->loanCurrBal        = Input::get('loanCurrBal');
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
//
        $data['title']              = 'القروض';
        $data['employees']          = 'open' ;
        $data['tablesData']        = Loans::where('co_id','=',$this->coAuth())->get();
//        dd( $data['tablesData']->employees  );
        return $data;
    }

    /**
     * @return bool|string
     */
    public function strToTime($date)
    {
        return date("Y-m-d", strtotime($date));
    }

}