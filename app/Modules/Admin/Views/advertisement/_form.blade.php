<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('title', 'Title', array('class' => 'col-form-label')) !!}     

                {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control','required'=> 'required',  'placeholder'=>'Enter Advertisement Title', 'onkeyup'=>"convert_to_slug();"]) !!}
                <span class="error">{!! $errors->first('title') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('slug', 'Slug', array('class' => 'col-form-label')) !!}     

                {!! Form::text('slug',Input::old('slug'),['id'=>'slug','class' => 'form-control','required'=> 'required', 'placeholder'=>'Enter Advertisement Slug' ]) !!}

                <span class="error">{!! $errors->first('slug') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('image_link', 'Image', array('class' => 'col-form-label')) !!}
                    <span class="error">Supported format :: jpeg,png,jpg,gif & file size max :: 1MB</span>
                    
                <div style="position:relative;">
                    <a class='btn btn-primary btn-sm font-10' href='javascript:;'>
                        Choose File...
                        <input name="image_link" type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                    </a>
                    &nbsp;
                    <span class='label label-info' id="upload-file-info"></span>
                </div>

                @if(isset($data['image_link'] ) && !empty($data['image_link']) )
                <a target="_blank" href="{{URL::to('')}}/uploads/advertisement/{{$data->image_link}}" style="margin-top: 5px;" class="btn btn-primary btn-sm font-10"><img src="{{URL::to('')}}/uploads/advertisement/{{$data->image_link}}" height="50px" alt="{{$data['image_link']}}" ></img>
                </a>
                @endif
            </div>
        </div>
        <br>
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('type', 'Position', array('class' => 'col-form-label')) !!}      

               {!! Form::Select('type',array(''=>'Select Position','1'=>'After Slider 1','2'=>'After Slider 2','3' => 'Before Hotdeals','4' => 'Before Tranding','5' => 'Before Category','6' => 'After On Sale','7' => 'After Brand','8' => 'Product Details page 1','9' => 'Before Related Item'),Input::old('type'),['id'=>'type', 'class'=>'form-control selectheight']) !!}

                <span class="error">{!! $errors->first('type') !!}</span>
            </div>
        </div>
       
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('short_order', 'URL Link', array('class' => 'col-form-label')) !!}      

               {!! Form::text('short_order',Input::old('short_order'),['id'=>'short_order','class' => 'form-control','required'=> 'required', 'placeholder'=>'Enter Advertisement Link' ]) !!}


                <span class="error">{!! $errors->first('short_order') !!}</span>
            </div>
        </div>
        <br>
        
    <br>
         <div class="form-group">
            
            <div class="form-line">
                {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!}     

                {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control selectheight']) !!}
                <span class="error">{!! $errors->first('status') !!}</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">

        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('description', 'Description', array('class' => 'col-form-label')) !!}
                
                {!! Form::textarea('description',Input::old('description'),['id'=>'description','class' => 'form-control', 'placeholder'=>'Enter Description', 'rows'=>'5', 'cols'=>'50']) !!}

                <span class="error">{!! $errors->first('description') !!}</span>
            </div>
            <br>
            <div class="col-md-12">

             {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

         </div>
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

        $("#advertisementform").validate({
          rules:{
            short_order:{
              required:true,
             
            },
            title:{
              required:true
            },
            slug:{
              required:true
            },
            type:{
              required:true
            },

            status:{
              required:true
            }
            
          },
          messages:{
            type:'Please enter type data',
            short_order:'Please enter order data',
            title:'Please enter title',
            slug: 'Plese enter slug',
            status: 'Plese choose status'
          }
        });
    });
</script>

