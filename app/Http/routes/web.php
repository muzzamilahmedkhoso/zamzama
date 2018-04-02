<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

/*Route::get('/', function () {
    return view('auth.login');
});*/
Route::get('/abc',function(){
	$nexmo = app('Nexmo\Client');
	$nexmo->message()->send([
    	'to'   => '923368980737',
    	'from' => '923368980737',
    	'text' => 'Using the instance to send a message.'
	]);
});
Route::get('/', 'NormalUsersController@index');

Route::group(['prefix' => 'nu','before' => 'csrf'], function () {
    Route::get('/d', 'NormalUsersController@index');
    Route::get('/nuViewJobsList', 'NormalUsersController@nuViewJobsList');
    Route::get('/ViewandApplyDetail','NormalUsersController@ViewandApplyDetail');
});


Route::get('/dMaster', 'MasterController@index');
Route::get('/dClient', 'ClientController@index');
Route::get('/dCompany', 'CompanyController@index');
Route::get('/d', 'HomeController@index');



Route::get('/deleteMasterTableReceord', 'DeleteMasterTableRecordController@deleteMasterTableReceord');

//Start Select List Ajax Load
Route::group(['prefix' => 'slal','before' => 'csrf'], function () {
	Route::get('/stateLoadDependentCountryId', 'SelectListLoadAjaxController@stateLoadDependentCountryId');
	Route::get('/cityLoadDependentStateId', 'SelectListLoadAjaxController@cityLoadDependentStateId');
	Route::get('/employeeLoadDependentDepartmentID', 'SelectListLoadAjaxController@employeeLoadDependentDepartmentID');
});
//End Select List Ajax Load

//Start Companies
Route::group(['prefix' => 'companies','before' => 'csrf'], function () {
	Route::get('/c', 'ClientCompaniesController@toDayActivity');
	Route::post('/addCompanyDetail','ClientCompaniesController@addCompanyDetail');
});

Route::group(['prefix' => 'ccd','before' => 'csrf'], function () {
	$companiesList = DB::table('company')->select(['name','id','dbName'])->where('status','=','1')->get();
	foreach($companiesList as $routeRow1){
		Route::get('/'.$routeRow1->dbName.'', 'ClientController@clientCompanyMenu');
	}
});

//End Companies


//Start Users
Route::group(['prefix' => 'users','before' => 'csrf'], function () {
	Route::get('/u', 'UsersController@toDayActivity');
	Route::get('/createMainMenuTitleForm','UsersController@createMainMenuTitleForm');
	Route::get('/createSubMenuForm','UsersController@createSubMenuForm');
	Route::get('/createUsersForm', 'UsersController@createUsersForm');
	Route::get('/createRoleForm','UsersController@createRoleForm');
	Route::get('/viewRoleList','UsersController@viewRoleList');
});

Route::group(['prefix' => 'udc','before' => 'csrf'], function () {
	Route::get('/viewMainMenuTitleList','UsersDataCallController@viewMainMenuTitleList');
	Route::get('/viewSubMenuList','UsersDataCallController@viewSubMenuList');
});

Route::group(['prefix' => 'uad','before' => 'csrf'], function () {
	Route::post('/addMainMenuTitleDetail','UsersAddDetailController@addMainMenuTitleDetail');
	Route::post('/addSubMenuDetail','UsersAddDetailController@addSubMenuDetail');
	Route::post('/addRoleDetail','UsersAddDetailController@addRoleDetail');
	
});
//End Users

