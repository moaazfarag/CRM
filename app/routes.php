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
Route::get('/add-new-company',array('uses'=>'CompanyController@addNewCompany','as'=>'addNewCompany'));
Route::post('/storeNewCompany',array('uses'=>'CompanyController@storeNewCompany','as'=>'storeNewCompany','before'=>'csrf'));
Route::get('/', 'HomeController@index');

Route::group(array('prefix'=>'admin','before'=>'auth'),function(){

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

//    markes area
    Route::get('addMark',array('uses'=>'MarkesController@addMark','as'=>'addMark'));
    Route::post('storeMark',array('uses'=>'MarkesController@storeMark','as'=>'storeMark'));
    Route::get('editMark/{id}',array('uses'=>'MarkesController@editMark','as'=>'editMark'));
    Route::post('updateMark/{id}',array('uses'=>'MarkesController@updateMark','as'=>'updateMark'));
    Route::get('deleteMark/{id}',array('uses'=>'MarkesController@deleteMark','as'=>'deleteMark' ));

    /**
     * Model Area
     */
    Route::get('addModel',array('uses'=>'ModelsController@addModel','as'=>'addModel'));
    Route::post('storeModel',array('before'=>'csrf','uses'=>'ModelsController@storeModel','as'=>'storeModel'));
    Route::get('editModel/{id}',array('uses'=>'ModelsController@editModel','as'=>'editModel'));
    Route::post('updateModel/{id}',array('before'=>'csrf','uses'=>'ModelsController@updateModel','as'=>'updateModel'));
    Route::get('deleteModel/{id}',array('uses'=>'ModelsController@deleteModel','as'=>'deleteModel' ));

    /**
     * Item Area
     */
    Route::get('addItem',array('uses'=>'ItemController@addItem','as'=>'addItem'));
    Route::post('storeItem',array('before'=>'csrf','uses'=>'ItemController@storeItem','as'=>'storeItem'));
    Route::get('editItem/{id}',array('uses'=>'ItemController@editItem','as'=>'editItem'));
    Route::post('updateItem/{id}',array('before'=>'csrf','uses'=>'ItemController@updateItem','as'=>'updateItem'));
    Route::get('deleteItems/{id}',array('uses'=>'ItemController@deleteItems','as'=>'deleteItems'));
    Route::post('addItem/select_mark',array('uses'=>'ItemController@select_mark','as'=>'select_mark'));

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
        Route::get('View-Items-Balances/',array('uses'=>'ItemsBalancesController@viewItemsBalances','as'=>'viewItemsBalances')) ;
        Route::get('Delete-Items-Balances/{id}',array('uses'=>'ItemsBalancesController@deleteItemsBalances','as'=>'deleteItemsBalances')) ;
    });

    /**
     *  Accounts Balances Area
     */
    Route::group(array('prefix'=>'AccountsBalances'),function()
    {
        Route::get('Add-Accounts-Balances', array('uses' => 'AccountsBalancesController@addAccountsBalances','as' => 'addAccountsBalances'));
        Route::get('View-Accounts-Balances', array('uses' => 'AccountsBalancesController@viewAccountsBalances','as' => 'viewAccountsBalances'));
        Route::get('delete-Accounts-Balances/{id}', array('uses' => 'AccountsBalancesController@deleteAccountsBalances','as' => 'deleteAccountsBalances'));
        Route::get('Add-Accounts-Balances-data', array('uses' => 'AccountsBalancesController@sendData','as' => 'sendData'));
        Route::post('Store-Accounts-Balances',array('before'=>'csrf','uses'=>'AccountsBalancesController@storeAccountsBalances','as'=>'storeAccountsBalances')) ;
        Route::get('Edit-Accounts-Balances/{id}',array('uses'=>'AccountsBalancesController@editAccountsBalances','as'=>'editAccountsBalances')) ;
        Route::post('Update-Accounts-Balances/{id}',array('before'=>'csrf','uses'=>'AccountsBalancesController@updateAccountsBalances','as'=>'updateAccountsBalances')) ;

    });

    /**
     *  settle  Area
     */
    Route::group(array('prefix'=>'Transaction'),function()
    {
        Route::get('Add-Trans-Header/{type}', array('uses' => 'SettleController@addSettle','as' => 'addSettle'));
        Route::get('Add-Trans-Header-data', array('uses' => 'SettleController@jsonData','as' => 'jsonData'));
        Route::post('Add-Trans-Header/{type}', array('uses' => 'SettleController@storeSettle','as' => 'storeSettle'));
        Route::post('Store-Trans-Header/{type}',array('before'=>'csrf','uses'=>'SettleController@storeTransHeader','as'=>'storeTransHeader')) ;
        Route::get('view-settle/{invoiceId}',array('uses'=>'SettleController@viewSettle','as'=>'viewSettle')) ;
        Route::get('view-settles/',array('uses'=>'SettleController@viewSettles','as'=>'viewSettles')) ;
        Route::post('test',array('uses'=>'SettleController@test','as'=>'test')) ;
    });
    /**
     *
     */
    Route::group(array('prefix'=>'invoice'),function(){

        Route::get('add-{type}-invoice/{br_id}', array('uses' => 'InvoiceController@addInvoice','as' => 'addInvoice'));
        Route::post('add-{type}-invoice/{br_id}', array('uses' => 'InvoiceController@storeInvoice','as' => 'storeInvoice'));
        Route::get('view-invoice/{headerId}', array('uses' => 'InvoiceController@viewInvoice','as' => 'viewInvoice'));
        Route::get('view-invoices', array('uses' => 'InvoiceController@viewInvoices','as' => 'viewInvoices'));
        Route::get('sales-returns', array('uses' => 'InvoiceController@salesReturns','as' => 'salesReturns'));
        Route::post('accounts-data', array('uses' => 'InvoiceController@accountsData','as' => 'accountsData'));
        Route::post('accounts-by-id', array('uses' => 'InvoiceController@accountById','as' => 'accountById'));
        Route::post('items-data', array('uses' => 'InvoiceController@itemsData','as' => 'itemsData'));
        Route::get('all-invoices', array('uses' => 'InvoiceController@allInvoices','as' => 'allInvoices'));
        Route::post('returns-invoice-data', array('uses' => 'InvoiceReturnController@returnsInvoiceData','as' => 'itemsData'));
        Route::post('cancelInvoice',array('before'=>'csrf','uses'=>'InvoiceController@cancelInvoice','as'=>'cancelInvoice')) ;


    });



    Route::group(array('prefix'=>'hr'),function()
    {
        Route::get('Add-Employees', array('uses' => 'EmployeesController@addEmp','as' => 'addEmp'));
        Route::post('Store-Employees',array('before'=>'csrf','uses'=>'EmployeesController@storeEmp','as'=>'storeEmp')) ;
        Route::get('Edit-Employees/{id}',array('uses'=>'EmployeesController@editEmp','as'=>'editEmp')) ;
        Route::post('Update-Employees/{id}',array('before'=>'csrf','uses'=>'EmployeesController@updateEmp','as'=>'updateEmp')) ;
        Route::post('employee-dep-dis-data',array('uses'=>'EmployeesController@employeeDepDisData','as'=>'employeeDepDisData')) ;
        Route::post('store-emp-des-ded-pop',array('uses'=>'EmployeeDeductionController@storeEmpdesdedPop','as'=>'storeEmpdesdedPop')) ;
        Route::delete('delete-emp-des-ded-pop/{id}',array('uses'=>'EmployeeDeductionController@deleteEmpdesdedPop','as'=>'deleteEmpdesdedPop')) ;


        //Departments Page
        Route::get('addDep',array('uses'=>'DepartmentController@addDep','as'=>'addDep'));
        Route::post('storeDep',array('before'=>'csrf','uses'=>'DepartmentController@storeDep','as'=>'storeDep'));
        Route::get('editDep/{id}',array('uses'=>'DepartmentController@editDep','as'=>'editDep'));
        Route::post('updateDep/{id}',array('before'=>'csrf','uses'=>'DepartmentController@updateDep','as'=>'updateDep'));
        Route::get('deleteDep/{id}',array('uses'=>'DepartmentController@deleteDep','as'=>'deleteDep'));

//        Route::get('deleteDep/{id}','DepartmentController@deleteDep');

         //Job Page
        Route::get('addJob',array('uses'=>'JobController@addJob','as'=>'addJob'));
        Route::post('storeJob',array('before'=>'csrf','uses'=>'JobController@storeJob','as'=>'storeJob'));
        Route::get('editJob/{id}',array('uses'=>'JobController@editJob','as'=>'editJob'));
        Route::post('updateJob/{id}',array('before'=>'csrf','uses'=>'JobController@updateJob','as'=>'updateJob'));  //Job Page
        Route::get('deleteJob/{id}',array('uses'=>'JobController@deleteJob','as'=>'deleteJob'));


        //Loans Page
        Route::get('addLoans',array('uses'=>'LoansController@addLoans','as'=>'addLoans'));
        Route::post('storeLoans',array('before'=>'csrf','uses'=>'LoansController@storeLoans','as'=>'storeLoans'));
        Route::get('editLoans/{id}',array('uses'=>'LoansController@editLoans','as'=>'editLoans'));
        Route::post('updateLoans/{id}',array('before'=>'csrf','uses'=>'LoansController@updateLoans','as'=>'updateLoans'));

        //Deduction  Page
        Route::get('addDesded',array('uses'=>'DeductionController@addDesded','as'=>'addDesded'));
        Route::post('storeDesded',array('before'=>'csrf','uses'=>'DeductionController@storeDesded','as'=>'storeDesded'));
        Route::get('editDesded/{id}',array('uses'=>'DeductionController@editDesded','as'=>'editDesded'));
        Route::post('updateDesded/{id}',array('before'=>'csrf','uses'=>'DeductionController@updateDesded','as'=>'updateDesded'));
        Route::get('deleteDesded/{id}',array('uses'=>'DeductionController@deleteDesded','as'=>'deleteDesded'));

        //EmpDesDed Page
        Route::get('addEmpdesded',array('uses'=>'EmployeeDeductionController@addEmpdesded','as'=>'addEmpdesded'));
        Route::post('storeEmpdesded',array('before'=>'csrf','uses'=>'EmployeeDeductionController@storeEmpdesded','as'=>'storeEmpdesded'));
        Route::get('editEmpdesded/{id}',array('uses'=>'EmployeeDeductionController@editEmpdesded','as'=>'editEmpdesded'));
        Route::post('updateEmpdesded/{id}',array('before'=>'csrf','uses'=>'EmployeeDeductionController@updateEmpdesded','as'=>'updateEmpdesded'));
        Route::get('deleteEmpdesded/{id}',array('uses'=>'EmployeeDeductionController@deleteEmpdesded','as'=>'deleteEmpdesded'));


        //ChangeMonth Page
        Route::get('addMonthChange',array('uses'=>'MonthChangeController@addMonthChange','as'=>'addMonthChange'));
        Route::post('storeMonthChange',array('before'=>'csrf','uses'=>'MonthChangeController@storeMonthChange','as'=>'storeMonthChange'));
        Route::get('editMonthChange/{id}',array('uses'=>'MonthChangeController@editMonthChange','as'=>'editMonthChange'));
        Route::post('updateMonthChange/{id}',array('before'=>'csrf','uses'=>'MonthChangeController@updateMonthChange','as'=>'updateMonthChange'));

        Route::get('month-salary-search',array('uses'=>'MsHeaderController@monthSalarySearch','as'=>'monthSalarySearch'));
        Route::post('storeMsHeader',array('before'=>'csrf','uses'=>'MsHeaderController@storeMsHeader','as'=>'storeMsHeader'));
        Route::post('prepMsHeader',array('before'=>'csrf','uses'=>'MsHeaderController@prepMsHeader','as'=>'prepMsHeader'));
        Route::get('printReceipt',array('uses'=>'MsHeaderController@printReceipt','as'=>'printReceipt'));
        Route::post('readyToPay',array('before'=>'csrf','uses'=>'MsHeaderController@readyToPay','as'=>'readyToPay'));

    });


    Route::get('test',array('uses'=>'TestController@index','as'=>'testIndex'));
    Route::get('addtest',array('uses'=>'TestController@addTest','as'=>'addTest'));
    Route::delete('testdelete/{id}',array('uses'=>'TestController@destroy','as'=>'testdelete'));
    Route::get('tests',array('uses'=>'TestController@view','as'=>'testsIndex'));

    Route::get('product','dashboardController@manageProduct');


    Route::get('accounts','dashboardController@accounts');
    Route::get('hrr','dashboardController@hr');

    Route::get('add-direct-movement',array('uses'=>'AccountController@addDirectMovement','as'=>'addDirectMovement'));
    Route::post('store-direct-movement',array('uses'=>'AccountController@storeDirectMovement','as'=>'storeDirectMovement'));
    Route::get('edit-direct-movement/{id}',array('uses'=>'AccountController@editDirectMovement','as'=>'editDirectMovement'));
    Route::post('update-direct-movement/{id}',array('uses'=>'AccountController@updateDirectMovement','as'=>'updateDirectMovement'));

    App::missing(function()
    {
        return  View::make('errors.missing');
    });
});
