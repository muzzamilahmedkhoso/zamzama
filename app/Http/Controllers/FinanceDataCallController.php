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
class FinanceDataCallController extends Controller
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
   
   	public function viewCashPaymentVoucherDetail(){
		return $_GET['id'];
	}
	
	public function viewBankPaymentVoucherDetail(){
		return $_GET['id'];
	}
	
	public function viewCashReceiptVoucherDetail(){
		return $_GET['id'];
	}
	
	public function viewBankReceiptVoucherDetail(){
		return $_GET['id'];
	}
	
	
	
}
