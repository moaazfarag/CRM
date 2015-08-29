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
            $data['pricing'] = $this->pricing;
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
            if($this->checkType($accountType)) {
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
            }else{
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


}

