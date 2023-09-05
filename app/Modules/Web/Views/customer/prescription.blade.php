@extends('Web::layouts.master')

@section('body')
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<ul class="bread-list">
						<li><a href="{{URL::to('/')}}">Home<i class="ti-arrow-right"></i></a></li>
						<li><a href="{{route('web.customer.account')}}">Account <i class="ti-arrow-right"></i></a></li>
						<li><a href="#">Prescription</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="contact-us section">
	<div class="container">
		<div class="row">
			<div id="content" class="col-md-9 form-main">
				<h2>Uploads Your Prescriptions.</h2>
				<?php 
				$url = route('prescription.store');

				?>

				{!! Form::open(array('url' => $url,'files'=> true, 'method' => 'post', 'class' => "login-formas" ,'id'=>'resetform')) !!}

				<div class="row">
					<div class="well col-md-6">

						<div class="form-group">
							{!! Form::label('note', 'Enter your comment.', array('class' => 'col-form-label')) !!}<span class="required">*</span>

							{!! Form::textarea('comment',Request::old('comment'),['id'=>'comment','class' => 'form-control', 'title'=>'Enter comment', 'rows'=>'3', 'cols'=>'50','required']) !!}

							<span class="errors">
								{!! $errors->first('comment') !!}
							</span>

						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">

							<div class="col-lg-12">
								<strong>Note:  </strong><span class="error"> Supported format :: jpeg,png,jpg,gif & file size max :: 2MB </span>
							</div>
							<div class="input-group control-group increment" style="margin-top:10px;">
								<a class='btn btn-primary btn-sm font-10' href='javascript:;'>
									Choose File...
									<input  type="file" name="file[]" class="form-control m-r-10"  style='width:100px;position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'></a>

									<span class='label label-info  m-r-10' id="upload-file-info"></span>

									<div class="input-group-btn"> 
										<button class="btn btn-success imageheight" type="button"><i class="fa fa-plus" style="margin-top: -4px">add</i></button>
									</div>
								</div>
								<div class="clone hide">
									<div class="control-group input-group" style="margin-top:10px;" >
										<a class='btn btn-primary btn-sm font-10' href='javascript:;'>
											Choose File...
											<input type="file" name="file[]" class="form-control  m-r-10" style='width:100px;position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'></a>

											<span class='label label-info  m-r-10' id="upload-file-info"></span>

											<div class="input-group-btn"> 
												<button class="btn btn-danger imageheight" type="button"><i class="fa fa-trash" style="margin-top: -4px">delete</i></button>
											</div>
										</div>
									</div>	
								</div>
							</div>
							<div class="col-md-12">
								<div class="buttons clearfix">

									<div class="pull-right">
										<input type="submit" value="Submit" class="btn btn-primary">
									</div>
								</div>
							</div>


						</div>
						{!! Form::close() !!}

						<div class="col-md-12">
							<hr>
							@if(Session::has('success'))

                            <div class="alert alert-success" style="background-color:green !important;color:white !important">
	                        <span class="close" data-dismiss="alert">×</span>
	                        <i class="fa fa-check-circle"></i> {{Session::get('success')}} 
                            </div>
                            @endif
							<div class="row">
								@if (isset($imagedata) && !empty($imagedata))
								@foreach ($imagedata as $image)
								<div class="col-md-2 imgdiv" >
									<div id="parent-{{$image->id}}" onmousemove="showchild('{{$image->id}}');" onmouseout="hidechild('{{$image->id}}');">

										<a target="__blank" href="{{URL::to('uploads/prescription')}}/{{auth::user()->id}}/{{$image->image_link}}"><img width="100" class="img img-responsive" src="{{URL::to('uploads/prescription')}}/{{auth::user()->id}}/{{$image->image_link}}" style="border: 1px solid;"></a>

									</div>
									<div class="middle" id="child-{{$image->id}}" onmousemove="showchild('{{$image->id}}');" onmouseout="hidechild('{{$image->id}}');">
										<div class="row">
											<center>
												<a class="btnclassdelete " style="color:white" onclick="DeleteImage('{{$image->id}}');" ><i class="fa fa-trash"></i></a>
											</center>

										</div>
									</div>
								</div>
								@endforeach
								@endif

							</div>
						</div>
					</div>
					@include('Web::customer.menu')
				</div>
			</div>
		</div>




		@endsection