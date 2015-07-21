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
    );
    public function co_data()
    {
        return $this->belongsTo('Co_data','co_id');
    }

    public function cat()
    {
        return $this->belongsTo('Cat','cat_id','id');
    }

    public function seasons()
    {
        return $this->belongsTo('Seasons','seasons_id','id');
    }


    public function models()
    {
        return $this->belongsTo('Models','models_id');
    }
    public function accounts()
    {
        return $this->belongsTo('Accounts','supplier_id');
    }

}