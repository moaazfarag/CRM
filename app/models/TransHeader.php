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
    public static function getItems($inputs,$tBal)
    {
        $bCtrl = new BaseController;
        $date_from = $bCtrl->strToTime($inputs['date_from']);
        $date_to   = $bCtrl->strToTime($inputs['date_to']);
        $cat_id = (!empty($inputs['cat_id'])) ? $inputs['cat_id'] : "";
        $br_id = (!empty($inputs['br_id'])) ? $inputs['br_id'] : "";
        $item_id = (!empty($inputs['item_id'])) ? $inputs['item_id'] : "";
        $itemsTrans =  DB::table('items_balance')
                        ->select(DB::raw('SUM(item_bal) AS balance') ,'items_balance.*')
                        ->company()
                        ->where('deleted', 0)
                        ->groupBy('invoice_no','br_id','invoice_type','item_id','serial_no')
                        ->orderBy('date');
        if($tBal){
            $itemsTrans->where('date','<',$date_from);
        }else{
            $itemsTrans->dateBetween('date', $date_from, $date_to);
        }
        if ($br_id != '') {
            $itemsTrans->where('br_id', $br_id);
        }if($item_id != '') {
        $itemsTrans->where('item_id', $item_id);
       }if($cat_id != ''){
            $itemsTrans->where('cat_id',$cat_id);
        }
        return $itemsTrans;
    }

}
