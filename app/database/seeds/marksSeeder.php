
<?php

class marksSeeder extends Seeder {


	public function run()
	{
		
		DB::table('marks')->truncate();
		DB::table('marks')->insert(array(

	    array(
			'true_id'  => '1',
	    	'co_id'      =>'1',
	    	'name'  =>'nike',
	    	'user_id'    =>'1',

	    ),
    array(
			'true_id'  => '1',
	    	'co_id'      =>'2',
	    	'name'  =>'bmw',
	    	'user_id'    =>'2',

	    ),
    array(
			'true_id'  => '1',
	    	'co_id'     =>'3',
	    	'name' =>'مكرونة الملكة',
	    	'user_id'   =>'3',

	    ),


		));

	} // end function run

} // end class 
