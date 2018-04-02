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
						@include('Finance.financeMenu')
					</div>
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
						<div class="well">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<span class="subHeadingLabelClass">Create Cash Payment Voucher Form</span>
								</div>
							</div>
							<div class="lineHeight">&nbsp;</div>
							<div class="row">
								<?php echo Form::open(array('url' => 'fad/addCashPaymentVoucherDetail'));?>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="panel">
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<input type="hidden" name="pvsSection[]" class="form-control" id="pvsSection" value="1" />
												</div>		
											</div>
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="row">
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
															<label class="sf-label">Slip No.</label>
															<input type="text" class="form-control" placeholder="Slip No" name="slip_no_1" id="slip_no_1" value="" />
														</div>
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
															<label class="sf-label">PV Date.</label>
															<span class="rflabelsteric"><strong>*</strong></span>
															<input type="date" class="form-control" max="<?php echo date('Y-m-d') ?>" name="pv_date_1" id="pv_date_1" value="<?php echo date('Y-m-d') ?>" />
														</div>
													</div>	
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="row">
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
															<label class="sf-label">Description</label>
                											<span class="rflabelsteric"><strong>*</strong></span>
															<textarea name="description_1" id="description_1" style="resize:none;" class="form-control"></textarea>
														</div>
													</div>
												</div>
											</div>
											<div class="lineHeight">&nbsp;</div>
											<div class="well">
												<div class="panel">
													<div class="panel-body">
														<div class="row">
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																<div class="table-responsive">
																	<table id="buildyourform" class="table table-bordered">
																		<thead>
																			<tr>
																				<th class="text-center">Account Head <span class="rflabelsteric"><strong>*</strong></span></th>
																				<th class="text-center" style="width:150px;">Debit <span class="rflabelsteric"><strong>*</strong></span></th>
																				<th class="text-center" style="width:150px;">Credit <span class="rflabelsteric"><strong>*</strong></span></th>
																				<th class="text-center" style="width:150px;">Action</th>
																			</tr>
																		</thead>
																		<tbody class="addMorePvsDetailRows_1" id="addMorePvsDetailRows_1">
																			<?php for($j = 1 ; $j <= 2 ; $j++){?>
																			<input type="hidden" name="pvsDataSection_1[]" class="form-control" id="pvsDataSection_1" value="<?php echo $j?>" />
																			<tr>
																				<td>
																					<select class="form-control" name="account_id_1_<?php echo $j?>" id="account_id_1_<?php echo $j?>">
                                    													<option value="">Select Account</option>
                                    													@foreach($accounts as $key => $y)
                                    														<option value="{{ $y->id}}">{{ $y->code .' ---- '. $y->name}}</option>
                                    													@endforeach
                                    												</select>
																				</td>
																				<td>
																					<input onfocus="disable('c_amount_1_<?php echo $j ?>','d_amount_1_<?php echo $j ?>');" placeholder="Debit" class="form-control d_amount_1" maxlength="15" min="0" type="number" name="d_amount_1_<?php echo $j ?>" id="d_amount_1_<?php echo $j ?>" onkeyup="sum('1')" value="" required="required"/>
																				</td>
																				<td>
																					<input onfocus="disable('d_amount_1_<?php echo $j ?>','c_amount_1_<?php echo $j ?>');" placeholder="Credit" class="form-control c_amount_1" maxlength="15" min="0" type="number" name="c_amount_1_<?php echo $j ?>" id="c_amount_1_<?php echo $j ?>" onkeyup="sum('1')" value="" required="required"/>
																				</td>
																				<td class="text-center">---</td>
																			</tr>
																			<?php }?>
																		</tbody>
																	</table>
																	<table class="table table-bordered">
																		<tbody>
																			<tr>
																				<td></td>
																				<td style="width:150px;">
																					<input 
                  																	type="number"
                  																	readonly="readonly"
                  																	id="d_t_amount_1"
                                        											maxlength="15"
                                       	 											min="0"
                  																	name="d_t_amount_1" 
                               														class="form-control text-right"
                  																	value=""/>
																				</td>
																				<td style="width:150px;">
																					<input 
                  																	type="number"
                  																	readonly="readonly"
                  																	id="c_t_amount_1"
                                        											maxlength="15"
                                       	 											min="0"
                  																	name="c_t_amount_1" 
                               														class="form-control text-right"
                  																	value=""/>
																				</td>
																				<td style="width:150px;"></td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
													<input type="button" class="btn btn-sm btn-primary" onclick="addMorePvsDetailRows('1')" value="Add More PV's Rows" />
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="pvsSection"></div>
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
										{{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
										<button type="reset" id="reset" class="btn btn-primary">Clear Form</button>
										<input type="button" class="btn btn-sm btn-primary addMorePvs" value="Add More PV's Section" />
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
<script>
    $(document).ready(function() {
		var p = 1;
		$('.addMorePvs').click(function (e){
			e.preventDefault();
        	p++;
			$.ajax({
				url: '<?php echo url('/')?>/fmfal/makeFormCashPaymentVoucher',
				type: "GET",
				data: { id:p},
				success:function(data) {
					$('.pvsSection').append('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="cashPvs_'+p+'"><a href="#" onclick="removePvsSection('+p+')" class="btn btn-xs btn-danger">Remove</a><div class="lineHeight">&nbsp;</div><div class="panel"><div class="panel-body">'+data+'</div></div></div>');
              	}
          	});
		});
	});
	var x = 2;
	function addMorePvsDetailRows(id){
		x++;
		$.ajax({
			url: '<?php echo url('/')?>/fmfal/addMoreCashPvsDetailRows',
			type: "GET",
			data: { counter:x,id:id},
			success:function(data) {
				$('.addMorePvsDetailRows_'+id+'').append(data);
          	}
      	});
	}
	
	function removePvsRows(id,counter){
		var elem = document.getElementById('removePvsRows_'+id+'_'+counter+'');
    	elem.parentNode.removeChild(elem);
	}
	function removePvsSection(id){
		var elem = document.getElementById('cashPvs_'+id+'');
    	elem.parentNode.removeChild(elem);
	}
	function disable(disable,enable){
		if ($('#'+disable).val() == ""){		
			$('#'+disable).attr('readonly','readonly');
			$('#'+disable).removeAttr('required','required');	
			$('#'+disable).val("");	
			$('#'+enable).removeAttr('readonly');	
			$('#'+enable).attr('required','required');
		}
	};
</script>
@endsection