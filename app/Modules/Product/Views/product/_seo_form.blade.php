<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


<div class="row">

    <div class="col-md-6">
        <div class="form-group">
         
            <div class="form-line">
                {!! Form::label('meta_title', 'Meta Title', array('class' => 'col-form-label')) !!}     

                {!! Form::text('meta_title', Input::old('meta_title'),['id'=>'meta_title','class' => 'form-control','required'=> 'required',  'placeholder'=>'Enter product meta title']) !!}
                <span class="error">{!! $errors->first('meta_title') !!}</span>
            </div>
        </div>
        <br>
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('meta_keywords', 'Meta Keywords', array('class' => 'col-form-label')) !!}     

                {!! Form::text('meta_keywords',Input::old('meta_keywords'),['id'=>'meta_keywords','class' => 'form-control','required'=> 'required', 'placeholder'=>'Enter product meta keywords' ]) !!}

                <span class="error">{!! $errors->first('meta_keywords') !!}</span>
            </div>
        </div>
        <br>
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('meta_image_link', 'Meta Image', array('class' => 'col-form-label')) !!}
                
                {!! Form::text('meta_image_link',Input::old('meta_image_link'),['id'=>'meta_image_link','class' => 'form-control','placeholder'=>'Enter Meta Image Link']) !!}

                <span class="error">{!! $errors->first('meta_image_link') !!}</span>
            </div>
        </div>
        


    </div>

    

    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('meta_description', 'Meta description', array('class' => 'col-form-label')) !!}
                
                {!! Form::textarea('meta_description',Input::old('meta_description'),['id'=>'meta_description','class' => 'textarea form-control', 'placeholder'=>'Enter meta description', 'rows'=>'9', 'cols'=>'50']) !!}

                <span class="error">{!! $errors->first('meta_description') !!}</span>
            </div>
            
        </div>
        <br>
        <div class="form-group">
            <div class="col-md-12">
                {!!  Form::label('', '', array('class' => 'col-form-label')) !!}
                
                <input type="submit" name="finish" class="btn btn-warning pull-right btn-sm font-10 m-r-15" value="Save & Finished">

                <input type="submit" name="save_continue" class="btn btn-primary pull-right btn-sm font-10 m-r-15" value="Save & Continue">

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

        $("#seoform").validate({
          rules:{

            meta_title:{
              required:true
          },
          meta_keywords:{
              required:true
          },

      },
      messages:{
        meta_title:'Please enter product meta title',
        meta_keywords:'Please enter product meta keywords',

    }
});
    });
    
    $(document).ready( function() {
        $("#meta_description").Editor();                    
    });
</script>



