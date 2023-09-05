<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


<div class="row">

    <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('email', 'Email', array('class' => 'col-form-label')) !!}     

                {!! Form::text('email',Input::old('email'),['id'=>'email','class' => 'form-control','required'=> 'required',  'email'=>'Enter User email']) !!}
                {!! $errors->first('email') !!}
            </div>
        </div>
    </div>

    @if (!isset ($data) && empty($data->id))
       <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('password', 'Password', array('class' => 'col-form-label')) !!}     
                
                {{ Form::password('password', array('id'=>'password', 'class'=>'form-control', 'required'=> 'required', 'title'=>'Enter User password' ) ) }}

                {!! $errors->first('password') !!}
            </div>
        </div>
    </div> 
    @endif
    
    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('first_name', 'First Name', array('class' => 'col-form-label')) !!}     

                {!! Form::text('first_name',Input::old('first_name'),['id'=>'first_name','class' => 'form-control','required'=> 'required', 'title'=>'Enter User first_name' ]) !!}

                {!! $errors->first('first_name') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('last_name', 'Last Name', array('class' => 'col-form-label')) !!}     

                {!! Form::text('last_name',Input::old('last_name'),['id'=>'last_name','class' => 'form-control','required'=> 'required', 'title'=>'Enter User last_name' ]) !!}

                {!! $errors->first('last_name') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('roles_id', 'Roles', array('class' => 'col-form-label')) !!}     

                {!! Form::Select('roles_id', $roles_list ,Input::old('roles_id'),['id'=>'roles_id', 'class'=>'form-control selectheight']) !!}
                <span class="error">{!! $errors->first('roles_id') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line">
                {!!  Form::label('type', 'User Type', array('class' => 'col-form-label')) !!}     

                {!! Form::Select('type',array('admin'=>'Admin','customer'=>'Customer','seller' => 'Seller'),Input::old('type'),['id'=>'type', 'class'=>'form-control selectheight']) !!}
                {!! $errors->first('type') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('image', 'Image', array('class' => 'col-form-label')) !!}
                <span class="error">Supported format :: jpeg,png,jpg,gif & file size max :: 1MB</span>

                <div style="position:relative;">
                    <a class='btn btn-primary btn-sm font-10' href='javascript:;'>
                        Choose File...
                        <input name="image" type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                    </a>
                    &nbsp;
                    <span class='label label-info' id="upload-file-info"></span>

                    
                </div>

                @if(isset($data['image'] ) && !empty($data['image']) )
                <a target="_blank" href="{{URL::to('')}}/uploads/user/{{$data->image}}" style="margin-top: 5px;" class="btn btn-primary btn-sm font-10"><img src="{{URL::to('')}}/uploads/user/{{$data->image}}" height="50px" alt="{{$data['image']}}" ></img>
                </a>
                @endif
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

        {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

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

$("#userform").validate({
    rules:{
        roles_id:{
            required:true,
            number:true
        },
        email:{
            required:true,
            email:email
        },
        password:{
            required:true,
            minlength:6,
            maxlength:20
        },
        first_name:{
            required:true
        },
        last_name:{
            required:true
        },
        type:{
            required:true
        },

        status:{
            required:true
        }

    },
    messages:{
        roles_id:'Please choose Roles',
        email:'Please enter email',
        password: 'Plese enter password',
        first_name: 'Plese enter first name',
        last_name: 'Plese enter last name',
        type: 'Plese choose type',
        status: 'Plese choose status'
    }
});
});
</script>

