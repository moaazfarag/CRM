<?php

class seasonsSeeder extends Seeder {


	public function run()
	{
		
		DB::table('seasons')->truncate();
		DB::table('seasons')->insert(array(

	    array(

	    	'co_id'      =>'1',
	    	'name' =>'فصل الشتاء',
	    	'user_id'    =>'1',
	
	    ), 

	      array(

	    	'co_id'      =>'2',
	    	'name' =>'فصل الصيف ',
	    	'user_id'    =>'2',
	
	    ),   array(

	    	'co_id'      =>'3',
	    	'name' =>' طوال العام',
	    	'user_id'    =>'3',
	
	    ),


		));

	} // end function run

} // end class 
