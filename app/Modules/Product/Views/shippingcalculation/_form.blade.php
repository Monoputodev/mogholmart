<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


<div class="row">

    <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('shipping_type', 'Shipping Type', array('class' => 'col-form-label')) !!}<span class="required">*</span> 

                {!! Form::text('shipping_type',Input::old('shipping_type'),['id'=>'shipping_type','class' => 'form-control','required'=> 'required','shipping_type'=>'Enter  shipping type']) !!}
                <span class="error">{!! $errors->first('shipping_type') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('condition', 'Condition', array('class' => 'col-form-label')) !!}     

                {!! Form::text('condition',Input::old('condition'),['id'=>'condition','class' => 'form-control','required'=> 'required', 'title'=>'Enter shipping condition' ]) !!}
                <span class="error">{!! $errors->first('condition') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('method', 'Method', array('class' => 'col-form-label')) !!}     

                {!! Form::text('method',Input::old('method'),['id'=>'method','class' => 'form-control','required'=> 'required', 'title'=>'Enter shipping method' ]) !!}
                <span class="error">{!! $errors->first('method') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('main_value', 'Main value', array('class' => 'col-form-label')) !!}     

                {!! Form::text('main_value',Input::old('main_value'),['id'=>'main_value','class' => 'form-control','required'=> 'required', 'title'=>'Enter shipping main value' ]) !!}
                <span class="error">{!! $errors->first('Main_value') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">


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
     

        <div class="form-group">
            <div class="col-md-12">
            {!! Form::label('', '', array('class' => 'col-form-label')) !!}
              
             {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

         </div>
     </div>

 </div>
</div>
</div>
<!-- @@============================================validate and convet to slug part=========================@@ -->


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

        $("#shippingform").validate({
          rules:{

            shipping_type:{
              required:true
          },
          condition:{
              required:true
          },
          method:{
              required:true
          },
          main_value:{
              required:true
          },

          status:{
              required:true
          }

      },
      messages:{
        shipping_type:'Please enter shipping type',
        condition: 'Plese enter condition',
        method: 'Plese enter method',
        main_value: 'Plese enter main value',

        status: 'Plese choose status'
    }
});
    });
</script>

