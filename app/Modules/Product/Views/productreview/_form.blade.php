<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


<div class="row">

    <div class="col-md-6">

        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('title', 'Title', array('class' => 'col-form-label')) !!}     

                {!! Form::text('title', Input::old('title'),['id'=>'title','class' => 'form-control orderheight','required'=> 'required',  'placeholder'=>'Enter review title']) !!}
                <span class="error">{!! $errors->first('title') !!}</span>
            </div>
        </div>
    </div>
        
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('rating_value_score', 'Rating Value Score', array('class' => 'col-form-label')) !!} <span class="required">*</span>
                <br>
                <br>
                <label>1 Star</label>
                {!! Form::radio('rating_value_score','1') !!}
                <label>2 Star</label>
                {!! Form::radio('rating_value_score','2') !!}

                <label>3 Star</label>
                {!! Form::radio('rating_value_score','3') !!}

                <label>4 Star</label>
                {!! Form::radio('rating_value_score','4') !!}

                <label>5 Star</label>
                {!! Form::radio('rating_value_score','5') !!}

            
            </div>  
        </div>
    </div>
        
        <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('customer_id', 'Customer Email', array('class' => 'col-form-label')) !!}<span class="required">*</span> 

                 {!! Form::Select('customer_id', $customer_list ,Input::old('customer_id'),['id'=>'customer_id', 'class'=>'form-control selectheight']) !!}
                <span class="error">{!! $errors->first('customer_id') !!}</span>
            </div>
           
        </div>
        <br>
        <div class="form-group">
          
            <div class="form-line">
                {!! Form::label('product_id', 'Select Product', array('class' => 'col-form-label')) !!}<span class="required">*</span> 
                 {!! Form::Select('product_id', $product_list ,Input::old('product_id'),['id'=>'product_id', 'class'=>'form-control selectheight']) !!}
                <span class="error">{!! $errors->first('product_id') !!}</span>
            </div>
        </div>
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
                {!! Form::label('review', 'Review', array('class' => 'col-form-label')) !!}     
                
                {!! Form::textarea('review',Input::old('review'),['id'=>'review','class' => 'textarea form-control', 'placeholder'=>'Enter review', 'rows'=>'8', 'cols'=>'50']) !!}

                <span class="error">{!! $errors->first('review') !!}</span>
            </div>
            
        </div>
        <div class="form-group">
            <div class="col-md-12">
                {!!  Form::label('', '', array('class' => 'col-form-label')) !!}

                {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

            </div>
        </div>
    </div>
</div>

</div>

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

        $("#reviewform").validate({
          rules:{

            title:{
              required:true
          },
          customer_id:{
              required:true
          },
          product_id:{
              required:true
          },
          rating_value_score:{
              required:true,
          },
          review:{
              required:true,
          },

      },
      messages:{
        title:'Please enter product title',
        customer_id:'Please enter customer email',
        product_id:'Please enter product name',
        rating_value_score:'Please enter rating value',
        review:'Please enter product review',

    }
});
    });

     $(document).ready( function() {
        $("#review").Editor();                    
    });
</script>

