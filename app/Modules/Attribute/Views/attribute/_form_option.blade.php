<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('frontend_title', 'Attribute Option Title', array('class' => 'col-form-label')) !!}<span class="required">*</span> 

                {!! Form::text('frontend_title',Input::old('frontend_title'),['id'=>'frontend_title','class' => 'form-control','required'=> 'required', 'placeholder'=>'Enter Option  Title', 'onkeyup'=>"convert_to_slug();"]) !!}
                <span class="error">{!! $errors->first('frontend_title') !!}</span>
                <input type="hidden" name="attribute_id" id="attribute_id" value="{{$attid}}">
            </div>
            
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('slug', 'Slug', array('class' => 'col-form-label')) !!}     

                {!! Form::text('slug',Input::old('slug'),['id'=>'slug','class' => 'form-control','required'=> 'required',  'placeholder'=>'Enter Option Slug']) !!}
                <span class="error">{!! $errors->first('slug') !!}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!}     

                {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control', 'height'=>'33px']) !!}
                {!! $errors->first('status') !!}
            </div>

        </div>

        
    </div>
    <div class="col-md-6">
        {!!  Form::label('', '', array('class' => 'col-form-label')) !!}


        {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

    </div>

</div>
