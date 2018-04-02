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
	<?php 
		$currentDate = date('Y-m-d');
	?>
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
									<span class="subHeadingLabelClass">Create Job Type Form</span>
								</div>
							</div>
							<div class="lineHeight">&nbsp;</div>
							<?php echo Form::open(array('url' => 'had/addJobTypeDetail?m='.$m.'&&d='.$d.'','id'=>'jobTypeForm'));?>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="panel">
									<div class="panel-body">
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<input type="hidden" name="jobTypeSection[]" class="form-control" id="jobTypeSection" value="1" />
											</div>		
										</div>
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<label>Job Type Name:</label>
												<span class="rflabelsteric"><strong>*</strong></span>
												<input type="text" name="job_type_name_1" id="job_type_name_1" value="" class="form-control requiredField" />
											</div>
										</div>
									</div>
								</div>
								<div class="lineHeight">&nbsp;</div>
								<div class="jobTypeSection"></div>
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
										{{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
										<button type="reset" id="reset" class="btn btn-primary">Clear Form</button>
										<input type="button" class="btn btn-sm btn-primary addMoreJobTypeSection" value="Add More Job Type Section" />
									</div>
								</div>
							<?php echo Form::close();?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
    $(document).ready(function() {
		var jobType = 1;
		$('.addMoreJobTypeSection').click(function (e){
			e.preventDefault();
        	jobType++;
			
			$.ajax({
				url: '<?php echo url('/')?>/hmfal/makeFormJobTypeDetail',
				type: "GET",
				data: { id:jobType},
				success:function(data) {
					$('.jobTypeSection').append('<div id="sectionJobType_'+jobType+'"><a href="#" onclick="removeJobTypeSection('+jobType+')" class="btn btn-xs btn-danger">Remove</a><div class="lineHeight">&nbsp;</div><div class="panel"><div class="panel-body">'+data+'</div></div></div>');
              	}
          	});
		});
		
		// Wait for the DOM to be ready
		$(".btn-success").click(function(e){
			var jobType = new Array();
			var val;
			$("input[name='jobTypeSection[]']").each(function(){
    			jobType.push($(this).val());
			});
			var _token = $("input[name='_token']").val();
			for (val of jobType) {
				
				jqueryValidationCustom();
				if(validate == 0){
					//alert(response);
				}else{
					return false;
				}
			}
			
		});
		
	});
	
	function removeJobTypeSection(id){
		var elem = document.getElementById('sectionJobType_'+id+'');
    	elem.parentNode.removeChild(elem);
	}
</script>
@endsection