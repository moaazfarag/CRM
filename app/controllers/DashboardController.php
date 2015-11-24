<?php

class dashboardController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function home()
	{
		$data['home_page'] = Home::company()->first();
		return View::make('dashboard.home.home',$data);
	}

	public function editHome(){
		$data['home_page'] = Home::company()->first();
		return View::make('dashboard.home.edit_home', $data);

	}





	public function updateHome($type){

		  if($type == 'header'){
			$ruels = Home::$header_ruels;
		}elseif($type == 'about_us'){
			 $ruels = Home::$about_us_ruels;

		 }elseif($type == 'sochial'){
			 $ruels = Home::$sochial_ruels;

		 }elseif($type == 'email'){
			 $ruels = Home::$email_ruels;

		 }
		$inputs = Input::all();
		$validation = Validator::make($inputs,$ruels,BaseController::$messages);
		if($validation->fails()){

			return Redirect::back()->withInput()->withErrors($validation->messages());

		}else {

			$home_page = Home::company()->first();
			if($type == 'header'){
				$home_page->title = $inputs['title'];
				$home_page->details = $inputs['details'];
			}elseif($type == 'about_us'){
				$home_page->about = $inputs['about'];
				$home_page->about_content = $inputs['about_content'];

			}elseif($type == 'sochial'){
				$home_page->facebook = $inputs['facebook'];
				$home_page->twitter = $inputs['twitter'];
				$home_page->google = $inputs['google'];
				$home_page->youtube = $inputs['youtube'];
				$home_page->linkedin = $inputs['linkedin'];
				$home_page->instgram = $inputs['instgram'];

			}elseif($type == 'email'){
				$home_page->email = $inputs['email'];

			}

			if($home_page->update()){
				Session::flash('success',BaseController::editSuccess('البيانات'));
			}else{
				Session::flash('error',BaseController::editError('البيانات'));
			}

			$data['home_page'] = Home::company()->first();
			return View::make('dashboard.home.edit_home', $data);
		}



	}


    public function createSetting()
	{
		return View::make('dashboard.setting');
	}
    public function manageProduct()
	{
		return View::make('dashboard.product_home');
	}
    public function accounts()
	{
		return View::make('dashboard.accounts_home');
	}
    public function hr()
	{
		return View::make('dashboard.hr_home');
	}


}
