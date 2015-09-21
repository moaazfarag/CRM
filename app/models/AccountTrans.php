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
            if(($type == "sales" || $type == "buy_back") && ($inputs['pay_type'] == "cash" || $inputs['pay_type'] == "visa") ){
                $newAccountTrans->credit = $net ;
            }elseif(($type == "buy" || $type == "sales_back") &&  ($inputs['pay_type'] == "cash" || $inputs['pay_type'] == "visa")  ){
                $newAccountTrans->debit = $net ;
            }elseif(($type == "sales" || $type == "buy_back") && $inputs['pay_type'] == "on_account" ){
                $newAccountTrans->debit = $net ;
            }elseif(($type == "buy" || $type == "sales_back") && $inputs['pay_type'] == "on_account" ){
                $newAccountTrans->credit = $net ;
            }else{
                return "undefind type";
            }
            $newAccountTrans->save() ;
        }

    }

}
