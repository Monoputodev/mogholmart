<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            
            <div class="form-line">
                {!! Form::label('note', 'Enter the refund note', array('class' => 'col-form-label')) !!}<span class="required">*</span> 
                {!! Form::textarea('note',Input::old('note'),['id'=>'note','class' => 'form-control', 'title'=>'Enter note', 'rows'=>'3', 'cols'=>'50']) !!}
            </div>

             <span class="error">{!! $errors->first('note') !!}</span>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">

            <div class="col-md-12">
                {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
            </div>
        </div>
        
    </div>
</div>

<script>
    $(function() {
        $("#order_refund").validate({
          rules:{

            note:{
              required:true
            }
          },
          messages:{
            note: 'Plese choose note'
          }
        });
    });
</script>