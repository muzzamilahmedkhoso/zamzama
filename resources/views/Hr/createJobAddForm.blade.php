<?php 
	$accType = Auth::user()->acc_type;
	if($accType == 'client'){
		$m = $_GET['m'];
	}else{
		$m = Auth::user()->company_id;
	}
	$d = DB::selectOne('select `dbName` from `company` where `id` = '.$m.'')->dbName
?>
@extends('layouts.default')

@section('content')
	<div class="well">
		<div class="panel">
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
						@include('Hr.'.$accType.'hrMenu')
					</div>
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
						<div class="well">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<span class="subHeadingLabelClass">Post a New Job </span>
										</div>
									</div>
									<div class="lineHeight">&nbsp;</div>
									<?php
										echo Form::open(array('url' => 'had/addJobAddDetail','id'=>'addJobAddForm'));
									?>
									<div class="panel">
										<div class="panel-body">
											<div class="row">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="row">
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
															<input type="hidden" name="jobsSection[]" class="form-control" id="jobsSection" value="1" />
														</div>		
													</div>
													<div class="row">
														<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
															<label class="sf-label">Job Title</label>
															<span class="rflabelsteric"><strong>*</strong></span>
															<input type="text" class="form-control requiredField" placeholder="Job Title" name="job_title" id="job_title" value="" />
														</div>
														<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
															<label class="sf-label">Employer</label>
															<span class="rflabelsteric"><strong>*</strong></span>
															<select class="form-control requiredField" name="employer_id" id="employer_id">
                                    							<option value="">Select Employer</option>
                                    							<option value="1">Oracle Corporation</option>
                                    							<option value="2">Computer Training Ltd</option>
                                    							<option value="3">Amazon.com Inc.</option>
                                    							<option value="4">Dell Inc</option>
                                    						</select>
														</div>
														<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
															<label class="sf-label">Department</label>
															<span class="rflabelsteric"><strong>*</strong></span>
															<select class="form-control requiredField" name="department_id" id="department_id">
		                                    					<option value="">Select Department</option>
		                                    					@foreach($departments as $key => $y)
		                                    						<option value="{{ $y->id}}">{{ $y->department_name}}</option>
		                                    					@endforeach
		                                    				</select>
														</div>
													</div>
													<div class="lineHeight">&nbsp;</div>
													<div class="row">
														<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
															<label class="sf-label">Job Type</label>
															<span class="rflabelsteric"><strong>*</strong></span>
															<select class="form-control requiredField" name="job_type_id" id="job_type_id">
                                    							<option value="">Select Job Type</option>
                                    							<option value="1">Full Time</option>
                                    							<option value="2">Contract</option>
                                    							<option value="3">Part Time</option>
                                    							<option value="4">Internship</option>
                                    							<option value="5">Temp</option>
                                    						</select>
														</div>
														<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
															<label class="sf-label">Apply Start Date</label>
															<span class="rflabelsteric"><strong>*</strong></span>
															<input type="date" class="form-control requiredField" placeholder="Apply Start Date" name="apply_start_date" id="apply_start_date" value="" />
														</div>
														<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
															<label class="sf-label">Apply End Date</label>
															<span class="rflabelsteric"><strong>*</strong></span>
															<input type="date" class="form-control requiredField" placeholder="Apply End Date" name="apply_end_date" id="apply_end_date" value="" />
														</div>
													</div>
													<div class="lineHeight">&nbsp;</div>
													<div class="row">
														<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
															<label class="sf-label">Gender</label>
															<span class="rflabelsteric"><strong>*</strong></span>
															<select class="form-control requiredField" name="gender" id="gender">
                                    							<option value="">Select Gender</option>
                                    							<option value="1">Male</option>
																<option value="2">Female</option>
                                    						</select>
														</div>
														<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
															<label class="sf-label">Salary</label>
															<span class="rflabelsteric"><strong>*</strong></span>
															<input type="number" class="form-control requiredField" placeholder="Salary" name="salary" id="salary" value="" />
														</div>
														<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
															<label class="sf-label">Age</label>
															<span class="rflabelsteric"><strong>*</strong></span>
															<input type="number" class="form-control requiredField" placeholder="Age" name="age" id="age" value="" />
														</div>
													</div>
													<div class="lineHeight">&nbsp;</div>
													<div class="row">
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
															<label class="sf-label">Job Description</label>
															<span class="rflabelsteric"><strong>*</strong></span>
															<textarea id="job_description" name="job_description" class="form-control requiredField" style="resize: none;" rows="10"></textarea>
														</div>
													</div>
												</div>
												
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
											{{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
											<button type="reset" id="reset" class="btn btn-primary">Clear Form</button>
										</div>
									</div>
									<?php echo Form::close();?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
    $(document).ready(function() {
    	$(".btn-success").click(function(e){
			var jobs = new Array();
			var val;
			$("input[name='jobsSection[]']").each(function(){
    			jobs.push($(this).val());
			});
			var _token = $("input[name='_token']").val();
			for (val of jobs) {
				
				jqueryValidationCustom();
				if(validate == 0){
					//alert(response);
				}else{
					return false;
				}
			}
		});
    });
</script>
@endsection