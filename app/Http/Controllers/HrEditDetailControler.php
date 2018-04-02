<?php

namespace App\Http\Controllers;
use Illuminate\Database\DatabaseManager;
use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use Auth;
use DB;
use Config;
use Redirect;
use Session;
use App\Models\Employee;
use App\Models\Allowance;
use App\Models\Deduction;
use App\Models\Institute;
class HrEditDetailControler extends Controller
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
   
   	public function editDepartmentDetail(){
		$departmentSection = Input::get('departmentSection');
		foreach($departmentSection as $row){
			$department_name = Input::get('department_name_'.$row.'');
			$department_id = Input::get('department_id_'.$row.'');
			$data1['department_name'] =	strip_tags($department_name);
        	$data1['username'] 		  = Auth::user()->name;
        	$data1['company_id'] 	  	  = $_GET['m'];
        	$data1['date']     		  = date("Y-m-d");
        	$data1['time']     		  = date("H:i:s");
        
			DB::table('department')->where('id', $department_id)->update($data1);	
		}
        Session::flash('dataEdit','successfully edit.');
		return Redirect::to('hr/viewDepartmentList?pageType=viewlist&&parentCode=6&&m='.$_GET['m'].'');
	}


    public function editSubDepartmentDetail(){
        $subDepartmentSection = Input::get('subDepartmentSection');
        foreach($subDepartmentSection as $row){
            $department_id                  = Input::get('department_id_'.$row.'');
            $sub_department_name            = Input::get('sub_department_name_'.$row.'');
            $sub_department_id              = Input::get('sub_department_id_'.$row.'');
            $data1['department_id']         =   strip_tags($department_id);
            $data1['sub_department_name']   =   strip_tags($sub_department_name);
            $data1['username']              = Auth::user()->name;
            $data1['company_id']            = $_GET['m'];
            $data1['date']                  = date("Y-m-d");
            $data1['time']                  = date("H:i:s");
        
            DB::table('sub_department')->where('id', $sub_department_id)->update($data1);    
        }
        Session::flash('dataEdit','successfully edit.');
        return Redirect::to('hr/viewSubDepartmentList?pageType=viewlist&&parentCode=10&&m='.$_GET['m'].'');
    }
}
