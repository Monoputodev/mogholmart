{!! Form::model($product, ['method' => 'PATCH', 'files'=> true, "class"=>"", 'id' => 'product_form_basic_info']) !!}

<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label>Title</label> {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control','required'=>
                'required', 'title'=>'Enter Advertisement Title', 'onkeyup'=>"convert_to_slug();"]) !!}
                <span class="error">{!! $errors->first('title') !!}</span>
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
                <label>Title (Bangla)</label>
                <?php
                if(isset($product))
                {
                    if(!empty($product->translate('bn')->title_tr)){
                        $title_tr = $product->translate('bn')->title_tr;
                    }else{
                        $title_tr = $product->title;
                    }
                }else{
                    $title_tr = '';
                }
                ?>
                    <input id="title_tr" class="form-control" title="Enter  Title" name="title_tr" type="text" value="{{$title_tr}}">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label>Slug</label> {!! Form::text('slug',Input::old('slug'),['id'=>'slug','class' => 'form-control','required'=>
                'required', 'title'=>'Enter Advertisement Slug' ]) !!}

                <span class="error">{!! $errors->first('slug') !!}</span>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label>Manufacturer</label> {!! Form::Select('manufacturer_id', $manufacturer_lists ,Input::old('manufacturer_id'),['id'=>'manufacturer_id',
                'class'=>'form-control selectheight']) !!}
                <span class="error">{!! $errors->first('manufacturer_id') !!}</span>
                <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label>Brand</label>
                <div class="form-line brandheight">


                    <select class="form-control selectheight" id="brand_select" name="brand[]" multiple="multiple"></select>
                </div>

                <span class="error">{!! $errors->first('brand_id') !!}</span>

            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label>Item No</label> {!! Form::text('item_no',Input::old('item_no'),['id'=>'item_no','class' => 'form-control','required'=>
                'required', 'title'=>'Enter Product item_no' ]) !!}
                 <input type="hidden" name="item_no_copy" value="{{$product->item_no}}">
                 <input type="hidden" name="merchant_id" value="{{Auth::user()->id}}">
                <span class="error">{!! $errors->first('item_no') !!}</span>
            </div>
        </div>

        
        <div class="col-3">
            <div class="form-group">
                <label>Sell Price</label> {!! Form::text('sell_price',Input::old('sell_price'),['id'=>'sell_price','class'
                => 'form-control','required'=> 'required', 'title'=>'Enter Product Sale price' ]) !!}

                <span class="error">{!! $errors->first('sell_price') !!}</span>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label>Sell Price (Bn)</label>


                <?php
                if(isset($product))
                {
                    if(!empty($product->translate('bn')->sell_price_tr)){
                        $sell_price_tr = $product->translate('bn')->sell_price_tr;
                    }else{
                        $sell_price_tr = $product->sell_price;
                    }
                }else{
                    $sell_price_tr = '';
                }
                ?>
                    <input id="sell_price_tr" class="form-control" title="Enter Sell Price" name="sell_price_tr" type="text" value="{{$sell_price_tr}}">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label>List Price</label> {!! Form::text('list_price',Input::old('list_price'),['id'=>'list_price','class'
                => 'form-control','required'=> 'required', 'title'=>'Enter Product List Price' ]) !!}

                <span class="error">{!! $errors->first('list_price') !!}</span>
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
                <label>List Price (Bn)</label>


                <?php
                if(isset($product))
                {
                    if(!empty($product->translate('bn')->list_price_tr)){
                        $list_price_tr = $product->translate('bn')->list_price_tr;
                    }else{
                        $list_price_tr = $product->list_price;
                    }
                }else{
                    $list_price_tr = '';
                }
                ?>
                    <input id="list_price_tr" class="form-control" title="Enter List Price" name="list_price_tr" type="text" value="{{$list_price_tr}}">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label>Offer Price</label> {!! Form::text('offer_price',Input::old('offer_price'),['id'=>'offer_price','class'
                => 'form-control', 'title'=>'Enter Product Offer Price' ]) !!}

                <span class="error">{!! $errors->first('offer_price') !!}</span>
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
                <label>Offer Price (Bn)</label>


                <?php
                if(isset($product))
                {
                    if(!empty($product->translate('bn')->offer_price_tr)){
                        $offer_price_tr = $product->translate('bn')->offer_price_tr;
                    }else{
                        $offer_price_tr = $product->offer_price;
                    }
                }else{
                    $offer_price_tr = '';
                }
                ?>
                    <input id="offer_price_tr" class="form-control" title="Enter Offer Price" name="offer_price_tr" type="text" value="{{$offer_price_tr}}">
            </div>
        </div>

        <div class="col-6">

            <input type="hidden" name="status" value="inactive" id="status">
        </div>


        <div class="col-12">
            <button class="btn btn-primary pull-right btn-sm font-10 m-r-15">Save Changes</button>
        </div>
    </div>

    {!! Form::close() !!}