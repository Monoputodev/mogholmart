<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;

?>


<div class="row">
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('method', 'Method', array('class' => 'col-form-label')) !!} <span
                        class="required"> *</span>

                {!! Form::text('method',Input::old('method'),['id'=>'method','class' => 'form-control','required'=> 'required',  'title'=>'Enter roles method']) !!}
                <span class="error"> {!! $errors->first('method') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('title', 'Route', array('class' => 'col-form-label')) !!}<span
                        class="required"> *</span>

                {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control','required'=> 'required',  'title'=>'Enter role title', 'onkeyup'=>"convert_to_slug();"]) !!}
                <span class="error"> {!! $errors->first('title') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('route', 'Route Name', array('class' => 'col-form-label')) !!}<span
                        class="required"> *</span>

                {!! Form::text('route',Input::old('route'),['id'=>'route','class' => 'form-control','required'=> 'required',  'route'=>'Enter role route', 'onkeyup'=>"convert_to_slug();"]) !!}
                <span class="error"> {!! $errors->first('route') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('description', 'Description', array('class' => 'col-form-label')) !!}<span
                        class="required"> *</span>

                {!! Form::text('description',Input::old('description'),['id'=>'description','class' => 'form-control','required'=> 'required',  'description'=>'Enter role description', 'onkeyup'=>"convert_to_slug();"]) !!}
                <span class="error"> {!! $errors->first('description') !!}</span>
            </div>
        </div>
    </div>


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
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-12">
                <label></label>
            </div>
            <div class="col-md-12">

                {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right btn-big font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                &nbsp;

            </div>
        </div>

    </div>


</div>


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
                route: {
                    required: true
                },
                status: {
                    required: true
                }

            },
            messages: {
                title: 'Please enter title',
                slug: 'Please enter route',
                status: 'Plese choose status'
            }
        });
    });
</script>