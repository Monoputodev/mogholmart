<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


       <div class="col-md-12">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('old_password', 'Current Password', array('class' => 'col-form-label')) !!}     

                {!! Form::password('old_password',['id'=>'old_password','class' => 'form-control','required'=> 'required', 'title'=>'Enter Current old_password' ]) !!}

                {!! $errors->first('old_password') !!}
            </div>
        </div>
    </div> 

    
    <div class="col-md-12">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('password', 'New Password', array('class' => 'col-form-label')) !!}     

                {!! Form::password('password',['id'=>'password','class' => 'form-control','required'=> 'required', 'title'=>'Enter User New password' ]) !!}

                {!! $errors->first('password') !!}

            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('password_confirmation', 'Confirm Password', array('class' => 'col-form-label')) !!}     

                {!! Form::password('password_confirmation',['id'=>'password_confirmation','class' => 'form-control','required'=> 'required', 'title'=>'Retype Password' ]) !!}

                {!! $errors->first('password_confirmation') !!}
            </div>
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-12">
                {!!  Form::label('', '', array('class' => 'col-form-label')) !!}
                
                {!! Form::submit('Rest Password', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

            </div>
        </div>
    </div>



<!-- @@============================================validate and convet to slug part=========================@@ -->


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

$("#password_resetfrom").validate({
    rules:{
        
        old_password:{
            required:true,
        },
        password:{
            required:true,
            minlength:6,
            maxlength:20
        },
        password_confirmation:{
            required:true,
            equalTo: '#password',
        },
        

    },
    messages:{
        old_password:'Please enter old password',
        password:'Please enter new password',
        password_confirmation: 'Plese retype password',
    }
});
});
</script>