//Start HR
Route::group(['prefix' => 'hr','before' => 'csrf'], function () {
	Route::get('/h', 'HrController@toDayActivity');
	Route::get('/departmentAddNView', 'HrController@departmentAddNView');
	
	Route::get('/createDepartmentForm', 'HrController@createDepartmentForm');
	Route::get('/viewDepartmentList','HrController@viewDepartmentList');
	Route::get('/editDepartmentForm','HrController@editDepartmentForm');
	

	Route::get('/createSubDepartmentForm', 'HrController@createSubDepartmentForm');
	Route::get('/viewSubDepartmentList','HrController@viewSubDepartmentList');
	Route::get('/editSubDepartmentForm','HrController@editSubDepartmentForm');
	

	Route::get('/createDesignationForm', 'HrController@createDesignationForm');
	Route::get('/viewDesignationList','HrController@viewDesignationList');

	Route::get('/createHealthInsuranceForm', 'HrController@createHealthInsuranceForm');
	Route::get('/viewHealthInsuranceList','HrController@viewHealthInsuranceList');

	Route::get('/createLifeInsuranceForm', 'HrController@createLifeInsuranceForm');
	Route::get('/viewLifeInsuranceList','HrController@viewLifeInsuranceList');

	Route::get('/createJobTypeForm', 'HrController@createJobTypeForm');
	Route::get('/viewJobTypeList','HrController@viewJobTypeList');

	Route::get('/createQualificationForm', 'HrController@createQualificationForm');
	Route::get('/viewQualificationList','HrController@viewQualificationList');

	Route::get('/createLeaveTypeForm', 'HrController@createLeaveTypeForm');
	Route::get('/viewLeaveTypeList','HrController@viewLeaveTypeList');

	Route::get('/createLoanTypeForm', 'HrController@createLoanTypeForm');
	Route::get('/viewLoanTypeList','HrController@viewLoanTypeList');

	Route::get('/createAdvanceTypeForm', 'HrController@createAdvanceTypeForm');
	Route::get('/viewAdvanceTypeList','HrController@viewAdvanceTypeList');

	Route::get('/createShiftTypeForm', 'HrController@createShiftTypeForm');
	Route::get('/viewShiftTypeList','HrController@viewShiftTypeList');
	
	
	Route::get('/createEmployeeForm', 'HrController@createEmployeeForm');
	Route::get('/viewEmployeeList','HrController@viewEmployeeList');
	Route::get('/createManageAttendanceForm', 'HrController@createManageAttendanceForm');
	Route::get('/viewEmployeeAttendanceList','HrController@viewEmployeeAttendanceList');
	Route::get('/createPayslipForm','HrController@createPayslipForm');
	Route::get('/viewPayslipList','HrController@viewPayslipList');

	Route::get('/createJobAddForm','HrController@createJobAddForm');
	Route::get('/viewJobsList','HrController@viewJobsList');
	
});

Route::group(['prefix' => 'had','before' => 'csrf'], function () {
	Route::post('/addDepartmentDetail', 'HrAddDetailControler@addDepartmentDetail');
	Route::post('/editDepartmentDetail', 'HrEditDetailControler@editDepartmentDetail');

	
	Route::post('/addSubDepartmentDetail', 'HrAddDetailControler@addSubDepartmentDetail');
	Route::post('/editSubDepartmentDetail', 'HrAddDetailControler@editSubDepartmentDetail');
	
	Route::post('/addDesignationDetail', 'HrAddDetailControler@addDesignationDetail');
	Route::post('/addHealthInsuranceDetail', 'HrAddDetailControler@addHealthInsuranceDetail');
	Route::post('/addLifeInsuranceDetail', 'HrAddDetailControler@addLifeInsuranceDetail');
	Route::post('/addJobTypeDetail', 'HrAddDetailControler@addJobTypeDetail');
	Route::post('/addQualificationDetail', 'HrAddDetailControler@addQualificationDetail');
	Route::post('/addLeaveTypeDetail', 'HrAddDetailControler@addLeaveTypeDetail');
	Route::post('/addLoanTypeDetail', 'HrAddDetailControler@addLoanTypeDetail');
	Route::post('/addAdvanceTypeDetail', 'HrAddDetailControler@addAdvanceTypeDetail');
	Route::post('/addShiftTypeDetail', 'HrAddDetailControler@addShiftTypeDetail');
	
	Route::post('/addEmployeeDetail','HrAddDetailControler@addEmployeeDetail');
	Route::post('/addManageAttendenceDetail','HrAddDetailControler@addManageAttendenceDetail');
	Route::post('/createPayslipForm','HrAddDetailControler@createPayslipForm');
	Route::post('/addJobAddDetail','HrAddDetailControler@addJobAddDetail');

	
});

