@extends('Admin::layouts.master')
@section('body')

<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;

if(Session::has('image_size')){
    $image_size=Session::get('image_size');
}else{
    $image_size='1000x1000';
}

?>

<div class="block-header block-header-2">
<h2 class="pull-left">
Product Update
</h2> 
<a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>

</div>
<label>Attribute set :</label>	{{isset($data->relAttribute->title)?ucfirst($data->relAttribute->title):''}}  || 
<label>Type :</label>	{{ $data->type}}

<div class="block-header m-t-10">

@include('Product::product.menu_bar',
[
'current_tab' => 'image'
])
</div>
<div class="row clearfix">

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="card">
	<div class="body">

		{!! Form::model($data, ['method' => 'PATCH', 'files'=> true, 'route'=> ['admin.product.update_image', $data->id],"class"=>"", 'id' => '']) !!}

		<div class="row">
<div class="col-lg-12">
<strong>Note:  </strong><span class="error"> Supported format :: jpeg,png,jpg,gif & file size max :: 2MB </span>& Image Width & Height must be <strong class="error">{{$image_size->value}}x{{$image_size->value}} px</strong><br><br>
	</div>	
<div class="col-md-6">
	<div class="row">
		@if (isset($imagedata) && !empty($imagedata))
		@foreach ($imagedata as $image)
		<div class="col-md-3 imgdiv" >
			<div id="parent-{{$image->id}}" onmousemove="showchild('{{$image->id}}');" onmouseout="hidechild('{{$image->id}}');"><img width="100" class="img img-responsive" src="{{URL::to($image->image_link)}}/200x200/{{$image->image}}" style="border: 1px solid;">
			</div>
			<div class="middle" id="child-{{$image->id}}" onmousemove="showchild('{{$image->id}}');" onmouseout="hidechild('{{$image->id}}');">
				<div class="row">
					<center>
						<a class="btnclassdelete demo-google-material-icon" style="color:white" onclick="DeleteImage('{{$image->id}}');" ><i class="material-icons">delete</i></a>

						<a data-href="{{ route('admin.product.image.show',$image->id) }}"
							class="btnclass demo-google-material-icon open-attr-modal" style="color:white" ><i class="material-icons">remove_red_eye</i></a>
						</center>

					</div>
				</div>
			</div>
			@endforeach
			@endif

		</div>
</div> 
<div class="col-md-6">
	<div class="form-group">
		<div class="col-md-12">

			<div class="input-group control-group increment" style="margin-top:10px;background-color:gray">
				<a class='btn btn-primary btn-sm font-10' href='javascript:;'>
					Choose File...
					<input  type="file" name="file[]" class="form-control m-r-10" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'></a>

					<span class='label label-info  m-r-10' id="upload-file-info"></span>

					<div class="input-group-btn"> 
						<button class="btn btn-success demo-google-material-icon imageheight" type="button"><i class="material-icons" style="margin-top: -4px">add</i></button>
					</div>
				</div>
				<div class="clone hide">
					<div class="control-group input-group" style="margin-top:10px;background-color:gray" >
						<a class='btn btn-primary btn-sm font-10' href='javascript:;'>
							Choose File...
							<input type="file" name="file[]" class="form-control  m-r-10" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'></a>

							<span class='label label-info  m-r-10' id="upload-file-info"></span>

							<div class="input-group-btn"> 
								<button class="btn btn-danger demo-google-material-icon imageheight" type="button"><i class="material-icons" style="margin-top: -4px">delete</i></button>
							</div>
						</div>
					</div>	
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12">

					<input type="submit" name="finish" class="btn btn-warning pull-right btn-sm font-10 m-r-15" value="Save & Finished">

					<input type="submit" name="save_continue" class="btn btn-primary pull-right btn-sm font-10 m-r-15" value="Save & Continue">

				</div>
			</div>
		</div>

	</div>

	{!! Form::close() !!}

</div>
</div>
</div>

</div>



<!-- model for image show -->
<div class="modal fade open_modal_update" tabindex="" role="dialog" style="display: none;">
	<div class="modal-dialog modal-mini">

		<div class="modal-content">
			<div class="modal-header">
				<h4>Preview Image
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
				</h4>
				
			</div>
			<div class="modal-body">



			</div> <!-- / .modal-body -->
		</div> <!-- / .modal-content -->
	</div> 
</div>

<script type="text/javascript">

//===================================== for increment image button @@
$(document).ready(function() {

	$(".btn-success").click(function(){ 
		var html = $(".clone").html();
		$(".increment").before(html);
	});

	$("body").on("click",".btn-danger",function(){ 
		$(this).parents(".control-group").remove();
	});

});


//===================================== for increment show and delete button @@
function showchild(id) {
$('#child-'+id).css('opacity','1');

}
function hidechild(id) {
$('#child-'+id).css('opacity','0');
}

//===================================== for delete confrim @@

function DeleteImage(id) {
	$.confirm({
		title:'Confirm!',
		content:'<b style="color:red">Are Your Confirm To Delete ?</b>',
		theme: 'modern',
		closeIcon: true,
		animation: 'scale',
		type: 'red',
		buttons:{
			ok:function() {
				$.ajax({
					url: "{{URL::to(config('global.prefix_name').'/product/image/delete')}}/"+id,
					type: 'GET',
					data: {},
					success:function(data) {
						if(data=="true"){
							$.alert({
								title: 'Success !',
								content: '<b style="color:green">Image Deleted Successfully</b>',
								autoClose: 'ok|2000',
							});
							$('#parent-'+id).fadeOut();
						}else if(data=="false"){
							$.alert({
								title: 'Whoops !',
								content: '<b style="color:green">Something Went Wrong!!</b>',
								autoClose: 'ok|2000',
							});
						}
					}
				});

			},
			close:function() {

			}
		},
	});
}

$(document).delegate('.open-attr-modal','click',function () {

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

<!--  -->
