@extends('Admin::layouts.master')
@section('body')

<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>

<div class="block-header block-header-2">
	<h2 class="pull-left">
		Product Preview.
	</h2> 
	<a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
    <a style="margin-left: 10px;" href="{{route('admin.product.create')}}" class="btn btn-primary waves-effect pull-right">Add Product</a>
    <a  style="margin-left: 10px;" href="{{ route('admin.product.active') }}" class="btn btn-success waves-effect pull-right">Active Product</a>
    <a   style="margin-left: 10px;"href="{{ route('admin.product.inactive') }}" class="btn btn-warning waves-effect pull-right">InActive Product</a>
    <a  style="margin-left: 10px;"href="{{ route('admin.product.cancel') }}" class="btn btn-danger waves-effect pull-right">Cancel Product</a>
    
	</br> 
	<label>Attribute set :</label>	{{isset($headerData->relAttribute->title)?ucfirst($headerData->relAttribute->title):''}}  || 
				<label>Type :</label>	{{ $headerData->type}}

				@include('Product::product.menu_bar',
				[
					'current_tab' => 'product_preview'
				])
				            
</div>


<div class="row clearfix">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
				<div class="table-responsive">  
                   
                <table id="" class="table table-bordered  table-striped">
                    <tr>
                        <th>Title</th>
                        <td>{{ isset($data->product_title)?ucfirst($data->product_title):''}}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ isset($data->product_slug)?ucfirst($data->product_slug):''}}</td>
                    </tr>
                    
                    <tr>
                        <th>Manufacturer</th>
                        <td>{{ isset($data->manufacturer)?ucfirst($data->manufacturer):''}}</td>
                    </tr>
                    <tr>
                        <th>Brand</th>
                        <td>{{ isset($data->brand)?ucfirst($data->brand):''}}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{{ isset($data->category_title)?ucfirst($data->category_title):''}}</td>
                    </tr>
                    
                    <tr>
                        <th>Item No</th>
                        <td>{{ isset($data->item_no)?ucfirst($data->item_no):''}}</td>
                    </tr>
                    <tr>
                        <th> Price</th>
                        <td>{{ isset($data->sell_price)?ucfirst($data->sell_price):''}}</td>
                    </tr>
                    <tr>
                        <th>List Price</th>
                        <td>{{ isset($data->list_price)?ucfirst($data->list_price):''}}</td>
                    </tr> 
                    <tr>
                        <th>Offer Price</th>
                        <td>{{ isset($data->offer_price)?ucfirst($data->offer_price):''}}</td>
                    </tr> 
                    <tr>
                        <th>Short Description</th>
                        <td>{!! $data->short_description !!}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{!! $data->description !!}</td>
                    </tr>
                     <tr>
                        <th>Specification</th>
                        <td>{!! $data->specifition !!}</td>
                    </tr>
                     <tr>
                        <th>Stock</th>
                        <td>{{ isset($data->quantity)?ucfirst($data->quantity):''}}</td>
                    </tr> 

                    <tr>
                        <th>Meta Titile</th>
                        <td>{{ isset($data->meta_title)?ucfirst($data->meta_title):''}}</td>
                    </tr> 
                    <tr>
                    	<th>Meta keywords</th>
                    	<td>{{ isset($data->meta_keywords)?ucfirst($data->meta_keywords):''}}</td>
                    </tr> 

                    <tr>
                    	<th>Image</th>
                    	<td>@if (isset($imagedata) && !empty($imagedata))
                    		@foreach ($imagedata as $image)
                    		<div class="col-md-1 imgdiv" >
                    			<img width="100" class="img img-responsive" src="{{URL::to($image->image_link)}}/200x200/{{$image->image}}" style="border: 1px solid;">
                    			
                    			
                    			</div>
                    			@endforeach
                    			@endif
                    		</td>
                    </tr> 

                   
                   


                </table>
          
        <!-- end panel-body -->
    </div>
    <!-- end panel -->


			</div>
		</div>
	</div>
</div>
@endsection