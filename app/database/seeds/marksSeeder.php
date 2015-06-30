
<?php

class marksSeeder extends Seeder {


	public function run()
	{
		
		DB::table('marks')->truncate();
		DB::table('marks')->insert(array(

	    array(

	    	'co_id'      =>'1',
	    	'mark_name'  =>'nike',
	    	'user_id'    =>'1',

	    ),
    array(

	    	'co_id'      =>'2',
	    	'mark_name'  =>'bmw',
	    	'user_id'    =>'2',

	    ),
    array(

	    	'co_id'     =>'3',
	    	'mark_name' =>'مكرونة الملكة',
	    	'user_id'   =>'3',

	    ),


		));

	} // end function run

} // end class 