Route::group(['prefix' => 'hdc','before' => 'csrf'], function (){
	Route::get('/viewDepartmentList','HrDataCallController@viewDepartmentList');
	Route::get('/viewEmployeeListManageAttendence','HrDataCallController@viewEmployeeListManageAttendence');
	Route::get('/viewAttendenceReport','HrDataCallController@viewAttendenceReport');
	Route::get('/viewEmployeePaysilpForm','HrDataCallController@viewEmployeePaysilpForm');
	Route::get('/viewEmployeePaysilpList','HrDataCallController@viewEmployeePaysilpList');
	Route::get('/viewEmployeeDetail','HrDataCallController@viewEmployeeDetail');
	Route::get('/viewJobDetail','HrDataCallController@viewJobDetail');
});

Route::group(['prefix' => 'hmfal','before' => 'csrf'], function () {
	Route::get('/makeFormEmployeeDetail','HrMakeFormAjaxLoadController@makeFormEmployeeDetail');
	Route::get('/addMoreAllowancesDetailRows','HrMakeFormAjaxLoadController@addMoreAllowancesDetailRows');
	Route::get('/addMoreDeductionsDetailRows','HrMakeFormAjaxLoadController@addMoreDeductionsDetailRows');
	Route::get('/makeFormDepartmentDetail','HrMakeFormAjaxLoadController@makeFormDepartmentDetail');
	Route::get('/makeFormSubDepartmentDetail','HrMakeFormAjaxLoadController@makeFormSubDepartmentDetail');
	Route::get('/makeFormDesignationDetail','HrMakeFormAjaxLoadController@makeFormDesignationDetail');
	Route::get('/makeFormHealthInsuranceDetail','HrMakeFormAjaxLoadController@makeFormHealthInsuranceDetail');
	Route::get('/makeFormLifeInsuranceDetail','HrMakeFormAjaxLoadController@makeFormLifeInsuranceDetail');
	Route::get('/makeFormJobTypeDetail','HrMakeFormAjaxLoadController@makeFormJobTypeDetail');
	Route::get('/makeFormQualificationDetail','HrMakeFormAjaxLoadController@makeFormQualificationDetail');
	Route::get('/makeFormLeaveTypeDetail','HrMakeFormAjaxLoadController@makeFormLeaveTypeDetail');
	Route::get('/makeFormLoanTypeDetail','HrMakeFormAjaxLoadController@makeFormLoanTypeDetail');
	Route::get('/makeFormAdvanceTypeDetail','HrMakeFormAjaxLoadController@makeFormAdvanceTypeDetail');
	Route::get('/makeFormShiftTypeDetail','HrMakeFormAjaxLoadController@makeFormShiftTypeDetail');
});
//End HR

//Start Finance
Route::group(['prefix' => 'finance','before' => 'csrf'], function () {
	Route::get('/f', 'FinanceController@toDayActivity');
	Route::get('/ccoa', 'FinanceController@ccoa');
	Route::get('/createAccountForm','FinanceController@createAccountForm');
	Route::get('/viewChartofAccountList','FinanceController@viewChartofAccountList');
	Route::post('/ccoa_detail','FinanceController@ccoa_detail');
	
	Route::get('/createCashPaymentVoucherForm','FinanceController@createCashPaymentVoucherForm');
	Route::get('/viewCashPaymentVoucherList','FinanceController@viewCashPaymentVoucherList');
	
	Route::get('/createBankPaymentVoucherForm','FinanceController@createBankPaymentVoucherForm');
	Route::get('/viewBankPaymentVoucherList','FinanceController@viewBankPaymentVoucherList');
	
	Route::get('/createCashReceiptVoucherForm','FinanceController@createCashReceiptVoucherForm');
	Route::get('/viewCashReceiptVoucherList','FinanceController@viewCashReceiptVoucherList');
	
	Route::get('/createBankReceiptVoucherForm','FinanceController@createBankReceiptVoucherForm');
	Route::get('/viewBankReceiptVoucherList','FinanceController@viewBankReceiptVoucherList');
	
});

Route::group(['prefix' => 'fad','before' => 'csrf'], function () {
	Route::post('/addAccountDetail', 'FinanceAddDetailControler@addAccountDetail');
	Route::post('/addCashPaymentVoucherDetail', 'FinanceAddDetailControler@addCashPaymentVoucherDetail');
	Route::post('/addBankPaymentVoucherDetail', 'FinanceAddDetailControler@addBankPaymentVoucherDetail');
	Route::post('/addCashReceiptVoucherDetail', 'FinanceAddDetailControler@addCashReceiptVoucherDetail');
	Route::post('/addBankReceiptVoucherDetail', 'FinanceAddDetailControler@addBankReceiptVoucherDetail');
});


