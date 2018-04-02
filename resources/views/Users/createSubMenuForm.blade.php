@extends('layouts.default')

@section('content')
	<div class="well">
		<div class="panel">
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
						@include('Users.usersMenu')
					</div>
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
						<div class="well">
							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<span class="subHeadingLabelClass">Add Sub Menu</span>
										</div>
									</div>
									<div class="lineHeight">&nbsp;</div>
									<div class="panel">
										<div class="panel-body">
											<div class="row">
												<?php
													echo Form::open(array('url' => 'uad/addSubMenuDetail','id'=>'addSubMenuForm'));
												?>
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<label>Main Navigation Name</label>
														<select class="form-control" name="main_navigation_name" id="main_navigation_name">
															<option value="">Select Main Navigation</option>
                                    						@foreach($MainMenuTitles as $key => $y)
                                    							<option value="<?php echo $y->id.'_'.$y->title_id?>">{{ $y->title}}</option>
                                    						@endforeach
														
														</select>
													</div>
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<label>Sub Navigation Title Name</label>
														<input type="text" name="sub_navigation_title_name" id="sub_navigation_title_name" value="" class="form-control" />
													</div>
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<label>Sub Navigation Url</label>
														<input type="text" name="sub_navigation_url" id="sub_navigation_url" value="" class="form-control" />
													</div>
													<div>&nbsp;</div>
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														{{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
														<button type="reset" id="reset" class="btn btn-primary">Clear Form</button>
														
														<?php 
															//echo Form::submit('Click Me!');
														?>
													</div>
												<?php
													echo Form::close();
												?>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<span class="subHeadingLabelClass">View Sub Menu</span>
										</div>
									</div>
									<div class="lineHeight">&nbsp;</div>
									<div class="panel">
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="table-responsive">
														<table class="table table-bordered sf-table-list">
   															<thead>
																<th class="text-center">S.No</th>   
                                        						<th class="text-center">Main Navigation</th>
																<th class="text-center">Sub Navigation</th> 
																<th class="text-center">Action</th>
															</thead>
															<tbody id="viewSubMenuList">
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
	$(document).ready(function() {
		function viewSubMenuList(){
			$('#viewSubMenuList').html('<tr><td colspan="4"><div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center"><div class="loader"></div></div></div></div></td><tr>');
			$.ajax({
					url: '<?php echo url('/')?>/udc/viewSubMenuList',
					type: "GET",
					success:function(data) {
						setTimeout(function(){
							$('#viewSubMenuList').html(data);
						},1000);
                    }
                });
		}
		viewSubMenuList();
		
		
		$(function(){
			$('#addSubMenuForm').on('submit',function(e){
    			$.ajaxSetup({
        			header:$('meta[name="_token"]').attr('content')
    			})
    			e.preventDefault(e);

        		$.ajax({
					type:"POST",
        			url:'<?php echo url('/')?>/uad/addSubMenuDetail',
        			data:$(this).serialize(),
        			dataType: 'json',
        			success: function(data){
						alert(data);
            			console.log(data);
					},
        			error: function(data){
					}
    			})
				$("#reset").click();
				viewSubMenuList();
			});
		});
    });
</script>
@endsection