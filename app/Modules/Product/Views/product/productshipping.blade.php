@extends('Admin::layouts.master')
@section('body')


<div class="row">
<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


<div class="block-header block-header-2">
	<h2 class="pull-left">
		Product Seo Update
	</h2>
	<a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
	<a style="margin-left: 10px;" href="{{route('admin.product.create')}}" class="btn btn-primary waves-effect pull-right">Add Product</a>
	<a  style="margin-left: 10px;" href="{{ route('admin.product.active') }}" class="btn btn-success waves-effect pull-right">Active Product</a>
	<a   style="margin-left: 10px;"href="{{ route('admin.product.inactive') }}" class="btn btn-warning waves-effect pull-right">InActive Product</a>
	<a  style="margin-left: 10px;"href="{{ route('admin.product.cancel') }}" class="btn btn-danger waves-effect pull-right">Cancel Product</a>
			            
</div>

<label>Attribute set :</label>	{{isset($data->relAttribute->title)?ucfirst($data->relAttribute->title):''}}  || 
<label>Type :</label>	{{ $data->type}} 


<div class="block-header m-t-10">
	@include('Product::product.menu_bar',
				[
					'current_tab' => 'product_shipping'
				])
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                   LIST OF SHIPPING AREA AND COST
                </h2>
                

                 <a data-toggle="modal"  data-color="blue" href="#open_modal" class="btn btn-primary waves-effect pull-right" style="margin-top: -26px;"><i class="material-icons">exposure_plus_1</i> Add Shipping</a>


            </div>
            <div class="body">
                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example">

		                <thead>
		                    <tr>
		                    	<th> No</th>
		                    	<th> Division Name </th>
		                    	<th> District Name </th>
		                    	<th> Thana Name </th>                        
		                    	<th> Delivery Day </th>
		                    	<th> Delivery Cost </th>
		                    	<th> Action </th>
		                    </tr>
		                </thead>

		                    	<tbody>
			                	@if(count($ps_data) > 0)
			                		<?php
			                			$serial = 1;
			                		?>
			                		@foreach($ps_data as $data)
			                			<tr>
			                				<td>
			                					{{$serial}}
			                				</td>
			                				<td>
			                					@foreach($ddt_data as $data_division)
				                					@if ($data_division->checkid==$data->division_id)
				                							
				                							{{$data_division->name}}
				                						
				                					@endif
			                					@endforeach
			                					
			                				</td>
			                                <td>
			                                   @foreach($ddt_data as $data_division)
				                					@if ($data_division->checkid==$data->district_id)
				                							
				                							{{$data_division->name}}
				                						
				                					@endif
			                					@endforeach
			                                </td>
			                				<td>
			                					 @foreach($ddt_data as $data_division)
				                					@if ($data_division->checkid==$data->thana_id)
				                							
				                							{{$data_division->name}}
				                						
				                					@endif
			                					@endforeach
			                				</td>
			                                	
			                                 <td>
			                					{{$data->deliver_day}}
			                                 
			                                </td>
			                				<td>
			                					{{$data->deliver_cost}}
			                				</td>
			                				
			                				<td>
			                					
			                                    <a data-href="{{ route('admin.product.shipping.edit', $data->id) }}" class="open-shipping-modal demo-google-material-icon mousepointer"><i class="material-icons">border_color</i></a>
			                                    

			                                    <a href="{{ route('admin.product.shipping.destroy', $data->id) }}" class="demo-google-material-icon" onclick="return confirm('Are you sure to Delete?')" ><i class="material-icons">delete</i></a>
			                				</td>
			                			</tr>
			                			<?php
				                			$serial++;
				                		?>
			                		@endforeach
			                	@endif
                		</tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="open_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Product Shipping</h4>
            </div>
            <div class="modal-body">
				
				  {!! Form::open(['route' => 'admin.product.shipping.store',  'files'=> true, 'id'=>'', 'class' => 'form-horizontal product_shipping_form']) !!}

				  @include('Product::product._product_shipping_form')

				  <input type="hidden" name="product_id" value="{{$product_id}}">

            	{!! Form::close() !!}
            </div>
           
        </div>
    </div>
</div>

<div class="modal fade open_modal_update" tabindex="" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg">
       
        <div class="modal-content">
             <div class="modal-header">
                <h4>Product shipping update</h4>
            </div>
            <div class="modal-body">
                
            </div>
        </div>
    </div> 
</div>

<script type="text/javascript">
	function custom_validate(){

        var elements = $("input[type!='submit'], textarea, select");
        elements.focus(function() {
            $(this).parents('li').addClass('highlight');
        });
        elements.blur(function() {
            $(this).parents('li').removeClass('highlight');
        });

        $("#product_shipping_form").validate({
          rules:{
            
            division_id:{
              required:true
            },
            district_id:{
              required:true
            },

            thana_id:{
              required:true
            },
            deliver_day:{
              required:true
            },
            deliver_cost:{
              required:true
            },
            
          },
          messages:{
            division_id:'Please select division',
            district_id: 'Plese select district',
            
            thana_id:'Plese select thana',
            deliver_day: 'Plese enter deliver day',
            deliver_cost: 'Plese enter deliver day'
          }
        });

  }

  custom_validate();

$(document).delegate('.open-shipping-modal','click',function () {

        var url = $(this).attr('data-href');
        var id = '';

        $.ajax({
            url: url,
            method: "GET",
            data: {id:id},
            dataType: "json",
            beforeSend: function( xhr ) {

            }
        }).done(function( response ) {
            if(response.result == 'success'){

                $('.open_modal_update .modal-body').html(response.content);
                
                $('.open_modal_update').modal('show');

            }else{

            }
        }).fail(function( jqXHR, textStatus ) {

        });


        return false;


    });


</script>
@endsection