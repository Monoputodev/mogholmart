<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('title', 'Title', array('class' => 'col-form-label')) !!}     

                {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control','required'=> 'required',  'placeholder'=>'Enter Attribute Set Title', 'onkeyup'=>"convert_to_slug();"]) !!}
                <span class="error">{!! $errors->first('title') !!}</span>     
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('slug', 'Slug', array('class' => 'col-form-label')) !!}     

                {!! Form::text('slug',Input::old('slug'),['id'=>'slug','class' => 'form-control','required'=> 'required', 'placeholder'=>'Enter Attribute Set Slug' ]) !!}

                <span class="error">{!! $errors->first('slug') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line">
                {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!}     

                {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control selectheighttype']) !!}
                <span class="error">{!! $errors->first('status') !!}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            
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

            $("#attributesetform").validate({
                rules:{
                    title:{
                        required:true,
                    },
                    slug:{
                        required:true
                    },
                    status:{
                        required:true
                    }

                },
                messages:{
                    title:'Please enter title',
                    slug:'Please enter slug',
                    status: 'Plese choose status'
                }
            });
        });
</script>

