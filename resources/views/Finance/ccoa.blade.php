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
									<?php
        								echo Form::open(array('url' => 'finance/ccoa_detail'));
            								echo Form::text('cName','Category Name');
            								echo '<br/>';
            								echo Form::submit('Click Me!');
         								echo Form::close();
      								?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection