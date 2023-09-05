<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('courier', 'Select Courier', array('class' => 'col-form-label')) !!}<span class="required">*</span> 
                {!! Form::Select('courier',array('eCourier'=>'eCourier'),Input::old('courier'),['id'=>'courier', 'class'=>'form-control selectheight']) !!}
                <span class="error">{!! $errors->first('courier') !!}</span>
            </div>

        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">

            <div class="col-md-12">
               <button  class="btn btn-info pull-right btn-sm font-10 m-t-15 ">Update</button>

                <a  class="btn btn-danger pull-right btn-sm font-10 m-r-10 m-t-15" data-dismiss="modal">Cancel</a>
            </div>
        </div>
        
    </div>
</div>

<script>
    $(function() {
        $("#courier_id").validate({
          rules:{

            courier:{
              required:true
            }
          },
          messages:{
            courier: 'Plese choose courier'
          }
        });
    });
</script>