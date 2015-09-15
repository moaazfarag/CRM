<?php


class TransHeader extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    
	protected $table = 'trans_header';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */


    /**
     * Store Rules
     * @var array
     */
    public static  $store_rules = array
                (
                    'discount'       => 'integer',
                    'tax'            => 'integer'
                );
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

    public function branch()
    {
        return $this->hasOne('Branches','id','br_code');

    }
    public function details()
    {
        return $this->hasMany('TransDetails','trans_header_id','id')
            ->join('items','items.id','=','trans_details.item_id')
            ->select('trans_details.*','items.item_name')
            ->whereIn('invoice_type',['sales','settleAdd']);
    }
    public function accountInfo(){

        return $this->hasOne('Accounts','id','account')
            ->company()
            ->whereIn('acc_type',['customers','suppliers','partners']);
    }
    public static function test(){

    }
    public static function  itemBalance(){

        $add ="(sales".','."settleAdd)";
        $discount ="(buy".','."settleDiscount)";
//dd($add);
         $addQ =  DB::table('trans_header')
            ->whereRaw("`invoice_type` IN ( 'sales', 'settleAdd' )")
            ->join('trans_details','trans_details.trans_header_id','=','trans_header.id')
            ->join('items','items.id','=','trans_details.item_id')
            ->select(DB::raw('SUM(qty) as exitItemBal') ,'trans_details.item_id','items.*')
             ->groupBy('trans_details.item_id')
         ;
        $discountQ =  self::whereRaw("`invoice_type` IN ( 'settlediscount', 'buy' )")
            ->join('trans_details','trans_details.trans_header_id','=','trans_header.id')
            ->join('items','items.id','=','trans_details.item_id')
            ->union($addQ)
            ->select(DB::raw('SUM(qty)*-1 as unExitItemBal') ,'trans_details.item_id','items.*')
            ->groupBy('trans_details.item_id');
        return   (DB::statement('CREATE OR REPLACE VIEW items_balance AS'.$discountQ->toSql())).'<br>' .dd(DB::getQueryLog());
    }

}
