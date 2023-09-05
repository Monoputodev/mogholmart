<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
           <div class="form-line">
            {!! Form::label('comission_type', 'Comission Type', array('class' => 'col-form-label')) !!}    
            {!! Form::Select('comission_type',array('merchantwise'=>'Merchant Wise'),Input::old('comission_type'),['id'=>'comission_type', 'class'=>'form-control selectheight']) !!}
            <span class="error">{!! $errors->first('comission_type') !!}</span>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">

        <div class="form-line">
            {!! Form::label('merchant_id', 'Merchant', array('class' => 'col-form-label')) !!}     

            {!! Form::Select('merchant_id', $merchant ,Input::old('merchant_id'),['id'=>'merchant_id', 'class'=>'form-control selectheighttype select2class']) !!}
            <span class="error">{!! $errors->first('merchant_id') !!}</span>
        </div>
    </div>
</div>
<div class="col-md-4">

    <div class="form-group">
        <div class="form-line">
            {!! Form::label('comission_rate', 'Comission Rate', array('class' => 'col-form-label')) !!}    
            {!! Form::text('comission_rate',Input::old('comission_rate'),['id'=>'comission_rate','class' => 'form-control','placeholder'=>'2.00']) !!}
            <span class="error">{!! $errors->first('comission_rate') !!}</span>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
       <div class="form-line">
        {!! Form::label('from_date', 'From Date', array('class' => 'col-form-label')) !!}
        {!!Form::text('from_date',Input::old('from_date'),['id'=>'from_date','class' => 'form-control datepic','placeholder'=>'yyyy-mm-dd',]) !!}
        <span class="error">{!! $errors->first('from_date') !!}</span>
    </div>
</div>
</div>
<div class="col-md-4">
    <div class="form-group">
       <div class="form-line">
        {!! Form::label('to_date', 'To Date', array('class' => 'col-form-label')) !!}
        {!! Form::text('to_date',Input::old('to_date'),['id'=>'to_date','class' => 'form-control datepic','placeholder'=>'yyyy-mm-dd',]) !!}
        <span class="error">{!! $errors->first('to_date') !!}</span>
    </div>
</div>


</div>

<div class="col-md-4">
    <div class="form-group">
        <div class="form-line">
            {!! Form::label('status', 'Status', array('class' => 'col-form-label')) !!}    
            {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control selectheight']) !!}
            <span class="error">{!! $errors->first('status') !!}</span>
        </div>
    </div>

    <div class="col-md-12">

        {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
    </div>
</div>
</div>
<script>

    jQuery('.select2class').select2({
        width: "100%",
        tag: true
    });

    $('.datepic').datepicker({
        language: 'en',
        dateFormat: 'yyyy-mm-dd',
        autoClose: true,
        
    });
    
    $(function() {
        // highlight
        var elements = $("input[type!='submit'], textarea, select");
        elements.focus(function() {
            $(this).parents('li').addClass('highlight');
        });
        elements.blur(function() {
            $(this).parents('li').removeClass('highlight');
        });

        $("#comissionform").validate({
          rules:{
            merchant_id:{
              required:true,
              number:true
          },
          comission_rate:{
              required:true
          },
          comission_type:{
              required:true
          },

          status:{
              required:true
          }

      },
      messages:{
        merchant_id:'Please choose merchant',
        comission_rate:'Please enter comission rate',
        comission_type: 'Plese enter comission type',
        status: 'Plese choose status'
    }
});
    });
</script>

