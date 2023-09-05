{!! Form::model($product_shipping,['method' => 'PATCH', 'files'=> true, 'route'=> ['admin.product.shipping.update',$product_shipping->id]," class"=>"", 'id' => 'product_shipping_form']) !!}

		@include('Product::product._product_shipping_form')

		<input type="hidden" name="product_id" value="{{$product_id}}">

{!! Form::close() !!}