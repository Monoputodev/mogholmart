<?php
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Input;
?>

<div class="row">
    
    <div class="col-md-6">
        <div class="form-group">
            
            <div class="form-line brandheight">
                {!! Form::label('category_id', 'Select Category', array('class' => 'col-form-label')) !!}

                <select id="category_select" name="category_id[]" class="form-control" multiple></select>
            </div>

            <span class="error">{!! $errors->first('category_id') !!}</span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('disc_percentage', 'Discount Percentage', array('class' => 'col-form-label')) !!}    

                {!! Form::number('disc_percentage',Input::old('disc_percentage'),['id'=>'disc_percentage','class' => 'form-control','required'=> 'required', 'placeholder'=>'Discount Percentage']) !!}

                <span class="error">{!! $errors->first('name') !!}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('start_date', 'Start Date', array('class' => 'col-form-label')) !!}    
               {!! Form::text('start_date',Input::old('start_date'),['id'=>'start_date', 'class'=>'form-control', 'placeholder'=>'yyyy-mm-dd']) !!}
                <span class="error">{!! $errors->first('start_date') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('end_date', 'End Date', array('class' => 'col-form-label')) !!}    
               {!! Form::text('end_date',Input::old('end_date'),['id'=>'end_date', 'class'=>'form-control', 'placeholder'=>'yyyy-mm-dd']) !!}
                <span class="error">{!! $errors->first('end_date') !!}</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('type', 'Type', array('class' => 'col-form-label')) !!}    
                {!! Form::Select('type',array('include'=>'Include','exclude'=>'Exclude','exclude-cashback' => 'Exclude Cashback'),Input::old('type'),['id'=>'type', 'class'=>'form-control selectheight']) !!}
                <span class="error">{!! $errors->first('type') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('status', 'Status', array('class' => 'col-form-label')) !!}    
                {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control selectheight']) !!}
                <span class="error">{!! $errors->first('status') !!}</span>
            </div>
        </div>
    </div>
        <div class="col-md-12">

                {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
            </div>
    </div>



<script>
    
    ///alert($("#put_category").val());

    /*var valoresArea=$('#put_category').val(); // it has the multiple values to set, separated by comma
    var arrayArea = valoresArea.split(',');
    $('#category_select').val(arrayArea);*/

    $('#category_select').select2({

        placeholder: "Select Category",
        minimumInputLength: 2,
        ajax: {
            url: "{{ url('admin-discount-category') }}",
            type: 'GET',
            data: { _token: '{!! csrf_token() !!}'},
            dataType: 'json',
            data: function (params) {
                return {
                    q: $.trim(params.term)
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

   

    

    jQuery('#start_date').datepicker({
        format: 'yyyy-mm-dd',
    });
    jQuery('#end_date').datepicker({
        format: 'yyyy-mm-dd',
    });

    $("#discount").validate({
          rules:{
            
            category_select:{
              required:true
            },
            disc_percentage:{
              required:true
            },
            start_date:{
              required:true
            },
            end_date:{
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
            category_select:'Please select category',
            disc_percentage: 'Plese enter discount persentage',
            start_date: 'Plese enter start date',
            end_date:'Please enter end date',
            type: 'Plese enter hub type',
            status: 'Plese choose status'
          }
    });
</script>

