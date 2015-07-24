

<?php

class modelsSeeder extends Seeder {


	public function run()
	{
		
		DB::table('models')->truncate();
		DB::table('models')->insert(array(

	array(

	    	'co_id'       =>'1',
	    	'marks_id'   =>'1',
	    	'name'  =>'بنطلون',
	    	'user_id'     =>'1',
	
	    ),
  
  	array(

	    	'co_id'       =>'2',
	    	'marks_id'   =>'2',
	    	'name'  =>'x5',
	    	'user_id'     =>'2',
	
	    ),
  
  	array(

	    	'co_id'       =>'3',
	    	'marks_id'   =>'3',
	    	'name'  =>'الملكة',
	    	'user_id'     =>'3',
	
	    ),


		));

	} // end function run

} // end class 
