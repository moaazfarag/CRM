<?php

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the Closure to execute when that URI is requested.
    |
    */
Route::get('/login',function(){
    if(Auth::check())
    {
        return Redirect::to('/admin');
    }

    return View::make('emails.auth.login');

});
/*
 * logout route
 * */
Route::get('/logout',array('uses'=>'UserController@logout','as'=>'login'));
/*
 * login post
 * check username and password
 * */
Route::post('/login',array('uses'=>'UserController@checkLogin','as'=>'login','before'=>'csrf'));

Route::get('/', 'HomeController@index');
Route::group(array('prefix'=>'admin','before'=>'auth'),function(){

    Route::get('/','dashboardController@index');
    Route::get('setting',array('uses'=>'CompanyController@editCompanyInfo','as'=>'editCompanyInfo'));
    Route::post('updateSetting/{id}',array('before'=>'csrf','uses'=>'CompanyController@updateCompanyInfo','as'=>'updateCompanyInfo'));
    Route::get('addBranch/',array('uses'=>'BranchController@addBranch','as'=>'addBranch'));
    Route::post('storeBranch/',array('before'=>'csrf','uses'=>'BranchController@storeBranch','as'=>'storeBranch'));
    Route::get('editBranch/',array('uses'=>'BranchController@editBranch','as'=>'editBranch'));
    Route::post('updateBranch/{id}',array('before'=>'csrf','uses'=>'BranchController@updateBranch','as'=>'updateBranch'));
    Route::get('product','dashboardController@manageProduct');
    Route::get('accounts','dashboardController@accounts');
    Route::get('hr','dashboardController@hr');

});
