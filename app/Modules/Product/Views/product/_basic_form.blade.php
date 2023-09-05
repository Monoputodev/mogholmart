<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>
<div class="row">
    <div class="col-md-3 pr-0">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('title', 'Title', array('class' => 'col-form-label')) !!} 

                {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control','required'=> 'required',  'placeholder'=>'Enter Product Title', 'onkeyup'=>"convert_to_slug();"]) !!}
                <span class="error">{!! $errors->first('title') !!}</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('slug', 'Slug', array('class' => 'col-form-label')) !!} 

                {!! Form::text('slug',Input::old('slug'),['id'=>'slug','class' => 'form-control','required'=> 'required', 'placeholder'=>'Enter Product Slug' ]) !!}

                <span class="error">{!! $errors->first('slug') !!}</span>
            </div>
        </div>
    </div>

    
    
    <div class="col-md-3">
        <div class="form-group">


            <div class="form-line">
                {!! Form::label('manufacturer_id', 'Company Name', array('class' => 'col-form-label')) !!}

                {!! Form::Select('manufacturer_id', $manufacturer_lists ,Input::old('manufacturer_id'),['id'=>'manufacturer_id', 'class'=>'form-control selectheighttype select2class']) !!}
                <span class="error">{!! $errors->first('manufacturer_id') !!}</span>
                <input type="hidden" name="product_id" id="product_id" value="{{$data->id}}">
                <input type="hidden" name="short_description" value="">
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">

            <div class="form-line brandheight">
                {!! Form::label('brand_id', 'Select Brand', array('class' => 'col-form-label')) !!}

                <select class="form-control selectheight" id="brand_select" name="brand[]" multiple="multiple"></select>
            </div>

            <span class="error">{!! $errors->first('brand_id') !!}</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">


            <div class="form-line">
                {!! Form::label('attribute_set_id', 'Attribute Set', array('class' => 'col-form-label')) !!} 

                {!! Form::Select('attribute_set_id', $attribute_set_lists ,Input::old('attribute_set_id'),['id'=>'attribute_set_id', 'class'=>'form-control selectheighttype select2class']) !!}
                <span class="error">{!! $errors->first('attribute_set_id') !!}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 pr-0">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('item_no', 'Product Code', array('class' => 'col-form-label')) !!} 

                {!! Form::text('item_no',Input::old('item_no'),['id'=>'item_no','class' => 'form-control','required'=> 'required', 'placeholder'=>'Enter Product Code' ]) !!}

                <input type="hidden" name="item_no_copy" value="{{$data->item_no}}">

                <span class="error">{!! $errors->first('item_no') !!}</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 pr-0">
        <div class="form-group">

            <div class="form-line">
                {!! Form::label('sell_price', 'Sales Price', array('class' => 'col-form-label')) !!} 

                {!! Form::number('sell_price',Input::old('sell_price'),['id'=>'sell_price','class' => 'form-control','required'=> 'required', 'placeholder'=>'0.00' ]) !!}

                <span class="error">{!! $errors->first('sell_price') !!}</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 pr-0">
        <div class="form-group">
         <div class="form-line">
            {!!  Form::label('comission', 'Comission', array('class' => 'col-form-label')) !!} 

            {!! Form::number('comission',Input::old('comission'),['id'=>'comission','class' => 'form-control','placeholder'=>'0.00','title'=>'Enter comission according to list price' ]) !!}
            <span class="error">{!! $errors->first('status') !!}</span>
        </div>
    </div>
</div>
<div class="col-md-2 pr-0">
    <div class="form-group">

        <div class="form-line">
            {!! Form::label('list_price', 'Purchase Price', array('class' => 'col-form-label')) !!} 

            {!! Form::number('list_price',Input::old('list_price'),['id'=>'list_price','class' => 'form-control','required'=> 'required', 'placeholder'=>'0.00' ]) !!}

            <span class="error">{!! $errors->first('list_price') !!}</span>
        </div>
    </div>
</div> 

<div class="col-md-3 pr-0">
    <div class="form-group">

        <div class="form-line">
            {!! Form::label('offer_price', 'Regular Price (For Offer Product)', array('class' => 'col-form-label')) !!}

            {!! Form::number('offer_price',Input::old('offer_price'),['id'=>'offer_price','class' => 'form-control','placeholder'=>'0.00', 'title'=>'Its only fiilabe when you give an offer' ]) !!}

            <span class="error">{!! $errors->first('offer_price') !!}</span>
        </div>
    </div>