Route::group(['prefix' => 'fmfal','before' => 'csrf'], function () {
	Route::get('/makeFormCashPaymentVoucher', 'FinanceMakeFormAjaxLoadController@makeFormCashPaymentVoucher');
	Route::get('/addMoreCashPvsDetailRows', 'FinanceMakeFormAjaxLoadController@addMoreCashPvsDetailRows');
	
	Route::get('/makeFormBankPaymentVoucher', 'FinanceMakeFormAjaxLoadController@makeFormBankPaymentVoucher');
	Route::get('/addMoreBankPvsDetailRows', 'FinanceMakeFormAjaxLoadController@addMoreBankPvsDetailRows');
	
	
	Route::get('/makeFormCashReceiptVoucher', 'FinanceMakeFormAjaxLoadController@makeFormCashReceiptVoucher');
	Route::get('/addMoreCashRvsDetailRows', 'FinanceMakeFormAjaxLoadController@addMoreCashRvsDetailRows');
	
	Route::get('/makeFormBankReceiptVoucher', 'FinanceMakeFormAjaxLoadController@makeFormBankReceiptVoucher');
	Route::get('/addMoreBankRvsDetailRows', 'FinanceMakeFormAjaxLoadController@addMoreBankRvsDetailRows');
	
});
Route::group(['prefix' => 'fdc','before' => 'csrf'], function () {
	Route::get('/viewCashPaymentVoucherDetail', 'FinanceDataCallController@viewCashPaymentVoucherDetail');
	Route::get('/viewBankPaymentVoucherDetail', 'FinanceDataCallController@viewBankPaymentVoucherDetail');
	Route::get('/viewCashReceiptVoucherDetail', 'FinanceDataCallController@viewCashReceiptVoucherDetail');
	Route::get('/viewBankReceiptVoucherDetail', 'FinanceDataCallController@viewBankReceiptVoucherDetail');
});
//End Finance


//Start Purchase
Route::group(['prefix' => 'purchase','before' => 'csrf'], function () {
	Route::get('/p', 'PurchaseController@toDayActivity');
	Route::get('/supplierAddNView', 'PurchaseController@supplierAddNView');
	Route::get('/categoryAddNView', 'PurchaseController@categoryAddNView');
	Route::get('/subItemAddNView', 'PurchaseController@subItemAddNView');
});

Route::group(['prefix' => 'pad','before' => 'csrf'], function () {
	Route::post('/addSupplierDetail', 'PurchaseAddDetailControler@addSupplierDetail');
	Route::post('/addCategoryDetail', 'PurchaseAddDetailControler@addCategoryDetail');
	Route::post('/addSubItemDetail', 'PurchaseAddDetailControler@addSubItemDetail');
});

Route::group(['prefix' => 'pdc','before' => 'csrf'], function (){
	Route::get('/viewSupplierList','PurchaseDataCallController@viewSupplierList');
	Route::get('/viewCategoryList','PurchaseDataCallController@viewCategoryList');
	Route::get('/viewSubItemList','PurchaseDataCallController@viewSubItemList');
});
//End Purchase

//Start Sales
Route::group(['prefix' => 'sales','before' => 'csrf'], function () {
	Route::get('/s', 'SalesController@toDayActivity');
	Route::get('/creditCustomerAddNView', 'SalesController@creditCustomerAddNView');
	Route::get('/cashCustomerAddNView', 'SalesController@cashCustomerAddNView');
});

Route::group(['prefix' => 'sad','before' => 'csrf'], function () {
	Route::post('/addCashCustomerDetail', 'SalesAddDetailControler@addCashCustomerDetail');
	Route::post('/addCreditCustomerDetail', 'SalesAddDetailControler@addCreditCustomerDetail');
});
Route::group(['prefix' => 'sdc','before' => 'csrf'], function (){
	Route::get('/viewCashCustomerList','SalesDataCallController@viewCashCustomerList');
	Route::get('/viewCreditCustomerList','SalesDataCallController@viewCreditCustomerList');
});
//End Sales