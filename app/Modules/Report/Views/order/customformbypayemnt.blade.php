
<div class="row clearfix">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
			{!! Form::open(['route' => 'admin.order.custom.bypayment.form.submit', 'id'=>'orderreport', 'class' => 'form-horizontal']) !!}
			<?php
				
				$order_status =  [
						
						'pending' => 'Pending',
						'confirmed' => 'Confirmed',
						'processing' => 'Processing',
						'on_transit' => 'On Transit',
						'delivered' => 'Delivered',
						'delivery_failed' => 'Delivered Failed',
						'returned' => 'Returned',
						'cancel' => 'Cancel'
					];

				$payment_type =  [
						
						'cod' => 'Cash on delivery',
						'foster_payment' => 'Online payment',
					];
				?>
				<div class="row">
					<div class="col-md-12 pr-0">
						<div class="form-group">

							<div class="form-line">
								<label>Select Payment Type</label>

							{!! Form::Select('payment_type',$payment_type,Input::old('payment_type'),['id'=>'payment_type', 'class'=>'form-control ','placeholder'=>'Select payment type']) !!}
								
							</div>
						</div>
					</div>

					<div class="col-md-12 pr-0">
						<div class="form-group">

							<div class="form-line">
								<label>Select Status</label>

							{!! Form::Select('status',$order_status,Input::old('status'),['id'=>'status', 'class'=>'form-control ','placeholder'=>'Select status']) !!}
								
							</div>
						</div>
					</div>

					
					
					<div class="col-md-12 pr-0">
						<div class="form-group">

							<div class="form-line">
								
								<label>&nbsp;</label><br/>
								{!! Form::submit('Search', array('class'=>'btn btn-w-lg btn-info','id'=>'button', 'data-placement'=>'right', 'data-content'=>'type code or title or both in specific field then click search button for required information')) !!}
								
							</div>
						</div>
					</div>
				</div>

				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

