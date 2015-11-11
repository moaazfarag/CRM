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
	    	'password'   =>Hash::Make('123456'),
	    	'permission' => json_encode(PermissionController::setPermission(1)),
	    	'photo'      =>'image.jpg',
			'owner'      =>'acount_creator'
	    ),
 		
 		array(

	    	'co_id'      =>'2',
	    	'br_id'    =>'2',
	    	'all_br'     =>'1',
	    	'name'       =>'ahmed',
	    	'username'  =>'admin_2',
	    	'email'      =>'ahmed@yahoo.com',
	    	'password'   =>Hash::Make('1234567'),
            'permission' => json_encode(PermissionController::setPermission(1)),
	    	'photo'      =>'image_2.jpg',
			 'owner'      =>'acount_creator'

		),
 		
 		array(

	    	'co_id'      =>'3',
	    	'br_id'    =>'0',
	    	'all_br'     =>'1',
	    	'name'       =>'sayed',
	    	'username'  =>'admin_3',
	    	'email'      =>'sayed@yahoo.com',
	    	'password'   =>Hash::Make('12345678'),
            'permission' => json_encode(PermissionController::setPermission(1)),
           	'photo'      =>'image_3.jpg',
			'owner'      =>'acount_creator'

		),


		));

	} // end function run

} // end class 
