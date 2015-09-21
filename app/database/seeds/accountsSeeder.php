<?php 

class accountsSeeder extends Seeder {


	public function run()
	{
		
		DB::table('accounts')->truncate();
		DB::table('accounts')->insert(array(

	    
	     array(

	    	'co_id'         =>'1',
	    	'acc_type'      =>'customers', // العملاء
	    	'acc_name'      =>'أحمد عمر ',
	    	'acc_address'   =>'55 شارع معروف خلف دار القضاء العالى',
	    	'acc_tel'       =>'002555888777',
	    	'acc_commercial_registration'  =>'012457996666',
	    	'acc_tax_card'  =>'012584796366',
	    	'acc_email'     =>'folan@yahoo.com',
	    	'acc_limit'     =>'5000',
	    	'acc_notes'     =>'sdsadsad',
	    	'user_id'       =>'1',
	    ),

            array(

                'co_id'         =>'1',
                'acc_type'      =>'customers', // العملاء
                'acc_name'      =>'سعيد بندارى ',
                'acc_address'   =>'55 شارع معروف خلف دار القضاء العالى',
                'acc_tel'       =>'002555888777',
                'acc_commercial_registration'  =>'012457996666',
                'acc_tax_card'  =>'012584796366',
                'acc_email'     =>'folan@yahoo.com',
                'acc_limit'     =>'5000',
                'acc_notes'     =>'sdsadsad',
                'user_id'       =>'1',
            ),
            array(

                'co_id'         =>'1',
                'acc_type'      =>'suppliers', // العملاء
                'acc_name'      =>'معتصم عبد الجواد',
                'acc_address'   =>'55 شارع معروف خلف دار القضاء العالى',
                'acc_tel'       =>'002555888777',
                'acc_commercial_registration'  =>'012457996666',
                'acc_tax_card'  =>'012584796366',
                'acc_email'     =>'folan@yahoo.com',
                'acc_limit'     =>'5000',
                'acc_notes'     =>'sdsadsad',
                'user_id'       =>'1',
            ),

            array(

                'co_id'         =>'1',
                'acc_type'      =>'suppliers', // العملاء
                'acc_name'      =>'حازم كمال  ',
                'acc_address'   =>'55 شارع معروف خلف دار القضاء العالى',
                'acc_tel'       =>'002555888777',
                'acc_commercial_registration'  =>'012457996666',
                'acc_tax_card'  =>'012584796366',
                'acc_email'     =>'folan@yahoo.com',
                'acc_limit'     =>'5000',
                'acc_notes'     =>'sdsadsad',
                'user_id'       =>'1',
            ),

            array(

                'co_id'         =>'1',
                'acc_type'      =>'bank',
                'acc_name'      =>'البنك المركزى ',
                'acc_address'   =>'',
                'acc_tel'       =>'',
                'acc_commercial_registration'  =>'753951',
                'acc_tax_card'  =>'159753',
                'acc_email'     =>'',
                'acc_limit'     =>'',
                'acc_notes'     =>'sdsadsad',
                'user_id'       =>'1',
            ),

            array(

                'co_id'         =>'1',
                'acc_type'      =>'bank',
                'acc_name'      =>'البنك الأهلى',
                'acc_address'   =>'',
                'acc_tel'       =>'',
                'acc_commercial_registration'  =>'753951',
                'acc_tax_card'  =>'178513',
                'acc_email'     =>'',
                'acc_limit'     =>'',
                'acc_notes'     =>'sdsadsad',
                'user_id'       =>'1',
            ),
            array(

                'co_id'         =>'1',
                'acc_type'      =>'partners', // العملاء
                'acc_name'      =>'أحمد ايهاب ',
                'acc_address'   =>'55 شارع معروف خلف دار القضاء العالى',
                'acc_tel'       =>'002555888777',
                'acc_commercial_registration'  =>'012457996666',
                'acc_tax_card'  =>'012584796366',
                'acc_email'     =>'folan@yahoo.com',
                'acc_limit'     =>'5000',
                'acc_notes'     =>'sdsadsad',
                'user_id'       =>'1',
            ),
            array(

                'co_id'         =>'1',
                'acc_type'      =>'partners', // العملاء
                'acc_name'      =>'غريب ',
                'acc_address'   =>'55 شارع معروف خلف دار القضاء العالى',
                'acc_tel'       =>'002555888777',
                'acc_commercial_registration'  =>'012457996666',
                'acc_tax_card'  =>'012584796366',
                'acc_email'     =>'folan@yahoo.com',
                'acc_limit'     =>'5000',
                'acc_notes'     =>'sdsadsad',
                'user_id'       =>'1',
            ),



		));

	} // end function run

} // end class 
