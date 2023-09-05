<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('coupon_name', 'Coupon Name', array('class' => 'col-form-label')) !!}     

                {!! Form::text('coupon_name',Input::old('coupon_name'),['id'=>'coupon_name','class' => 'form-control','required'=> 'required',  'placeholder'=>'Enter coupon name']) !!}
                <span class="error">{!! $errors->first('coupon_name') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('coupon_code', 'Coupon Code', array('class' => 'col-form-label')) !!}     

                {!! Form::text('coupon_code',Input::old('coupon_code'),['id'=>'coupon_code','class' => 'form-control','required'=> 'required',  'placeholder'=>'Enter coupon code']) !!}
                <span class="error">{!! $errors->first('coupon_code') !!}</span>
            </div>
        </div>
    </div>
    

    <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('coupon_type', 'Coupon Type', array('class' => 'col-form-label')) !!}     

                {!! Form::text('coupon_type',Input::old('coupon_type'),['id'=>'coupon_type','class' => 'form-control','required'=> 'required', 'placeholder'=>'Enter coupon type' ]) !!}

                <span class="error">{!! $errors->first('coupon_type') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('user_per_customer', 'Uses Per Customer', array('class' => 'col-form-label')) !!}
                
               {!! Form::number('user_per_customer',Input::old('user_per_customer'),['id'=>'user_per_customer','class' => 'form-control','required'=> 'required', 'placeholder'=>'Enter Uses Per Customer','title'=>'Uses per Customer is the number of times a Customer may use the same Discount Coupon' ]) !!}

                <span class="error">{!! $errors->first('user_per_customer') !!}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('user_per_coupon', 'Uses per Coupon', array('class' => 'col-form-label')) !!}
                
               {!! Form::number('user_per_coupon',Input::old('user_per_coupon'),['id'=>'user_per_coupon','class' => 'form-control','required'=> 'required', 'placeholder'=>'Enter Uses per Coupon','title'=>'Uses per Coupon sets the number of times the coupon code is used' ]) !!}

                <span class="error">{!! $errors->first('user_per_coupon') !!}</span>
            </div>
        </div>
   
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('amount', 'Amount', array('class' => 'col-form-label')) !!}
                
               {!! Form::number('amount',Input::old('amount'),['id'=>'amount','class' => 'form-control','required'=> 'required', 'placeholder'=>'0.00' ]) !!}

                <span class="error">{!! $errors->first('amount') !!}</span>
            </div>
        </div>
    
        <div class="form-group">
             <div class="form-line">
                {!! Form::label('valid_from', 'From Date', array('class' => 'col-form-label')) !!}
                {!!Form::text('valid_from',Input::old('valid_from'),['id'=>'valid_from','class' => 'form-control custome_date','placeholder'=>'yyyy-mm-dd']) !!}
                <span class="error">{!! $errors->first('valid_from') !!}</span>
            </div>
        </div>
        
            <div class="form-group">
               <div class="form-line">
                {!! Form::label('valid_to', 'To Date', array('class' => 'col-form-label')) !!}
                {!! Form::text('valid_to',Input::old('valid_to'),['id'=>'valid_to','class' => 'form-control custome_date','placeholder'=>'yyyy-mm-dd', 'data-date-format'=>'yyyy-mm-dd']) !!}
                <span class="error">{!! $errors->first('valid_to') !!}</span>
            </div>
        </div>
   
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
                {!! Form::label('description', ' Description', array('class' => 'col-form-label')) !!}
                
                {!! Form::textarea('description',Input::old('description'),['id'=>'description','class' => 'form-control textarea', 'placeholder'=>'Enter  Description','size' => '120x5']) !!}

                <span class="error">{!! $errors->first('description') !!}</span>
            </div>
            <div class="col-md-12">

               {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

            </div>
        </div>

    </div>
    

</div>

<script>
    jQuery('.custome_date').datepicker({
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

        $("#couponform").validate({
          rules:{
            
            coupon_name:{
              required:true
            },
             coupon_code:{
              required:true
            },
            coupon_type:{
              required:true
            },
            amount:{
              required:true
            },

            status:{
              required:true
            }
            
          },
          messages:{
           
            coupon_name:'Please enter coupon name',
            coupon_code: 'Plese enter coupon code',
            coupon_type: 'Plese enter coupon type',
            amount: 'Plese enter amount',
            status: 'Plese choose status'
          }
        });
    });
</script>

