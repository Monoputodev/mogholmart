@extends('Admin::layouts.master')
@section('body')

<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    LIST OF SEARCH DATA
                </h2>
            </div>
            <div class="body">
              {!! Form::open(['method' =>'GET', 'route' => 'admin.new.order.search', 'id'=>'', 'class' => 'form-horizontal']) !!}
              <div class="input-group">
                <div class="form-line">            
                    {!! Form::text('item_no',@Input::get('item_no')? Input::get('item_no') : null,['class' => 'form-control assign_product_typeahead','placeholder'=>'Please type product name or item no', 'data-type'=>'assign_child_product']) !!}
                </div>
                <span class="input-group-addon">
                    <button type="submit" class="btn bg-red waves-effect">
                        Search
                    </button>
                </span>
            </div>
            {!! Form::close() !!}

            <?php $url = route('admin.cart.add'); ?>
            {!! Form::open(array('url' => $url, 'method' => 'post', 'class' => "add_to_cart_form")) !!}

            <div class="row border border-bottom-0 border-left-0 border-right-0">
                <div class="col-md-3">
                    <div class="form-group">
                      <div class="form-line">

                        {!! Form::label('color', 'Color', array('class' => 'col-form-label')) !!}
                        @if(count($product_color_size['color']) > 0)
                        <p>

                            @foreach($product_color_size['color'] as $key => $color)
                            <input id="<?=urlencode($color)?>" type="radio" name="color_list" class="color_list" data="<?=$key?>" value="<?=$key?>">
                            <label for="<?=urlencode($color)?>"><?=ucfirst($color)?></label>
                            @endforeach
                        </p> 
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <div class="form-line">
                        {!! Form::label('size', 'Size', array('class' => 'col-form-label')) !!}


                        @if(count($product_color_size['size']) > 0)
                        <div>
                            @foreach($product_color_size['size'] as $key => $size)
                            <span class="size-hide">
                                <input id="<?=urlencode($size)?>" type="radio" name="size_list" class="size_list" data="<?=$key?>" value="<?=$key?>">
                                <label for="<?=urlencode($size)?>"><?=ucfirst($size)?></label>
                            </span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">

                    <div class="form-line">
                        {!! Form::label('product_quantity', 'Quantity', array('class' => 'col-form-label')) !!}

                        {!! Form::number('product_quantity','1',['id'=>'product_quantity','class' => 'form-control','required'=> 'required',  'product_quantity'=>'enter quantity' ]) !!}
                        <input id="product_id_cart" type="hidden" value="{{$product_data->product_id}}" name="product_id">
                        <input type="hidden" value="{{URL::to('uploads/product/'.$product_data->product_id.'/200x200/'.$product_data->image)}}" name="product_image">
                        <input id="product_merchant_id_cart" type="hidden" value="{{$product_data->product_merchant_id}}" name="product_merchant_id">
                        <input id="product_weight" type="hidden" value="{{$product_data->weight}}" name="product_weight">
                        <input id="product_category_id" type="hidden" value="{{$product_data->category_id}}" name="product_category_id">
                    </div>

                </div>

            </div>
            <div class="col-md-2">
                <div class="form-group">

                    <div class="form-line">
                        {!! Form::label('price', 'Sell Price', array('class' => 'col-form-label')) !!}

                        <input type="text" name="price" value="{{$data->sell_price}}" class="form-control" readonly="">
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">

                    <div class="col-md-12">

                        {!! Form::submit('Add to cart', ['class' => 'btn btn-primary pull-right btn-xs font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}


    </div>
</div>
</div>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                 Product Cart
             </h2>
         </div>
         <div class="body">
            <div class="row bg-gray ml-sm-0 mr-sm-0">

                <!-- slider part -->
                <div class="col-md-8 pl-sm-0 pr-sm-0">
                    <div class="cart cart-part" data-pageload-addclass="animated fadeIn">

                        <div class="cart-body">
                            <div class="cart-content">
                                @if(count($cart_items) > 0)
                                <table class="table table-responsive">
                                    <thead class="head-class">
                                        <tr>
                                            <th style="width:5%"> Remove </th>
                                            <th style="width:10%"> Image</th>
                                            <th style="width:40%"> Products</th>
                                            <th style="width:15%"> Price</th>
                                            <th style="width:15%"> Qty </th>
                                            <th style="width:15%;"><span class="total">Total</span></th>
                                        </tr>
                                    </thead>
                                    <tbody class="body-class">

                                        @foreach($cart_items as $cart)
                                        <tr class="cart_item_tr" product_id="{{$cart['product_id']}}">
                                            <td><a href="#" class="btn btn-danger btn-xs remove_product_cart" product_id="{{$cart['product_id']}}" onclick="return confirm('Are you sure to Delete?')"  ><i class="material-icons">delete</i></a>
                                            </td>
                                            <td>
                                                <img class="img img-responsive" width="50" height="50" src="{{$cart['product_image']}}" alt="{{$cart['product_title']}}">
                                            </td>
                                            <td><p class="mb-0">
                                                {{$cart['product_title']}}
                                            </p></td>
                                            <td><span>Tk {{number_format($cart['sell_price'], 2)}}</span></td>
                                            <td>
                                                <input type="number" name="qty" value="{{$cart['product_quantity']}}" min="1" class="qtyfiled product_quantity_field form-control">
                                            </td>
                                            <td class="total"><span>Tk {{number_format($cart['subtotal'],2)}}</span></td>
                                        </tr>
                                        @endforeach 

                                    </tbody>
                                </table>
                                @else

                                <p>No items add in your cart.</p>

                                @endif

                            </div>
                        </div>
                    </div>

                    @if(count($cart_items) > 0)
                    <div class="shipping-button">
                        <button id="update_cart" class="btn btn-sm btn-info float-right">Update Cart</button>
                    </div>
                    @endif
                </div>
                <!-- qualified sufliar -->
                <div class="col-md-3  pl-sm-0 pr-sm-0">
                    <div class="cart cart-part" data-pageload-addclass="animated fadeIn">

                        @if(count($cart_items) > 0)
                        <div class="cart-body">
                            <div class="cart-content">

                                <div class="table-responsive total-sidebar">  
                                    <h5>Hear is your total price</h5>
                                    <table class="table">
                                        <tbody>

                                            <tr class="total-total">
                                                <td>Total</td>
                                                <td>Tk {{number_format($cart_total['total'],2)}}</td>
                                            </tr>   
                                        </tbody>


                                    </table>
                                </div>

                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                    <div class="panel-group full-body" id="accordion_19" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-col-teal">
                            <div class="panel-heading" role="tab" id="headingThree_19">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_19" aria-expanded="false" aria-controls="collapseThree_19">
                                        <i class="material-icons">contact_phone</i>Click Heare & Search existing customer Or Buy as a guest customer
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree_19" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_19">
                                <div class="panel-body">
                                   <?php $url = route('admin.checkout.post.login.search'); ?>
                                   {!! Form::open(array('url' => $url, 'method' => 'GET', 'class' => "login-formas")) !!}

                                   <div class="form-mobile-email row clearfix">

                                    <div class="col-md-11">

                                      <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                        <div class="form-line">
                                           {!! Form::text('searchinput',@Input::get('searchinput')? Input::get('searchinput') : null,['class' => 'form-control','placeholder'=>'Please type customer email or mobile number', 'data-type'=>'assign_child_product']) !!}
                                           <span class="errors">
                                            {!! $errors->first('searchinput') !!}
                                        </span>                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">

                                    <div class="col-md-12">

                                        <button type="submit" class="btn bg-red waves-effect">
                                            Search
                                        </button>

                                    </div>
                                </div>

                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{!! Form::model($billing, ['method' => 'POST', 'route'=> ['admin.cart.confirm.checkout'],'id'=>'', 'class' => 'needs-validation ']) !!}

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Billing And Shipping Address
                </h2>

                <div class="form-check  open-address-form pull-right" style="margin-top: -20px;">
                    @if ($user_data->type != 'customer')
                    <input class="form-check-input" name="shipping_defferent_address" type="checkbox" id="autoSizingCheck2">
                    @else
                    <input class="form-check-input" name="shipping_same_as_billing" type="checkbox" id="autoSizingCheck2">
                    @endif

                    <label class="form-check-label" for="autoSizingCheck2">
                        <h2>Do you want to ship different addresses ?</h2>
                    </label>
                </div>
            </div>
            <div class="body">
                <div class="row bg-gray ml-sm-0 mr-sm-0">

                    <!-- slider part -->
                    <div class="col-md-6 pl-sm-0 pr-sm-0">
                        <div class="cart cart-part" data-pageload-addclass="animated fadeIn">

                            <div class="cart-body">
                                <div class="cart-content">
                                   <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                        <div class="form-line">
                                         {!! Form::text('first_name',Input::old('first_name'),['id'=>'first_name', 'class' => 'form-control inputfield','placeholder'=>'User Name']) !!}

                                         <span class="errors">
                                            {!! $errors->first('first_name') !!}
                                        </span>                   
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">email</i>
                                    </span>
                                    <div class="form-line">
                                       {!! Form::email('email',Input::old('email'),['id'=>'email', 'class' => 'form-control inputfield','placeholder'=>'Email']) !!}

                                       <span class="errors">
                                        {!! $errors->first('email') !!}
                                    </span>                 
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">phone</i>
                                </span>
                                <div class="form-line">
                                   {!! Form::number('phone',Input::old('phone'),['id'=>'phone', 'class' => 'form-control inputfield','placeholder'=>'Phone No']) !!}

                                   <span class="errors">
                                    {!! $errors->first('phone') !!}
                                </span>               
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">my_location</i>
                            </span>
                            <div class="form-line">
                             {!! Form::textarea('address',Input::old('address'),['id'=>'address','rows'=> '5', 'class' => 'form-control inputfield','placeholder'=>'Address']) !!}

                             <span class="errors">
                                {!! $errors->first('address') !!}
                            </span>              
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- qualified sufliar -->
<div class="col-md-6 mt-5" style="height: 300px;">
    <div class="cart cart-part" data-pageload-addclass="animated fadeIn">


        <div class="cart-body">
            <div class="cart-content">

                <div class="another-shipping-address">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                {!! Form::text('shipping_first_name',Input::old('shipping_first_name'),['id'=>'shipping_first_name', 'class' => 'form-control inputfield','placeholder'=>'User Name']) !!}

                                <span class="errors">
                                    {!! $errors->first('shipping_first_name') !!}
                                </span>                  
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">email</i>
                            </span>
                            <div class="form-line">
                                {!! Form::email('shipping_email',Input::old('shipping_email'),['id'=>'shipping_email', 'class' => 'form-control inputfield','placeholder'=>'Email']) !!}

                                <span class="errors">
                                    {!! $errors->first('shipping_email') !!}
                                </span>                  
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">phone</i>
                            </span>
                            <div class="form-line">
                               {!! Form::number('shipping_phone',Input::old('shipping_phone'),['id'=>'shipping_phone', 'class' => 'form-control inputfield','placeholder'=>'Phone No']) !!}

                               <span class="errors">
                                {!! $errors->first('shipping_phone') !!}
                            </span>                  
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group">
                       <div class="form-line">
                           {!! Form::Select('city',$citylist,Request::old('city'),['id'=>'city', 'class'=>'form-control selectheighttype city-ajax select2class']) !!}

                           <span class="errors">
                            {!! $errors->first('city') !!}
                        </span>                  
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="input-group">
                    <span class="form-line">
                        {!! Form::Select('area',isset($arealist)?$arealist:[''=>'Select Area'],Request::old('area'),['id'=>'area', 'class'=>'form-control selectheighttype modal-area-ajax select2class']) !!}
                        <span class="errors">
                            {!! $errors->first('area') !!}
                        </span>
                    </span>
                </div>
            </div>

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">my_location</i>
                </span>
                <div class="form-line">
                   {!! Form::textarea('shipping_address',Input::old('shipping_address'),['id'=>'shipping_address', 'class' => 'form-control inputfield','placeholder'=>'Address', 'rows'=> '3']) !!}

                   <span class="errors">
                    {!! $errors->first('shipping_address') !!}
                </span>                
            </div>
        </div>
    </div>   <!-- end another shipping address -->  
</div> <!-- end cart content -->
</div> <!-- end card body -->
</div> <!-- end cart cart part -->

</div> <!-- end col 6 -->
</div> 
</div>

</div>
</div>
</div>
</div>
<div class="row clearfix">
    <div class="col-md-12">
        <div class="form-group col-sm-12 shipping-method ">
            <h5>Shipping Method</h5>
            <div class="custom-control custom-radio">
                <input type="radio" id="shipping_method_1" checked name="shipping_method" class="custom-control-input">
                <label class="custom-control-label" for="shipping_method_1">Direct From Our Office</label>
            </div>
        </div>
        <div class="form-group col-sm-12 payment-method ">
            <h5>Payment Method</h5>                              
            <div class="custom-control custom-radio custom-control-inline">
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="col-xs-12 col-sm-12 col-md-12" style="text-align:center;">
                           <label class="form-check-label" for="payment-method-1"><img src="{{URL::to('logo')}}/cash-payment1.png" style="max-height: 80px;" alt="cod"></label>
                       </div>
                       <div class="col-xs-12 col-sm-12 col-md-12" style="text-align:center;">
                        <input  type="radio" id="payment-method-1" checked name="payment_method" class="" value="cod">
                    </div>
                </div> 

                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="col-xs-12 col-sm-12 col-md-12" style="text-align:center;">
                      <label class="form-check-label" for="payment-method-2"><img src="{{URL::to('logo')}}/foster.png" style="max-height: 80px;" alt="Online Payment"></label>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12" style="text-align:center;">
                     <input  type="radio" id="payment-method-2" name="payment_method"  value="online_payment">
                 </div>
             </div> 


         </div>
     </div>
 </div>
</div>
</div>


<div class="row clearfix" style="margin-top: 40px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Review your Order
                </h2>
            </div>
            <div class="body" style="height: 500px;">
                <div class="row bg-gray ml-sm-0 mr-sm-0">

                    <!-- slider part -->
                    <div class="col-md-8 pl-sm-0 pr-sm-0">
                        <div class="cart cart-part" data-pageload-addclass="animated fadeIn">

                            <div class="cart-body">
                                <div class="cart-content">
                                    @if(count($cart_items) > 0)
                                    <table class="table table-responsive">
                                        <thead class="head-class">
                                            <tr>

                                                <th style="width:10%"> Image</th>
                                                <th style="width:40%"> Products</th>
                                                <th style="width:15%"> Price</th>
                                                <th style="width: 15%"> Qty </th>
                                                <th style="width:15%;"><span class="total">Total</span></th>
                                            </tr>
                                        </thead>
                                        <tbody class="body-class">

                                            @foreach($cart_items as $cart)
                                            <tr>

                                                <td>
                                                    @if($cart['product_image'] !='')
                                                    <img class="img img-responsive" width="50" height="50" src="{{$cart['product_image']}}" alt="{{$cart['product_title']}}">
                                                    @else
                                                    <img class="img img-responsive" width="50" height="50" src="{{URL::to('logo/nofound.png')}}" alt="{{$cart['product_title']}}">
                                                    @endif
                                                </td>
                                                <td><p class="mb-0">
                                                    {{$cart['product_title']}}
                                                </p></td>
                                                <td><span>Tk {{number_format($cart['sell_price'], 2)}}</span></td>
                                                <td>
                                                    {{$cart['product_quantity']}}
                                                </td>
                                                <td class="total"><span>Tk {{number_format($cart['subtotal'],2)}}</span></td>
                                            </tr>
                                            @endforeach 

                                        </tbody>
                                    </table>
                                    @else

                                    <p>No items add in your cart.</p>

                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- qualified sufliar -->
                    <div class="col-md-3 offset-1 mt-5" style="height: 300px;">
                        <div class="cart cart-part " data-pageload-addclass="animated fadeIn">

                            @if(count($cart_items) > 0)
                            <div class="cart-body">
                                <div class="cart-content">

                                    <div class="table-responsive total-sidebar">  
                                        <h5>Hear is your total price</h5>
                                        <table class="table ">
                                            <thead class="total-cart">

                                            </thead>
                                            <tbody>

                                                <tr class="total-total">
                                                    <td>Sub Total</td>
                                                    <td>Tk <span id="sub_total_amount">{{number_format($cart_total['total'],2)}}</span></td>
                                                </tr>
                                                <tr class="total-total">
                                                    <td>Delivery Cost</td>
                                                    <td>
                                                        Tk <span id="gen_delivery_cost_show">{{$shipping_charge}}</span>
                                                        <input type="hidden" name="gen_delivery_cost" value="{{$shipping_charge}}" id="gen_delivery_cost">
                                                    </td>
                                                </tr>
                                                <tr class="total-total">
                                                    <td>Total Cost</td>
                                                    <td>Tk 
                                                        <span id="total_delivery_cost">{{number_format($cart_total['total']+$shipping_charge,2)}}</span>
                                                    </td>
                                                </tr>
                                                <tr class="total-total">
                                                    <td>Discount</td>
                                                    <td>Tk <span id="coupon_amount">0.00</span></td>
                                                </tr> 

                                                <tr class="total-total">
                                                    <td>Grand Total</td>
                                                    <td>Tk  <span id="total_coupon">{{number_format($cart_total['total']+$shipping_charge,2)}}</span></td>
                                                </tr>   
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label  data-toggle="collapse" data-target="#collapseforcoupon" aria-expanded="false" aria-controls="collapseforcoupon">
                                        <input class="form-check-input" name="shipping_defferent_address" type="checkbox">
                                        Have a special code ?
                                    </label>
                                </div>
                            </div>
                            <div id="collapseforcoupon" aria-expanded="false" class="collapse">

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">

                                                <input type="text" name="coupon_code" id="coupon_code_id" class="form-control" placeholder="special code" style="border:1px solid red">


                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                            <a class="btn btn-success" id="submit_coupon">Go</a>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <center class="border border-bottom-0 border-left-0 border-right-0"><button class=" mt-3 btn btn-primary btn-sm" type="submit">Checkout</button></center>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
{!! Form::close() !!}


</div>
</div>
</div>

<script type="text/javascript">

    $(document).delegate('.city-ajax','change',function () {

        var city_name = $(this).val();

        $.ajax({
            url: '{{ url(config('global.prefix_name').'/admin/city/to/area/ecourier') }}',
            type: 'POST',
            data: { _token: '{!! csrf_token() !!}', city_name:city_name},
            dataType: "json",
            success: function (data) {

                if(data.result == 'success'){

                    $('.modal-area-ajax').html(data.data);
                }else{
                    alert(data.message);
                }
            }
        });

        return false;
    });

    function replaceComma(num) {
      return num.toString().replace(/,/g, '');
  };


  $(document).ready(function(){

   $('#submit_coupon').click(function(){ 

    var coupon_code = document.getElementById('coupon_code_id').value;
    var total_delivery_cost = $('#total_delivery_cost').html();

    $.ajax({
        url:"{{ route('admin.coupoon.price') }}",
        method:"POST",
        data:{coupon_code:coupon_code, _token: '{!! csrf_token() !!}'},

        success:function(data){

            if(data.result=='success'){

                jQuery('#coupon_amount').html(data.coupon_amount);
                jQuery('#total_coupon').html(total_delivery_cost - data.coupon_amount);
            }

        }
    });

}); 

});


  $(document).delegate('.color_list','click',function () {

    var color = $( this ).attr('data');

    $( ".size_list" ).each(function( index ) {

        var size = $( this ).attr('data');

        $(this).parent().removeClass('size-show');                   

        if(color.indexOf(size) != -1){
            $(this).parent().addClass('size-show');                  
        }

    });
});

  $(document).delegate('.size_list','click',function () {
    var color = $('input[name=color_list]:checked').val();
    var size = $( this ).attr('data');

    var color_size = color+"=="+size;

    $('#product_id_cart').val(color_size);
});


  init_typeahead_assign_product();
  function init_typeahead_assign_product() {
    var pid = $('#product_id').attr('data-val');

    $(".assign_product_typeahead").typeahead("destroy");

    var product_list = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '<?php echo URL::to(''); ?>/admin-new-search-product/%QUERY',
            wildcard: '%QUERY'
        }
    });


    $(".assign_product_typeahead").typeahead({
        hint: true,
        highlight: true,
        minLength: 2,
        limit: 50
    },
    {
        name: 'product_list',
        source: product_list,
        displayKey : 'item_no',
        templates: {
            suggestion: Handlebars.compile("<p style='padding:5px 10px;margin-bottom:0;'><b style='font-size:12px;'>@{{title}}</b><br/><small><i>Item no:</i> @{{item_no}} </small></p>")
        }
    }).bind('typeahead:selected', function(obj, selected, name) {

        var target = obj.target;
        var add_type = $(target).attr('data-type');

        save_assign_product(selected.id,add_type);

        return false;

    });

}


