<?php 

class accountsSeeder extends Seeder {


	public function run()
	{
		
		DB::table('accounts')->truncate();
		DB::table('accounts')->insert(array(

	    
	     array(

	    	'co_id'         =>'1',
	    	'acc_type'      =>'customers', // العملاء
	    	'acc_name'      =>'فلان الفلانى ',
	    	'acc_address'   =>'55 شارع معروف خلف دار القضاء العالى',
	    	'acc_tel'       =>'002555888777',
	    	'acc_mobile_1'  =>'012457996666',
	    	'acc_mobile_2'  =>'012584796366',
	    	'acc_email'     =>'folan@yahoo.com',
	    	'acc_limit'     =>'5000',
	    	'user_id'       =>'1',
	    ),

	    array(

	    	'co_id'        =>'1',
	    	'acc_type'     =>'suppliers', // الموردين
	    	'acc_name'     =>'مصنع ملابس',
	    	'acc_address'  =>'هليوبلس مصر الجديدة ',
	    	'acc_tel'      =>'002558877',
	    	'acc_mobile_1' =>'0159753852',
	    	'acc_mobile_2' =>'0159753853',
	    	'acc_email'    =>'fashion@addidas.com',
	    	'acc_limit'    =>'50000',
	    	'user_id'      =>'1',
	    
	    ),    array(

	    	'co_id'        =>'2',
	    	'acc_type'     =>'suppliers', // الموردين
	    	'acc_name'     =>'متولى',
	    	'acc_address'  =>'التوفيقية شارع سليمان الحلبى ',
	    	'acc_tel'      =>'0025583377',
	    	'acc_mobile_1' =>'01593333332',
	    	'acc_mobile_2' =>'01597333333',
	    	'acc_email'    =>'car@bmw.com',
	    	'acc_limit'    =>'50000',
	    	'user_id'      =>'2',
	    ),
 			
 			array(

	    	'co_id'        =>'3',
	    	'acc_type'     =>'suppliers', // الموردين
	    	'acc_name'     =>'أولاد رجب',
	    	'acc_address'  =>'مدينة نصر السراج مول الدور الثانى',
	    	'acc_tel'      =>'002511111',
	    	'acc_mobile_1' =>'01111111222',
	    	'acc_mobile_2' =>'01111111112',
	    	'acc_email'    =>'awlad_ragab_el-serag_moal@ragab_market.com',
	    	'acc_limit'    =>'50000',
	    	'user_id'      =>'3',
	    ),

	    array(

	    	'co_id'       =>'1',
	    	'acc_type'    =>'bank', //البنك 
	    	'acc_num'     =>'159753852',
	    	'acc_name'    =>'Alex Bank',
	    	'acc_address' =>'55 شارع طلعت حرب ',
	    	'acc_tel'     =>'00258963',
	    	'acc_mobile_1'=>'018963259',
	    	'acc_mobile_2'=>'018963258',
	    	'acc_email'   =>'customer_services@alex_bank.com',
	    	'user_id'     =>'1',
	    ),

 array(

	    	'co_id'       =>'2',
	    	'acc_type'    =>'bank', //البنك 
	    	'acc_num'     =>'159753852',
	    	'acc_name'    =>'Centeral bank egypt',
	    	'acc_address' =>'55 شارع عباس العقاد ',
	    	'acc_tel'     =>'00258963',
	    	'acc_mobile_1'=>'018963259',
	    	'acc_mobile_2'=>'018963258',
	    	'acc_email'   =>'customer_services@centeral_bank_egypt.com',
	    	'user_id'     =>'2',
	    ),
  array(

	    	'co_id'       =>'3',
	    	'acc_type'    =>'bank', //البنك 
	    	'acc_num'     =>'159753852',
	    	'acc_name'    =>'Cairo Bank',
	    	'acc_address' =>'55 شارع محمد فريد  ',
	    	'acc_tel'     =>'00258963',
	    	'acc_mobile_1'=>'018963259',
	    	'acc_mobile_2'=>'018963258',
	    	'acc_email'   =>'customer_services@cairo_bank.com',
	    	'user_id'     =>'3',
	    ),
	    array(

	    	'co_id'=>'1',
	    	'acc_type'=>'expenses', // المصروفات
	    	'acc_name'=>'',
	    	'acc_address'=>'',
	    	'acc_tel'=>'',
	    	'acc_mobile_1'=>'',
	    	'acc_mobile_2'=>'',
	    	'acc_email'=>'',
	    	'acc_limit'=>'',
	    	'user_id'=>'',
	    ),

	    array(

	    	'co_id'=>'',
	    	'acc_type'=>'multiple_revenue', // الايرادات المتنوعة 
	    	'acc_name'=>'',
	    	'acc_address'=>'',
	    	'acc_tel'=>'',
	    	'acc_mobile_1'=>'',
	    	'acc_mobile_2'=>'',
	    	'acc_email'=>'',
	    	'acc_limit'=>'',
	    	'user_id'=>'',
	    ),

	    array(

	    	'co_id'=>'',
	    	'acc_type'=>'partners', // جارى الشركاء
	    	'acc_name'=>'',
	    	'acc_address'=>'',
	    	'acc_tel'=>'',
	    	'acc_mobile_1'=>'',
	    	'acc_mobile_2'=>'',
	    	'acc_email'=>'',
	    	'acc_limit'=>'',
	    	'user_id'=>'',
	    ),

	  

		));

	} // end function run

} // end class 
