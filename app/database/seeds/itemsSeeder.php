
<?php

class itemsSeeder extends Seeder {


	public function run()
	{
		
		DB::table('items')->truncate();
		DB::table('items')->insert(array(

array(
			'true_id' 		 => '1',
	    	'co_id'           =>'1',
	    	'cat_id'       		 =>'1',
	    	'item_name'       =>' بنطلون جينز ',
	    	'unit'            =>'قطعة',
	    	'supplier_id'        =>'مصنع ملابس',
	    	'seasons_id'          =>'فصل الشتاء',
	    	'models_id'           =>'بنطلون',
	    	'bar_code'        =>'no',
	    	'buy'             =>'50',
	    	'sell_users'      =>'80',
	    	'sell_nos_gomla'  =>'75',
	    	'sell_gomla'      =>'68',
	    	'sell_gomla_gomla'=>'60',
	    	'limit'           =>'10',
			'has_serial'      =>'1',
	    	'notes'           =>'بنطلون جينز اسود مقاس 38',
	    	'user_id'         =>'1',
	    ),
			array(
				'true_id'  => '2',
				'co_id'           =>'1',
				'cat_id'        =>'4',
				'item_name'       =>'تيشرت اديداس',
				'unit'            =>'قطعة',
				'supplier_id'        =>'مصنع ملابس',
				'seasons_id'          =>'فصل الشتاء',
				'models_id'           =>'بنطلون',
				'bar_code'        =>'no',
				'buy'             =>'90',
				'sell_users'      =>'125',
				'sell_nos_gomla'  =>'12',
				'sell_gomla'      =>'105',
				'sell_gomla_gomla'=>'100',
				'limit'           =>'4',
				'has_serial'      =>'0',
				'notes'           =>'تيشرت اديداس كحلى مقاس 22 ',
				'user_id'         =>'1',
			),

			array(
				'true_id'  => '3',
				'co_id'           =>'1',
				'cat_id'        =>'5',
				'item_name'       =>'جاكيت كحلى',
				'unit'            =>'قطعة',
				'supplier_id'        =>'مصنع ملابس',
				'seasons_id'          =>'فصل الشتاء',
				'models_id'           =>'بنطلون',
				'bar_code'        =>'no',
				'buy'             =>'200',
				'sell_users'      =>'250',
				'sell_nos_gomla'  =>'240',
				'sell_gomla'      =>'230',
				'sell_gomla_gomla'=>'220',
				'limit'           =>'4',
				'has_serial'      =>'0',
				'notes'           =>'جاكت كحلى مقاس 12  ',
				'user_id'         =>'1',
			),


	 array(
			'true_id'  => '5',
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
			'has_serial'      =>'0',
	    	'notes'           =>'لا تعليق',
	    	'user_id'         =>'3',
	    ),




		));

	} // end function run

} // end class 
