<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;

?>

<div class="row">

    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('title', 'Title', array('class' => 'col-form-label')) !!}<span
                        class="required"> *</span>

                {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control','required'=> 'required',  'placeholder'=>'Enter role title', 'onkeyup'=>"convert_to_slug();"]) !!}
                <span class="error"> {!! $errors->first('title') !!}</span>
            </div>
        </div>
    </div>

@if(isset($data))
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!} <span
                        class="required"> *</span>

                {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control selectheight']) !!}
                <span class="error"> {!! $errors->first('status') !!}</span>
            </div>
        </div>
    </div>
@else
<input type="hidden" name="status" value="active">    
@endif
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-12">
                {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right btn-big font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                &nbsp;
            </div>
        </div>
    </div>

</div>

<script>

    function convert_to_slug() {
        var str = document.getElementById("title").value;
        str = str.replace(/[^a-zA-Z0-12\s]/g, "");
        str = str.toLowerCase();
        str = str.replace(/\s/g, '-');
        document.getElementById("slug").value = str;

    }

</script>
<script>
    $(function () {
        // highlight
        var elements = $("input[type!='submit'], textarea, select");
        elements.focus(function () {
            $(this).parents('li').addClass('highlight');
        });
        elements.blur(function () {
            $(this).parents('li').removeClass('highlight');
        });

        $("#rolesform").validate({
            rules: {
                title: {
                    required: true,
                },
                // slug:{
                //     required:true
                // },
                status: {
                    required: true
                }

            },
            messages: {
                title: 'Please enter title',
                // slug:'Please enter slug',
                status: 'Please choose status'
            }
        });
    });
</script>