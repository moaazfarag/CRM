<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 7/11/2015
 * Time: 1:39 AM
 */
class AccountController extends BaseController
{

    public $pricing = array(

        'sell_users'=> 'سعر البيع',
        'sell_nos_gomla'=>'نصف جملة',
        'sell_gomla'=>'جملة',
        'sell_gomla_gomla' =>'جملة الجملة',

    );

    public static function pricing_name($name) {

        switch ($name){

            case 'sell_users':
            $pricing = 'سعر البيع';
            break;

            case 'sell_nos_gomla':
            $pricing = 'سعر نصف الجملة ';
            break;


                  case 'sell_gomla':
            $pricing =  'سعر الجملة ';
            break;


            case 'sell_gomla_gomla':
            $pricing =  'سعر جملة الجمله ';
            break;

            default:
                $pricing =  'غير محدد ';

        }

        return $pricing;


    }
        public function addAccount($accountType)
        {
            if($this->checkType($accountType)) {
            $data['rowsData'] = Accounts::company()->where('acc_type','=',$accountType)->get();
            $data['pricing'] = $this->pricing;
            $data['accountType'] = $accountType;
            $data['asideOpen']   = 'open' ;
            $data['arabicName']   = Lang::get('main.'.$accountType);
            $data['navActive']      = "active";
            return View::make('dashboard.accounts.index',$data);
            }else{
                return View::make('errors.missing');
                }
        }

         public function editAccount($accountType,$id)

         {
            if($this->checkType($accountType)) {

            $data['rowsData']       = Accounts::where('acc_type','=',$accountType)->get();
            $data['accountType']    = $accountType;
            $data['asideOpen']      = 'open' ;
            $data['pricing']        = $this->pricing;
            $data['navActive']      = "active";
            $data['arabicName']     = Lang::get('main.'.$accountType);
            $data['account']        = Accounts::where('acc_type','=',$accountType)->where('id','=',$id)->first();

            if($data['account']) {
                return View::make('dashboard.accounts.index', $data);
            }else{

                $data['error']      ="عفواً يوجد خطأ";

                return View::make('errors.missing',$data);            }
        }else{

                return View::make('errors.missing');
            }
        }

         public function storeAccount($accountType)
        {
            if ($this->checkType($accountType)) {

            $inputs = Input::all();

            $validation = Validator::make($inputs,Accounts::ruels($accountType),BaseController::$messages);
            if($validation->fails()){

                return Redirect::back()->withInput()->withErrors($validation->messages());

            }else {


                $account = new Accounts;
                $account->co_id = Auth::user()->co_id;
                $account->acc_type = $accountType;
                $account->acc_name = Input::get('acc_name');
                $account->acc_limit = Input::get('acc_limit');
                $account->acc_email = Input::get('acc_email');
                $account->acc_address = Input::get('acc_address');
                $account->acc_tel = Input::get('acc_tel');
                $account->acc_tel2 = Input::get('acc_tel2');
                $account->pricing = Input::get('pricing');

                $account->acc_commercial_registration = Input::get('acc_commercial_registration');
                $account->acc_tax_card = Input::get('acc_tax_card');
                $account->acc_notes = Input::get('acc_notes');
                $account->user_id = Auth::id();

                if($account->save()){

                    Session::flash('success',BaseController::addSuccess(Lang::get("main.the_".$accountType)));
                }else{

                    Session::flash('error',BaseController::addError(Lang::get("main.the_".$accountType)));
                }

                $data['accountType'] = $accountType;
                return Redirect::route('addAccount', $accountType);
            }
            }else {

                return View::make('errors.missing');                 }
             }
    public function updateAccount($accountType,$id)
        {
            if($this->checkType($accountType)){
            $account = Accounts::where('acc_type', '=', $accountType)->where('id', '=', $id)->first();
            if ($account) {
                $account->co_id = Auth::user()->co_id;
                $account->acc_type = $accountType;
                $account->acc_name    = Input::get('acc_name');
                $account->acc_limit   = Input::get('acc_limit');
                $account->acc_email   = Input::get('acc_email');
                $account->acc_address = Input::get('acc_address');
                $account->acc_tel     = Input::get('acc_tel');
                $account->acc_tel2   = Input::get('acc_tel2');
                $account->pricing  = Input::get('pricing');
                $account->acc_commercial_registration = Input::get('acc_commercial_registration');
                $account->acc_tax_card = Input::get('acc_tax_card');
                $account->acc_notes = Input::get('acc_notes');
                $account->user_id = Auth::id();

                if($account->update()){
                    Session::flash('success',BaseController::editSuccess(Lang::get('main.the_'.$accountType)));
                }else{
                    Session::flash('error',BaseController::editError(Lang::get('main.the_'.$accountType)));
                }
                $data['accountType'] = $accountType;
                return Redirect::route('addAccount', $accountType);
            } else {

                return View::make('errors.missing');                 }


        }else{

                return View::make('errors.missing');                 }

        }
    public  function checkType($type){
    $types = array('customers','suppliers','bank','expenses','multiple_revenue','partners');
        if (in_array($type,$types)) {
            return true;
        }else{
            return false;

        }
    }


