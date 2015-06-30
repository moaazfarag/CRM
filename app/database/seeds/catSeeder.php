
<?php

class catSeeder extends Seeder {


	public function run()
	{
		
		DB::table('cat')->truncate();
		DB::table('cat')->insert(array(

	    array(

	    	'co_id'    =>'1',
	    	'cat_name' =>'بنطلون',
	    	'user_id'  =>'1',
	    ),

	    array(

	    	'co_id'    =>'2',
	    	'cat_name' =>'سيارات',
	    	'user_id'  =>'2',
	    ),


	    array(

	    	'co_id'    =>'3',
	    	'cat_name' =>'مكرونة',
	    	'user_id'  =>'3',
	    ),


		));

	} // end function run

} // end class 
