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

	public function index()
	{
		return View::make('dashboard.home.index');
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
