<?php


class Items extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'items';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public static  $store_rules = array(
        'cat_id'           => 'required|integer',
        'item_name'        => 'required|min:3',
        'unit'             => 'required|in:piece,kilo,ton,galon,meter',
        'supplier_id'      => '',
        'seasons_id'       => '',
        'models_id'        => '',
        'bar_code'         => 'min:3',
        'buy'              => 'regex:/^\d*(\.\d{2})?$/',
        'sell_users'       => 'regex:/^\d*(\.\d{2})?$/',
        'sell_nos_gomla'   => 'regex:/^\d*(\.\d{2})?$/',
        'sell_gomla'       => 'regex:/^\d*(\.\d{2})?$/',
        'sell_gomla_gomla' => 'regex:/^\d*(\.\d{2})?$/',
        'limit'            => 'integer',
        'has_serial'       =>  'boolean',
        'has_label'        =>  'boolean'
    );
    public static  $update_rules = array(
        'cat_id'           => 'required|integer',
        'item_name'        => 'required|min:3',
        'unit'             => 'required|in:piece,kilo,ton,galon,meter',
        'supplier_id'      => 'boolean',
        'seasons_id'       => 'boolean',
        'models_id'        => 'boolean',
        'bar_code'         => 'min:3',
        'buy'              => 'regex:/^\d*(\.\d{2})?$/',
        'sell_users'       => 'regex:/^\d*(\.\d{2})?$/',
        'sell_nos_gomla'   => 'regex:/^\d*(\.\d{2})?$/',
        'sell_gomla'       => 'regex:/^\d*(\.\d{2})?$/',
        'sell_gomla_gomla' => 'regex:/^\d*(\.\d{2})?$/',
        'limit'            => 'integer',
        'has_serial'       =>'boolean',
        'has_label'        =>'boolean'

    );
    public function co_data()
    {
        return $this->belongsTo('Co_data','co_id');
    }

    public function cat()
    {
        return $this->belongsTo('Category','cat_id','id');
    }

    public function seasons()
    {
        return $this->belongsTo('Seasons','seasons_id','id');
    }
    public static function round_up($value, $places)
    {
        $mult = pow(10, abs($places));
        return $places < 0 ?
            ceil($value / $mult) * $mult :
            ceil($value * $mult) / $mult;
    }
    public function cost()
    {
        $header_id = TransHeader::company()->whereIn('invoice_type',['buy','itemBalance',])->lists('id');
        $details   = TransDetails::company()
            ->where('item_id',$this->id)
            ->whereIn('trans_header_id',$header_id)
            ->select( DB::raw('sum(qty) as total_qty'),DB::raw('sum(item_total) as total_item') )
            ->first();
        if(count($details) && $details->total_item != 0 && $details->total_qty != 0){

            $cost = $this->round_up($details->total_item / $details->total_qty,2);
        }else{
            $cost = 0;
        }

        return $cost;
    }
    public function models()
    {
        return $this->belongsTo('Models','models_id');
    }


    public function marks()
    {
        return $this->belongsTo('Markes','marks_id');
    }

    public function accounts()
    {
        return $this->belongsTo('Accounts','supplier_id');
    }
    public function offer()
    {
        return $this->belongsTo('Offer','offer_id');
    }

    public static function getItemsWithBalanceByBrId($brId)
    {
        $itemsTrans =  DB::table('items_balance')
                            ->company()->where('trans_deleted', 0)
                            ->groupBy('br_id')
                            ->groupBy('item_id')
                            ->where('br_id',$brId)
                            ->select(DB::raw('SUM(item_bal) AS balance') ,'items_balance.*');
        $items      = Items::where("items.co_id",'=',Auth::user()->co_id)->select('items.*','cat.name AS cat_name')->join('cat','cat.id','=','items.cat_id')->where('deleted', 0)->whereNotIn('items.id',$itemsTrans->lists('item_id'))->get();
        return array_merge($itemsTrans->get(),$items->toArray());
    }

    /**
     * get item balance on whole company
     * @param $itemId
     * @return mixed
     */
  public static function getItem($itemId)
    {
        $item =  DB::table('items_balance')
                            ->company()->where('trans_deleted', 0)
                            ->groupBy('br_id')
                            ->groupBy('item_id')
                            ->where('item_id',$itemId)
                            ->select(DB::raw('SUM(item_bal) AS balance') ,'items_balance.*')
                            ->first();
        return $item;
    }
    /**
     * get item balance base on item id and br_id
     * @param $itemId
     * @param $brId
     * @param $serialNo
     * @return mixed
     */
  public static function getItemByBrId($itemId,$serialNo = null ,$brId)
    {
        $item =  DB::table('items_balance')
                            ->company()->where('trans_deleted', 0)
                            ->groupBy('br_id')
                            ->groupBy('serial_no')
                            ->groupBy('item_id')
                            ->where('item_id',$itemId)
                            ->where('serial_no',$serialNo)
                            ->where('br_id',$brId)
                            ->select(DB::raw('SUM(item_bal) AS balance') ,'items_balance.*')
                            ->first();
        return $item;
    }

    public static function getSerialItemsWithBalanceByBrId($brId,$itemId,$serial_no= null)
    {

        $itemsTrans =  DB::table('items_balance')
            ->whereRaw('co_id ='.Auth::user()->co_id)
            ->whereRaw('br_id ='.$brId)
            ->whereRaw('item_id ='.$itemId)
            ->whereRaw('deleted = 0')
            ->select(DB::raw('SUM(item_bal) AS balance'),'items_balance.*')
            ->groupBy('br_id')
            ->groupBy('item_id')
            ->groupBy('serial_no')
            ->toSql();
        if($serial_no){
            $SerialItem=  DB::select("SELECT  items_balance.* FROM (" . $itemsTrans.")AS items_balance  WHERE `balance`= 1 AND `serial_no`='".$serial_no."'");
            return $SerialItem;
        }else{
            $SerialItem=  DB::select('SELECT   items_balance.* FROM (' . $itemsTrans.')AS items_balance WHERE `balance`>0');
            return $SerialItem  ;
        }
    }



}
