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
Route::get('register/verify/{confirmationCode}', ['as' => 'confirmation_path','uses' => 'HomeController@confirm']);
Route::get('/',array('uses'=>'HomeController@home','as'=>'homePage'));

Route::get('/login', function () {
    if (Auth::check()) {
        return Redirect::to('/admin');
    }
    $data['type'] = 'user';
    return View::make('emails.auth.login_2');

});

Route::get('/login-management', function () {
    if (Auth::check()) {
        return Redirect::to('/management');
    }
    $data['type'] = 'management';
    return View::make('emails.auth.login_management');

});

Route::get('remind-password', function(){
    return View::make('password.remind_password');
});
Route::post('post-remind',array('uses'=>'RemindersController@postRemind','as'=>'postRemind') );
Route::post('post-reset',array('uses'=>'RemindersController@postReset','as'=>'postReset') );
Route::get('password/reset/{token}',array('uses'=>'RemindersController@getReset','as'=>'getReset') );

/*
 * logout route
 * */
Route::get('/logout', array('uses' => 'UserController@logout', 'as' => 'logout'));
Route::get('/logout-management', array('uses' => 'UserController@logOutManagement', 'as' => 'logOutManagement'));
/*
 * login post
 * check username and password
 * */
Route::post('/login', array('uses' => 'UserController@checkLogin', 'as' => 'login', 'before' => 'csrf'));
Route::post('/login-management', array('uses' => 'UserController@checkLoginManagement', 'as' => 'checkLoginManagement', 'before' => 'csrf'));
Route::get('/add-new-company', array('uses' => 'CompanyController@addNewCompany', 'as' => 'addNewCompany'));
Route::get('/trial-end', array('uses' => 'CompanyController@trialEnd', 'as' => 'trialEnd'));
Route::post('/storeNewCompany', array('uses' => 'CompanyController@storeNewCompany', 'as' => 'storeNewCompany', 'before' => 'csrf'));

Route::group(array('prefix' => 'management', 'before' => 'auth_management'), function () {

    Route::get('/{statues?}', array('uses' => 'elrasedManagementController@home', 'as' => 'elrasedManagement'));
    Route::post('update-company-reservations', array('uses' => 'elrasedManagementController@updateCompanyReservations', 'as' => 'updateCompanyReservations'));
    Route::post('stop-company', array('uses' => 'elrasedManagementController@stopCompany', 'as' => 'stopCompany'));
    Route::post('activation-company', array('uses' => 'elrasedManagementController@activationCompany', 'as' => 'activationCompany'));
    Route::post('delete-company', array('uses' => 'elrasedManagementController@deleteCompany', 'as' => 'deleteCompany'));

});

