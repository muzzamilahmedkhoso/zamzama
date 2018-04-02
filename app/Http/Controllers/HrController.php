<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\SubDepartment;
use App\Models\Employee;
use App\Models\Attendence;
use App\Models\Designation;
use App\Models\HealthInsurance;
use App\Models\LifeInsurance;
use App\Models\JobType;
use App\Models\Countries;
use App\Models\Institute;
use App\Models\Qualification;
use App\Models\LeaveType;
use App\Models\LoanType;
use App\Models\AdvanceType;
use App\Models\ShiftType;

use App\Models\Job;
use Input;
use Auth;
use DB;
use Config;
use Illuminate\Pagination\LengthAwarePaginator;
class HrController extends Controller
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
   		return view('Hr.toDayActivity');
   	}
	
	public function departmentAddNView(){
		return view('Hr.departmentAddNView');
	}
	
	public function createDepartmentForm(){
		return view('Hr.createDepartmentForm');
	}
	
	public function viewDepartmentList(){
		$page = LengthAwarePaginator::resolveCurrentPage();
		$total = DB::table('department')->where('status','=','1')->where('company_id','=',$_GET['m'])->count('id'); //Count the total record
        $perPage = 10;
         
        //Set the limit and offset for a given page.
        $results = DB::table('department')->forPage($page, $perPage)->where('status','=','1')->where('company_id','=',$_GET['m'])->get(['id','department_name','username']);
        $departments = new LengthAwarePaginator($results, $total, $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);
        return view('Hr.viewDepartmentList', ['departments' => $departments]);
	}

	public function editDepartmentForm(){
		return view('Hr.editDepartmentForm');
	}

	public function createSubDepartmentForm(){
		$departments = new Department;
		$departments = $departments::where('company_id','=',$_GET['m'])->orderBy('id')->get();
		return view('Hr.createSubDepartmentForm',compact('departments'));
	}
	
	public function viewSubDepartmentList(){
		$page = LengthAwarePaginator::resolveCurrentPage();
        $total = DB::table('sub_department')->where('status','=','1')->where('company_id','=',$_GET['m'])->count('id'); //Count the total record
        $perPage = 10;
         
        //Set the limit and offset for a given page.
        $results = DB::table('sub_department')->forPage($page, $perPage)->where('status','=','1')->where('company_id','=',$_GET['m'])->get(['id','department_id','sub_department_name','username']);
        $SubDepartments = new LengthAwarePaginator($results, $total, $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);
        return view('Hr.viewSubDepartmentList', ['SubDepartments' => $SubDepartments]);
	}

	public function editSubDepartmentForm(){
		$departments = new Department;
		$departments = $departments::where('company_id','=',$_GET['m'])->orderBy('id')->get();
		return view('Hr.editSubDepartmentForm',compact('departments'));
	}

	public function createDesignationForm(){
		return view('Hr.createDesignationForm');
	}
	
	public function viewDesignationList(){
		$designations = new Designation;
		$designations = $designations::where('company_id','=',$_GET['m'])->orderBy('id')->get();
   		return view('Hr.viewDesignationList',compact('designations'));
	}

	public function createHealthInsuranceForm(){
		return view('Hr.createHealthInsuranceForm');
	}
	
	public function viewHealthInsuranceList(){
		$HealthInsurances = new HealthInsurance;
		$HealthInsurances = $HealthInsurances::where('company_id','=',$_GET['m'])->orderBy('id')->get();
   		return view('Hr.viewHealthInsuranceList',compact('HealthInsurances'));
	}

	
	public function createLifeInsuranceForm(){
		return view('Hr.createLifeInsuranceForm');
	}

	public function viewLifeInsuranceList(){
		$LifeInsurances = new LifeInsurance;
		$LifeInsurances = $LifeInsurances::where('company_id','=',$_GET['m'])->orderBy('id')->get();
   		return view('Hr.viewLifeInsuranceList',compact('LifeInsurances'));
	}


	public function createJobTypeForm(){
		return view('Hr.createJobTypeForm');
	}

	public function viewJobTypeList(){
		$JobTypes = new JobType;
		$JobTypes = $JobTypes::where('company_id','=',$_GET['m'])->orderBy('id')->get();
   		return view('Hr.viewJobTypeList',compact('JobTypes'));
	}

	public function createQualificationForm(){
		$countries = new Countries;
		$countries = $countries::where('status', '=', 1)->get();

		$institutes = new Institute;
		$institutes = $institutes::where('status', '=', 1)->get();
		
		return view('Hr.createQualificationForm',compact('countries','institutes'));
	}

	public function viewQualificationList(){
		$Qualifications = new Qualification;
		$Qualifications = $Qualifications::where('company_id','=',$_GET['m'])->orderBy('id')->get();
   		return view('Hr.viewQualificationList',compact('Qualifications'));
	}

	public function createLeaveTypeForm(){
		return view('Hr.createLeaveTypeForm');
	}

	public function viewLeaveTypeList(){
		$LeaveTypes = new LeaveType;
		$LeaveTypes = $LeaveTypes::where('company_id','=',$_GET['m'])->orderBy('id')->get();
   		return view('Hr.viewLeaveTypeList',compact('LeaveTypes'));
	}

	public function createLoanTypeForm(){
		return view('Hr.createLoanTypeForm');
	}

	public function viewLoanTypeList(){
		$LoanTypes = new LoanType;
		$LoanTypes = $LoanTypes::where('company_id','=',$_GET['m'])->orderBy('id')->get();
   		return view('Hr.viewLoanTypeList',compact('LoanTypes'));
	}

	public function createAdvanceTypeForm(){
		return view('Hr.createAdvanceTypeForm');
	}

	public function viewAdvanceTypeList(){
		$AdvanceTypes = new AdvanceType;
		$AdvanceTypes = $AdvanceTypes::where('company_id','=',$_GET['m'])->orderBy('id')->get();
   		return view('Hr.viewAdvanceTypeList',compact('AdvanceTypes'));
	}

	public function createShiftTypeForm(){
		return view('Hr.createShiftTypeForm');
	}

	public function viewShiftTypeList(){
		$ShiftTypes = new ShiftType;
		$ShiftTypes = $ShiftTypes::where('company_id','=',$_GET['m'])->orderBy('id')->get();
   		return view('Hr.viewShiftTypeList',compact('ShiftTypes'));
	}
	
	

	public function createJobAddForm(){
		$departments = new Department;
		$departments = $departments::where('company_id','=',$_GET['m'])->orderBy('id')->get();
		return view('Hr.createJobAddForm',compact('departments'));
	}

	public function viewJobsList(){
		$jobs = new Job;
		$jobs = $jobs::orderBy('id')->get();
		return view('Hr.viewJobsList',compact('jobs'));
	}
	
	public function createEmployeeForm(){
		Config::set(['database.connections.tenant.database' => Auth::user()->dbName]);
		Config::set(['database.connections.tenant.username' => 'root']);
		Config::set('database.default', 'tenant');
		DB::reconnect('tenant');
		$departments = new Department;
		$departments = $departments::where('company_id','=',$_GET['m'])->orderBy('id')->get();
   		return view('Hr.createEmployeeForm',compact('departments'));
		Config::set('database.default', 'mysql');
		DB::reconnect('mysql');
	}
	
	public function viewEmployeeList(){
		Config::set(['database.connections.tenant.database' => Auth::user()->dbName]);
		Config::set(['database.connections.tenant.username' => 'root']);
		Config::set('database.default', 'tenant');
		DB::reconnect('tenant');
		$employees = new Employee;
		$employees = $employees::orderBy('id')->get();
		$departments = new Department;
		$departments = $departments::where('company_id','=',$_GET['m'])->orderBy('id')->get();
   		return view('Hr.viewEmployeeList',compact('employees','departments'));
		Config::set('database.default', 'mysql');
		DB::reconnect('mysql');
	}
	
	public function createManageAttendanceForm(){
		Config::set(['database.connections.tenant.database' => Auth::user()->dbName]);
		Config::set(['database.connections.tenant.username' => 'root']);
		Config::set('database.default', 'tenant');
		DB::reconnect('tenant');
		$departments = new Department;
		$departments = $departments::where('company_id','=',$_GET['m'])->orderBy('id')->get();
   		return view('Hr.createManageAttendanceForm',compact('departments'));
		Config::set('database.default', 'mysql');
		DB::reconnect('mysql');
	}
	
	public function viewEmployeeAttendanceList(){
		Config::set(['database.connections.tenant.database' => Auth::user()->dbName]);
		Config::set(['database.connections.tenant.username' => 'root']);
		Config::set('database.default', 'tenant');
		DB::reconnect('tenant');
		$employees = new Employee;
		$employees = $employees::orderBy('id')->get();
		$departments = new Department;
		$departments = $departments::where('company_id','=',$_GET['m'])->orderBy('id')->get();
		return view('Hr.viewEmployeeAttendanceList',compact('departments','employees'));
	}
	
	public function createPayslipForm(){
		Config::set(['database.connections.tenant.database' => Auth::user()->dbName]);
		Config::set(['database.connections.tenant.username' => 'root']);
		Config::set('database.default', 'tenant');
		DB::reconnect('tenant');
		$departments = new Department;
		$departments = $departments::where('company_id','=',$_GET['m'])->orderBy('id')->get();
   		return view('Hr.createPayslipForm',compact('departments'));
		Config::set('database.default', 'mysql');
		DB::reconnect('mysql');
	}
	
	public function viewPayslipList(){
		Config::set(['database.connections.tenant.database' => Auth::user()->dbName]);
		Config::set(['database.connections.tenant.username' => 'root']);
		Config::set('database.default', 'tenant');
		DB::reconnect('tenant');
		$departments = new Department;
		$departments = $departments::where('company_id','=',$_GET['m'])->orderBy('id')->get();
   		return view('Hr.viewPayslipList',compact('departments'));
		Config::set('database.default', 'mysql');
		DB::reconnect('mysql');
	}

	
	
}
