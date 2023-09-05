
<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>

{!! Form::model($billing_shipping_data, ['method' => 'PATCH', 'files'=> true, 'route'=> ['order.update.billing.shipping.info', $billing_shipping_data->id], 'id'=>'customer_address_form' ]) !!}
<div class="row">
    <div class="col-md-12 ">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('first_name', 'Name', array('class' => 'col-form-label')) !!}    
                {!! Form::text('first_name',Input::old('first_name'),['id'=>'first_name', 'class' => 'form-control inputfield','placeholder'=>'First Name', 'required']) !!}

                <span class="errors">
                    {!! $errors->first('first_name') !!}
                </span>

            </div>
        </div>
    </div>
    <div class="col-md-6 m-t-15">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('email', 'Email', array('class' => 'col-form-label')) !!}    
                {!! Form::email('email',Input::old('email'),['id'=>'email', 'class' => 'form-control inputfield','placeholder'=>'email']) !!}

                <span class="errors">
                    {!! $errors->first('email') !!}
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-6 m-t-15">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('phone', 'Phone', array('class' => 'col-form-label')) !!}    
                {!! Form::number('phone',Input::old('phone'),['id'=>'phone', 'class' => 'form-control inputfield','placeholder'=>'phone number', 'required']) !!}

                <span class="errors">
                    {!! $errors->first('phone') !!}
                </span>
            </div>
        </div>
    </div>
    

    <div class="col-md-4 m-t-15">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('city', 'City', array('class' => 'col-form-label')) !!}    
                
                 {!! Form::text('city',Input::old('city'),['id'=>'city', 'class' => 'form-control inputfield','placeholder'=>'city name', 'required']) !!}

                <span class="errors">
                    {!! $errors->first('city') !!}
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-4 m-t-15">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('area', 'Area', array('class' => 'col-form-label')) !!}    

               {!! Form::text('area',Input::old('area'),['id'=>'area', 'class' => 'form-control inputfield','placeholder'=>'area name', 'required']) !!}

                <span class="errors">
                    {!! $errors->first('area') !!}
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-4 m-t-15">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('post_code', 'Post Code', array('class' => 'col-form-label')) !!}    

               {!! Form::text('post_code',Input::old('post_code'),['id'=>'post_code', 'class' => 'form-control inputfield','placeholder'=>'post code no', 'required']) !!}

                <span class="errors">
                    {!! $errors->first('post_code') !!}
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-6 m-t-15">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('address', 'Address', array('class' => 'col-form-label')) !!}    
                {!! Form::textarea('address',Input::old('address'),['id'=>'address', 'class' => 'form-control inputfield','placeholder'=>'Address', 'required','rows'=>'3', 'cols'=>'50']) !!}

                <span class="errors">
                    {!! $errors->first('address') !!}
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-6 m-t-15">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('special_instruction', 'Special Instruction', array('class' => 'col-form-label')) !!}
                {!! Form::textarea('special_instruction',Input::old('special_instruction'),['id'=>'special_instruction', 'class' => 'form-control inputfield','placeholder'=>'Special Instruction','rows'=>'3', 'cols'=>'50']) !!}

                <span class="errors">
                    {!! $errors->first('special_instruction') !!}
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-12 m-t-15">
        <a  class="btn btn-danger btn-sm pull-right" data-dismiss="modal">Cancel</a>
        <button  class="btn btn-info btn-sm pull-right m-r-10">Update</button>
    </div>
</div>
{!! Form::close() !!}

<script type="text/javascript">

    jQuery('.select2class').select2({
            width: "100%",
            tag: true
    });

    $(document).delegate('.city-ajax','change',function () {

        var city_name = $(this).val();

        $.ajax({
            url: '{{ url(config('global.prefix_name').'/order/city/to/area') }}',
            type: 'POST',
            data: { _token: '{!! csrf_token() !!}', city_name:city_name},
            dataType: "json",
            success: function (data) {

                if(data.result == 'success'){

                    $('.modal-area-ajax').html(data.data);
                }else{
                    alert(data.message);
                }
            }
        });

        return false;
    });

</script>