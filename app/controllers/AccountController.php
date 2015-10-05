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
            $data['rowsData'] = Accounts::where('acc_type','=',$accountType)->get();
            $data['pricing'] = $this->pricing;
            $data['accountType'] = $accountType;
            $data['asideOpen']   = 'open' ;
            $data['arabicName']   = Lang::get('main.'.$accountType);
            $data['navActive']      = "active";
            return View::make('dashboard.accounts.index',$data);
            }else{
                    return "type check error";
                }
        }
    public function editAccount($accountType,$id)
        {
            if($this->checkType($accountType)) {
            $data['rowsData'] = Accounts::where('acc_type','=',$accountType)->get();
            $data['accountType'] = $accountType;
            $data['asideOpen']   = 'open' ;
            $data['pricing']   = $this->pricing;
            $data['navActive']      = "active";
            $data['arabicName']   = Lang::get('main.'.$accountType);
            $data['account'] = Accounts::where('acc_type','=',$accountType)->where('id','=',$id)->first();
            if($data['account']) {
                return View::make('dashboard.accounts.index', $data);
            }else{
                return "error";
            }
        }else{
            return "type check error";
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
                $account->save();
                $data['accountType'] = $accountType;
                return Redirect::route('addAccount', $accountType);
            }
            }else {
                    return "type check error";
                }

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
                $account->update();
                $data['accountType'] = $accountType;
                return Redirect::route('addAccount', $accountType);
            } else {
                return "error";
            }
        }else{
                return "type check error";
        }
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

        $data['title']      = 'إضافة حركة مباشرة ';
        $data['company']    = CoData::find(Auth::user()->co_id);
        $data['account_type']  = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'),'bank'=>Lang::get('main.bank'));
        $data['rowsData']   = AccountTrans::company()->where('trans_type','direct_movement')->get();
        return View::make('dashboard.accounts.treasury_account.index', $data);
    }

    public function storeDirectMovement(){

        $inputs = Input::all();
        $ruels =  Accounts::$ruels_direct_movement;


        $validation = Validator::make($inputs,$ruels,BaseController::$messages);
        if($validation->fails())
        {

            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {


            $movement           = new AccountTrans;
            $movement->co_id    = Auth::user()->co_id;
            $movement->account  = $inputs['account'];
            $movement->account_id  = $inputs['account_id'];
            $movement->trans_type     = 'direct_movement';
            $movement->pay_type = 'cash';
            $movement->date     = $this->strToTime($inputs['date']);
            $movement->notes    = $inputs['notes'];

            $movement->user_id  = Auth::id();

            if($inputs['price_type'] == 'credit'){

                $movement->credit   =  $inputs['price'] ;

            }elseif($inputs['price_type'] == 'debit') {
                $movement->debit =  $inputs['price'];
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

            $data['title'] = 'تعديل حركة مباشرة';
            $data['company']       = CoData::find(Auth::user()->co_id);
            $data['rowsData']      = AccountTrans::company()->where('type', 'direct_movement')->get();
            $data['account_type']  = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'));

//        var_dump($data['rowsData']); die();
            return View::make('dashboard.accounts.treasury_account.index', $data);
        }else{
            return 'not found this movement';
        }
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
            $movement->trans_type    = 'direct_movement';
            $movement->pay_type      = 'cash';
            $movement->date          = $this->strToTime($inputs['date']);
            $movement->notes         = $inputs['notes'];
            $movement->user_id       = Auth::id();

            if($inputs['price_type'] == 'credit'){

                $movement->credit   =  $inputs['price'] ;
                $movement->debit    = 0;

            }elseif($inputs['price_type'] == 'debit') {

                $movement->debit =  $inputs['price'];
                $movement->credit= 0;
            }

            $movement->update();
            Session::flash('success','تم التعديل بنجاح');
            return Redirect::route('addDirectMovement');

        }
    }



    public  function searchAccounts($type){


        $types = array('customers','suppliers','bank','partners');

        if(in_array($type,$types)){

            $data['co_info']   = CoData::thisCompany()->first();
            $data['title']     = Lang::get('main.accounts_'.$type);
            $data['accounts']  = Accounts::company()->where('acc_type',$type)->get();
            $data['type']      = $type;

            if(empty($data['accounts'])){
                $data['accounts_empty'] = 'yes';
            }else{
                $data['select_account'] ='أختر '. Lang::get('main.'.$type);
                $data['accounts_empty'] = 'no';
            }

            return View::make('dashboard.accounts.accounts_search.accounts_search',$data);

        }else{
            return 'type check error';
        }

    }

    public function resultAccounts(){

        $inputs = Input::all();

        $validation = Validator::make($inputs,Accounts::$ruels_result_account,BaseController::$messages);

        if($validation->fails()) {
            return Redirect::to('resultAccounts')->withInput()->withErrors($validation->messages());
        }else{


            $date_from   = $this->strToTime($inputs['date_from']);
            $date_to     = $this->strToTime($inputs['date_to']);
            $account_id  = $inputs['account_id'];
            $type        = $inputs['type'];

            $data['account_trans'] = AccountTrans::company()->dateBetween('date',$date_from,$date_to)->where('account_id',$account_id)->get();
            $data['name']          = Accounts::find($account_id)->acc_name;
            $data['date_from']     = $date_from;
            $data['date_to']       = $date_to;
            $data['type']          = $type;
            $data['account']       = $type;
            $data['account_id']    = $account_id;
            // data for search

            $types = array('customers','suppliers','bank','partners');
            if(in_array($type,$types)){

                $data['co_info']   = CoData::thisCompany()->first();
                $data['title']     = Lang::get('main.accounts_'.$type);
                $data['accounts']  = Accounts::company()->where('acc_type',$type)->get();

                if(empty($data['accounts'])){
                    $data['accounts_empty'] = 'yes';
                }else{
                    $data['select_account'] ='أختر '. Lang::get('main.'.$type);
                    $data['accounts_empty'] = 'no';
                }

                return View::make('dashboard.accounts.accounts_search.accounts_result',$data);

            }else{
                return 'type check error';
            }


        }

    }

    public function addNewDirectMovement()
    {
        // this function add new direct movement from general accounts pages
        $inputs = Input::all();

        $ruels  = Accounts::$ruels_direct_movement;

        $validation = Validator::make($inputs, $ruels, BaseController::$messages);

        if ($validation->fails()) {

            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            $movement = new AccountTrans;
            $movement->co_id = Auth::user()->co_id;
            $movement->account = $inputs['account'];
            $movement->account_id = $inputs['account_id'];
            $movement->trans_type = 'direct_movement';
            $movement->pay_type = 'cash';
            $movement->date = $this->strToTime($inputs['date']);
            $movement->notes = $inputs['notes'];

            $movement->user_id = Auth::id();

            if ($inputs['price_type'] == 'credit') {

                $movement->credit = $inputs['price'];

            } elseif ($inputs['price_type'] == 'debit') {
                $movement->debit = $inputs['price'];
            }

            $movement->save();

            if($movement->save()){



                $date_from   = $this->strToTime($inputs['date_from']);
                $date_to     = $this->strToTime($inputs['date_to']);
                $account_id  = $inputs['account_id'];
                $type        = $inputs['account'];

                return Redirect::route('resultSearchAccounts',array('type'=>$type,'account_id'=>$account_id,'date_from'=>$date_from,'date_to'=>$date_to));
            }// end if movement
        }
    }
        public function resultSearchAccounts (){

            // this function redirect back to general accounts after store new direct movement
            $type        =Input::get('type');
            $account_id  =Input::get('account_id');
            $date_from   =Input::get('date_from');
            $date_to     =Input::get('date_to');

            $data['account_trans'] = AccountTrans::company()->dateBetween('date',$date_from,$date_to)->where('account_id',$account_id)->get();
            $data['name']          = Accounts::find($account_id)->acc_name;
            $data['date_from']     = $date_from;
            $data['date_to']       = $date_to;
            $data['type']          = $type;
            $data['account']       = $type;
            $data['account_id']    = $account_id;
            // data for search

            $types = array('customers','suppliers','bank','partners');

            if(in_array($type,$types)){

                $data['co_info']   = CoData::thisCompany()->first();
                $data['title']     = Lang::get('main.accounts_'.$type);
                $data['accounts']  = Accounts::company()->where('acc_type',$type)->get();


                if(empty($data['accounts'])){
                    $data['accounts_empty'] = 'yes';
                }else{
                    $data['select_account'] ='أختر '. Lang::get('main.'.$type);
                    $data['accounts_empty'] = 'no';
                }

                return View::make('dashboard.accounts.accounts_search.accounts_result',$data);

            }else{
                return 'type check error';
            }



        }

}

