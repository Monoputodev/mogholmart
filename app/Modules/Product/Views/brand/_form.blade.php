<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('manufacturer_id', 'Dealer', array('class' => 'col-form-label')) !!}     

                {!! Form::Select('manufacturer_id', $manufacturer_lists ,Input::old('manufacturer_id'),['id'=>'manufacturer_id', 'class'=>'form-control custom-height']) !!}
                <span class="error">{!! $errors->first('manufacturer_id') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('title', 'Title', array('class' => 'col-form-label')) !!}     

                {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control ','required'=> 'required',  'placeholder'=>'Enter Brand Title', 'onkeyup'=>"convert_to_slug();"]) !!}
                <span class="error">{!! $errors->first('title') !!}</span>
            </div>
        </div>
    </div>
    

    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('slug', 'Slug', array('class' => 'col-form-label')) !!}     

                {!! Form::text('slug',Input::old('slug'),['id'=>'slug','class' => 'form-control','required'=> 'required', 'placeholder'=>'Enter Brand Slug' ]) !!}

                <span class="error">{!! $errors->first('slug') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('is_top_brand', 'Is Top Brand', array('class' => 'col-form-label')) !!}
                
                {!! Form::Select('is_top_brand',array('no'=>'No','yes'=>'Yes'),Input::old('is_top_brand'),['id'=>'is_top_brand', 'class'=>'form-control custom-height']) !!}

                <span class="error">{!! $errors->first('is_top_brand') !!}</span>
            </div>
        </div>
    </div>


    
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('meta_title', 'Meta Title', array('class' => 'col-form-label')) !!} 

                {!! Form::text('meta_title',Input::old('meta_title'),['id'=>'meta_title','class' => 'form-control','placeholder'=>'Enter Brand Meta Title']) !!}

                <span class="error">{!! $errors->first('meta_title') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('meta_image_link', 'Meta Image', array('class' => 'col-form-label')) !!}

                {!! Form::text('meta_image_link',Input::old('meta_image_link'),['id'=>'meta_image_link','class' => 'form-control','placeholder'=>'Enter Brand Meta Image']) !!}

                <span class="error">{!! $errors->first('meta_image_link') !!}</span>
            </div>
        </div>
    </div>



<div class="col-md-12">
    <div class="form-group">

        <div class="form-line">
            {!! Form::label('meta_description', 'Meta Description', array('class' => 'col-form-label')) !!}

            {!! Form::textarea('meta_description',Input::old('meta_description'),['id'=>'meta_description','class' => 'form-control', 'placeholder'=>'Enter Meta Description','rows' => '5']) !!}

            <span class="error">{!! $errors->first('meta_description') !!}</span>


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

            @if(isset($data['image_link'] ) && !empty($data['image_link']) )
            <a target="_blank" href="{{URL::to('')}}/uploads/brand/{{$data->image_link}}" style="margin-top: 5px;" class="btn btn-primary btn-sm font-10"><img src="{{URL::to('')}}/uploads/brand/{{$data->image_link}}" height="50px" alt="{{$data['image_link']}}" ></img>
            </a>
            @endif
        </div>
    </div> 


    

</div>
<div class="col-md-6">
       <div class="form-group">
         
        <div class="form-line">
            {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!}     

            {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control custom-height']) !!}
            <span class="error">{!! $errors->first('status') !!}</span>
        </div>
    </div>
    
</div>
<div class="col-md-12">
    <div class="col-md-12">

     {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

 </div>
</div>


</div>
<script>
    function convert_to_slug(){
        var str = document.getElementById("title").value;
        str = str.replace(/[^a-zA-Z0-12\s]/g,"");
        str = str.toLowerCase();
        str = str.replace(/\s/g,'-');
        document.getElementById("slug").value = str;

    }
</script>

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
            menufacture_id:{
              required:true,
              number:true
          },
          title:{
              required:true
          },
          slug:{
              required:true
          },

          status:{
              required:true
          }

      },
      messages:{
        menufacture_id:'Please choose manufacture title',
        title:'Please enter title',
        slug: 'Plese enter slug',
        status: 'Plese choose status'
    }
});
    });
</script>

