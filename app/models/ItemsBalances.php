<?php


class ItemsBalances extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'items_balances';

	/**
	 * Store Rules
	 * @var array
	 */

    public function items()
    {
        return $this->hasOne('Items','id','item_id');
    }

//    public function getItemName(){
//
//        $item_name = Markes::where('id','=',$this->item_id)->first();
//        if(!empty($item_name))
//            return $item_name->name;
//        else
//            return "no name ";
//    }

    public static function rulesCreator($inputs)
    {
        $count = TransDetails::countOfInputs($inputs);
        $store_rules = array();
        $store_rules['br_id'] = 'required|exists:branches,id,co_id,'.Auth::user()->co_id;
        $date     = new dateTime;
        $tomorrowDate  = $date->modify('+2 day')->format('Y-m-d');
        $yesterdayDate = $date->modify('-3 day')->format('Y-m-d');
        $store_rules['date'] = 'required|date|before:'.$tomorrowDate.'|after:'.$yesterdayDate;
        foreach($count as $k => $v)
        {
            $store_rules['id_'.$k] = 'required|exists:items,id,co_id,'.Auth::user()->co_id;
            $item = Items::getSerialItemsWithBalanceByBrId($store_rules['br_id'],$inputs['id_'.$k]);
            $serial  = self::hasSarial($v);
            $serials = implode(",",array_pluck($item,'serial_no'));
            if($serial){
                $store_rules['serial_'.$k] = 'required|not_in:'.$serials;
                $store_rules['quantity_'.$k] = 'required|integer|min:1|max:1';
            }else{
                $store_rules['quantity_'.$k] = 'required|integer|min:1';
            }
                $store_rules['cost_'.$k]     = 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/';
        }

        return $store_rules;
    }
    /**
     * @param $v
     * @return mixed
     */
    private static function hasSarial($v)
    {
        return Items::find($v)->has_serial;
    }
    /**
	 * update Rules
	 * @var array
	 */
    public static  $update_rules = array(

                                'item_id'          => 'required|integer',
                                'bar_code'         => 'min:3',
                                'qty'              => 'required|integer|min:1',
                                'cost'             => 'integer',
                                'serial_no'        => 'string'

                                        );

}
