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

    public function sendData()
    {
        $data['accounts'] = Accounts::company()->get();
        return Response::make(json_encode($data));
    }
    public function addAccountsBalances()
    {
        $addAccountBalance=Lang::get('main.addAccountBalance');
        $data['title']     = $addAccountBalance ; // page title
        $data['sideOpen']   = 'open' ;
//        $data['co_info']  = CoData::thisCompany()->first();//select info models category seasons
        $data['items']    = AccountsBalances::company()->get(); //  get all item to view in table
        return View::make('dashboard.account_balances.index',$data);
    }


    /**
     * @return mixed
     * store Items Balances
     */

    public function storeAccountsBalances()
    {
        $inputs = Input::all();

        $validation = Validator::make(Input::all(), AccountsBalances::rulesCreator($inputs));

        if($validation->fails())
        {
            echo "fail";
            dd($validation->messages());
            dd(AccountsBalances::rulesCreator($inputs));
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {
            echo "suev=css";
//            dd(AccountsBalances::rulesCreator($inputs));
            $newData = array();//create array to insert into database on  one query
            foreach(AccountsBalances::countOfInputs($inputs) as $k => $v){
                $newData[]= array
                (
                    'co_id'           => $this->coAuth(),
                    'user_id'         => Auth::id(),
                    'account_id'      => Input::get('id_'.$k),
                    'debit'           => Input::get('debit_'.$k),
                    'credit'          => Input::get('credit_'.$k),
                    'notes'           => Input::get('notes_'.$k),
                    'created_at'   => date('Y-m-d H:i:s'),
                    'updated_at'   => date('Y-m-d H:i:s')
                );//end of array
            }//end foreach
            AccountsBalances::insert($newData);//insert  data
                return Redirect::route('addAccountsBalances');
            }
        
    }



    /**
     * @return mixed
     * edit Items Balances
     */
    public  function editAccountsBalances($id)
    {
        $editAccountsBalances=Lang::get('main.editAccountsBalances');
        $data['title']     = $editAccountsBalances; // page title
        $data['sideOpen']   = 'open' ;
        $data['items']     = AccountsBalances::company()->get(); //  get all item to view in table
        $data['item']      = AccountsBalances::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();//item will edit
//        dd($data['item']);
        if($data['item'])
        {
//            $data['co_info']  = CoData::thisCompany()->first();//select info models category seasons

            return View::make('dashboard.account_balances.index',$data);
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