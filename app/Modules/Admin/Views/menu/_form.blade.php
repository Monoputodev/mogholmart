<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>

<div class="row">

    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('title', 'Title', array('class' => 'col-form-label')) !!}    
                {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control','required'=> 'required',  'placeholder'=>'Enter Title','onkeyup'=>"convert_to_slug();"]) !!}
                <span class="error">{!! $errors->first('name') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('slug', 'Slug', array('class' => 'col-form-label')) !!}    
                {!! Form::text('slug',Input::old('slug'),['id'=>'slug','class' => 'form-control','required'=> 'required', 'placeholder'=>'Menu Slug' ]) !!}
                <span class="error">{!! $errors->first('slug') !!}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('position', 'Position', array('class' => 'col-form-label')) !!}    
               {!! Form::Select('position',array('top'=>'Top','main-menu'=>'Main Menu','footer-1'=>'Footer 1','footer-2'=>'Footer 2','footer-3'=>'Footer-3','footer-4'=>'Footer 4'),Input::old('position'),['id'=>'position', 'class'=>'form-control']) !!}
                <span class="error">{!! $errors->first('position') !!}</span>
            </div>
        </div>
  
        
        
    </div>
    
<div class="col-md-6">
    
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('short_order', 'Order', array('class' => 'col-form-label')) !!}    
                {!! Form::number('short_order',Input::old('short_order'),['id'=>'short_order','class' => 'form-control','placeholder'=>'Enter order']) !!}
                <span class="error">{!! $errors->first('short_order') !!}</span>
            </div>
        </div>

</div>
    
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('status', 'Status', array('class' => 'col-form-label')) !!}    
                {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control selectheight']) !!}
                <span class="error">{!! $errors->first('status') !!}</span>
            </div>
        </div>

        
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('image_link', 'Image Link', array('class' => 'col-form-label')) !!} (<span class="error">Supported format :: jpeg,png,jpg,gif & file size max :: 1MB</span>)
                
                <div style="position:relative;">
                    <a class='btn btn-primary btn-sm font-10' href='javascript:;'>
                        Choose File...
                        <input name="image_link" type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                    </a>
                    &nbsp;
                    <span class='label label-info' id="upload-file-info"></span>
                </div>
                @if(isset($data['image_link'] ) && !empty($data['image_link']) )
                    <a target="_blank" href="{{URL::to('')}}/uploads/menu/{{$data->image_link}}" style="margin-top: 5px;" class="btn btn-primary btn-sm font-10"><img src="{{URL::to('')}}/uploads/menu/{{$data->image_link}}" height="50px" alt="{{$data['image_link']}}" ></img>
                    </a>
                
                @endif

                <span class="error">{!! $errors->first('image_link') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-12">

        <div class="form-group">
            <div class="form-line">
                {!! Form::label('description', 'Description', array('class' => 'col-form-label')) !!}
               {!! Form::textarea('description',Input::old('description'),['id'=>'description','class' => 'form-control textarea', 'placeholder'=>'Enter Description','rows'=>'5', 'cols'=>'30']) !!}
                <span class="error">{!! $errors->first('description') !!}</span>
            </div>
        </div>
    </div>

    <div class="col-md-12">

        {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
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
<script type="text/javascript">
    $(document).ready( function() {
        $(".textarea").Editor();                    
    });
</script>
