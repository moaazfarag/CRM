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
            $store_rules['branch_id'] = 'required|integer';
            $count = TransDetails::countOfInputs($inputs);

            foreach($count as $k => $v)
            {
                $store_rules['cost_'.$k] = 'required|integer';
                $store_rules['quantity_'.$k] = 'required|integer';
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
