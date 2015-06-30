

<?php

class modelsSeeder extends Seeder {


	public function run()
	{
		
		DB::table('models')->truncate();
		DB::table('models')->insert(array(

	array(

	    	'co_id'       =>'1',
	    	'mark_code'   =>'1',
	    	'model_name'  =>'بنطلون',
	    	'user_id'     =>'1',
	
	    ),
  
  	array(

	    	'co_id'       =>'2',
	    	'mark_code'   =>'2',
	    	'model_name'  =>'x5',
	    	'user_id'     =>'2',
	
	    ),
  
  	array(

	    	'co_id'       =>'3',
	    	'mark_code'   =>'3',
	    	'model_name'  =>'الملكة',
	    	'user_id'     =>'3',
	
	    ),


		));

	} // end function run

} // end class 
