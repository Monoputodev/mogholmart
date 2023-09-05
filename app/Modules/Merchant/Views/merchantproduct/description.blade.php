{!! Form::model($product, ['method' => 'PATCH', 'files'=> true, "class"=>"", 'id' => 'product_description']) !!}

<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="description-en-tab" data-toggle="tab" href="#description-en" role="tab" aria-controls="description-en"
                aria-selected="false">Description English</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="description-bn-tab" data-toggle="tab" href="#description-bn" role="tab" aria-controls="description-bn"
                aria-selected="true">Description Bangla</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="description-en" role="tabpanel" aria-labelledby="">


            <div class="form-group">

                <div class="form-line">
                    {!! Form::label('short_description', 'Short description', array('class' => 'col-form-label')) !!} {!! Form::textarea('short_description',Input::old('short_description'),['id'=>'short_description','class'
                    => 'textarea form-control', 'title'=>'Enter short_description', 'rows'=>'5', 'cols'=>'50']) !!}
                    <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">

                    <span class="error">{!! $errors->first('short_description') !!}</span>
                </div>
            </div>
            <br>

            <div class="form-group">

                <div class="form-line">
                    {!! Form::label('specification', 'Details', array('class' => 'col-form-label')) !!} {!! Form::textarea('specification',Input::old('specification'),['id'=>'specification','class'
                    => 'textarea form-control', 'title'=>'Enter specification', 'rows'=>'5', 'cols'=>'50']) !!}

                    <span class="error">{!! $errors->first('specification') !!}</span>
                </div>
            </div>

            <br>

            <div class="form-group">

                <div class="form-line">
                    {!! Form::label('description', 'Description', array('class' => 'col-form-label')) !!} {!! Form::textarea('description',Input::old('description'),['id'=>'description','class'
                    => 'textarea form-control', 'title'=>'Enter Description', 'rows'=>'5', 'cols'=>'50']) !!}

                    <span class="error">{!! $errors->first('description') !!}</span>
                </div>

            </div>
            <br>
            <div class="form-group">
                {!! Form::label('', '', array('class' => 'col-form-label')) !!}


                <button class="btn btn-primary pull-right btn-sm font-10 m-r-15">Save Changes</button>
            </div>

        </div>
        <div class="tab-pane fade show" id="description-bn" role="tabpanel" aria-labelledby="">

            <div class="form-group">

                <div class="form-line">
                    {!! Form::label('short_description_tr', 'Short description (bn)', array('class' => 'col-form-label fr-my')) !!}

                    <?php
                if(isset($product))
                {
                    if(!empty($product->translate('bn')->short_description_tr)){
                        $short_description_tr = $product->translate('bn')->short_description_tr;
                    }else{
                        $short_description_tr = $product->short_description;
                    }
                }else{
                    $short_description_tr = '';
                }
                ?>

                        <textarea class="form-control textarea" id="short_description_tr" name="short_description_tr" rows="5" cols="50">
                    {{$short_description_tr}}    
                </textarea>
                </div>
            </div>
            <br>
            <div class="form-group">

                <div class="form-line">
                    {!! Form::label('specification_tr', 'Details (bn)', array('class' => 'col-form-label fr-my')) !!}

                    <?php
                if(isset($product))
                {
                    if(!empty($product->translate('bn')->specification_tr)){
                        $specification_tr = $product->translate('bn')->specification_tr;
                    }else{
                        $specification_tr = $product->specification;
                    }
                }else{
                    $specification_tr = '';
                }
                ?>


                        <textarea class="form-control textarea" id="specification_tr" name="specification_tr" rows="5" cols="50">
                    {{$specification_tr}}    
                </textarea>
                </div>
            </div>


            <br>
            <div class="form-group">

                <div class="form-line">
                    {!! Form::label('description_tr', 'Description (bn)', array('class' => 'col-form-label fr-my')) !!}

                    <?php
                if(isset($product))
                {
                    if(!empty($product->translate('bn')->description_tr)){
                        $description_tr = $product->translate('bn')->description_tr;
                    }else{
                        $description_tr = $product->description;
                    }
                }else{
                    $description_tr = '';
                }
                ?>

                        <textarea class="form-control textarea" id="description_tr" name="description_tr" rows="5" cols="50">
                    {{$description_tr}}    
                </textarea>
                </div>

            </div>
            <br>
            <div class="form-group">



                <button class="btn btn-primary pull-right btn-sm font-10 m-r-15">Save Changes</button>

            </div>
        </div>

    </div>
    {!! Form::close() !!}