<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\category;
use App\Models\Account;
use App\Models\Pvs;
use App\Models\Pvs_data;
use App\Models\Rvs;
use App\Models\Rvs_data;
use Input;
use Auth;
use DB;
use Config;
class FinanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   
   	public function toDayActivity(){
   		return view('Finance.toDayActivity');
   	}
	
	public function viewChartofAccountList(){
		Config::set(['database.connections.tenant.database' => Auth::user()->dbName]);
		Config::set(['database.connections.tenant.username' => 'root']);
		Config::set('database.default', 'tenant');
		DB::reconnect('tenant');
		$accounts = new Account;
		$accounts = $accounts::orderBy('level1', 'ASC')
    				->orderBy('level2', 'ASC')
					->orderBy('level3', 'ASC')
					->orderBy('level4', 'ASC')
					->orderBy('level5', 'ASC')
					->orderBy('level6', 'ASC')
					->orderBy('level7', 'ASC')
    				->get();
		
   		return view('Finance.viewChartofAccountList',compact('accounts'));
		Config::set('database.default', 'mysql');
		DB::reconnect('mysql');
   	}
	
	public function createAccountForm(){
		Config::set(['database.connections.tenant.database' => Auth::user()->dbName]);
		Config::set(['database.connections.tenant.username' => 'root']);
		Config::set('database.default', 'tenant');
		DB::reconnect('tenant');
		$accounts = new Account;
		$accounts = $accounts::orderBy('level1', 'ASC')
    				->orderBy('level2', 'ASC')
					->orderBy('level3', 'ASC')
					->orderBy('level4', 'ASC')
					->orderBy('level5', 'ASC')
					->orderBy('level6', 'ASC')
					->orderBy('level7', 'ASC')
    				->get();
   		return view('Finance.createAccountForm',compact('accounts'));
		Config::set('database.default', 'mysql');
		DB::reconnect('mysql');
   	}
	
	public function ccoa(){
		return view('Finance.ccoa');
	}
	
	public function ccoa_detail(){
		Config::set(['database.connections.tenant.database' => Auth::user()->dbName]);
		Config::set(['database.connections.tenant.username' => 'root']);
		Config::set('database.default', 'tenant');
		DB::reconnect('tenant');
		$category = new category;
		$category->name = Input::get('cName');
		$category->save();
		return view('Finance.ccoa');
		Config::set('database.default', 'mysql');
		DB::reconnect('mysql');
	}
	
	
	public function createCashPaymentVoucherForm(){
		Config::set(['database.connections.tenant.database' => Auth::user()->dbName]);
		Config::set(['database.connections.tenant.username' => 'root']);
		Config::set('database.default', 'tenant');
		DB::reconnect('tenant');
		$accounts = new Account;
		$accounts = $accounts::orderBy('level1', 'ASC')
    				->orderBy('level2', 'ASC')
					->orderBy('level3', 'ASC')
					->orderBy('level4', 'ASC')
					->orderBy('level5', 'ASC')
					->orderBy('level6', 'ASC')
					->orderBy('level7', 'ASC')
    				->get();
   		return view('Finance.createCashPaymentVoucherForm',compact('accounts'));
		Config::set('database.default', 'mysql');
		DB::reconnect('mysql');
   	}
	
	public function viewCashPaymentVoucherList(){
		Config::set(['database.connections.tenant.database' => Auth::user()->dbName]);
		Config::set(['database.connections.tenant.username' => 'root']);
		Config::set('database.default', 'tenant');
		DB::reconnect('tenant');
		$currentMonthStartDate = date('Y-m-01');
    	$currentMonthEndDate   = date('Y-m-t');
		$accounts = new Account;
		$accounts = $accounts::orderBy('level1', 'ASC')
    				->orderBy('level2', 'ASC')
					->orderBy('level3', 'ASC')
					->orderBy('level4', 'ASC')
					->orderBy('level5', 'ASC')
					->orderBy('level6', 'ASC')
					->orderBy('level7', 'ASC')
    				->get();
		$pvs = new Pvs;
		$pvs = $pvs::whereBetween('pv_date',[$currentMonthStartDate,$currentMonthEndDate])
					 ->where('voucherType','=','1')
					 ->get();
		return view('Finance.viewCashPaymentVoucherList',compact('accounts','pvs'));
		Config::set('database.default', 'mysql');
		DB::reconnect('mysql');
   	}
	
	public function createBankPaymentVoucherForm(){
		Config::set(['database.connections.tenant.database' => Auth::user()->dbName]);
		Config::set(['database.connections.tenant.username' => 'root']);
		Config::set('database.default', 'tenant');
		DB::reconnect('tenant');
		$accounts = new Account;
		$accounts = $accounts::orderBy('level1', 'ASC')
    				->orderBy('level2', 'ASC')
					->orderBy('level3', 'ASC')
					->orderBy('level4', 'ASC')
					->orderBy('level5', 'ASC')
					->orderBy('level6', 'ASC')
					->orderBy('level7', 'ASC')
    				->get();
   		return view('Finance.createBankPaymentVoucherForm',compact('accounts'));
		Config::set('database.default', 'mysql');
		DB::reconnect('mysql');
   	}
	
	public function viewBankPaymentVoucherList(){
		Config::set(['database.connections.tenant.database' => Auth::user()->dbName]);
		Config::set(['database.connections.tenant.username' => 'root']);
		Config::set('database.default', 'tenant');
		DB::reconnect('tenant');
		$currentMonthStartDate = date('Y-m-01');
    	$currentMonthEndDate   = date('Y-m-t');
		$accounts = new Account;
		$accounts = $accounts::orderBy('level1', 'ASC')
    				->orderBy('level2', 'ASC')
					->orderBy('level3', 'ASC')
					->orderBy('level4', 'ASC')
					->orderBy('level5', 'ASC')
					->orderBy('level6', 'ASC')
					->orderBy('level7', 'ASC')
    				->get();
		$pvs = new Pvs;
		$pvs = $pvs::whereBetween('pv_date',[$currentMonthStartDate,$currentMonthEndDate])
					 ->where('voucherType','=','2')
					 ->get();
		return view('Finance.viewBankPaymentVoucherList',compact('accounts','pvs'));
		Config::set('database.default', 'mysql');
		DB::reconnect('mysql');
   	}
	
	public function createCashReceiptVoucherForm(){
		Config::set(['database.connections.tenant.database' => Auth::user()->dbName]);
		Config::set(['database.connections.tenant.username' => 'root']);
		Config::set('database.default', 'tenant');
		DB::reconnect('tenant');
		$accounts = new Account;
		$accounts = $accounts::orderBy('level1', 'ASC')
    				->orderBy('level2', 'ASC')
					->orderBy('level3', 'ASC')
					->orderBy('level4', 'ASC')
					->orderBy('level5', 'ASC')
					->orderBy('level6', 'ASC')
					->orderBy('level7', 'ASC')
    				->get();
   		return view('Finance.createCashReceiptVoucherForm',compact('accounts'));
		Config::set('database.default', 'mysql');
		DB::reconnect('mysql');
   	}
	
	public function viewCashReceiptVoucherList(){
		Config::set(['database.connections.tenant.database' => Auth::user()->dbName]);
		Config::set(['database.connections.tenant.username' => 'root']);
		Config::set('database.default', 'tenant');
		DB::reconnect('tenant');
		$currentMonthStartDate = date('Y-m-01');
    	$currentMonthEndDate   = date('Y-m-t');
		$accounts = new Account;
		$accounts = $accounts::orderBy('level1', 'ASC')
    				->orderBy('level2', 'ASC')
					->orderBy('level3', 'ASC')
					->orderBy('level4', 'ASC')
					->orderBy('level5', 'ASC')
					->orderBy('level6', 'ASC')
					->orderBy('level7', 'ASC')
    				->get();
		$rvs = new Rvs;
		$rvs = $rvs::whereBetween('rv_date',[$currentMonthStartDate,$currentMonthEndDate])
					 ->where('voucherType','=','1')
					 ->get();
		return view('Finance.viewCashReceiptVoucherList',compact('accounts','rvs'));
		Config::set('database.default', 'mysql');
		DB::reconnect('mysql');
   	}
	
	public function createBankReceiptVoucherForm(){
		Config::set(['database.connections.tenant.database' => Auth::user()->dbName]);
		Config::set(['database.connections.tenant.username' => 'root']);
		Config::set('database.default', 'tenant');
		DB::reconnect('tenant');
		$accounts = new Account;
		$accounts = $accounts::orderBy('level1', 'ASC')
    				->orderBy('level2', 'ASC')
					->orderBy('level3', 'ASC')
					->orderBy('level4', 'ASC')
					->orderBy('level5', 'ASC')
					->orderBy('level6', 'ASC')
					->orderBy('level7', 'ASC')
    				->get();
   		return view('Finance.createBankReceiptVoucherForm',compact('accounts'));
		Config::set('database.default', 'mysql');
		DB::reconnect('mysql');
   	}
	
	public function viewBankReceiptVoucherList(){
		Config::set(['database.connections.tenant.database' => Auth::user()->dbName]);
		Config::set(['database.connections.tenant.username' => 'root']);
		Config::set('database.default', 'tenant');
		DB::reconnect('tenant');
		$currentMonthStartDate = date('Y-m-01');
    	$currentMonthEndDate   = date('Y-m-t');
		$accounts = new Account;
		$accounts = $accounts::orderBy('level1', 'ASC')
    				->orderBy('level2', 'ASC')
					->orderBy('level3', 'ASC')
					->orderBy('level4', 'ASC')
					->orderBy('level5', 'ASC')
					->orderBy('level6', 'ASC')
					->orderBy('level7', 'ASC')
    				->get();
		$rvs = new Rvs;
		$rvs = $rvs::whereBetween('rv_date',[$currentMonthStartDate,$currentMonthEndDate])
					 ->where('voucherType','=','2')
					 ->get();
		return view('Finance.viewBankReceiptVoucherList',compact('accounts','rvs'));
		Config::set('database.default', 'mysql');
		DB::reconnect('mysql');
   	}
	
}