Route::group(array('prefix' => 'admin', 'before' => 'auth'), function () {


    /**
     * company info area
     */
    Route::get('up', 'AccountController@run');
    Route::get('/', array('uses' => 'dashboardController@index', 'as' => 'index'));
    Route::get('setting', array('before' => 'filter:main_info:company:edit_show', 'uses' => 'CompanyController@editCompanyInfo', 'as' => 'editCompanyInfo'));
    Route::post('updateSetting/{id}', array('before' => 'csrf|filter:main_info:company:edit', 'uses' => 'CompanyController@updateCompanyInfo', 'as' => 'updateCompanyInfo'));
    /**
     * Branch Area
     */
    Route::get('addBranch/', array('before' => 'filter:main_info:branch:show_edit_add', 'uses' => 'BranchController@addBranch', 'as' => 'addBranch'));//add branch
    Route::group(array('before' => 'filter:main_info:branch:add'), function () {
        Route::post('storeBranch/', array('before' => 'csrf|filter:main_info:branch:add', 'uses' => 'BranchController@storeBranch', 'as' => 'storeBranch'));
    });
    Route::group(array('before' => 'filter:main_info:branch:edit'), function () {
        Route::get('editBranch/', array('before' => 'filter:main_info:branch:edit', 'uses' => 'BranchController@editBranch', 'as' => 'editBranch'));
        Route::post('updateBranch/{id}', array('before' => 'csrf|filter:main_info:branch:edit', 'uses' => 'BranchController@updateBranch', 'as' => 'updateBranch'));

    });
    /**
     * Category Area
     */
    Route::get('addCategory', array('before' => 'filter:main_info:cat:show_edit_add', 'uses' => 'CategoryController@addCategory', 'as' => 'addCategory'));
    Route::group(array('before' => 'filter:main_info:cat:add'), function () {
        Route::post('storeCategory', array('before' => 'csrf', 'uses' => 'CategoryController@storeCategory', 'as' => 'storeCategory'));
    });
    Route::group(array('before' => 'filter:main_info:cat:edit'), function () {
        Route::get('editCategory/{id}', array('uses' => 'CategoryController@editCategory', 'as' => 'editCategory'));
        Route::post('updateCategory/{id}', array('before' => 'csrf', 'uses' => 'CategoryController@updateCategory', 'as' => 'updateCategory'));
    });
    Route::get('deleteCategory/{id}', array('before' => 'filter:main_info:cat:delete', 'uses' => 'CategoryController@deleteCategory', 'as' => 'deleteCategory'));
    /**
     * Season Area
     */
    Route::get('addSeason', array('before' => 'filter:main_info:cat:show_edit_add', 'uses' => 'SeasonController@addSeason', 'as' => 'addSeason'));
    Route::group(array('before' => 'filter:main_info:season:add'), function () {
        Route::post('storeSeason', array('before' => 'csrf', 'uses' => 'SeasonController@storeSeason', 'as' => 'storeSeason'));
    });
    Route::get('editSeason/{id}', array('before' => 'filter:main_info:season:show_edit_add', 'uses' => 'SeasonController@editSeason', 'as' => 'editSeason'));
    Route::group(array('before' => 'filter:main_info:season:edit'), function () {
        Route::post('updateSeason/{id}', array('before' => 'csrf', 'uses' => 'SeasonController@updateSeason', 'as' => 'updateSeason'));
    });
    Route::get('deleteSeason/{id}', array('before' => 'filter:main_info:season:delete', 'uses' => 'SeasonController@deleteSeason', 'as' => 'deleteSeason'));

//    markes area
    Route::get('addMark', array('before' => 'filter:main_info:mark_model:show_edit_add', 'uses' => 'MarkesController@addMark', 'as' => 'addMark'));
    Route::get('addModel', array('before' => 'filter:main_info:mark_model:show_edit_add', 'uses' => 'ModelsController@addModel', 'as' => 'addModel'));
    Route::group(array('before' => 'filter:main_info:mark_model:add'), function () {
        Route::post('storeMark', array('before' => 'csrf', 'uses' => 'MarkesController@storeMark', 'as' => 'storeMark'));
        Route::post('storeModel', array('before' => 'csrf', 'uses' => 'ModelsController@storeModel', 'as' => 'storeModel'));
    });
    Route::group(array('before' => 'filter:main_info:mark_model:edit'), function () {
        Route::get('editMark/{id}', array('uses' => 'MarkesController@editMark', 'as' => 'editMark'));
        Route::post('updateMark/{id}', array('before' => 'csrf', 'uses' => 'MarkesController@updateMark', 'as' => 'updateMark'));
        Route::get('editModel/{id}', array('uses' => 'ModelsController@editModel', 'as' => 'editModel'));
        Route::post('updateModel/{id}', array('before' => 'csrf', 'uses' => 'ModelsController@updateModel', 'as' => 'updateModel'));
    });
    Route::get('deleteMark/{id}', array('before' => 'filter:main_info:mark_model:delete', 'uses' => 'MarkesController@deleteMark', 'as' => 'deleteMark'));
    Route::get('deleteModel/{id}', array('before' => 'filter:main_info:mark_model:delete', 'uses' => 'ModelsController@deleteModel', 'as' => 'deleteModel'));
    /**
     * barcode Area
     */
    Route::group(array('before' => 'filter:main_info:barcode:add'), function () {
        Route::get('addItem', array('uses' => 'ItemController@addItem', 'as' => 'addItem'));
        Route::get('barcode', array( 'uses' => 'ItemController@barcode', 'as' => 'barcode'));
        Route::post('barcode', array( 'uses' => 'ItemController@barcodeSearch', 'as' => 'barcode'));
        Route::post('printBarcode', array('uses' => 'ItemController@printBarcode', 'as' => 'printBarcode'));
    });
    /**
     * Item Area
     */
    Route::group(array('before' => 'filter:main_info:item:add'), function () {
        Route::post('storeItem', array('before' => 'csrf', 'uses' => 'ItemController@storeItem', 'as' => 'storeItem'));
    });
    Route::group(array('before' => 'filter:main_info:item:edit'), function () {
        Route::get('editItem/{id}', array('uses' => 'ItemController@editItem', 'as' => 'editItem'));
        Route::post('updateItem/{id}', array('before' => 'csrf', 'uses' => 'ItemController@updateItem', 'as' => 'updateItem'));
    });
    Route::post('addItem/select_mark', array('uses' => 'ItemController@select_mark', 'as' => 'select_mark'));
    Route::get('deleteItems/{id}', array('before' => 'filter:main_info:mark_model:delete', 'uses' => 'ItemController@deleteItems', 'as' => 'deleteItems'));

    /**
     * Account Area
     */
    Route::group(array('prefix' => 'account',), function () {
        Route::get('{accountType}', array('before' => 'filter:main_info:add_account:add_edit_show', 'uses' => 'AccountController@addAccount', 'as' => 'addAccount'));
        Route::post('storeAccount/{accountType}', array('before' => 'csrf|filter:main_info:add_account:add', 'uses' => 'AccountController@storeAccount', 'as' => 'storeAccount'));
    });
    Route::group(array('prefix' => 'account', 'before' => 'filter:main_info:add_account:edit'), function () {
        Route::get('{editAccount}/{id}', array('uses' => 'AccountController@editAccount', 'as' => 'editAccount'));
        Route::post('updateAccount/{accountType}/{id}', array('before' => 'csrf', 'uses' => 'AccountController@updateAccount', 'as' => 'updateAccount'));
    });
    /**
     * Users Area
     */
    Route::group(array('prefix' => 'users'), function () {
        Route::get('/set_password', array('uses' => 'UserController@set_password', 'as' => 'set_Password')); //set password
        Route::post('/set_password', array('uses' => 'UserController@storeNewPassword', 'as' => 'storeNewPassword')); //set password
        Route::get('addUser', array('before' => 'filter:main_info:users:add_edit_show', 'uses' => 'UserController@addUser', 'as' => 'addUser'));
        Route::group(array('before' => 'filter:main_info:users:add'), function () {
            Route::post('storeUser', array('before' => 'csrf', 'uses' => 'UserController@storeUser', 'as' => 'storeUser'));
        });
        Route::group(array('before' => 'filter:main_info:users:edit'), function () {
            Route::get('editUser/{id}', array('uses' => 'UserController@editUser', 'as' => 'editUser'));
            Route::post('updateUser/{id}', array('before' => 'csrf', 'uses' => 'UserController@updateUser', 'as' => 'updateUser'));
        });
    });

    /**
     *  Accounts Balances Area
     */
    Route::group(array('prefix' => 'AccountsBalances'), function () {
        Route::get('Add-Accounts-Balances', array('before' => 'filter:balances:accountsBalances:add_show', 'uses' => 'AccountsBalancesController@addAccountsBalances', 'as' => 'addAccountsBalances'));
        Route::group(array('before' => 'filter:balances:accountsBalances:add'), function () {
            Route::get('Add-Accounts-Balances-data', array('uses' => 'AccountsBalancesController@sendData', 'as' => 'sendData'));
            Route::post('Store-Accounts-Balances', array('before' => 'csrf', 'uses' => 'AccountsBalancesController@storeAccountsBalances', 'as' => 'storeAccountsBalances'));
            Route::get('Edit-Accounts-Balances/{id}', array('uses' => 'AccountsBalancesController@editAccountsBalances', 'as' => 'editAccountsBalances'));
            Route::post('Update-Accounts-Balances/{id}', array('before' => 'csrf', 'uses' => 'AccountsBalancesController@updateAccountsBalances', 'as' => 'updateAccountsBalances'));
        });
        Route::get('View-Accounts-Balances', array('uses' => 'AccountsBalancesController@viewAccountsBalances', 'as' => 'viewAccountsBalances'));
        Route::get('delete-Accounts-Balances/{id}', array('before' => 'filter:balances:accountsBalances:delete', 'uses' => 'AccountsBalancesController@deleteAccountsBalances', 'as' => 'deleteAccountsBalances'));

    });

    /**
     * transaction area
     */
    Route::group(array('prefix' => 'transaction'), function () {
        Route::get('{type}/{br_id}', array('before' => 'canTrans:add', 'uses' => 'TransController@addTrans', 'as' => 'addTrans'));
        Route::group(array('before' => 'canTrans:add'), function () {
            Route::post('{type}/{br_id}', array('before' => 'csrf', 'uses' => 'TransController@storeTrans', 'as' => 'storeTrans'));
        });
        Route::group(array('before' => 'canTransData'), function () {
            Route::post('serial-items-data', array('uses' => 'TransController@serialItemsData', 'as' => 'serialItemsData'));
            Route::post('items-data', array('uses' => 'TransController@items', 'as' => 'items'));
            Route::post('invoice-data', array('uses' => 'TransController@returnsInvoiceData', 'as' => 'returnsInvoiceData'));
            Route::post('returns-invoice-data', array('uses' => 'TransController@returnsInvoiceData', 'as' => 'itemsData'));
        });
        Route::get('all/{type}/{br_id}', array('before' => 'canViewTrans', 'uses' => 'TransController@viewTransactions', 'as' => 'viewTransactions'));
        Route::get('{type}-{br_id}-{invoice_no}', array('before' => 'canViewOneTrans', 'uses' => 'TransController@viewTransaction', 'as' => 'viewTransaction'));
        Route::get('label-{invoice_no}', array('before' => 'filter:main_info:barcode:add','uses' => 'TransController@viewLabel', 'as' => 'viewLabel'));
        Route::post('accounts-data', array('uses' => 'TransController@accountsData', 'as' => 'accountsData'));
        Route::post('accounts-by-id', array('uses' => 'TransController@accountById', 'as' => 'accountById'));
        Route::post('items-data-br', array('uses' => 'TransController@itemsData', 'as' => 'itemsData'));

        Route::post('cancelTrans', array('before' => 'csrf|canTrans:delete', 'uses' => 'TransController@cancelTrans', 'as' => 'cancelTrans'));

    });


    Route::group(array('prefix' => 'hr'), function () {
        Route::get('Add-Employees', array('before' => 'filter:hr:Employee:add_edit_show', 'uses' => 'EmployeesController@addEmp', 'as' => 'addEmp'));
        Route::group(array('before' => 'filter:hr:Employee:add'), function () {
            Route::post('Store-Employees', array('before' => 'csrf', 'uses' => 'EmployeesController@storeEmp', 'as' => 'storeEmp'));
        });
        Route::group(array('before' => 'filter:hr:Employee:edit'), function () {
            Route::get('Edit-Employees/{id}', array('uses' => 'EmployeesController@editEmp', 'as' => 'editEmp'));
            Route::post('Update-Employees/{id}', array('before' => 'csrf', 'uses' => 'EmployeesController@updateEmp', 'as' => 'updateEmp'));
            Route::post('employee-dep-dis-data', array('uses' => 'EmployeesController@employeeDepDisData', 'as' => 'employeeDepDisData'));
            Route::post('store-emp-des-ded-pop', array('uses' => 'EmployeeDeductionController@storeEmpdesdedPop', 'as' => 'storeEmpdesdedPop'));
        });

        Route::delete('delete-emp-des-ded-pop/{id}', array('before' => 'filter:hr:Employee:delete', 'uses' => 'EmployeeDeductionController@deleteEmpdesdedPop', 'as' => 'deleteEmpdesdedPop'));

        //Departments Page
        Route::get('addDep', array('before' => 'filter:hr:Departments:add_edit_show', 'uses' => 'DepartmentController@addDep', 'as' => 'addDep'));
        Route::group(array('before' => 'filter:hr:Departments:add'), function () {
            Route::post('storeDep', array('before' => 'csrf', 'uses' => 'DepartmentController@storeDep', 'as' => 'storeDep'));
        });
        Route::group(array('before' => 'filter:hr:Departments:edit'), function () {
            Route::get('editDep/{id}', array('uses' => 'DepartmentController@editDep', 'as' => 'editDep'));
            Route::post('updateDep/{id}', array('before' => 'csrf', 'uses' => 'DepartmentController@updateDep', 'as' => 'updateDep'));
        });
        Route::get('deleteDep/{id}', array('before' => 'filter:hr:Departments:delete', 'uses' => 'DepartmentController@deleteDep', 'as' => 'deleteDep'));

//        Route::get('deleteDep/{id}','DepartmentController@deleteDep');

        //Job Page
        Route::get('addJob', array('before' => 'filter:hr:jobs:add_edit_show', 'uses' => 'JobController@addJob', 'as' => 'addJob'));
        Route::group(array('before' => 'filter:hr:jobs:add'), function () {
            Route::post('storeJob', array('before' => 'csrf', 'uses' => 'JobController@storeJob', 'as' => 'storeJob'));
        });
        Route::group(array('before' => 'filter:hr:jobs:edit'), function () {
            Route::get('editJob/{id}', array('uses' => 'JobController@editJob', 'as' => 'editJob'));
            Route::post('updateJob/{id}', array('before' => 'csrf', 'uses' => 'JobController@updateJob', 'as' => 'updateJob'));  //Job Page
        });
        Route::get('deleteJob/{id}', array('before' => 'filter:hr:jobs:delete', 'uses' => 'JobController@deleteJob', 'as' => 'deleteJob'));


        //Loans Page
        Route::get('addLoans', array('before' => 'filter:hr:loans:add_edit_show', 'uses' => 'LoansController@addLoans', 'as' => 'addLoans'));
        Route::group(array('before' => 'filter:hr:loans:add'), function () {
            Route::post('storeLoans', array('before' => 'csrf', 'uses' => 'LoansController@storeLoans', 'as' => 'storeLoans'));
        });
        Route::group(array('before' => 'filter:hr:loans:edit'), function () {
            Route::get('editLoans/{id}', array('uses' => 'LoansController@editLoans', 'as' => 'editLoans'));
            Route::post('updateLoans/{id}', array('before' => 'csrf', 'uses' => 'LoansController@updateLoans', 'as' => 'updateLoans'));
        });
        //Deduction  Page
        Route::get('addDesded', array('before' => 'filter:hr:Desdeds:add_edit_show', 'uses' => 'DeductionController@addDesded', 'as' => 'addDesded'));
        Route::group(array('before' => 'filter:hr:Desdeds:add'), function () {
            Route::post('storeDesded', array('before' => 'csrf', 'uses' => 'DeductionController@storeDesded', 'as' => 'storeDesded'));
        });
        Route::group(array('before' => 'filter:hr:Desdeds:edit'), function () {
            Route::get('editDesded/{id}', array('uses' => 'DeductionController@editDesded', 'as' => 'editDesded'));
            Route::post('updateDesded/{id}', array('before' => 'csrf', 'uses' => 'DeductionController@updateDesded', 'as' => 'updateDesded'));
        });
        Route::get('deleteDesded/{id}', array('before' => 'filter:hr:Desdeds:delete', 'uses' => 'DeductionController@deleteDesded', 'as' => 'deleteDesded'));

        //EmpDesDed Page
        Route::get('addEmpdesded', array('before' => 'filter:hr:Empdesded:add_edit_show', 'uses' => 'EmployeeDeductionController@addEmpdesded', 'as' => 'addEmpdesded'));
        Route::group(array('before' => 'filter:hr:Empdesded:add'), function () {
            Route::post('storeEmpdesded', array('before' => 'csrf', 'uses' => 'EmployeeDeductionController@storeEmpdesded', 'as' => 'storeEmpdesded'));
        });
        Route::group(array('before' => 'filter:hr:Empdesded:edit'), function () {
            Route::get('editEmpdesded/{id}', array('uses' => 'EmployeeDeductionController@editEmpdesded', 'as' => 'editEmpdesded'));
            Route::post('updateEmpdesded/{id}', array('before' => 'csrf', 'uses' => 'EmployeeDeductionController@updateEmpdesded', 'as' => 'updateEmpdesded'));
        });
        Route::get('deleteEmpdesded/{id}', array('before' => 'filter:hr:Empdesded:delete', 'uses' => 'EmployeeDeductionController@deleteEmpdesded', 'as' => 'deleteEmpdesded'));


        //ChangeMonth Page
        Route::get('addMonthChange', array('before' => 'filter:hr:MonthChange:add_edit_show', 'uses' => 'MonthChangeController@addMonthChange', 'as' => 'addMonthChange'));
        Route::group(array('before' => 'filter:hr:MonthChange:add'), function () {
            Route::post('storeMonthChange', array('before' => 'csrf', 'uses' => 'MonthChangeController@storeMonthChange', 'as' => 'storeMonthChange'));
        });
        Route::group(array('before' => 'filter:hr:MonthChange:edit'), function () {
            Route::get('editMonthChange/{id}', array('uses' => 'MonthChangeController@editMonthChange', 'as' => 'editMonthChange'));
            Route::post('updateMonthChange/{id}', array('before' => 'csrf', 'uses' => 'MonthChangeController@updateMonthChange', 'as' => 'updateMonthChange'));
        });
        Route::group(array('before' => 'filter:hr:salariesProcessing:show'), function () {
            Route::get('month-salary-search', array('uses' => 'MsHeaderController@monthSalarySearch', 'as' => 'monthSalarySearch'));
            Route::post('storeMsHeader', array('before' => 'csrf', 'uses' => 'MsHeaderController@storeMsHeader', 'as' => 'storeMsHeader'));
            Route::post('prepMsHeader', array('before' => 'csrf', 'uses' => 'MsHeaderController@prepMsHeader', 'as' => 'prepMsHeader'));
            Route::get('printReceipt', array('uses' => 'MsHeaderController@printReceipt', 'as' => 'printReceipt'));
            Route::post('readyToPay', array('before' => 'csrf', 'uses' => 'MsHeaderController@readyToPay', 'as' => 'readyToPay'));
        });
    });

    Route::group(array('prefix' => 'report'), function () {
        // outgoing-salaries
        Route::group(array('before' => 'filter:p_reports_hr:p_outgoingSalaries:show'), function () {
            Route::get('search-outgoing-salaries', array('uses' => 'MsHeaderController@searchOutgoingSalariesReport', 'as' => 'searchOutgoingSalariesReport'));
            Route::get('view-outgoing-salaries-details/{id}', array('uses' => 'MsHeaderController@ViewOutGoingSalariesDetails', 'as' => 'ViewOutGoingSalariesDetails'));
            Route::post('the-outgoing-salaries', array('before' => 'csrf', 'uses' => 'MsHeaderController@outGoingSalariesReport', 'as' => 'outGoingSalariesReport'));
        });
        // settels
        Route::group(array('before' => 'canShowSettle'), function () {
            Route::get('search-settle/{type}', array('uses' => 'SettleController@reportSettleSearch', 'as' => 'reportSettleSearch'));
            Route::post('settles/{type}', array('uses' => 'SettleController@reportSettleResult', 'as' => 'reportSettleResult'));
        });
        // invoices
        Route::group(array('before' => 'canShowSettle'), function () {
            Route::get('search-invoices/{type}/{sum?}', array('uses' => 'InvoiceController@reportSearchInvoice', 'as' => 'searchReportInvoices'));
            Route::post('invoices/{type}', array('uses' => 'InvoiceController@reportResultInvoice', 'as' => 'InvoiceReport'));
            Route::post('company-earnings', array('uses' => 'InvoiceController@reportResultCompanyEarnings', 'as' => 'companyEarnings'));

        });
        // item card
        Route::group(array('before' => 'filter:p_reports_stores:p_itemsCard:show'), function () {
            Route::get('items-card/items', array('uses' => 'ItemController@searchItemCard', 'as' => 'searchItemCard'));
            Route::post('items-card-result/', array('uses' => 'ItemController@reportResultItemCard', 'as' => 'reportResultItemCard'));
        });
        // Balances Stores
        Route::group(array('before' => 'canShowSettle'), function () {
            Route::get('search-the-balance-of-the-stores/{type}', array('uses' => 'ItemController@searchTheBalanceOfTheStores', 'as' => 'searchTheBalanceOfTheStores'));
            Route::post('result-the-balance-of-the-stores/{type}', array('uses' => 'ItemController@resultTheBalanceOfTheStores', 'as' => 'resultTheBalanceOfTheStores'));
        });
        Route::post('inventory-store', array('before' => 'filter:p_reports_stores:p_inventoryStore:show', 'uses' => 'ItemController@inventoryResult', 'as' => 'inventoryResult'));

    });

//    Route::get('test', array('uses' => 'TestController@index', 'as' => 'testIndex'));
//    Route::get('addtest', array('uses' => 'TestController@addTest', 'as' => 'addTest'));
//    Route::delete('testdelete/{id}', array('uses' => 'TestController@destroy', 'as' => 'testdelete'));
//    Route::get('tests', array('uses' => 'TestController@view', 'as' => 'testsIndex'));


    Route::group(array('prefix' => 'accounts'), function () {
        // direct movement
        Route::get('add-direct-movement', array('before' => 'filter:p_general_accounts:p_directMovement:add_edit_show', 'uses' => 'AccountController@addDirectMovement', 'as' => 'addDirectMovement'));
        Route::group(array('before' => 'filter:p_general_accounts:p_directMovement:show'), function () {
            Route::post('store-direct-movement', array('uses' => 'AccountController@storeDirectMovement', 'as' => 'storeDirectMovement'));
        });
        Route::group(array('before' => 'filter:p_general_accounts:p_directMovement:edit'), function () {
            Route::get('edit-direct-movement/{id}', array('uses' => 'AccountController@editDirectMovement', 'as' => 'editDirectMovement'));
            Route::post('update-direct-movement/{id}', array('uses' => 'AccountController@updateDirectMovement', 'as' => 'updateDirectMovement'));
        });
        // Daily treasury
        Route::group(array('before' => 'filter:p_general_accounts:p_dailyTreasury:add'), function () {
            Route::get('daily-treasury-search', array('uses' => 'AccountController@dailyTreasurySearch', 'as' => 'dailyTreasurySearch'));
            Route::post('daily-treasury-result', array('uses' => 'AccountController@dailyTreasuryResult', 'as' => 'dailyTreasuryResult'));
        });
        Route::group(array('before' => 'filter:p_general_accounts:p_directMovement:add'), function () {
            Route::get('result-search-daily-treasury', array('uses' => 'AccountController@resultSearchDailyTreasury', 'as' => 'resultSearchDailyTreasury'));
            Route::post('daily-treasury-add-direct-movement', array('uses' => 'AccountController@dailyTreasuryAddDirectMovement', 'as' => 'dailyTreasuryAddDirectMovement'));
        });
        //  accounts ( customers ,suppliers ,bank ,partners )
        Route::group(array('before' => 'canShowSettle'), function () {
            Route::get('search-accounts/{type}', array('uses' => 'AccountController@searchAccounts', 'as' => 'searchAccounts'));
            Route::post('result-accounts/{type}', array('uses' => 'AccountController@resultAccounts', 'as' => 'resultAccounts'));
        });
        Route::group(array('before' => 'filter:p_general_accounts:p_directMovement:add'), function () {
            Route::get('result-search-account', array('uses' => 'AccountController@resultSearchAccounts', 'as' => 'resultSearchAccounts'));
            Route::post('add-new-direct-movement', array('uses' => 'AccountController@accountsAddNewDirectMovement', 'as' => 'addNewDirectMovement'));
        });
    });


    App::missing(function () {
        if (Auth::check()) {
            if (Auth::check()->co_id == 0) {

                return View::make('errors.404');
            } else {
                return View::make('errors.missing');

            }
        } else {
            return Redirect::to('/login');
        }
    });
});


