{!! Form::model($attributes,['method' => 'PATCH', 'files'=> true, "class"=>"product_attribute_form", 'id' => 'product_attribute_form']) !!}

<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>

    <?php
   
    $old_attributes = [];
    $old_attributes_data = $product->relProductAttribute;

    if(count($old_attributes_data) > 0){
        foreach ($old_attributes_data as $oa_key => $oa_value){
            $old_attributes[$oa_value->attribute_code] = $oa_value;
        }
    }
    ?>

<style type="text/css">
            .attribute_item_container_2 {}

            .attribute_item_container_2 label {
                margin-right: 10px;
            }

            .attribute_item_container_2 label input {}

            .attribute_checkbox_style {
                margin-right: 7px;
            }
</style>


        <div class="row">

            <div class="col-md-12">
                <?php
                        if(count($attributes) > 0){
                            foreach ($attributes as $attr){
                                $attr_item = $attr;
                                $attr_options = [];

                                if($attr_item->type =='dropdown'){
                                    $attr_options[''] = 'Select one option';
                                }

                                if(!empty($attr_item)){
                                    $attr_options_data = $attr->relAttributeOption;
                                    if(count($attr_options_data) > 0){
                                        foreach ($attr_options_data as $option){
                                            $attr_options[$option->frontend_title] = $option->backend_title;
                                        }
                                    }
                                }

                                $attr_val = '';
                                if(isset($old_attributes[$attr_item->code_column])){
                                    $attr_val = $old_attributes[$attr_item->code_column]->attribute_data;
                                }
                ?>


                    {!! Form::label($attr_item->code_column,$attr_item->backend_title) !!} @if($attr_item->type == 'textarea') {!! Form::textarea('Attribute['.$attr_item->code_column.']',
                    ($attr_val != '')?str_replace('==','',$attr_val):Input::old('Attribute['.$attr_item->code_column.']'),['id'=>$attr_item->code_column,'class'
                    => 'form-control']) !!} @elseif($attr_item->type =='text') {!! Form::text('Attribute['.$attr_item->code_column.']',($attr_val
                    != '')?str_replace('==','',$attr_val):Input::old('Attribute['.$attr_item->code_column.']'),['id'=>$attr_item->code_column,'class'
                    => 'form-control']) !!} @elseif($attr_item->type =='checkbox')

                    <?php
                $attr_counter = 0;
                $attr_val = explode('==',$attr_val);
                ?>
                        <div class="row">
                            <div class="container-fluid attribute_item_container_{{ $attr_item->id }}">
                                @if(count($attr_options) > 0) @foreach($attr_options as $opt_item_key => $opt_item_value)
                                <?php $attr_counter++; ?>
                                <label for="attribute_{{$attr_item->code_column.'_'.$attr_counter}}" class="pull-left attribute_checkbox_style">
                            {!! Form::checkbox('Attribute['.$attr_item->code_column.'][]' , $opt_item_key, (in_array($opt_item_key,$attr_val))?'checked':'' ,['class' => '','id'=>'attribute_'.$attr_item->code_column.'_'.$attr_counter]) !!} {{ $opt_item_value }}
                        </label> @endforeach 
                        @endif
                            </div>
                        </div>

                        @else {!! Form::text('Attribute['.$attr_item->code_column.']',($attr_val != '')?str_replace('==','',$attr_val):Input::old('Attribute['.$attr_item->code_column.']'),['id'=>$attr_item->code_column,'class'
                        => 'form-control']) !!} 
                        @endif


                        <?php
            }
        }
        ?>

                            <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
                            <input type="submit" name="save_continue" class="btn btn-primary pull-right btn-sm font-10 m-r-15" value="Save & Continue">

            </div>
        </div>

        {!! Form::close() !!}