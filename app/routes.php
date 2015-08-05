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
App::setlocale('ar');
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
Route::group(array('prefix'=>'admin'),function(){
    /**
     * company info area
     */
    Route::get('/','dashboardController@index');
    Route::get('setting',array('uses'=>'CompanyController@editCompanyInfo','as'=>'editCompanyInfo'));
    Route::post('updateSetting/{id}',array('before'=>'csrf','uses'=>'CompanyController@updateCompanyInfo','as'=>'updateCompanyInfo'));
    /**
     * Branch Area
     */
    Route::get('addBranch/',array('uses'=>'BranchController@addBranch','as'=>'addBranch'));
    Route::post('storeBranch/',array('before'=>'csrf','uses'=>'BranchController@storeBranch','as'=>'storeBranch'));
    Route::get('editBranch/',array('uses'=>'BranchController@editBranch','as'=>'editBranch'));
    Route::post('updateBranch/{id}',array('before'=>'csrf','uses'=>'BranchController@updateBranch','as'=>'updateBranch'));
    /**
     * Category Area
     */
    Route::get('addCategory',array('uses'=>'CategoryController@addCategory','as'=>'addCategory'));
    Route::post('storeCategory',array('before'=>'csrf','uses'=>'CategoryController@storeCategory','as'=>'storeCategory'));
    Route::get('editCategory/{id}',array('uses'=>'CategoryController@editCategory','as'=>'editCategory'));
    Route::post('updateCategory/{id}',array('before'=>'csrf','uses'=>'CategoryController@updateCategory','as'=>'updateCategory'));
    /**
     * Season Area
     */
    Route::get('addSeason',array('uses'=>'SeasonController@addSeason','as'=>'addSeason'));
    Route::post('storeSeason',array('before'=>'csrf','uses'=>'SeasonController@storeSeason','as'=>'storeSeason'));
    Route::get('editSeason/{id}',array('uses'=>'SeasonController@editSeason','as'=>'editSeason'));
    Route::post('updateSeason/{id}',array('before'=>'csrf','uses'=>'SeasonController@updateSeason','as'=>'updateSeason'));

    /**
     * Model Area
     */
    Route::get('addModel',array('uses'=>'ModelsController@addModel','as'=>'addModel'));
    Route::post('storeModel',array('before'=>'csrf','uses'=>'ModelsController@storeModel','as'=>'storeModel'));
    Route::get('editModel/{id}',array('uses'=>'ModelsController@editModel','as'=>'editModel'));
    Route::post('updateModel/{id}',array('before'=>'csrf','uses'=>'ModelsController@updateModel','as'=>'updateModel'));
    /**
     * Item Area
     */
    Route::get('addItem',array('uses'=>'ItemController@addItem','as'=>'addItem'));
    Route::post('storeItem',array('before'=>'csrf','uses'=>'ItemController@storeItem','as'=>'storeItem'));
    Route::get('editItem/{id}',array('uses'=>'ItemController@editItem','as'=>'editItem'));
    Route::post('updateItem/{id}',array('before'=>'csrf','uses'=>'ItemController@updateItem','as'=>'updateItem'));

    /**
     * Account Area
     */
    Route::group(array('prefix'=>'account'),function()
    {
        Route::get('{accountType}',array('uses'=>'AccountController@addAccount','as'=>'addAccount'));
        Route::get('{editAccount}/{id}',array('uses'=>'AccountController@editAccount','as'=>'editAccount'));
        Route::post('storeAccount/{accountType}',array('before'=>'csrf','uses'=>'AccountController@storeAccount','as'=>'storeAccount'));
        Route::post('updateAccount/{accountType}/{id}',array('before'=>'csrf','uses'=>'AccountController@updateAccount','as'=>'updateAccount'));
//    Route::post('{accountType}/{id}',array('uses'=>'AccountController@storeAccount','as'=>'storeAccount'));
    });
    /**
     * Users Area
     */
    Route::group(array('prefix'=>'users'),function()
    {
        Route::get('/set_password',array('uses'=>'UserController@set_password','as'=>'set_Password')); //set password
        Route::post('/set_password',array('uses'=>'UserController@storeNewPassword','as'=>'storeNewPassword')); //set password
        Route::get('addUser',array('uses'=>'UserController@addUser','as'=>'addUser')) ;
       Route::post('storeUser',array('before'=>'csrf','uses'=>'UserController@storeUser','as'=>'storeUser')) ;
       Route::get('editUser/{id}',array('uses'=>'UserController@editUser','as'=>'editUser')) ;
       Route::post('updateUser/{id}',array('before'=>'csrf','uses'=>'UserController@updateUser','as'=>'updateUser')) ;
    }
    );

    /**
     *  Items Balances Area
     */
    Route::group(array('prefix'=>'ItemBalance'),function()
    {
            Route::get('Add-Items-Balances', array('uses' => 'ItemsBalancesController@addItemsBalances','as' => 'addItemsBalances'));
        Route::post('Store-Items-Balances',array('before'=>'csrf','uses'=>'ItemsBalancesController@storeItemsBalances','as'=>'storeItemsBalances')) ;
        Route::get('Edit-Items-Balances/{id}',array('uses'=>'ItemsBalancesController@editItemsBalances','as'=>'editItemsBalances')) ;
        Route::post('Update-Items-Balances/{id}',array('before'=>'csrf','uses'=>'ItemsBalancesController@updateItemsBalances','as'=>'updateItemsBalances')) ;
    });

    /**
     *  Accounts Balances Area
     */
    Route::group(array('prefix'=>'AccountsBalances'),function()
    {
        Route::get('Add-Accounts-Balances', array('uses' => 'AccountsBalancesController@addAccountsBalances','as' => 'addAccountsBalances'));
        Route::post('Store-Accounts-Balances',array('before'=>'csrf','uses'=>'AccountsBalancesController@storeAccountsBalances','as'=>'storeAccountsBalances')) ;
        Route::get('Edit-Accounts-Balances/{id}',array('uses'=>'AccountsBalancesController@editAccountsBalances','as'=>'editAccountsBalances')) ;
        Route::post('Update-Accounts-Balances/{id}',array('before'=>'csrf','uses'=>'AccountsBalancesController@updateAccountsBalances','as'=>'updateAccountsBalances')) ;
    });

    /**
     *  Trans Header Area
     */
    Route::group(array('prefix'=>'Transaction'),function()
    {
        Route::get('Add-Trans-Header/{type}', array('uses' => 'TransHeaderController@addTransHeader','as' => 'addTransHeader'));
        Route::post('Store-Trans-Header/{type}',array('before'=>'csrf','uses'=>'TransHeaderController@storeTransHeader','as'=>'storeTransHeader')) ;
        Route::get('Edit-Accounts-Balances/{id}',array('uses'=>'TransHeaderController@editAccountsBalances','as'=>'editAccountsBalances')) ;
        Route::post('Update-Accounts-Balances/{id}',array('before'=>'csrf','uses'=>'TransHeaderController@updateAccountsBalances','as'=>'updateAccountsBalances')) ;
    });


    Route::group(array('prefix'=>''),function()
    {
        Route::get('Add-Employees', array('uses' => 'EmployeesController@addEmp','as' => 'addEmp'));
        Route::post('Store-Items-Balances',array('before'=>'csrf','uses'=>'ItemsBalancesController@storeItemsBalances','as'=>'storeItemsBalances')) ;
        Route::get('Edit-Items-Balances/{id}',array('uses'=>'ItemsBalancesController@editItemsBalances','as'=>'editItemsBalances')) ;
        Route::post('Update-Items-Balances/{id}',array('before'=>'csrf','uses'=>'ItemsBalancesController@updateItemsBalances','as'=>'updateItemsBalances')) ;
    });

    Route::get('product','dashboardController@manageProduct');


    Route::get('accounts','dashboardController@accounts');
    Route::get('hr','dashboardController@hr');



});
