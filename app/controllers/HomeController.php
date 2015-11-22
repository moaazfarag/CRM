<?php

class HomeController extends BaseController {

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
		return View::make('frontend/index');
	}

	public function confirm($confirm){
		$company = CoData::where('confirmation_code',$confirm)->first();
		if(!$company){
			return View::make('errors.missing');
		}else{
			$company->confirmed = 1;
			$company->confirmation_code = null;
			$company->update();
			Session::flash('success','تم تفعيل الشركة بنجاح');
			return Redirect::route('login');
		}
	}



}
