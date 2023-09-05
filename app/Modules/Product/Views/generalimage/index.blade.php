@extends('Admin::layouts.master')
@section('body')

<?php
use Illuminate\Support\Facades\Input;
?>


<div class="row clearfix">

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="body">

        {!! Form::open(['route' => 'admin.product.general.image.store',  'files'=> true, 'id'=>'general_file', 'class' => 'form-horizontal']) !!}

        <div class="row">

          <div class="col-md-6">
            <div class="form-group">

              <div class="form-line">
                {!! Form::label('title', 'Title', array('class' => 'col-form-label')) !!}     

                {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control','required'=> 'required',  'placeholder'=>'Enter Image Title']) !!}
                <span class="error">{!! $errors->first('title') !!}</span>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">

              <div class="form-line">
                {!! Form::label('image_link', 'Image', array('class' => 'col-form-label')) !!}
                (<span class="error">Supported format :: jpeg,png,jpg,gif & file size max :: 1MB</span>)


                <div style="position:relative;">
                  <a class='btn btn-primary btn-sm font-10' href='javascript:;'>
                    Choose File...
                    <input name="image_link" type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                  </a>
                  &nbsp;
                  <span class='label label-info' id="upload-file-info"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">

            {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

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
         LIST OF PRODUCT
       </h2>
     </div>
     <div class="body">
      <div class="table-responsive">

        <table class="table table-bordered table-striped table-hover dataTable js-basic-example list-unstyled clearfix" id="aniimated-thumbnials">
          <thead>
            <tr>
              <th> No</th>
              <th> Image </th>
              <th> Image Name </th>
              <th> Image Path </th>

            </tr>
          </thead>
          <tbody >

            @if (!empty($files_array))
            <?php $count=0; ?>
            @foreach ($files_array as $fileinfo)
            <?php  
            $count++;
            ?>
            <tr>
             <td>{{$count}}</td>
             <td>
              <img width="60" src="{{ URL::to('uploads/generel_file/') }}/{{$fileinfo}}">
            </td>
            <td>
             {{$fileinfo}}
           </td>
           <td>
            {{URL::to('')}}/uploads/generel_file/{{$fileinfo}}
          </td>
        </tr>

        @endforeach


        @endif

      </tbody>
    </table>

  </div>
</div>
</div>
</div>
</div>
<script>
  $(function() {
        // highlight
        var elements = $("input[type!='submit'], textarea, select");
        elements.focus(function() {
          $(this).parents('li').addClass('highlight');
        });
        elements.blur(function() {
          $(this).parents('li').removeClass('highlight');
        });

        $("#brandform").validate({
          rules:{
            general_file:{
              required:true,
            },

            
          },
          messages:{
            general_file:'Please add image title',
            
          }
        });
      });
    </script>
    @endsection