    public function addDirectMovement(){

        $data['of_account'] = array(

            ''=>'أختر الحساب',
            'customers'=>'العملاء',
            'suppliers'=>'الموردين',
            'partners' =>'جارى الشركاء',
            'bank'     =>'البنك',
        );
        $data['account_type']  = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'),'bank'=>Lang::get('main.bank'),'multiple_revenue'=>Lang::get('main.multiple_revenue'),'expenses'=>Lang::get('main.expenses'));
        $data['branch']      = $this->isAllBranch();
        $data['title']      = 'إضافة حركة مباشرة ';
        $data['company']    = CoData::find(Auth::user()->co_id);
        $data['rowsData']   = AccountTrans::company()->whereIn('trans_type',['catch','pay'])->get();
        return View::make('dashboard.accounts.treasury_account.index', $data);
    }

    public function storeDirectMovement(){

        $inputs = Input::all();
        $ruels =  Accounts::$ruels_direct_movement;
        if($this->isHaveBranch() == 1) {
            $ruels["br_id"] = "required";
        }

        $validation = Validator::make($inputs,$ruels,BaseController::$messages);
        if($validation->fails())
        {

            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {


            $movement           = new AccountTrans;
            $movement->co_id    = Auth::user()->co_id;
            $movement->br_id       = (!empty($inputs['br_id'])) ? $inputs['br_id'] : "";
            $movement->account  = $inputs['account'];
            $movement->account_id  = $inputs['account_id'];
            $movement->pay_type = 'cash';
            $movement->date     = $this->strToTime($inputs['date']);
            $movement->notes    = $inputs['notes'];

            $movement->user_id  = Auth::id();

            if($inputs['price_type'] == 'credit'){

                $account_trans_no           = AccountTrans::company()->where('trans_type','catch')->max('account_trans_no')+1;
                $movement->account_trans_no = $account_trans_no;

                $movement->credit   =  $inputs['price'] ;
                $movement->trans_type     = 'catch';

            }elseif($inputs['price_type'] == 'debit') {

                $account_trans_no           = AccountTrans::company()->where('trans_type','pay')->max('account_trans_no')+1;
                $movement->account_trans_no = $account_trans_no;

                $movement->debit    =  $inputs['price'];
                $movement->trans_type     = 'pay';

            }

            $movement->save();
            Session::flash('success','تمت الإضافة بنجاح ');
            return Redirect::back();

        }
    }


    public function editDirectMovement($id){
        $data['movement']   =  AccountTrans::company()->find($id);
//        dd();
        if(!empty($data['movement'])) {
            $data['of_account'] = array(

                '' => 'أختر الحساب',
                'customers' => 'العملاء',
                'suppliers' => 'الموردين',
                'partners'  => 'جارى الشركاء',
                'bank'      => 'البنك',
            );
            $data['branch']      = $this->isAllBranch();
            $data['title'] = 'تعديل حركة مباشرة';
            $data['company']       = CoData::find(Auth::user()->co_id);
            $data['rowsData']   = AccountTrans::company()->whereIn('trans_type',['catch','pay'])->get();
            $data['account_type']  = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'),'multiple_revenue'=>Lang::get('main.multiple_revenue'),'expenses'=>Lang::get('main.expenses'));

//        var_dump($data['rowsData']); die();
            return View::make('dashboard.accounts.treasury_account.index', $data);
        }else{
            $data['error'] = 'عفواً هذه الحركة المباشرة غير موجودة';
            return View::make('errors.missing',$data);                 }

    }


    public function updateDirectMovement($id){

        $inputs = Input::all();
        $ruels =  Accounts::$ruels_direct_movement;


        $validation = Validator::make($inputs,$ruels,BaseController::$messages);
        if($validation->fails())
        {

            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {


            $movement                =  AccountTrans::company()->where('id',$id)->first();

            $movement->co_id         = Auth::user()->co_id;
            $movement->account       = $inputs['account'];
            $movement->account_id    = $inputs['account_id'];
            $movement->pay_type      = 'cash';
            $movement->br_id       = (!empty($inputs['br_id'])) ? $inputs['br_id'] : "";
            $movement->date          = $this->strToTime($inputs['date']);
            $movement->notes         = $inputs['notes'];
            $movement->user_id       = Auth::id();

            if($inputs['price_type'] == 'credit'){

                $movement->credit   =  $inputs['price'] ;
                $movement->trans_type    = 'catch';
                $movement->debit    = 0;

            }elseif($inputs['price_type'] == 'debit') {

                $movement->debit         =  $inputs['price'];
                $movement->trans_type    = 'pay';
                $movement->credit= 0;
            }

            $movement->update();
            Session::flash('success','تم التعديل بنجاح');
            return Redirect::route('addDirectMovement');

        }
    }



    public  function searchAccounts($type){


        $types = array('customers','suppliers','bank','partners','expenses','multiple_revenue');

        if(in_array($type,$types)){

            $data['co_info']   = CoData::thisCompany()->first();
            $data['title']     = Lang::get('main.accounts_'.$type);
            $data['accounts']  = Accounts::company()->where('acc_type',$type)->get();
            $data['type']      = $type;

            if(empty($data['accounts'])){
                $data['accounts_empty'] = 'yes';
            }else{

                $data['select_account'] = Lang::get('main.balance_'.$type);
                $data['accounts_empty'] = 'no';
            }

            return View::make('dashboard.accounts.accounts_search.accounts_search',$data);

        }else{
            return 'type check error';
        }

    }

    public function resultAccounts($type){

        // VALIDATION

         $inputs     = Input::all();
         $validation = Validator::make($inputs,Accounts::$ruels_result_account,BaseController::$messages);

        if($validation->fails()) {
            return Redirect::to('resultAccounts')->withInput()->withErrors($validation->messages());
        }else{

            $types = array('customers','suppliers','bank','partners','expenses','multiple_revenue');

            if(in_array($type,$types)){

            // FILL VARIABELS FROM INPUTS
            $date_from          = $this->strToTime($inputs['date_from']);
            $date_to            = $this->strToTime($inputs['date_to']);
            $account_id         = $inputs['account_id'];



            // MAKE QUERY
            $account_trans     = AccountTrans::company()
                                ->dateBetween('date',$date_from,$date_to);
             if($account_id == 'all') {

                 $account_trans->where('account', $type);

             }else{

                 $account_trans->where('account_id', $account_id);
             }

                $account_balance = AccountsBalances::where('account_id',$account_id)
                    ->select(DB::raw('SUM(credit) AS sum_credit'),DB::raw('SUM(debit) AS sum_debit'),'accounts_balances.*')
                    ->first();

//            var_dump($account_trans); die();

            // FILL DATA FROM INPUTS AND ACCOUNT TRANS RESULT

            $data['account_balance'] = $account_balance;
            $data['account_trans'] = $account_trans->get();
            $data['date_from']     = $date_from;
            $data['date_to']       = $date_to;
            $data['type']          = $type;
            $data['account']       = $type;
            $data['account_id']    = $account_id;
            $data['company']       = CoData::find(Auth::user()->co_id);
            $data['branch']        = $this->isAllBranch();
            $data['co_info']       = CoData::thisCompany()->first();
            $data['title']         = Lang::get('main.accounts_'.$type);
            $data['select_account']= Lang::get('main.balance_'.$type);

                if($account_id != 'all'){
                    $data['name']          = Accounts::find($account_id)->acc_name;
                    $data['accounts']      = Accounts::company()->where('acc_type',$type)->get();
                }else{

                    $data['name']          = Lang::get('main.balance_'.$type);
                    $data['accounts']      = Accounts::company()->where('acc_type',$type)->get();

                }



                if($account_id == 'all') {

                    $data['of_account'] = array(

                        ''=>'أختر الحساب',
                        'customers'=>'العملاء',
                        'suppliers'=>'الموردين',
                        'partners' =>'جارى الشركاء',
                        'bank'     =>'البنك',
                    );
                    $data['account_type']  = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'),'bank'=>Lang::get('main.bank'),'multiple_revenue'=>Lang::get('main.multiple_revenue'),'expenses'=>Lang::get('main.expenses'));

                    $all_accounts         = Accounts::company()->where('acc_type',$type)->get()->lists('id');
                   $data['all_accounts'] = $all_accounts;
                   $credit               = 0;
                   $debit                = 0;

                    foreach($all_accounts as $account_id){

                        $account_balance = AccountsBalances::where('account_id',$account_id)
                            ->select(DB::raw('SUM(credit) AS sum_credit'),DB::raw('SUM(debit) AS sum_debit'))
                            ->first();
//                        dd($account_balance);
                        $all_trans_cash = AccountTrans::company()
                            ->where('account_id',$account_id)
                            ->whereIn('pay_type',['cash','visa'])
                            ->whereNotIn('trans_type',['catch','pay'])
                            ->select(DB::raw('SUM(credit) AS sum_credit'),DB::raw('SUM(debit) AS sum_debit'))
                            ->first();
                        $all_trans_on_account = AccountTrans::company()
                            ->where('account_id',$account_id)
                            ->where('pay_type','on_account')
                            ->whereIn('trans_type',['catch','pay'])
                            ->select(DB::raw('SUM(credit) AS sum_credit'),DB::raw('SUM(debit) AS sum_debit'))
                            ->first();

                        $all_trans_movement = AccountTrans::company()
                            ->where('account_id',$account_id)
                            ->whereIn('trans_type',['catch','pay'])
                            ->select(DB::raw('SUM(credit) AS sum_credit'),DB::raw('SUM(debit) AS sum_debit'))
                            ->first();

                        if(!empty($all_trans_cash)){
                            $credit = $all_trans_cash->sum_credit + $all_trans_cash->sum_debit;
                            $debit  = $credit;

//                           $data['account_trans'][$account_id] = ['']
                        }

                        if(!empty($all_trans_on_account)){

                            $credit += $all_trans_on_account->sum_credit;
                            $debit  += $all_trans_on_account->sum_debit;
                        }

                        if(!empty($all_trans_movement)){

                            $credit += $all_trans_movement->sum_credit;
                            $debit  += $all_trans_movement->sum_debit;
                        }

                        if(!empty($account_balance)){

                            $credit += $account_balance->sum_credit;
                            $debit  += $account_balance->sum_debit;
                        }


                       $name = Accounts::find($account_id)->acc_name;

                       $data['account_trans_result'][$account_id] =  ['credit'=>$credit,'debit'=>$debit,'name'=>$name];


                    }
                    return View::make('dashboard.accounts.accounts_search.accounts_balance_result', $data);
                }else{
                    return View::make('dashboard.accounts.accounts_search.accounts_result', $data);
                }
            }else{

            return View::make('errors.missing');

            }

            // end data for search

        }

    }

    public function accountsAddNewDirectMovement()
    {


        // this function add new direct movement from  accounts pages
        $inputs = Input::all();
//        var_dump($inputs); die();
        $ruels  = Accounts::$ruels_direct_movement;

        if($this->isHaveBranch() == 1) {

            $ruels["br_id"] = "required";

        }


        $validation = Validator::make($inputs, $ruels, BaseController::$messages);

        if ($validation->fails()) {

            return View::make('errors.missing');

        } else {

            $movement               = new AccountTrans;
            $movement->co_id        = Auth::user()->co_id;
            $movement->account      = $inputs['account'];
            $movement->br_id        = (!empty($inputs['br_id'])) ? $inputs['br_id'] : "";
            $movement->account_id   = $inputs['account_id'];
            $movement->pay_type     = 'cash';
            $movement->date         = $this->strToTime($inputs['date']);
            $movement->notes        = $inputs['notes'];

            $movement->user_id      = Auth::id();

            if ($inputs['price_type'] == 'credit') {

                $account_trans_no           = AccountTrans::company()->where('trans_type','catch')->max('account_trans_no')+1;
                $movement->account_trans_no = $account_trans_no;

                $movement->credit           = $inputs['price'];
                $movement->trans_type       = 'catch';

            } elseif ($inputs['price_type'] == 'debit') {

                $account_trans_no = AccountTrans::company()->where('trans_type','pay')->max('account_trans_no')+1;
                $movement->account_trans_no = $account_trans_no;

                $movement->debit = $inputs['price'];
                $movement->trans_type     = 'pay';

            }


            $movement->save();

            if($movement->save()){



                $date_from   = $this->strToTime($inputs['date_from']);
                $date_to     = $this->strToTime($inputs['date_to']);
                $account_id  = $inputs['account_id'];
                $type        = $inputs['account'];
                $for        = $inputs['for'];
                return Redirect::route('resultSearchAccounts',array('type'=>$type,'account_id'=>$account_id,'date_from'=>$date_from,'date_to'=>$date_to,'type'=>$type,'for'=>$for));
            }// end if movement
        }
    }
        public function resultSearchAccounts(){

            // this function redirect back to general accounts after store new direct movement


            // CHECK TYPE
            $type  = Input::get('type');
            $types = array('customers','suppliers','bank','partners','expenses','multiple_revenue');

            if(in_array($type,$types)){

                // FILL VARIABELS FROM INPUTS
                $date_from          = Input::get('date_from');
                $date_to            = Input::get('date_to');
                $account_id         = Input::get('account_id');
                $for                = Input::get('for');

                // MAKE QUERY
                $account_trans     = AccountTrans::company()
                    ->dateBetween('date',$date_from,$date_to);

                if($for == 'all') {

                    $account_trans->where('account', $type);

                }else{

                    $account_trans->where('account_id', $account_id);
                }

                $account_balance = AccountsBalances::where('account_id',$account_id)
                    ->select(DB::raw('SUM(credit) AS sum_credit'),DB::raw('SUM(debit) AS sum_debit'),'accounts_balances.*')
                    ->first();

//            var_dump($account_trans); die();

                // FILL DATA FROM INPUTS AND ACCOUNT TRANS RESULT

                $data['account_balance'] = $account_balance;
                $data['account_trans'] = $account_trans->get();
                $data['date_from']     = $date_from;
                $data['date_to']       = $date_to;
                $data['type']          = $type;
                $data['account']       = $type;
                $data['account_id']    = $account_id;
                $data['company']       = CoData::find(Auth::user()->co_id);
                $data['branch']        = $this->isAllBranch();
                $data['co_info']       = CoData::thisCompany()->first();
                $data['title']         = Lang::get('main.accounts_'.$type);
                $data['select_account']= Lang::get('main.balance_'.$type);

                if($for != 'all'){
                    $data['name']          = Accounts::find($account_id)->acc_name;
                    $data['accounts']      = Accounts::company()->where('acc_type',$type)->get();
                }else{

                    $data['accounts']      = Accounts::company()->where('acc_type',$type)->get();
                    $data['name']          = Lang::get('main.balance_'.$type);

                }



                if($for == 'all') {

                    $data['of_account'] = array(

                        ''=>'أختر الحساب',
                        'customers'=>'العملاء',
                        'suppliers'=>'الموردين',
                        'partners' =>'جارى الشركاء',
                        'bank'     =>'البنك',
                    );
                    $data['account_type']  = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'),'bank'=>Lang::get('main.bank'),'multiple_revenue'=>Lang::get('main.multiple_revenue'),'expenses'=>Lang::get('main.expenses'));

                    $all_accounts         = Accounts::company()->where('acc_type',$type)->get()->lists('id');
                    $data['all_accounts'] = $all_accounts;
                    $credit               = 0;
                    $debit                = 0;

                    foreach($all_accounts as $account_id){

                        $account_balance = AccountsBalances::where('account_id',$account_id)
                            ->select(DB::raw('SUM(credit) AS sum_credit'),DB::raw('SUM(debit) AS sum_debit'))
                            ->first();
//                        dd($account_balance);
                        $all_trans_cash = AccountTrans::company()
                            ->where('account_id',$account_id)
                            ->whereIn('pay_type',['cash','visa'])
                            ->whereNotIn('trans_type',['catch','pay'])
                            ->select(DB::raw('SUM(credit) AS sum_credit'),DB::raw('SUM(debit) AS sum_debit'))
                            ->first();
                        $all_trans_on_account = AccountTrans::company()
                            ->where('account_id',$account_id)
                            ->where('pay_type','on_account')
                            ->whereIn('trans_type',['catch','pay'])
                            ->select(DB::raw('SUM(credit) AS sum_credit'),DB::raw('SUM(debit) AS sum_debit'))
                            ->first();

                        $all_trans_movement = AccountTrans::company()
                            ->where('account_id',$account_id)
                            ->whereIn('trans_type',['catch','pay'])
                            ->select(DB::raw('SUM(credit) AS sum_credit'),DB::raw('SUM(debit) AS sum_debit'))
                            ->first();

                        if(!empty($all_trans_cash)){
                            $credit = $all_trans_cash->sum_credit + $all_trans_cash->sum_debit;
                            $debit  = $credit;

//                           $data['account_trans'][$account_id] = ['']
                        }

                        if(!empty($all_trans_on_account)){

                            $credit += $all_trans_on_account->sum_credit;
                            $debit  += $all_trans_on_account->sum_debit;
                        }

                        if(!empty($all_trans_movement)){

                            $credit += $all_trans_movement->sum_credit;
                            $debit  += $all_trans_movement->sum_debit;
                        }

                        if(!empty($account_balance)){

                            $credit += $account_balance->sum_credit;
                            $debit  += $account_balance->sum_debit;
                        }


                        $name = Accounts::find($account_id)->acc_name;

                        $data['account_trans_result'][$account_id] =  ['credit'=>$credit,'debit'=>$debit,'name'=>$name];


                    }

                    return View::make('dashboard.accounts.accounts_search.accounts_balance_result', $data);
                }else{
                    return View::make('dashboard.accounts.accounts_search.accounts_result', $data);
                }
            }else{

                return View::make('errors.missing');

            }


        }

    // TREASURY START
    public function dailyTreasurySearch(){

        $data['title']       = Lang::get('main.daily_treasury');
        $data['company']     = CoData::find(Auth::user()->co_id);
        $data['branch']      = $this->isAllBranch();

        return View::make('dashboard.accounts.daily_treasury.daily_treasury_search',$data);


    }
    public function dailyTreasuryResult(){


        $inputs = Input::all();

        $validation = Validator::make($inputs,Accounts::$ruels_treasury,BaseController::$messages);

        if($validation->fails()){

            return Redirect::back()->withInput()->withErrors($validation->messages());

        }else{
            if ($this->isHaveBranch()) {
                $br_id          = $inputs['br_id'];
            }else{
                $br_id          = Auth::user()->br_id;
            }
            $date_from      = $this->strToTime($inputs['date_from']);
            $date_to        = $this->strToTime($inputs['date_to']);

            $debit_types    = array('buy','pay','salesReturn');
            $credit_types   = array('sales','catch','buyReturn');
            $movements      = array('pay','catch');
            $debit          = array();
            $credit         = array();

            $data['company']        = CoData::find(Auth::user()->co_id);
            $data['branch']         = $this->isAllBranch();
            $data['title']          = Lang::get('main.daily_treasury');
            $data['date_from']      = $date_from;
            $data['date_to']        = $date_to;
            $data['movements']      = $movements;
            $data['debit_types']    = $debit_types;
            $data['credit_types']   = $credit_types;
             $data['br_id']         = $br_id  ;
            $data['account_type']   = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'),'bank'=>Lang::get('main.bank'),'multiple_revenue'=>Lang::get('main.multiple_revenue'),'expenses'=>Lang::get('main.expenses'));

            if(isset($br_id)&& $br_id !='' ){

                $data['branch_name']    = Branches::find($br_id)->first()->br_name ;
                $data['view_branch']  = 'one';
                $last_balances = Treasury::company()->where('br_id',$br_id)->where('date','<',$date_from)->get();

                if(!empty($last_balances)) {
                    foreach ($last_balances as $k => $last_balance) {


                        if (in_array($last_balance->type, $movements)) {

                            $debit[$k] = $last_balance->credit;
                            $credit[$k] = $last_balance->debit;

                        } else {

                            if (in_array($last_balance->type, $credit_types)) {

                                $debit[$k] = $last_balance->credit;
                                $credit[$k] = 0;

                            } elseif (in_array($last_balance->type, $debit_types)) {

                                $debit[$k] = 0;
                                $credit[$k] = $last_balance->debit;
                            }

                        }// end else
                    }

                    $data['last_debit'] = array_sum($credit);
                    $data['last_credit'] = array_sum($debit);

                }else{

                    $data['last_debit']  = 0;
                    $data['last_credit'] = 0;
                }


                //--------------------- treasury_between_date ----------------------------------------

                $data['treasury_between_date'] =  Treasury::company()->where('br_id',$br_id)->dateBetween('date',$date_from,$date_to)->get();


//                var_dump($data['treasury_between_date']); die();
                return View::make('dashboard.accounts.daily_treasury.daily_treasury_result',$data);

            }// end if one branch

            else{

                // get all branches

                $all_branches    = Branches::company()->get();
                $all_branches_id = array();
                $data['view_branch']  = 'many';

                foreach($all_branches as $i=>$branch ){

                        $br_id                = $branch->id;
                        $all_branches_id[$i]  = $branch->id;
                        $credit = [];
                        $debit = [];

                        $last_balances = Treasury::company()->where('br_id',$branch->id)->where('date','<',$date_from)->get();

                        if(!empty($last_balances)) {

                            foreach ($last_balances as $k => $last_balance) {


                                if (in_array($last_balance->type, $movements)) {

                                    $debit[$k]  = $last_balance->credit;
                                    $credit[$k] = $last_balance->debit;

                                } else {

                                    if (in_array($last_balance->type, $credit_types)) {

                                        $debit[$k]  = $last_balance->credit;
                                        $credit[$k] = 0;

                                    } elseif (in_array($last_balance->type, $debit_types)) {

                                        $debit[$k] = 0;
                                        $credit[$k] = $last_balance->debit;
                                    }

                                }// end else
                            }

                            $data["last_debit"][$branch->id]  = array_sum($credit);
                            $data["last_credit"][$branch->id] = array_sum($debit);

                        }else{

                            $data["last_debit"][$branch->id]  =  0;
                            $data["last_credit"][$branch->id] = 0;
                        }


                        //--------------------- treasury_between_date ----------------------------------------
                        $data['all_branches_id'] = $all_branches_id;
                        $data["treasury_between_date"][$br_id] =  Treasury::company()->where('br_id',$br_id)->dateBetween('date',$date_from,$date_to)->get();


                    }


//                echo '<pre>';   print_r($data['last_credit']);  echo '</pre>';   die() ;

                return View::make('dashboard.accounts.daily_treasury.daily_treasury_result',$data);

            }// end else




        }// end if validation



    }

    public function dailyTreasuryAddDirectMovement()
    {

        $inputs = Input::all();
        $ruels  = Accounts::$ruels_direct_movement;

        if ($this->isHaveBranch() == 1) {
            $ruels["br_id"] = "required";
        }

        $validation = Validator::make($inputs, $ruels, BaseController::$messages);
        if ($validation->fails()) {

            return Redirect::back()->withInput()->withErrors($validation->messages());

        } else {


            $movement               = new AccountTrans;
            $movement->co_id        = Auth::user()->co_id;
            $movement->br_id        = (!empty($inputs['br_id'])) ? $inputs['br_id'] : "";
            $movement->account      = $inputs['account'];
            $movement->account_id   = $inputs['account_id'];
            $movement->pay_type     = 'cash';
            $movement->date         = $this->strToTime($inputs['date']);
            $movement->notes        = $inputs['notes'];
            $movement->user_id      = Auth::id();

            if ($inputs['price_type'] == 'credit') {

                $account_trans_no = AccountTrans::company()->where('trans_type', 'catch')->max('account_trans_no') + 1;
                $movement->account_trans_no = $account_trans_no;

                $movement->credit = $inputs['price'];
                $movement->trans_type = 'catch';

            } elseif ($inputs['price_type'] == 'debit') {

                $account_trans_no = AccountTrans::company()->where('trans_type', 'pay')->max('account_trans_no') + 1;
                $movement->account_trans_no = $account_trans_no;

                $movement->debit = $inputs['price'];
                $movement->trans_type = 'pay';

            }

            $movement->save();

            if ($movement->save()) {


                $date_from  = $this->strToTime($inputs['date_from']);
                $date_to    = $this->strToTime($inputs['date_to']);
                $br_id      = $inputs['branch_id'];

                Session::flash('success','تم إضافة الحركة المباشرة بنجاح ');

//                return Redirect::r();
                return Redirect::route('resultSearchDailyTreasury', array('date_from' => $date_from , 'date_to' => $date_to, 'br_id' => $br_id));
            }// end if movement
         ;


        }
    }


    public function resultSearchDailyTreasury(){


        $br_id          = Input::get('br_id');
        $date_from      = $this->strToTime(Input::get('date_from'));
        $date_to        = $this->strToTime(Input::get('date_to'));


        $debit_types    = array('buy','pay','salesReturn');
        $credit_types   = array('sales','catch','buyReturn');
        $movements      = array('pay','catch');
        $debit          = array();
        $credit         = array();

        $data['company']        = CoData::find(Auth::user()->co_id);
        $data['branch']         = $this->isAllBranch();
        $data['title']          = Lang::get('main.daily_treasury');
        $data['date_from']      = $date_from;
        $data['date_to']        = $date_to;
        $data['movements']      = $movements;
        $data['debit_types']    = $debit_types;
        $data['credit_types']   = $credit_types;
        $data['br_id']          = $br_id  ;
        $data['account_type']   = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'),'bank'=>Lang::get('main.bank'),'multiple_revenue'=>Lang::get('main.multiple_revenue'),'expenses'=>Lang::get('main.expenses'));


        if(isset($br_id)&& $br_id !='' ){

            $data['branch_name']    = Branches::find($br_id)->first()->br_name ;
            $data['view_branch']  = 'one';
            $last_balances = Treasury::company()->where('br_id',$br_id)->where('date','<',$date_from)->get();

            if(!empty($last_balances)) {
                foreach ($last_balances as $k => $last_balance) {


                    if (in_array($last_balance->type, $movements)) {

                        $debit[$k] = $last_balance->credit;
                        $credit[$k] = $last_balance->debit;

                    } else {

                        if (in_array($last_balance->type, $credit_types)) {

                            $debit[$k] = $last_balance->credit;
                            $credit[$k] = 0;

                        } elseif (in_array($last_balance->type, $debit_types)) {

                            $debit[$k] = 0;
                            $credit[$k] = $last_balance->debit;
                        }

                    }// end else
                }

                $data['last_debit'] = array_sum($credit);
                $data['last_credit'] = array_sum($debit);

            }else{

                $data['last_debit']  = 0;
                $data['last_credit'] = 0;
            }


            //--------------------- treasury_between_date ----------------------------------------

            $data['treasury_between_date'] =  Treasury::company()->where('br_id',$br_id)->dateBetween('date',$date_from,$date_to)->get();


//                var_dump($data['treasury_between_date']); die();
            return View::make('dashboard.accounts.daily_treasury.daily_treasury_result',$data);

        }// end if branch

        else{

            // get all branches

            $all_branches    = Branches::company()->get();
            $all_branches_id = array();
            $data['view_branch']  = 'many';

            foreach($all_branches as $i=>$branch ){

                $br_id                = $branch->id;
                $all_branches_id[$i]  = $branch->id;


                $last_balances = Treasury::company()->where('br_id',$branch->id)->where('date','<',$date_from)->get();

                if(!empty($last_balances)) {

                    foreach ($last_balances as $k => $last_balance) {


                        if (in_array($last_balance->type, $movements)) {

                            $debit[$k]  = $last_balance->credit;
                            $credit[$k] = $last_balance->debit;

                        } else {

                            if (in_array($last_balance->type, $credit_types)) {

                                $debit[$k]  = $last_balance->credit;
                                $credit[$k] = 0;

                            } elseif (in_array($last_balance->type, $debit_types)) {

                                $debit[$k] = 0;
                                $credit[$k] = $last_balance->debit;
                            }

                        }// end else
                    }

                    $data["last_debit"][$branch->id]  = array_sum($credit);
                    $data["last_credit"][$branch->id] = array_sum($debit);

                }else{

                    $data["last_debit"][$branch->id]  =  0;
                    $data["last_credit"][$branch->id] = 0;
                }


                //--------------------- treasury_between_date ----------------------------------------
                $data['all_branches_id'] = $all_branches_id;
                $data["treasury_between_date"]["$br_id"] =  Treasury::company()->where('br_id',$br_id)->dateBetween('date',$date_from,$date_to)->get();


            }


//                echo '<pre>';   print_r($data['last_credit']);  echo '</pre>';   die() ;

            return View::make('dashboard.accounts.daily_treasury.daily_treasury_result',$data);

        }// end else




    }// end if validation



}

