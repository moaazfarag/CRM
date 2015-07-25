<?php
/**
 * Created by PhpStorm.
 * User: Mohamed Hafez
 * Date: 25/7/2015
 * Time: 3:49 PM
 */

class AccountsBalancesController extends BaseController {

    /**
     * @return mixed
     * add Items Balances
     */

    public function addAccountsBalances()
    {
        $data['title']     = "اضافة ارصدة حسابية  "; // page title
//        $data['co_info']  = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons
        $data['items']    = AccountsBalances::where('co_id','=',$this->coAuth())->get(); //  get all item to view in table

        return View::make('dashboard.accounts_balances',$data);
    }


    /**
     * @return mixed
     * store Items Balances
     */

    public function storeAccountsBalances()
    {
        $validation = Validator::make(Input::all(), AccountsBalances::$store_rules);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {
//            die('hi');
                $accountsBalances = new AccountsBalances;

            $accountsBalances->co_id      = $this->coAuth();
            $accountsBalances->user_id    = Auth::id();
            $accountsBalances->debit      = Input::get('debit');
            $accountsBalances->credit     = Input::get('credit');
            $accountsBalances->notes      = Input::get('notes');

            $accountsBalances->save();

                return Redirect::route('addAccountsBalances');
            }
        
    }



    /**
     * @return mixed
     * edit Items Balances
     */
    public  function editAccountsBalances($id)
    {
        $data['title']     = " تعديل  رصيد حساب"; // page title
        $data['items']     = AccountsBalances::where('co_id','=',$this->coAuth())->get(); //  get all item to view in table
        $data['item']      = AccountsBalances::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();//item will edit
//        dd($data['item']);
        if($data['item'])
        {
//            $data['co_info']  = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons

            return View::make('dashboard.accounts_balances',$data);
        }else{
            return "item not here";
        }


    }

    /**
     * @return mixed
     * update Items Balances
     */
    public  function updateAccountsBalances($id)
    {
        $validation = Validator::make(Input::all(), AccountsBalances::$update_rules);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {

            $accountsBalances  = AccountsBalances::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();

            if($accountsBalances)
            {

                $accountsBalances->user_id    = Auth::id();
                $accountsBalances->debit      = Input::get('debit');
                $accountsBalances->credit     = Input::get('credit');
                $accountsBalances->notes      = Input::get('notes');

                $accountsBalances->update();

                return Redirect::route('addAccountsBalances');
            }else{
                return "This Items Balances Not Found ";
            }
        }
    }





} 