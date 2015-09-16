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
        return $this->hasMany('Items','item_id');
    }
    public static function rulesCreator($inputs)
    {
        $count = TransDetails::countOfInputs($inputs);
        $store_rules = array();
        foreach($count as $k => $v)
        {
            $sarial = self::hasSarial($v);
            if($sarial){
                $store_rules['serial_'.$k] = 'required';
            }
            $store_rules['cost_'.$k] = 'required|integer';
            $store_rules['quantity_'.$k] = 'required|integer';
            $store_rules['id_'.$k] = 'required|integer';
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
