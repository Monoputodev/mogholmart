<?php
use Illuminate\Support\Facades\URL;
use Request;
?>
<div class="well row">
  <div class="col-md-12">
    <div class="form-group">
      <div class="form-line">
        {!! Form::label('note', 'Enter the refund note', array('class' => 'col-form-label')) !!}<span class="required">*</span> 
        {!! Form::textarea('note',Request::old('note'),['id'=>'note','class' => 'form-control', 'title'=>'Enter note', 'rows'=>'3', 'cols'=>'50','required']) !!}
      </div>
      <span class="error">{!! $errors->first('note') !!}</span>
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <div class="col-md-12">
       <a  class="btn btn-danger btn-sm pull-right m-t-15" style="margin-left: 10px;" data-dismiss="modal">Cancel</a>
       {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
     </div>
   </div>

 </div>
</div>
