<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('email', 'Email', array('class' => 'col-form-label')) !!}     

                {!! Form::text('email',Input::old('email'),['id'=>'email','class' => 'form-control','required'=> 'required',  'placeholder'=>'Enter Merchant email']) !!}
                {!! $errors->first('email') !!}
            </div>
        </div>
    </div>


    @if (!isset ($data) && empty($data->id))
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('password', 'Password', array('class' => 'col-form-label')) !!}     
                
                {{ Form::password('password', array('id'=>'password', 'class'=>'form-control', 'required'=> 'required', 'placeholder'=>'Enter Merchant password' ) ) }}

                {!! $errors->first('password') !!}
            </div>
        </div>
    </div> 
    @endif


    <div class="col-md-3">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('first_name', 'First Name', array('class' => 'col-form-label')) !!}     

                {!! Form::text('first_name',Input::old('first_name'),['id'=>'first_name','class' => 'form-control','required'=> 'required', 'placeholder'=>'Enter User First Name' ]) !!}

                {!! $errors->first('first_name') !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('last_name', 'Last Name', array('class' => 'col-form-label')) !!}     

                {!! Form::text('last_name',Input::old('last_name'),['id'=>'last_name','class' => 'form-control','required'=> 'required', 'placeholder'=>'Enter User Last Name' ]) !!}

                {!! $errors->first('last_name') !!}
            </div>
        </div>
    </div>
    

    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('fathers_name', 'Fathers Name', array('class' => 'col-form-label')) !!}     

                {!! Form::text('fathers_name',Input::old('fathers_name'),['id'=>'fathers_name','class' => 'form-control','required'=> 'required',  'placeholder'=>'Enter User Fathers Name']) !!}
                {!! $errors->first('fathers_name') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('age', 'Your Age', array('class' => 'col-form-label')) !!}     

                {!! Form::text('age',Input::old('age'),['id'=>'age','class' => 'form-control', 'required'=> 'required',  'placeholder'=>'Enter User Age']) !!}
                {!! $errors->first('age') !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('shop_name', 'Shop Name', array('class' => 'col-form-label')) !!}     

                {!! Form::text('shop_name',Input::old('shop_name'),['id'=>'shop_name','class' => 'form-control','required'=> 'required',  'placeholder'=>'Enter User Shop Name']) !!}
                {!! $errors->first('shop_name') !!}
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('mobile_no', 'Mobile No', array('class' => 'col-form-label')) !!}     

                {!! Form::number('mobile_no',Input::old('mobile_no'),['id'=>'mobile_no','class' => 'form-control','required'=> 'required', 'placeholder'=>'Enter Mobile No' ]) !!}

                {!! $errors->first('mobile_no') !!}
            </div>
        </div>
    </div>
    

    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('nid', 'Your Nid', array('class' => 'col-form-label')) !!}     

                {!! Form::text('nid',Input::old('nid'),['id'=>'nid','class' => 'form-control', 'required'=> 'required',  'placeholder'=>'Enter User Nid']) !!}
                {!! $errors->first('nid') !!}
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('tin_no', 'TIN / Trade with ward no', array('class' => 'col-form-label')) !!}     

                {!! Form::text('tin_no',Input::old('tin_no'),['id'=>'tin_no','class' => 'form-control', 'required'=> 'required',  'placeholder'=>'00000000 / 0000-000000']) !!}
                {!! $errors->first('tin_no') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!!  Form::label('type', 'User Type', array('class' => 'col-form-label')) !!}     

                {!! Form::Select('type',array('seller' => 'Seller'),Input::old('type'),['id'=>'type', 'class'=>'form-control selectheight']) !!}
                {!! $errors->first('type') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!!  Form::label('merchant_agreement', 'Merchant Agreement', array('class' => 'col-form-label')) !!}     

                {!! Form::Select('merchant_agreement',array('no' => 'No','yes' => 'Yes'),Input::old('merchant_agreement'),['id'=>'merchant_agreement', 'class'=>'form-control selectheight']) !!}
                {!! $errors->first('merchant_agreement') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('shop_address', 'Shop Address', array('class' => 'col-form-label')) !!}     

                {!! Form::textarea('shop_address',Input::old('shop_address'),['id'=>'shop_address','class' => 'form-control', 'placeholder'=>'Enter Shop Address','rows'=>'4' ]) !!}

                {!! $errors->first('shop_address') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('shop_description', 'Shop Description', array('class' => 'col-form-label')) !!}     

                {!! Form::textarea('shop_description',Input::old('shop_description'),['id'=>'shop_description','class' => 'form-control', 'placeholder'=>'Enter Shop Description','rows'=>'4' ]) !!}

                {!! $errors->first('shop_description') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('shop_agreement', 'Shop Agreement', array('class' => 'col-form-label')) !!}     

                {!! Form::textarea('shop_agreement',Input::old('shop_agreement'),['id'=>'shop_agreement','class' => 'form-control textarea', 'placeholder'=>'Enter Shop Agreement','rows'=>'4' ]) !!}

                {!! $errors->first('shop_agreement') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('agreement_details', 'Shop Agreement Details', array('class' => 'col-form-label')) !!}     

                {!! Form::textarea('agreement_details',Input::old('agreement_details'),['id'=>'agreement_details','class' => 'form-control textarea','placeholder'=>'Enter Agreement Details','rows'=>'4' ]) !!}

                {!! $errors->first('agreement_details') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('agreement_date', 'Shop Agreement Date', array('class' => 'col-form-label')) !!}     

                {!! Form::text('agreement_date',Input::old('agreement_date'),['id'=>'agreement_date','class' => 'form-control datepic','placeholder'=>'yyyy-mm-dd']) !!}

                {!! $errors->first('agreement_date') !!}
            </div>
        </div>
        <br>
        <div class="form-group">

            <div class="form-line">
                {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!}     
                
                {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control selectheight']) !!}
                {!! $errors->first('status') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!!  Form::label('first_contact_person_details', 'Contact person one', array('class' => 'col-form-label')) !!}     
                
                {!! Form::number('first_contact_person_details',Input::old('first_contact_person_details'),['id'=>'first_contact_person_details','class' => 'form-control', 'placeholder'=>'Enter User first Contact Person Number']) !!}
                {!! $errors->first('first_contact_person_details') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <div class="form-line">
                {!!  Form::label('second_contact_person_details', 'Contact person Two', array('class' => 'col-form-label')) !!}     
                
                {!! Form::number('second_contact_person_details',Input::old('second_contact_person_details'),['id'=>'second_contact_person_details','class' => 'form-control','placeholder'=>'Enter User Second Contact Person Number']) !!}
                {!! $errors->first('second_contact_person_details') !!}
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

        {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

    </div>


</div>

<script>
    jQuery('.datepic').datepicker({
        language: 'en',
        dateFormat: 'yyyy-mm-dd',
        autoClose: true,

    });
$(function() {
    var elements = $("input[type!='submit'], textarea, select");
    elements.focus(function() {
        $(this).parents('li').addClass('highlight');
    });
    elements.blur(function() {
        $(this).parents('li').removeClass('highlight');
    });

    $("#userform").validate({
        rules:{
            shop_name:{
                required:true,
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
            mobile_no:{
                required:true
            },

            status:{
                required:true
            }

        },
        messages:{
            shop_name:'Please Enter Your Shop',
            email:'Please enter email',
            password: 'Plese enter password',
            first_name: 'Plese enter first name',
            last_name: 'Plese enter last name',
            type: 'Plese choose type',
            mobile_no: 'Plese Enter mobile no',
            status: 'Plese choose status'
        }
    });
});
</script>

