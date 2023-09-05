<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;

?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('division_id', 'Select Division', array('class' => 'col-form-label')) !!}    

                {!! Form::Select('division_id', $division_data ,Input::old('division_id'),['id'=>'division_id', 'class'=>'form-control selectheight division_id']) !!}
				


                <span class="error">{!! $errors->first('division_id') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('district_id', 'Select District', array('class' => 'col-form-label')) !!}     
				
				<select class="form-control selectheight district_id" id="district_id" name="district_id">
					
				</select>


                <span class="error">{!! $errors->first('district_id') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 m-t-10">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('thana_id', 'Select Thana', array('class' => 'col-form-label')) !!}     

                <select class="form-control selectheight thana_id" id="thana_id" name="thana_id">
					
				</select>
                <span class="error">{!! $errors->first('thana_id') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 m-t-10">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('deliver_day', 'Delivery Day', array('class' => 'col-form-label')) !!}     

                {!! Form::text('deliver_day',Input::old('deliver_day'),['id'=>'deliver_day','class' => 'form-control','required'=> 'required',  'deliver_day'=>'Enter dalivery day']) !!}
                <span class="error">{!! $errors->first('deliver_day') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 m-t-10">
        <div class="form-group">
           
            <div class="form-line">
                {!! Form::label('deliver_cost', 'Delivery Cost', array('class' => 'col-form-label')) !!}     

                {!! Form::number('deliver_cost',Input::old('deliver_cost'),['id'=>'deliver_cost','class' => 'form-control','required'=> 'required',  'deliver_cost'=>'Enter dalivery cost']) !!}
                <span class="error">{!! $errors->first('deliver_cost') !!}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 m-t-30">
            <div class="form-group">
                <div class="col-md-12">
               
                <input type="submit" name="finish" class="btn btn-warning pull-right btn-sm font-10 m-r-15" value="Save & Finished">

                 <input type="submit" name="save_continue" class="btn btn-primary pull-right btn-sm font-10 m-r-15" value="Save & Continue">

               </div>
            </div>
        
       </div>

</div>

<script type="text/javascript">

	$(document).delegate('.division_id','change',function () {

            var division_id = $(this).val();
            
            $.ajax({
                url: '{{ url('admin-product-district') }}',
                type: 'POST',
                data: { _token: '{!! csrf_token() !!}', division_id:division_id},
                dataType: "json",
                success: function (data) {

                    if(data.result == 'success'){

                        $('.district_id').html(data.data);
                    }else{
                        alert(data.message);
                    }
                }
            });

            return false;
        });

    $( ".division_id" ).trigger( "change" );

	$(document).delegate('.district_id','change',function () {

            var district_id = $(this).val();
            

            $.ajax({
                url: '{{ url('admin-product-thana') }}',
                type: 'POST',
                data: { _token: '{!! csrf_token() !!}', district_id:district_id},
                dataType: "json",
                success: function (data) {

                    if(data.result == 'success'){

                        $('.thana_id').html(data.data);
                    }else{
                        alert(data.message);
                    }
                }
            });

            return false;
        });

    $( ".division_id" ).trigger( "change" );

</script>