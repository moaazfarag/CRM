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
            $store_rules['date'] = 'required|date';
//            $store_rules['br_id'] = 'required|integer';
            $count = TransDetails::countOfInputs($inputs);

            foreach($count as $k => $v)
            {
                $sarial = self::hasSarial($v);
                if($sarial){
                    $store_rules['serial_'.$k] = 'required';
                }
                $store_rules['quantity_'.$k] = 'required|integer';
                $store_rules['id_'.$k] = 'required|integer';
            }
//                dd($store_rules);
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
            return Items::company()->find($v)->has_serial;
        }else{
            return false;
        }

    }

    /**
     * Store Rules
     * @var array
     */
//    public static  $store_rules = array
//                (
//                    'debit'          => 'integer',
//                    'credit'         => 'integer'
//                );
//
//    /**
//     * update Rules
//     * @var array
//     */
//    public static  $update_rules = array
//                (
//                    'debit'          => 'integer',
//                    'credit'         => 'integer'
//                );


}