$(document).delegate('.add_to_cart_btn','click',function () {

    $(this).closest('.add_to_cart_form').submit();
    return false;
});

$(document).delegate(".add_to_cart_form",'submit',function() {

    var url = $(this).attr('action');
    var data = $(this).serializeArray();

    $.ajax({
        url: url,
        method: "POST",
        data: data,
        dataType: "json",
        beforeSend: function( xhr ) {

        }
    }).done(function( response ) {

        if(response.result == 'success'){
          jQuery.noConflict();

          jQuery('#total_items').html(response.total_item);
          jQuery('#total_prices').html(response.cart_total);      
              //jQuery('.added_to_cart_modal').modal('show');

              location.reload();
              
              
          }


      }).fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + jqXHR.responseText );
    });

      return false;
  });

$(document).delegate('.remove_product_cart', 'click', function () {
    var product_id = $(this).attr('product_id');
    var url = '{{ route('admin.cart.remove.item') }}';

    $.ajax({
        url: url,
        method: "POST",
        data: {_token: '{!! csrf_token() !!}', product_id: product_id},
        dataType: "json",
        beforeSend: function (xhr) {

        }
    }).done(function (response) {

        location.reload();

    }).fail(function (jqXHR, textStatus) {
        alert("11Request failed: " + jqXHR.responseText);
    });

    return false;

});


