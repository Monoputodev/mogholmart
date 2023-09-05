<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>

{!! Form::model($product, ['method' => 'PATCH', 'files'=> true, 'route'=> ['merchant.product.update_image', $product->id],"class"=>"", 'id' => '']) !!}

<div class="row">
        <div class="col-12">
            <div class="form-group">
                <strong>Note:  </strong><span class="error"> Supported format :: jpeg,png,jpg,gif & file size max :: 2MB </span>& Image Width & Height must be <strong class="error">1024x1024 px</strong><br><br>
            </div>
        </div>
		<div class="col-6">
			<div class="row">
				@if (isset($imagedata) && !empty($imagedata))
					@foreach ($imagedata as $image)
					<div class="col-md-3 imgdiv" >
						<div id="parent-{{$image->id}}" onmousemove="showchild('{{$image->id}}');" onmouseout="hidechild('{{$image->id}}');"><img width="100" class="img img-responsive" src="{{URL::to($image->image_link)}}/400x400/{{$image->image}}">
						</div>
						<div class="middle" id="child-{{$image->id}}" onmousemove="showchild('{{$image->id}}');" onmouseout="hidechild('{{$image->id}}');">
							<div class="row">
								<center><a class="btnclass" id="merchant_product_image" style="color:white" onclick="DeleteImage('{{$image->id}}');"><i class="fa fa-trash"></i></a>

									<a class="btnclass" onclick="sho_image('{{$image->id}}')" style="color:white" ><i class="fa fa-eye" aria-hidden="true"></i> </a></center>

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

						<div class="input-group control-group increment" style="margin-top:10px" >
							<input  type="file" name="file[]" class="form-control m-r-10">
							<div class="input-group-btn"> 
								<button class="btn btn-success" style="height: 43px;" type="button"><i class="fa fa-plus"></i></button>

							</div>
						</div>
						<div class="clone hide">
							<div class="control-group input-group" style="margin-top:10px" >
								<input type="file" name="file[]"  class="form-control  m-r-10">
								<div class="input-group-btn"> 
									<button class="btn btn-danger" style="height: 43px;"type="button"><i class="fa fa-trash"></i></button>
								</div>
							</div>
						</div>	
					</div>
				</div>
				<div class="form-group">
					<div>
						<input type="submit" name="save_continue" class="btn btn-primary pull-right btn-sm font-10 m-r-20 m-t-15" value="Save & Continue">

					</div>
				</div>
			</div>

</div>





<div class="modal open_modal_update" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Preview Image</h4>
			</div>
			<div class="modal-body">

			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{!! Form::close() !!}