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
        'unit'             => 'min:3',
        'supplier_id'      => 'integer',
        'seasons_id'       => 'integer',
        'models_id'        => 'integer',
        'bar_code'         => 'min:3',
        'buy'              => 'regex:/^\d*(\.\d{2})?$/',
        'sell_users'       => 'regex:/^\d*(\.\d{2})?$/',
        'sell_nos_gomla'   => 'regex:/^\d*(\.\d{2})?$/',
        'sell_gomla'       => 'regex:/^\d*(\.\d{2})?$/',
        'sell_gomla_gomla' => 'regex:/^\d*(\.\d{2})?$/',
        'limit'            => 'integer',
        'has_serial'       =>  'boolean'
    );
    public static  $update_rules = array(
        'cat_id'           => 'required|integer',
        'item_name'        => 'required|min:3',
        'unit'             => 'min:3',
        'supplier_id'      => 'integer',
        'seasons_id'       => 'integer',
        'models_id'        => 'integer',
        'bar_code'         => 'min:3',
        'buy'              => 'regex:/^\d*(\.\d{2})?$/',
        'sell_users'       => 'regex:/^\d*(\.\d{2})?$/',
        'sell_nos_gomla'   => 'regex:/^\d*(\.\d{2})?$/',
        'sell_gomla'       => 'regex:/^\d*(\.\d{2})?$/',
        'sell_gomla_gomla' => 'regex:/^\d*(\.\d{2})?$/',
        'limit'            => 'integer',
        'has_serial'       =>'boolean'

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

    public static function getItemsWithBalanceByBrId($brId)
    {
        $itemsTrans =  DB::table('items_balance')
                            ->company()
                            ->groupBy('br_id')
                            ->groupBy('item_id')
                            ->where('br_id',$brId)
                            ->select(DB::raw('SUM(item_bal) AS balance') ,'items_balance.*');
        $items      = Items::company()->whereNotIn('id',$itemsTrans->lists('item_id'))->get();
        return array_merge($itemsTrans->get(),$items->toArray());
    }
    public static function getSerialItemsWithBalanceByBrId($brId,$itemId)
    {
        $itemsTrans =  DB::table('items_balance')
                            ->whereRaw('co_id ='.Auth::user()->co_id)
                            ->whereRaw('br_id ='.$brId)
                            ->whereRaw('item_id ='.$itemId)
                            ->select(DB::raw('SUM(item_bal) AS balance'),'items_balance.*')
                            ->groupBy('br_id')
                            ->groupBy('item_id')
                            ->groupBy('serial_no')->toSql();
          $SerialItem=  DB::select('SELECT  items_balance.* FROM (' . $itemsTrans.')AS items_balance  WHERE `balance`= 1');
        return $SerialItem;
    }



}
