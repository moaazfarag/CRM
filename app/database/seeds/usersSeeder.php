<?php
	
class usersSeeder extends Seeder {


	public function run()
	{
		
		DB::table('users')->truncate();
		DB::table('users')->insert(array(

	    array(

	    	'co_id'      =>'1',
	    	'br_code'    =>'1',
	    	'all_br'     =>'1',
	    	'name'       =>'mohamed',
	    	'user_name'  =>'admin',
	    	'email'      =>'mohamed@yahoo.com',
	    	'password'   =>Hash::Make('123456'),
	    	'permission' =>'0',
	    	'photo'      =>'image.jpg',
	    ),
 		
 		array(

	    	'co_id'      =>'2',
	    	'br_code'    =>'2',
	    	'all_br'     =>'1',
	    	'name'       =>'ahmed',
	    	'user_name'  =>'admin_2',
	    	'email'      =>'ahmed@yahoo.com',
	    	'password'   =>Hash::Make('1234567'),
	    	'permission' =>'0',
	    	'photo'      =>'image_2.jpg',
	    ),
 		
 		array(

	    	'co_id'      =>'3',
	    	'br_code'    =>'0',
	    	'all_br'     =>'1',
	    	'name'       =>'sayed',
	    	'user_name'  =>'admin_3',
	    	'email'      =>'sayed@yahoo.com',
	    	'password'   =>Hash::Make('12345678'),
	    	'permission' =>'0',
	    	'photo'      =>'image_3.jpg',
	    ),


		));

	} // end function run

} // end class 
