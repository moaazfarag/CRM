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

    Route::get('/', 'HomeControlledr@index');
    Route::group(array('prefix'=>'admin'),function(){

        Route::get('/','dashboardController@index');
        Route::get('setting','dashboardController@createSetting');
        Route::get('product','dashboardController@manageProduct');
        Route::get('accounts','dashboardController@accounts');
        Route::get('hr','dashboardController@hr');

    });
