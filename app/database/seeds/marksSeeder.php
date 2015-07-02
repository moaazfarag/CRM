
<?php

class marksSeeder extends Seeder {


	public function run()
	{
		
		DB::table('marks')->truncate();
		DB::table('marks')->insert(array(

	    array(

	    	'co_id'      =>'1',
	    	'marks_name'  =>'nike',
	    	'user_id'    =>'1',

	    ),
    array(

	    	'co_id'      =>'2',
	    	'marks_name'  =>'bmw',
	    	'user_id'    =>'2',

	    ),
    array(

	    	'co_id'     =>'3',
	    	'marks_name' =>'مكرونة الملكة',
	    	'user_id'   =>'3',

	    ),


		));

	} // end function run

} // end class 
