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
        $data['branch']     = $this->isAllBranch();
        $data['account_type']  = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'));
        $data['rowsData']   = AccountTrans::company()->where('type','direct_movement')->get();
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
            $movement->br_id    = @$inputs['br_id'];
            $movement->account  = $inputs['account'];
            $movement->type     = 'direct_movement';
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
            $data['company'] = CoData::find(Auth::user()->co_id);
            $data['branch'] = $this->isAllBranch();
            $data['rowsData'] = AccountTrans::company()->where('type', 'direct_movement')->get();
            $data['account_type']  = array('customers'=>Lang::get('main.customers_'),'suppliers'=>Lang::get('main.suppliers_'),'partners'=>Lang::get('main.partners_'));

//        var_dump($data['rowsData']); die();
            return View::make('dashboard.accounts.treasury_account.direct_movement', $data);
        }else{
            return 'not found this movement';
        }
    }


    public function updateDirectMovement($id){

        $inputs = Input::all();
//        var_dump($inputs); die();
        $ruels =  Accounts::$ruels_direct_movement;
        if($this->isHaveBranch() == 1) {
            $ruels["br_id"] = "required";
        }

        $validation = Validator::make($inputs,$ruels,BaseController::$messages);
        if($validation->fails())
        {

            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {


            $movement           =  AccountTrans::company()->where('id',$id)->first();

            $movement->co_id    = Auth::user()->co_id;
            $movement->br_id    = @$inputs['br_id'];
            $movement->account  = $inputs['account'];
            $movement->type     = 'direct_movement';
            $movement->pay_type = 'cash';
            $movement->date     = $this->strToTime($inputs['date']);
            $movement->notes    = $inputs['notes'];
            $movement->user_id  = Auth::id();

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
}

