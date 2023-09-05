<?php
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Input;
?>

<div class="row">

    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('title', 'Hub Name', array('class' => 'col-form-label')) !!}    
                {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control','required'=> 'required',  'title'=>'Enter Title','placeholder'=>'Hub/Area Name', 'onkeyup'=>"convert_to_slug();"]) !!}
                <span class="error">{!! $errors->first('name') !!}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('slug', 'Hub Slug', array('class' => 'col-form-label')) !!}    
                {!! Form::text('slug',Input::old('slug'),['id'=>'slug','class' => 'form-control','required'=> 'required', 'placeholder'=>'Slug' ]) !!}
                <span class="error">{!! $errors->first('slug') !!}</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('status', 'Status', array('class' => 'col-form-label')) !!}    
                {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control selectheight']) !!}
                <span class="error">{!! $errors->first('status') !!}</span>
            </div>
        </div>
    </div>
        <div class="col-md-6">

                {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
            </div>
    </div>




<!-- @@============================================validate and convet to slug part=========================@@ -->

<script>

    function convert_to_slug(){
        var str = document.getElementById("title").value;
        str = str.replace(/[^a-zA-Z0-12\s]/g,"");
        str = str.toLowerCase();
        str = str.replace(/\s/g,'-');
        document.getElementById("slug").value = str;

    }

    $("#hubform").validate({
          rules:{
            
            title:{
              required:true
            },
            slug:{
              required:true
            },

            status:{
              required:true
            }
            
          },
          messages:{
            title:'Please enter hub name',
            slug: 'Plese enter hub slug',
            status: 'Plese choose status'
          }
    });
</script>

