@extends('layouts.default')

@section('content')
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
									<span class="subHeadingLabelClass">View Bank Receipt Voucher List</span>
								</div>
							</div>
							<div class="lineHeight">&nbsp;</div>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="panel">
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="table-responsive">
														<table class="table table-bordered sf-table-list">
   															<thead>
																<th class="text-center">S.No</th>   
                                        						<th class="text-center">R.V. No.</th>
																<th class="text-center">R.V. Date</th>        
																<th class="text-center">Debit/Credit</th>
																<th class="text-center">Amount</th>
																<th class="text-center">Total Amount</th>
																<th class="text-center">Action</th>
															</thead>
															<tbody>
																<?php 
																	$counter = 1;
																	$makeTotalAmount = 0;
																?>
																@foreach($rvs as $key => $y)
																	<tr>
																		<td class="text-center"><?php echo $counter++;?></td>
																		<td class="text-center">{{ $y->rv_no}}</td>
																		<td class="text-center">{{ $y->rv_date}}</td>
																		<td class="text-center">
																		<?php 
																			Config::set(['database.connections.tenant.database' => Auth::user()->dbName]);
																			Config::set(['database.connections.tenant.username' => 'root']);
																			Config::set('database.default', 'tenant');
																			DB::reconnect('tenant');
																			$d_acc = DB::selectOne('select accounts.name name 
																			from `rv_data` 
																			inner join `accounts` on accounts.id = rv_data.acc_id 
																			where rv_data.debit_credit = 1 and rv_data.rv_no = \''.$y->rv_no.'\' and rv_data.status = 1')->name;				
																			$c_acc = DB::selectOne('select accounts.name name 
																			from `rv_data` 
																			inner join `accounts` on accounts.id = rv_data.acc_id 
																			where rv_data.debit_credit = 0 and rv_data.rv_no = \''.$y->rv_no.'\' and rv_data.status = 1')->name;				
																			
																			$debit_amount = DB::selectOne(
																			"select sum(`amount`) total from `rv_data` where `debit_credit` = 1 
																			and `status` = 1 
																			and `rv_no` = '".$y->rv_no."'")->total;
																			
																			$credit_amount = DB::selectOne(
																			"select sum(`amount`) total from `rv_data` where `debit_credit` = 0 
																			and `status` = 1 
																			and `rv_no` = '".$y->rv_no."'")->total;				
																			echo 'Dr = '.$d_acc.'['.number_format($debit_amount,0).'] / Cr = '.$c_acc.'['.number_format($credit_amount,0).']';				
																		?>
																		</td>
																		<td class="text-right">
																			<?php $makeTotalAmount += $debit_amount;?>
																			<?php echo number_format($debit_amount,0);?>
																		</td>
																		<td class="text-right">
																			<?php echo number_format($makeTotalAmount,0);?>
																		</td>
																		<td class="text-center">
																			<a onclick="showDetailModelOneParamerter('fdc/viewBankReceiptVoucherDetail','<?php echo $y->pv_no;?>','View Bank R.V Detail')" class="btn btn-xs btn-success">View</a>
																		</td>
																	</tr>
																@endforeach
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
@endsection