$(document).delegate('#update_cart', 'click', function () {
    var data = [];
    $(document).find('.cart_item_tr').each(function (index, value) {
        var product_id = $(value).attr('product_id');
        var quantity = $(value).find('.product_quantity_field').val();

        data.push({
            'product_id': product_id,
            'product_quantity': quantity
        })
    });


    var url = '{{ route('admin.cart.update') }}';

    $.ajax({
        url: url,
        method: "POST",
        data: {_token: '{!! csrf_token() !!}', data: data},
        dataType: "json",
        beforeSend: function (xhr) {

        }
    }).done(function (response) {

        if(response.result == 'success')
        {
            location.reload();
        }

    }).fail(function (jqXHR, textStatus) {
        alert("Request failed: " + jqXHR.responseText);
    });

    return false;
});

</script>
<script type="text/javascript">
    // const checkedValu = $('.open-address-form input').is(":checked");
    $('.open-address-form input').click(function(){ 
    // $(this).attr('checked' , 'checked')  
    if($('.open-address-form input').is(":checked")){
        $('.another-shipping-address').slideDown('easeInOutCirc');
        console.log('slide down ')
    }
    else{
        $('.another-shipping-address').slideUp('easeInOutCirc');
        console.log('slide up ')
    }
});
</script>
@endsection