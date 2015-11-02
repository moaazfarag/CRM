<?php


class AccountsBalances extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    
	protected $table = 'accounts_balances';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public static function rulesCreator($inputs)
    {
        $count = AccountsBalances::countOfInputs($inputs);
        $store_rules = array(
            'id_0' => 'required|integer',
             self::defaultRule() => 'required|integer',
        );
        foreach($count as $k => $v)
        {
            $store_rules['id_'.$k]     = 'required|integer';
            if($inputs['credit_'.$k] > 0 && $inputs['debit_'.$k] <=  0)
            {
                $store_rules['credit_'.$k] = 'required|integer';
            }elseif($inputs['debit_'.$k] > 0 && $inputs['credit_'.$k] <= 0 )
            {
                $store_rules['debit_'.$k] = 'required|integer';
            }
        }
        return $store_rules;
    }

    /**
     * count of cost  input for using in foreach
     * @param $inputs
     * @return array
     */
    public static function countOfInputs($inputs)
    {
        $count = array();
        foreach($inputs as $k => $v)
        {
            if(preg_match('/^id_/', $k))
            {
                $count[] = $v ;
                if($v<=0){
                    break;
                }
            }
        }
        return $count;
    }

    /**
     * @return string
     */
    public static function defaultRule(){
        if (Input::has('debit_0')) {
            return 'debit_0';
        } else {
            return 'credit_0';
        }
    }

    public function ofAccount(){
      return  $this->hasOne('Accounts','id','account_id');
    }
    public function user(){
      return  $this->hasOne('User','id','user_id');
    }



}
