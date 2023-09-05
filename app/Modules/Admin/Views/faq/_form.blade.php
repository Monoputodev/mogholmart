<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


<div class="row">
    <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('title', 'Title', array('class' => 'col-form-label')) !!}     

                {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control','required'=> 'required',  'placeholder'=>'Enter faq Title']) !!}
                <span class="error">{!! $errors->first('title') !!}</span>
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
                {!! Form::label('description', 'Description', array('class' => 'col-form-label')) !!}
                
                {!! Form::textarea('description',Input::old('description'),['id'=>'description','class' => ' form-control', 'placeholder'=>'Enter Description', 'rows'=>'5', 'cols'=>'50']) !!}

                <span class="error">{!! $errors->first('description') !!}</span>
            </div>
            <br>
            <div class="col-md-12">

             {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

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

        $("#Faqform").validate({
          rules:{
            
            title:{
              required:true
            },  
            
            status:{
              required:true
            }
            
          },
          messages:{
            title:'Please enter title',
           
            status: 'Plese choose status'
          }
        });
    });
</script>

