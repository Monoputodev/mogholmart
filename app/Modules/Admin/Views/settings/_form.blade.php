<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>

<div class="row">
    @if(isset($data))
    <input type="hidden" name="key" value="{{$data->key}}">
    <input type="hidden" name="type" value="{{$data->type}}">
    @else
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('key', 'Settings Key', array('class' => 'col-form-label')) !!} <span
                class="required"> *</span>

                 {!! Form::text('key',Input::old('key'),['id'=>'key','class' => 'form-control key','required'=> 'required',  'placeholder'=>'site.name']) !!}
                <span id="lblError" class="error">{!! $errors->first('key') !!}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('type', 'Type', array('class' => 'col-form-label')) !!}<span
                class="required"> *</span>

                {!! Form::Select('type',array('text'=>'Text','file'=>'image'),Input::old('type'),['id'=>'type', 'class'=>'form-control selectheighttype type']) !!}
                
                {!! $errors->first('type') !!}
            </div>
        </div>
    </div>
@endif
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-line text_div" style="<?=isset($data)?$data->type=='text'?'':'display: none':''?>">
                {!! Form::label('value', 'Text Value', array('class' => 'col-form-label')) !!}    

                {!! Form::textarea('value',Input::old('value'),['id'=>'value','class' => 'form-control', 'placeholder'=>'Enter Value','rows'=>'5', 'cols'=>'30']) !!}

                <span class="error"> {!! $errors->first('value') !!}</span>
            </div>

            <div  class="form-line image_div" style="<?=isset($data)?$data->type=='file'?'':'display: none':'display: none'?>">
                {!! Form::label('value', 'Image', array('class' => 'col-form-label')) !!}
                <span class="error">Supported format :: jpeg,png,jpg,gif & file size max :: 1MB</span>

                <div style="position:relative;margin-top: 3px">
                    <a class='btn btn-primary btn-sm font-10' href='javascript:;'>
                        Choose File...
                        <input name="image" type="file"
                        style='position:absolute;z-index:2;top:0;left:0;opacity:0;'
                        name="file_source" size="40" onchange='$("#upload-file-info").html($(this).val());' class="selectheighttype">
                    </a>
                    &nbsp;
                    <span class='label label-info' id="upload-file-info"></span>

                </div>
                @if(isset($data) &&!empty($data->type=="file") )
                    <a target="_blank" href="{{URL::to('')}}/uploads/generel_file/{{$data->value}}" style="margin-top: 5px;"
                       class="btn btn-primary btn-sm font-10">
                        <img src="{{URL::to('')}}/uploads/generel_file/{{$data->value}}" height="50px"
                             alt="{{$data->value}}"></img>
                    </a>
                @endif
         </div>
        </div>
    </div>
   
    
    <div class="col-md-12">
        <div class="form-group">

            <div class="col-md-12">

                {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right btn-big font-10','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                &nbsp;
               
            </div>
        </div>
    </div>

</div>
<script>
    $('.type').on('click', function() {

          if(this.value == "text") {
            $('.text_div').show();
            $('.image_div').hide();
        }
        if(this.value == "file") {
            $('.text_div').hide();
            $('.image_div').show();
        }

    });

     $('.key').on('keypress', function() {

        var username = document.getElementById("key").value;
        var lblError = document.getElementById("lblError");
        lblError.innerHTML = "";
        var expr = /^[a-z._]*$/;
        if (!expr.test(username)) {
            lblError.innerHTML = "<p style='color:red'>Only Alphabets (Lowercase), Dot and Underscore allowed in Username.</p>";
        }

     });

</script>