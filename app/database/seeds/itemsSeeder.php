
<?php

class itemsSeeder extends Seeder {


	public function run()
	{
		
		DB::table('items')->truncate();
		DB::table('items')->insert(array(

array(
			'true_id'  => '1',
	    	'co_id'           =>'1',
	    	'cat_id'        =>'1',
	    	'item_name'       =>'بنطلون مقاس 32',
	    	'unit'            =>'قطعة',
	    	'supplier_id'        =>'مصنع ملابس',
	    	'seasons_id'          =>'فصل الشتاء',
	    	'models_id'           =>'بنطلون',
	    	'bar_code'        =>'no',
	    	'buy'             =>'90.20',
	    	'sell_users'      =>'125.35',
	    	'sell_nos_gomla'  =>'110.33',
	    	'sell_gomla'      =>'105.22',
	    	'sell_gomla_gomla'=>'100.78',
	    	'limit'           =>'4',
	    	'notes'           =>'بنطلون باجى ازرق اللون مقاس 37 ',
	    	'user_id'         =>'1',
	    ),
			array(
				'true_id'  => '2',
				'co_id'           =>'1',
				'cat_id'        =>'1',
				'item_name'       =>'تيشيرت اديداس مقاس 32',
				'unit'            =>'قطعة',
				'supplier_id'        =>'مصنع ملابس',
				'seasons_id'          =>'فصل الشتاء',
				'models_id'           =>'بنطلون',
				'bar_code'        =>'no',
				'buy'             =>'90.20',
				'sell_users'      =>'125.35',
				'sell_nos_gomla'  =>'12.33',
				'sell_gomla'      =>'105.22',
				'sell_gomla_gomla'=>'100.78',
				'limit'           =>'4',
				'notes'           =>'تيشرت ',
				'user_id'         =>'1',
			),
	    array(
			'true_id'  => '1',
	    	'co_id'           =>'2',
	    	'cat_id'          =>'2',
	    	'item_name'       =>'سيارة موديل 2012 ',
	    	'unit'            =>'سيارة',
	    	'supplier_id'        =>'متولى',
	    	'seasons_id'          =>'فصل الصيف',
	    	'models_id'           =>'x5',
	    	'bar_code'        =>'no',
	    	'buy'             =>'50000.20',
	    	'sell_users'      =>'75000.35',
	    	'sell_nos_gomla'  =>'70000.33',
	    	'sell_gomla'      =>'65000.222',
	    	'sell_gomla_gomla'=>'60000.78',
	    	'limit'           =>'5',
	    	'notes'           =>'السيارة 2500 cc حمراء اللون ',
	    	'user_id'         =>'2',
	    ), array(
			'true_id'  => '1',
	    	'co_id'           =>'3',
	    	'cat_id'          =>'3',
	    	'item_name'       =>'مكرونة الملكة اكيلو جرام ',
	    	'unit'            =>'كيس',
	    	'supplier_id'        =>'أولاد رجب',
	    	'seasons_id'      =>'طوال العام',
	    	'models_id'       =>'الملكة',
	    	'bar_code'        =>'555542',
	    	'buy'             =>'1.20',
	    	'sell_users'      =>'2.35',
	    	'sell_nos_gomla'  =>'0',
	    	'sell_gomla'      =>'2.20',
	    	'sell_gomla_gomla'=>'0',
	    	'limit'           =>'20',
	    	'notes'           =>'لا تعليق',
	    	'user_id'         =>'3',
	    ),




		));

	} // end function run

} // end class 
