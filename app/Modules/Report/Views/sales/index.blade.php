@extends('Admin::layouts.master')
@section('body')

<div class="block-header block-header-2">
	<h2 class="pull-left">
		Order Search
	</h2>

	<a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>

</div>
	

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">

			<div class="body">
				{!! Form::open(['method' =>'GET', 'route' => 'admin.sales.search']) !!}
				
				<div class="input-group">

					<div class="col-md-4 col-sm-2" >
						<div class="form-line">
							
							<label>From Date</label>
							{!! Form::text('from_date',isset($_GET['from_date']) ? $_GET['from_date']: Input::old('from_date'),['id'=>'from_date', 'class'=>'form-control', 'placeholder'=>'From']) !!}
						</div>

					</div>

					<div class="col-md-4 col-sm-2" >
						<div class="form-line">
							
							<label>To Date</label>
							{!! Form::text('to_date',isset($_GET['to_date']) ? $_GET['to_date']: Input::old('to_date'),['id'=>'to_date', 'class'=>'form-control ','placeholder'=>'To']) !!}
						</div>

					</div>	
					

					<div class="col-md-4 col-sm-2">
						

						<label>&nbsp;</label><br/>
						{!! Form::submit('Search', array('class'=>'btn btn-w-lg btn-info','id'=>'button', 'data-placement'=>'right', 'data-content'=>'type code or title or both in specific field then click search button for required information')) !!}
						

					</div>

				</div>


				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>



<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					LIST OF SALES DATA
					<input  class="btn btn-warning waves-effect pull-right" type="button" onclick="tableToExcel('testTable', 'TODAYS TOTAL ORDER LIST')" value="Export to Excel" style="height: 30px; margin-left: 10px;">

					<button class="btn btn-info waves-effect pull-right" style="margin-left:10px;">Export to PDF</button>
				</h2>

				
			</div>
			<div class="body">
				<div class="table-responsive">

					<table class="table table-bordered table-striped"  id="testTable" name="Data Table">
                        <caption> {{$pageTitle}}</caption><colgroup align="center"></colgroup><colgroup align="left"></colgroup><colgroup span="2" align="center"></colgroup><colgroup span="3" align="center"></colgroup>

						<thead>
							<tr>
								<th> SL.No</th>
								<th> Invoice No. </th>
								<th> Date </th>
								<th> Product</th>
								<th> Price</th>
								
								<th> Delivery Cost</th>
								<th> Total Price</th>
							</tr>
						</thead>

						<tbody>
						    <?php
						        $total = 0;
						        $total_shipping_value = 0;
						    ?>

							@if(!empty($data))

							
							@foreach($data as $key => $values)

							<?php
								$order_items = $values::getOrderItems($values);
								 

								if ($values->relOrderDetail){

										$cashback=0;
										

										foreach ($values->relOrderDetail as $key => $details) {

											$cashback += $details->cash_back;

											
										}

								}

								$total += $values->total_price+$values->shipping_value-$values->coupon_code_value;
								$total_shipping_value += $values->shipping_value;
							 	
							?>
							<tr>
								<td>{{$key+1}}</td>
								
								<td>{{$values->order_number}}</td>
								<td>{{ date('M d, Y',strtotime($values->date)) }}</td>
								<td>
									

									@if(count($order_items) > 0)
									@foreach($order_items as $item)

									
									
									<strong>{{ $item->product_title }}</strong><br/>
									<small>QTY: {{ $item->quantity }}&nbsp;&nbsp;&nbsp;&nbsp;Item No: {{$item->item_no}}
									</small>

									<br/>
									
									@endforeach
									@endif

								
								</td>

								<td>
									{{ __('messages.tk') }}  {{number_format($values->total_price,2)}}
								</td>


								
								<td>
									{{ __('messages.tk') }}  {{number_format($values->shipping_value,2)}}
								</td>

								<td>
									{{ __('messages.tk') }}  {{number_format( ($values->total_price + $values->shipping_value) - $values->coupon_code_value,2)}}
								</td>
							</tr>

							@endforeach
							@endif

						</tbody>
						<tfoot>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								
								<td>Total :: {{ __('messages.tk') }} {{number_format($total_shipping_value,2)}} </td>
								<td>Total :: {{ __('messages.tk') }} {{number_format($total,2)}}</td>
								
							</tr>
						</tfoot>

					</table>
					<table>
						
						<thead>
							<tr>
								<th>{{$data->links()}}</th>
							</tr>
						</thead>
						
					</table>
				</div>

			</div>
		</div>

	</div>
</div>

<script type="text/javascript">
    
    var tableToExcel = (function() {
      var uri = 'data:application/vnd.ms-excel;base64,'
      , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
      , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
      , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
      return function(table, name) {
        if (!table.nodeType) table = document.getElementById(table)
            var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
        window.location.href = uri + base64(format(template, ctx))
    }
})()

function printData()
{
   var divToPrint=document.getElementById("testTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('button').on('click',function(){
printData();
})
</script>

<script type="text/javascript">
	$('#from_date').datepicker({
		language: 'en',
        dateFormat: 'yyyy-mm-dd',
        autoClose: true,
	});
	$('#to_date').datepicker({
		language: 'en',
        dateFormat: 'yyyy-mm-dd',
        autoClose: true,
	});

</script>

<script type="text/javascript">

	$('#data-table-responsive').attr('data-page-length','50');


</script>	
@endsection