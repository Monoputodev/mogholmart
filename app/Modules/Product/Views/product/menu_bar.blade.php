
<div class="form-line" >
	<a href="{{route('admin.product.edit',$data->id)}}" class="btn <?=$current_tab == 'basic-information'?'btn-success':'btn-info'?> btn-sm font-10 m-t-10"><i class=" material-icons">person</i>
	<span>Basic Information </span></a>

	<a href="{{route('admin.product.inventory',$data->id)}}" class="btn <?=$current_tab == 'inventory'?'btn-success':'btn-info'?> btn-sm font-10 m-t-10"><i class=" material-icons">trending_up</i>
	<span>Inventory </span></a>

	<a href="{{route('admin.product.image',$data->id)}}" class="btn <?=$current_tab == 'image'?'btn-success':'btn-info'?> btn-sm font-10 m-t-10"><i class=" material-icons">image</i>
	<span>Image </span></a>

	<a href="{{route('admin.product.details', $data->id)}}" class="btn <?=$current_tab == 'description'?'btn-success':'btn-info'?> btn-sm font-10 m-t-10"><i class=" material-icons">description</i>
	<span>Description </span></a>

	

	<a href="{{route('admin.product.category',$data->id)}}" class="btn <?=$current_tab == 'category'?'btn-success':'btn-info'?> btn-sm font-10 m-t-10"><i class=" material-icons">list</i>
	<span>Category </span></a>

	<a href="{{route('admin.product.attribute',$data->id)}}" class="btn <?=$current_tab == 'attribute'?'btn-success':'btn-info'?> btn-sm font-10 m-t-10"><i class=" material-icons">vpn_key</i>
	<span>Attribute </span></a>
	
	
	<a href="{{route('admin.product.seo',$data->id)}}" class="btn <?=$current_tab == 'seo'?'btn-success':'btn-info'?> btn-sm font-10 m-t-10"><i class=" material-icons">search</i>
	<span>Seo </span></a>


	<!--<a href="{{route('admin.product.emi',$data->id)}}" class="btn <?=$current_tab == 'product_emi'?'btn-success':'btn-info'?> btn-sm font-10 m-t-10"><i class=" material-icons">attach_money</i>
	<span>EMI </span></a> -->
	
	<a href="{{route('admin.product.review',$data->id)}}" class="btn <?=$current_tab == 'product_review'?'btn-success':'btn-info'?> btn-sm font-10 m-t-10"><i class=" material-icons">forum</i>
	<span>Review </span></a>
	
	<a href="{{route('admin.product.preview',$data->id)}}" class="btn <?=$current_tab == 'product_preview'?'btn-success':'btn-info'?> btn-sm font-10 m-t-10"><i class=" material-icons">remove_red_eye</i>
	<span>Preview </span></a>

</div>
