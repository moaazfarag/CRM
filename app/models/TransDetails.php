<?php


class TransDetails extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    
	protected $table = 'trans_details';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
        public static function rulesCreator($inputs)
        {
//            dd($inputs);
            $type     = $inputs['type'];
            $br_id    = $inputs['br_id'];

            $discount = ['sales','buyReturn',"settleDown"];
            $add      = ['buy','salesReturn',"settleAdd"];
            $settles  = ["settleAdd","settleDown"];

            $date     = new dateTime;
            $tomorrowDate  = $date->modify('+2 day')->format('Y-m-d');
            $yesterdayDate = $date->modify('-3 day')->format('Y-m-d');
//dd($yesterdayDate);
            $store_rules['date'] = 'required|date|before:'.$tomorrowDate.'|after:'.$yesterdayDate;
            if(!in_array($type,$settles)){

                if(isset($inputs['pay_type'])&&$inputs['pay_type']=="on_account"){
                    $store_rules['account_id'] = 'required|integer|exists:accounts,id,co_id,'.Auth::user()->co_id;
                }
                $store_rules['pay_type'] = 'required|in:cash,visa,on_account';
            }
            $count = TransDetails::countOfInputs($inputs);
            foreach($count as $k => $v)
            {
                $store_rules['id_'.$k] = 'required|exists:items,id,co_id,'.Auth::user()->co_id;
                $item = Items::getSerialItemsWithBalanceByBrId($br_id,$inputs['id_'.$k]);
                $serials = implode(",",array_pluck($item,'serial_no'));
                
                $serial  = self::hasSarial($v);
                if($serial){
                    if(in_array($type,$add)){
                        $store_rules['serial_'.$k] = 'required|not_in:'.$serials;
                    }elseif(in_array($type,$discount)){
                        $store_rules['serial_'.$k] = 'required|in:'.$serials;
                    }
                }
//                dd(in_array($type,$discount));
//                dd($item[0]->balance);
                if(in_array($type,$discount)){
                    $store_rules['quantity_'.$k] = 'required|integer|min:1|max:'.(($item)?$item[0]->balance:0);
                }else{
                    $store_rules['quantity_'.$k] = 'required|integer|min:1';
                }

                if( in_array($type,$add) && @$inputs['cost_'.$k] > 0 ){
                    $store_rules['cost_'.$k]     = 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/';
                    }
            }
//            dd($store_rules);
            return $store_rules;
        }
    public static function ReturnRulesCreator($inputs)
        {
            $store_rules['date'] = 'required|date';
            $store_rules['pay_type'] = 'required|in:cash,visa,on_account';
            if($inputs['pay_type']=="on_account"){
                $store_rules['account_id'] = 'required|integer';
            }
            $count = TransDetails::countOfInputs($inputs);
            dd($inputs);
            foreach($count as $k => $v)
            {
                $sarial = self::hasSarial($v);
                if($sarial){
                    $store_rules['serial_'.$k] = 'required|in:'.Items::getSerialItemsWithBalanceByBrId();
                }
                $store_rules['return_'.$k] = 'required|integer';
                $store_rules['id_'.$k] = 'required|integer';
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
     * @param $v
     * @return mixed
     */
    private static function hasSarial($v)
    {
        $item = Items::company()->find($v);
        if($item){
            return $item->has_serial;
        }else{
            return false;
        }

    }

    /**
     * Store Rules
     * @var array
     */


}
