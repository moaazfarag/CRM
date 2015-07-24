
<?php

class catSeeder extends Seeder {


	public function run()
	{
		
		DB::table('cat')->truncate();
		DB::table('cat')->insert(array(

	    array(

	    	'co_id'    =>'1',
	    	'name' =>'بنطلون',
	    	'user_id'  =>'1',
	    ),

	    array(

	    	'co_id'    =>'2',
	    	'name' =>'سيارات',
	    	'user_id'  =>'2',
	    ),


	    array(

	    	'co_id'    =>'3',
	    	'name' =>'مكرونة',
	    	'user_id'  =>'3',
	    ),


		));

	} // end function run

} // end class 
