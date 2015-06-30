
<?php

class branchesSeeder extends Seeder {


	public function run()
	{
		
		DB::table('branches')->truncate();
		DB::table('branches')->insert(array(

	    array(

	    	'co_id'     => '1',
	    	'br_name'   => 'الحمد 2',
	    	'br_address'=> 'الاسكندرية 55 شارع خالد بن الوليد ',
	    	'user_id'   => '1',
	    
	   
	    ),

    array(

	    	'co_id'     => '1',
	    	'br_name'   => 'الحمد 3',
	    	'br_address'=> 'مصر القديمة  55 شارع عمرو بن العاص ',
	    	'user_id'   => '2',
	    
	   
	    ),

   array(

	    	'co_id'     => '2',
	    	'br_name'   => 'البركة 2',
	    	'br_address'=> 'دمياط 55 شارع سعد بن ابى وقاص  ',
	    	'user_id'   => '2',
	    
	   
	    ),


		));

	} // end function run

} // end class 
