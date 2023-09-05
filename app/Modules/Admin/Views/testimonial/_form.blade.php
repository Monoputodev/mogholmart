<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


<div class="row">
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('title', 'Title', array('class' => 'col-form-label')) !!}     

                {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control','required'=> 'required',  'placeholder'=>'Enter Testimonial Title', 'onkeyup'=>"convert_to_slug();"]) !!}
                <span class="error">{!! $errors->first('title') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('slug', 'Slug', array('class' => 'col-form-label')) !!}     

                {!! Form::text('slug',Input::old('slug'),['id'=>'slug','class' => 'form-control','required'=> 'required', 'placeholder'=>'Enter Testimonial Slug' ]) !!}

                <span class="error">{!! $errors->first('slug') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">

        <div class="form-group">

            <div class="form-line">
                {!! Form::label('short_description', 'Short description', array('class' => 'col-form-label')) !!}
                
                {!! Form::textarea('short_description',Input::old('short_description'),['id'=>'short_description','class' => 'textarea form-control', 'placeholder'=>'Enter short description', 'rows'=>'5', 'cols'=>'50']) !!}

                <span class="error">{!! $errors->first('short_description') !!}</span>
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
                
                {!! Form::textarea('description',Input::old('description'),['id'=>'description','class' => 'textarea form-control', 'placeholder'=>'Enter Description', 'rows'=>'5', 'cols'=>'50']) !!}

                <span class="error">{!! $errors->first('description') !!}</span>
            </div>
            <br>
            <div class="col-md-12">
                {!!  Form::label('', '', array('class' => 'col-form-label')) !!}

                {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

            </div>
        </div>
    </div>
</div>
<script>

    function convert_to_slug(){
        var str = document.getElementById("title").value;
        str = str.replace(/[^a-zA-Z0-12\s]/g,"");
        str = str.toLowerCase();
        str = str.replace(/\s/g,'-');
        document.getElementById("slug").value = str;

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

        $("#testimonialform").validate({
          rules:{

            title:{
              required:true
          },
          slug:{
              required:true
          },
          description:{
              required:true
          },
          status:{
              required:true
          }

      },
      messages:{
        description:'Please enter description',
        title:'Please enter title',
        slug: 'Plese enter slug',
        status: 'Plese choose status'
    }
});
    });
</script>

