<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>
<div class="row">
  <div class="col-md-6">
      <div class="form-line">
        <label for="last_name">User Name</label> <span class="validatefont">*</span>
        {!! Form::text('first_name',Input::old('first_name'),['id'=>'first_name', 'class' => 'form-control inputfield','placeholder'=>'User Name',]) !!}

        <span class="errors">
            {!! $errors->first('first_name') !!}
        </span>
    </div>
</div>  


<div class="col-md-6">

    <div class="form-line">
        <label for="email">Email</label>
        {!! Form::text('email',Input::old('email'),['id'=>'email', 'class' => 'form-control inputfield','placeholder'=>'Email']) !!}

        <span class="errors">
            {!! $errors->first('email') !!}
        </span>
    </div>
</div>

<div class="col-md-12">

    <div class="form-line">
        <label for="phone">Phone No</label> <span class="validatefont"> *</span>
        {!! Form::number('phone',Input::old('phone'),['id'=>'phone', 'class' => 'form-control inputfield','placeholder'=>'Phone No', 'required']) !!}

        <span class="errors">
            {!! $errors->first('phone') !!}
        </span>
    </div>
    
</div>

<div class="col-md-6">
    
        <div class="form-line">
            <label for="last_name">City</label> <span class="validatefont">*</span>
           {!! Form::Select('city',$citylist,Request::old('city'),['id'=>'city', 'class'=>'form-control selectheighttype city-ajax select2class']) !!}

        <span class="errors">
            {!! $errors->first('city') !!}
        </span>                  
    </div>
</div>

<div class="col-md-6">


        <span class="form-line">
        <label for="last_name">Area</label> <span class="validatefont">*</span>

             {!! Form::Select('area',isset($arealist)?$arealist:[''=>'Select Area'],Request::old('area'),['id'=>'area', 'class'=>'form-control selectheighttype modal-area-ajax select2class']) !!}

            <span class="errors">
                {!! $errors->first('area') !!}
            </span>

        </span>




</div>
<div class="col-md-12">

    <div class="form-line">
        <label for="address">Address</label> <span class="validatefont">    *</span>
        {!! Form::textarea('address',Input::old('address'),['id'=>'address', 'class' => 'form-control inputfield','placeholder'=>'Address', 'required', 'rows'=>'3' ]) !!}

        <span class="errors">
            {!! $errors->first('address') !!}
        </span>
    </div>
    {!! Form::submit('Submit', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
</div>

</div>

<script type="text/javascript">
    $(document).delegate('.city-ajax','change',function () {

            var city_name = $(this).val();
            
            $.ajax({
                url: '{{ url(config('global.prefix_name').'/admin/city/to/area/ecourier') }}',
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