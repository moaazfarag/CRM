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
    public function transDitails(){

        return $this->hasOne('TransDetails','trans_header_id','id');
    }
    public static  $store_rules = array
                (
                    'discount'       => 'integer',
                    'tax'            => 'integer',
                );


    public static $report_ruels_saels = array(

        'date_from'    =>'required',
        'date_to'      =>'required',
        'invoice_type' =>'required',

    );
    public static $report_ruels_saels_with_account = array(

        'date_from'    =>'required',
        'date_to'      =>'required',
        'invoice_type' =>'required',
        'account_id'   =>'not_in:? undefined:undefined ?',

    );



    public function branch()
    {
        return $this->hasOne('Branches','id','br_id');

    }


    public static $delete_ruels = array(

        'invoice_no'  => 'required|numeric',
        'cancel_cause'=>'required',
    );

    public static $settle_report_ruels = array(

        'date_from'    =>'required',
        'date_to'      =>'required',
        'invoice_type' =>'required',
    );

    public function details()
    {
        return $this->hasMany('TransDetails','trans_header_id','id')
            ->join('items','items.id','=','trans_details.item_id')
            ->select('trans_details.*','items.item_name','items.cat_id','items.id','items.buy');
//            ->whereIn('invoice_type',['sales','settleAdd']);
    }
    public function accountInfo(){

        return $this->hasOne('Accounts','id','account')
            ->company()
            ->whereIn('acc_type',['customers','suppliers','partners']);
    }
    public static function test(){

    }


}
