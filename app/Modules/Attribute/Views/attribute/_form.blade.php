<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


<div class="row">

    <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('frontend_title', 'Attribute Title', array('class' => 'col-form-label')) !!}     

                {!! Form::text('frontend_title',Input::old('frontend_title'),['id'=>'frontend_title','class' => 'form-control','required'=> 'required',  'placeholder'=>'Enter Attribute  Title', 'onkeyup'=>"convert_to_code_column();"]) !!}
                <span class="error">{!! $errors->first('frontend_title') !!}</span>
            </div>
        </div>
    </div>
    
    
        

    <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('code_column', 'Code Column', array('class' => 'col-form-label')) !!}    
                {!! Form::text('code_column',Input::old('code_column'),['id'=>'code_column','class' => 'form-control selectheight','required'=> 'required',  'placeholder'=>'Enter Attribute Code Colum']) !!}
                <span class="error">{!! $errors->first('code_column') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line">
                 {!! Form::label('type', 'Type', array('class' => 'col-form-label')) !!}<span class="required">*</span>

                {!! Form::Select('type',array('text'=>'Text','textarea'=>'Textarea','checkbox' => 'Checkbox'),Input::old('type'),['id'=>'type', 'class'=>'form-control selectheight']) !!}
                <span class="error">{!! $errors->first('type') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('type_is_required', 'Type Is Required', array('class' => 'col-form-label')) !!}<span class="required">*</span> 

                {!! Form::Select('type_is_required',array('no'=>'No','yes'=>'Yes'),Input::old('type_is_required'),['id'=>'type_is_required', 'class'=>'form-control selectheight']) !!}
                <span class="error">{!! $errors->first('type_is_required') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('order', 'Order', array('class' => 'col-form-label')) !!}<span class="required">*</span> <strong>(Plese enter number type data)</strong> 

                {!! Form::number('order',Input::old('order'),['id'=>'order','class' => 'form-control orderheight','required'=> 'required',  'placeholder'=>'Enter Attribute Order']) !!}
                <span class="error">{!! $errors->first('order') !!}</span>
            </div>
        </div>
    </div>
    
    
    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('default_value', 'Default Value', array('class' => 'col-form-label')) !!}     
                {!! Form::Select('default_value',array('no'=>'No','yes'=>'Yes'),Input::old('default_value'),['id'=>'default_value', 'class'=>'form-control selectheight']) !!}

                <span class="error">{!! $errors->first('default_value') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('use_in_quick_search', 'Use In Quick Search', array('class' => 'col-form-label')) !!}      

                {!! Form::Select('use_in_quick_search',array('no'=>'No','yes'=>'Yes'),Input::old('use_in_quick_search'),['id'=>'use_in_quick_search', 'class'=>'form-control selectheight']) !!}

                <span class="error">{!! $errors->first('use_in_quick_search') !!}</span>
            </div>
        </div> 
    </div>
    <div class="col-md-6">

        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('use_in_advance_search', 'Use In Advanced Search', array('class' => 'col-form-label')) !!}     
                {!! Form::Select('use_in_advance_search',array('no'=>'No','yes'=>'Yes'),Input::old('show_in_left_navigation_menu'),['id'=>'use_in_advance_search', 'class'=>'form-control selectheight']) !!}

                <span class="error">{!! $errors->first('use_in_advance_search') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('use_in_filter', 'Use In Filter', array('class' => 'col-form-label')) !!}     
                {!! Form::Select('use_in_filter',array('no'=>'No','yes'=>'Yes'),Input::old('show_in_left_navigation_menu'),['id'=>'use_in_filter', 'class'=>'form-control selectheight']) !!}

               <span class="error"> {!! $errors->first('use_in_filter') !!}</span>
            </div>

        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!}     

                {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control selectheight']) !!}
                {!! $errors->first('status') !!}
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
           
            <div class="col-md-12">
                 {!!  Form::label('', '', array('class' => 'col-form-label')) !!} <span class="required"></span>

                {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

            </div>
            
        </div>
    </div>

</div>

<!-- @@============================================validate and convet to code coloumn part=========================@@ -->
<script>

    function convert_to_code_column(){
        var str = document.getElementById("frontend_title").value;
        str = str.replace(/[^a-zA-Z0-12\s]/g,"");
        str = str.toLowerCase();
        str = str.replace(/\s/g,'-');
        document.getElementById("code_column").value = str;

    }

</script>
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

$("#attributeform").validate({
    rules:{
        code_colum:{
            required:true,
        },
        order:{
            required:true
        },
        
        frontend_title:{
            required:true
        },

        status:{
            required:true
        }

    },
    messages:{
        code_colum:'Please enter code column',
        order:'Please enter order',
       
        frontend_title: 'Plese enter frontend title',
        status: 'Plese choose status'
    }
});
});
</script>

