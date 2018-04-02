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
									<span class="subHeadingLabelClass">Create Leave Type Form</span>
								</div>
							</div>
							<div class="lineHeight">&nbsp;</div>
							<?php echo Form::open(array('url' => 'had/addLeaveTypeDetail?m='.$m.'&&d='.$d.'','id'=>'leaveTypeForm'));?>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="panel">
									<div class="panel-body">
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<input type="hidden" name="leaveTypeSection[]" class="form-control" id="leaveTypeSection" value="1" />
											</div>		
										</div>
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<label>Leave Type Name:</label>
												<span class="rflabelsteric"><strong>*</strong></span>
												<input type="text" name="leave_type_name_1" id="leave_type_name_1" value="" class="form-control requiredField" />
											</div>
										</div>
									</div>
								</div>
								<div class="lineHeight">&nbsp;</div>
								<div class="leaveTypeSection"></div>
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
										{{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
										<button type="reset" id="reset" class="btn btn-primary">Clear Form</button>
										<input type="button" class="btn btn-sm btn-primary addMoreLeaveTypeSection" value="Add More Leave Type Section" />
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
		var leaveType = 1;
		$('.addMoreLeaveTypeSection').click(function (e){
			e.preventDefault();
        	leaveType++;
			
			$.ajax({
				url: '<?php echo url('/')?>/hmfal/makeFormLeaveTypeDetail',
				type: "GET",
				data: { id:leaveType},
				success:function(data) {
					$('.leaveTypeSection').append('<div id="sectionLeaveType_'+leaveType+'"><a href="#" onclick="removeLeaveTypeSection('+leaveType+')" class="btn btn-xs btn-danger">Remove</a><div class="lineHeight">&nbsp;</div><div class="panel"><div class="panel-body">'+data+'</div></div></div>');
              	}
          	});
		});
		
		// Wait for the DOM to be ready
		$(".btn-success").click(function(e){
			var leaveType = new Array();
			var val;
			$("input[name='leaveTypeSection[]']").each(function(){
    			leaveType.push($(this).val());
			});
			var _token = $("input[name='_token']").val();
			for (val of leaveType) {
				
				jqueryValidationCustom();
				if(validate == 0){
					//alert(response);
				}else{
					return false;
				}
			}
			
		});
		
	});
	
	function removeLeaveTypeSection(id){
		var elem = document.getElementById('sectionLeaveType_'+id+'');
    	elem.parentNode.removeChild(elem);
	}
</script>
@endsection