</div> 

<div class="col-md-2">
 <div class="form-group">

    <div class="form-line">
        {!!  Form::label('weight', 'Weight', array('class' => 'col-form-label')) !!} 

        {!! Form::number('weight',Input::old('weight'),['id'=>'weight','class' => 'form-control','placeholder'=>'Enter Product Weight' ]) !!}
        <span class="error">{!! $errors->first('weight') !!}</span>
    </div>


</div>

</div>
<div class="col-md-3">
 <div class="form-group">

    <div class="form-line">
        {!!  Form::label('unit', 'Unit', array('class' => 'col-form-label')) !!} 

        {!! Form::Select('unit',array('gram'=>'gm','kg'=>'kg','millilitre' => 'mL','litre' => 'L'),Input::old('unit'),['id'=>'unit', 'class'=>'form-control selectheight']) !!}
        <span class="error">{!! $errors->first('unit') !!}</span>
    </div>
</div>
</div>
<div class="col-md-2">
 <div class="form-group">

    <div class="form-line">
        {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!} 

        {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel' => 'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control selectheight']) !!}
        <span class="error">{!! $errors->first('status') !!}</span>
    </div>
</div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <div class="col-md-12">

            <input type="submit" name="finish" class="btn btn-warning pull-right  font-10 m-r-15" value="Save & Finished">

            <input type="submit" name="save_continue" class="btn btn-primary pull-right  font-10 m-r-15" value="Save & Continue">

        </div>
    </div>
    
</div>
</div>

<script>
    jQuery('.select2class').select2({
        width: "100%",
        tag: true
    });
    function convert_to_slug(){
        var str = document.getElementById("title").value;
        str = str.replace(/[^a-zA-Z0-12\s]/g,"");
        str = str.toLowerCase();
        str = str.replace(/\s/g,'-');
        document.getElementById("slug").value = str;

    }

    $(function() {
        // highlight
        var elements = $("input[type!='submit'], textarea, select");
        elements.focus(function() {
            $(this).parents('li').addClass('highlight');
        });
        elements.blur(function() {
            $(this).parents('li').removeClass('highlight');
        });

        $("#productform").validate({
          rules:{

            title:{
              required:true
          },
          slug:{
              required:true
          },

          item_no:{
              required:true
          },
          sell_price:{
              required:true
          },
          list_price:{
              required:true
          },
          status:{
              required:true
          },

          
      },
      messages:{
        title:'Please enter title',
        slug: 'Plese enter slug',
        
        list_price:'Please enter list price',
        sale_price: 'Plese enter sale price',
        status: 'Plese choose status',
        
    }
});
    });


    function select2_brand(target,data,selected) {

        $(target).select2({
            placeholder: 'Select brand',
            width: "100%",
            closeOnSelect: false,
            data: data,
            multiple: true,
            formatSelection: function(item) {
                return item.text
            },
            formatResult: function(item) {
                return item.name
            },
            
        });

        $(target).val(selected).trigger("change");
    }

    $(document).delegate('#manufacturer_id','change',function () {

        var manufacturer_id = $(this).val();
        var product_id = $('#product_id').val();

        $.ajax({
            url: '{{ url(config('global.prefix_name').'/product/brand') }}',
            type: 'POST',
            data: { _token: '{!! csrf_token() !!}', manufacturer_id:manufacturer_id,product_id:product_id},
            dataType: "json",
            success: function (data) {

                if(data.result == 'success'){

                    $('#brand_select').html(data.data);
                    brand_data = data.brand_data;

                    select2_brand("#brand_select",brand_data,data.selected);

                }else{
                    alert(data.message);
                }
            }
        });

        return false;
    });
    
    $( document ).ready(function() {
        $('#manufacturer_id').trigger('change');
    });

    /*persentage calculate */


    function isNumeric(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }



    $('#comission').on('change', function() {

        calculate();

    });


    function calculate(){

        var sell_price = $('#sell_price').val().replace(/ +/g, "");
        var comission = $('#comission').val().replace(/ +/g, "");
        var perc = "0";
        if (sell_price.length > 0 && comission.length > 0) {
            if (isNumeric(sell_price) && isNumeric(comission)) {
                perc = (sell_price)-(sell_price*comission)/ 100;
            }
        }    
        $('#list_price').val(perc);

    }
</script>

