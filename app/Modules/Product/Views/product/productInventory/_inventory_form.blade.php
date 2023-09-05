<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


<div class="row">

    <div class="col-md-6">
        <div class="form-group">

         <div class="form-line">
            {!! Form::label('warehouse', 'Ware House', array('class' => 'col-form-label')) !!}     

            {!! Form::Select('warehouse',array('self'=>'Self'),Input::old('warehouse'),['id'=>'warehouse', 'class'=>'form-control selectheight']) !!}
            <span class="error">{!! $errors->first('warehouse') !!}</span>
        </div>
    </div>
    <br>
    <div class="form-group">

        <div class="form-line">
            {!! Form::label('item_number', 'Product Code', array('class' => 'col-form-label')) !!}     

            {!! Form::text('item_number',!empty($inventory_data->item_number)?$inventory_data->item_number:$data->item_no,['id'=>'item_number','class' => 'form-control','required'=> 'required', 'title'=>'Enter product item_number' ]) !!}

            <span class="error">{!! $errors->first('item_number') !!}</span>
        </div>
    </div>
    <br>
    <div class="form-group">

        <div class="form-line">
            {!! Form::label('quantity', 'Quantity', array('class' => 'col-form-label')) !!}

            {!! Form::number('quantity',Input::old('quantity'),['id'=>'quantity','class' => 'form-control','placeholder'=>'Enter product quantity']) !!}

            <span class="error">{!! $errors->first('quantity') !!}</span>
        </div>
    </div>

</div>



<div class="col-md-6">
    <div class="form-group">

        <div class="form-line">
            {!! Form::label('note', 'Note', array('class' => 'col-form-label')) !!}

            {!! Form::textarea('note',Input::old('note'),['id'=>'note','class' => 'form-control', 'placeholder'=>'Enter note', 'rows'=>'6', 'cols'=>'50']) !!}

            <span class="error">{!! $errors->first('note') !!}</span>
        </div>

    </div>
    <br>
    <div class="form-group">
        <div class="col-md-12">
            {!!  Form::label('', '', array('class' => 'col-form-label')) !!}

            <input type="submit" name="finish" class="btn btn-warning pull-right btn-sm font-10 m-r-15" value="Save & Finished">

            <input type="submit" name="save_continue" class="btn btn-primary pull-right btn-sm font-10 m-r-15" value="Save & Continue">

        </div>
    </div>
</div>
</div>

</div>

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

        $("#inventoryform").validate({
          rules:{

            warehouse:{
              required:true
          },
          item_number:{
              required:true,
          },
          quantity:{
              required:true,
              number:true
          },

      },
      messages:{
        warehouse:'Please select a warehouse',
        item_number:'Please enter item number',
        quantity:'Please enter product quantity',

    }
});
    });
</script>

