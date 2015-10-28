<?php
	
class usersSeeder extends Seeder {


	public function run()
	{
		
		DB::table('users')->truncate();
		DB::table('users')->insert(array(

	    array(

	    	'co_id'      =>'1',
	    	'br_id'    =>'1',
	    	'all_br'     =>'1',
	    	'name'       =>'mohamed',
	    	'username'  =>'admin',
	    	'email'      =>'mohamed@yahoo.com',
	    	'password'   =>Hash::Make('14781478'),
	    	'permission' =>'1',
	    	'photo'      =>'image.jpg',
	    ),
 		
 		array(

	    	'co_id'      =>'2',
	    	'br_id'    =>'2',
	    	'all_br'     =>'1',
	    	'name'       =>'ahmed',
	    	'username'  =>'admin_2',
	    	'email'      =>'ahmed@yahoo.com',
	    	'password'   =>Hash::Make('1234567'),
	    	'permission' =>'0',
	    	'photo'      =>'image_2.jpg',
	    ),
 		
 		array(

	    	'co_id'      =>'3',
	    	'br_id'    =>'0',
	    	'all_br'     =>'1',
	    	'name'       =>'sayed',
	    	'username'  =>'admin_3',
	    	'email'      =>'sayed@yahoo.com',
	    	'password'   =>Hash::Make('12345678'),
	    	'permission' =>'0',
	    	'photo'      =>'image_3.jpg',
	    ),


		));

	} // end function run

} // end class 
