{!! Form::model($product_category, ['method' => 'PATCH', 'files'=> true, "class"=>"", 'id' => 'product_category_form']) !!}

<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>

<div class="row">

	<div class="form-line">

		<ul class="product-category">
			@if(isset($category_lists) && count($category_lists) > 0)

			@foreach($category_lists as $key => $category)

			<?php
			$select_category = 'no';
			if(in_array($key, $product_category)){
				$select_category = 'yes';
			}
			?>

			<li>
				<input <?=$select_category=='yes'?'checked':''?> type="checkbox" id="category" name="category[]" value="{{$key}}">
				<span>{{$category}}</span>

			</li>

			@endforeach

			@endif

		</ul> 
	</div>
	<div class="col-md-6 offset-md-6">

		<div class="form-group">
			<div class="col-md-12">
				<input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
				<input type="submit" name="save_continue" class="btn btn-primary pull-right btn-sm font-10 m-r-15" value="Save Change">

			</div>
		</div>
	</div>
</div>




<style type="text/css">
  ul.product-category{
    margin:0;
    padding: 0;
    height: 380px;
    overflow: auto;
  }

  ul.product-category li{
    list-style: none;
    width: 100%;
    display: inline-block;
    margin-bottom: 5px;
  }

  ul.product-category li input{
    float: left;
    margin-right: 10px;
  }

  ul.product-category li span{
    float: left;
  }

</style>

{!! Form::close() !!}