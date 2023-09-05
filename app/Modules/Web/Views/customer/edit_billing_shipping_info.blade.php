{!! Form::model($billing_shipping_data, ['method' => 'PATCH', 'files'=> true, 'route'=> ['customer.update.billing.shipping.info', $billing_shipping_data->id], "class"=>"attribute_option_form" ]) !!}
    <div class="contact-us section">
        <div class="container form-main">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">

                        {!! Form::Select('type',array(''=>'Select Type','billing'=>'Billing','shipping' => 'Shipping'),Request::old('type'),['id'=>'type', 'class'=>'form-control inputfield', 'required']) !!}

                        <span class="errors">
                            {!! $errors->first('type') !!}
                        </span>

                        <input type="hidden" name="users_id" value="{{$billing_shipping_data->users_id}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">

                        {!! Form::text('first_name',Request::old('first_name'),['id'=>'first_name', 'class' => 'form-control inputfield','placeholder'=>'Name', 'required']) !!}

                        <span class="errors">
                            {!! $errors->first('first_name') !!}
                        </span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">

                        {!! Form::email('email',Request::old('email'),['id'=>'email', 'class' => 'form-control inputfield','placeholder'=>'Email','required']) !!}

                        <span class="errors">
                            {!! $errors->first('email') !!}
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">

                        {!! Form::number('phone',Request::old('phone'),['id'=>'phone', 'class' => 'form-control inputfield','placeholder'=>'Enter your phone no', 'required']) !!}

                        <span class="errors">
                            {!! $errors->first('phone') !!}
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">

                        {!! Form::number('alternative_phone',Request::old('alternative_phone'),['id'=>'alternative_phone', 'class' => 'form-control inputfield','placeholder'=>'optional']) !!}

                        <span class="errors">
                            {!! $errors->first('alternative_phone') !!}
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">

                        {!! Form::text('city',Request::old('city'),['id'=>'city', 'class' => 'form-control inputfield','placeholder'=>'City Name', 'required']) !!}

                        <span class="errors">
                            {!! $errors->first('city') !!}
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::text('area',Request::old('area'),['id'=>'area', 'class' => 'form-control inputfield','placeholder'=>'Area Name', 'required']) !!}
                        <span class="errors">
                            {!! $errors->first('area') !!}
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::text('post_code',Request::old('post_code'),['id'=>'post_code', 'class' => 'form-control inputfield','placeholder'=>'Post code ', 'required']) !!}
                        <span class="errors">
                            {!! $errors->first('post_code') !!}
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">

                        {!! Form::textarea('address',Request::old('address'),['id'=>'address', 'class' => 'form-control inputfield','placeholder'=>'Address', 'required','rows'=>'3',]) !!}

                        <span class="errors">
                            {!! $errors->first('address') !!}
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">

                        {!! Form::textarea('special_instruction',Request::old('special_instruction'),['id'=>'special_instruction', 'class' => 'form-control inputfield','placeholder'=>'Special instruction for address','rows'=>'3']) !!}

                        <span class="errors">
                            {!! $errors->first('special_instruction') !!}
                        </span>
                    </div>
                </div>


                <div class="col-md-12">
                    <a  class="btn btn-danger btn-sm pull-right" data-dismiss="modal" style="background: red;color: white">Cancel</a>
                    <button  class="btn btn-success btn-sm pull-right m-r-10">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

