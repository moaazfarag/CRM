<?php


class AccountTrans extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'account_trans';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */



    public function accountName(){

            $account_name = $this->hasOne('Accounts','id','account_id');
        if($account_name){

            return $account_name;
        }
            else {
                return ' ÛíÑ ãÍÏÏ ';
            }
    }

    public  function invoiceNo(){

        return $this->hasOne('TransHeader','id','trans_id');
    }
    public static function saveAccountTrans($inputs,$transHeaderId,$type,$net,$branchId)

    {
        $account = Accounts::company()->find($inputs['account_id']);

        if ($account) {
            $Base = new BaseController;
            $newAccountTrans = new AccountTrans;
            $newAccountTrans->co_id      = $Base->coAuth();
            $newAccountTrans->br_id      = $branchId;
            $newAccountTrans->user_id    = Auth::id();
            $newAccountTrans->account_id = $inputs['account_id'];
            $newAccountTrans->trans_id   = $transHeaderId;
            $newAccountTrans->trans_type = $type;
            $newAccountTrans->date       = $Base->strToTime($inputs['date']);
            $newAccountTrans->pay_type   = $inputs['pay_type'];
            if(($type == "sales" || $type == "buyReturn") && ($inputs['pay_type'] == "cash" || $inputs['pay_type'] == "visa") ){
                $newAccountTrans->credit = $net ;
            }elseif(($type == "buy" || $type == "salesReturn") &&  ($inputs['pay_type'] == "cash" || $inputs['pay_type'] == "visa")  ){
                $newAccountTrans->debit = $net ;
            }elseif(($type == "sales" || $type == "buyReturn") && $inputs['pay_type'] == "on_account" ){
                $newAccountTrans->debit = $net ;
            }elseif(($type == "buy" || $type == "salesReturn") && $inputs['pay_type'] == "on_account" ){
                $newAccountTrans->credit = $net ;
            }else{
                return "undefind type";
            }

            $newAccountTrans->save() ;
        }

    }

}
