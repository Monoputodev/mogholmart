<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


<ul class="nav nav-tabs tab-nav-right" role="tablist">
    <li role="presentation" class="active"><a href="#home" data-toggle="tab">Description (En)</a></li>
    
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="home">
        
        
            <div class="form-group">
               
                <div class="form-line">
                    {!! Form::label('short_description', 'Short description', array('class' => 'col-form-label')) !!}
                    
                    {!! Form::textarea('short_description',Input::old('short_description'),['id'=>'short_description','class' => 'form-control', 'placeholder'=>'Enter short description', 'rows'=>'5', 'cols'=>'50']) !!}

                    <span class="error">{!! $errors->first('short_description') !!}</span>
                </div>
            </div>
            <br>

            <div class="form-group">
                
                <div class="form-line">
                    {!! Form::label('specification', 'Specification', array('class' => 'col-form-label')) !!}
                    
                    {!! Form::textarea('specification',Input::old('specification'),['id'=>'specification','class' => 'form-control', 'placeholder'=>'Enter specification', 'rows'=>'5', 'cols'=>'50']) !!}

                    <span class="error">{!! $errors->first('specification') !!}</span>
                </div>  
            </div>
       
             <br>
       
            <div class="form-group">
               
                <div class="form-line">
                    {!! Form::label('description', 'Description', array('class' => 'col-form-label')) !!}
                
                    {!! Form::textarea('description',Input::old('description'),['id'=>'description','class' => 'form-control textarea', 'placeholder'=>'Enter Description', 'rows'=>'5', 'cols'=>'50']) !!}

                    <span class="error">{!! $errors->first('description') !!}</span>
                </div>
                
            </div>
             <br>
            <div class="form-group">
                {!!  Form::label('', '', array('class' => 'col-form-label')) !!}
                
                <input type="submit" name="finish" class="btn btn-warning pull-right btn-sm font-10 m-r-15" value="Save & Finished">

                <input type="submit" name="save_continue" class="btn btn-primary pull-right btn-sm font-10 m-r-15" value="Save & Continue">


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

        
    });
</script>

