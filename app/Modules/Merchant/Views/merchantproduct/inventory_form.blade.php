{!! Form::model($inventory_data,['method' => 'PATCH', 'files'=> true, "class"=>"", 'id' => 'inventory_form']) !!}
<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>

    <div class="row">

        <div class="col-md-6">
            <div class="form-group">

                <div class="form-line">
                    {!! Form::label('warehouse', 'Ware House', array('class' => 'col-form-label')) !!}                        {!! Form::Select('warehouse',array('self'=>'Self'),Input::old('warehouse'),['id'=>'warehouse', 'class'=>'form-control
                    selectheight']) !!}
                    <span class="error">{!! $errors->first('warehouse') !!}</span>

                    <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">

                </div>
            </div>

            <div class="form-group">

                <div class="form-line">
                    {!! Form::label('item_number', 'Item Number', array('class' => 'col-form-label')) !!}                         {!! Form::text('item_number',!empty($inventory_data->item_number)?$inventory_data->item_number:$product->item_no,['id'=>'item_number','class'
                    => 'form-control','required'=> 'required', 'title'=>'Enter product item_number' ]) !!}

                    <span class="error">{!! $errors->first('item_number') !!}</span>
                </div>
            </div>

            <div class="form-group">

                <div class="form-line">
                    {!! Form::label('quantity', 'Quantity', array('class' => 'col-form-label')) !!} {!! Form::number('quantity',Input::old('quantity'),['id'=>'quantity','class'
                    => 'form-control','title'=>'Enter Brand Meta Image']) !!}

                    <span class="error">{!! $errors->first('quantity') !!}</span>
                </div>
            </div>

        </div>



        <div class="col-md-6">
            <div class="form-group">

                <div class="form-line">
                    {!! Form::label('note', 'Note', array('class' => 'col-form-label')) !!} {!! Form::textarea('note',Input::old('note'),['id'=>'note','class'
                    => 'textarea form-control', 'title'=>'Enter note', 'rows'=>'9', 'cols'=>'50']) !!}

                    <span class="error">{!! $errors->first('note') !!}</span>
                </div>

            </div>

            <div class="form-group">
                <div class="col-md-12">

                    <input type="submit" name="save_continue" class="btn btn-primary pull-right btn-sm font-10 m-r-15" value="Save Change">

                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}