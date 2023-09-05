<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


<div class="row">

  <div class="col-md-6 col-md-offset-3">
    <div class="form-group">
     

      <div class="form-line">
        {!! Form::label('merchant_id', 'Merchant List', array('class' => 'col-form-label')) !!}     

        {!! Form::Select('merchant_id', $merchant_lists ,Input::old('merchant_id'),['id'=>'merchant_id', 'class'=>'form-control selectheight']) !!}
        <span class="error">{!! $errors->first('merchant_id') !!}</span>
      </div>
    </div>
  </div>
 

  <div class="col-md-6 col-md-offset-3">
    <div class="form-group">
     

      <div class="form-line">
        {!! Form::label('attribute_set_id', 'Attribute Set', array('class' => 'col-form-label')) !!}     

        {!! Form::Select('attribute_set_id', $attribute_set_lists ,Input::old('attribute_set_id'),['id'=>'attribute_set_id', 'class'=>'form-control selectheight']) !!}
        <span class="error">{!! $errors->first('attribute_set_id') !!}</span>
      </div>
    </div>
  </div>
  
  <input type="hidden" name="type" value="simple-product">

  <div class="col-md-6 col-md-offset-3">
    <div class="form-group">
      
      <div class="form-line">
        {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!}     

        {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control selectheight']) !!}
        <span class="error">{!! $errors->first('status') !!}</span>
      </div>            

    </div>
  </div>
  <div class="col-md-6 col-md-offset-3">
    <div class="form-group">
      {!!  Form::label('', '', array('class' => 'col-form-label')) !!}
      
      {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

    </div>
  </div>



</div>

<script>
  jQuery('#merchant_id').select2({
    width: '100%',

  });
  jQuery('#attribute_set_id').select2({
    width: '100%',

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

        $("#productform").validate({
          rules:{



            attribute_set_id:{
              required:true,
              number:true
            },

            type:{
              required:true
            },

            status:{
              required:true
            }

          },
          messages:{

            attribute_set_id:'Please choose attribute set',
            type: 'Plese choose type',
            
            status: 'Plese choose status'
          }
        });
      });
    </script>

