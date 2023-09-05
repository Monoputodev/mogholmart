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
                        Billing And Shipping Address
                    </h2>
                </div>
                <div class="body">

                    {!! Form::model($billing, ['method' => 'POST', 'route'=> ['admin.exist.cart.confirm.checkout'],'id'=>'', 'class' => 'needs-validation ']) !!}
                    <div class="row bg-gray ml-sm-0 mr-sm-0">

                        <!-- slider part -->
                        <div class="col-md-6 pl-sm-0 pr-sm-0">
                            <div class="cart cart-part" data-pageload-addclass="animated fadeIn">

                                <div class="cart-body">
                                    <div class="cart-content">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">person</i>
                                                </span>
                                                <div class="form-line">
                                                    {!! Form::text('first_name',Input::old('first_name'),['id'=>'first_name', 'class' => 'form-control inputfield','placeholder'=>'User Name']) !!}
                                                    <input type="hidden" name="user_search_id" value="{{$user_data->id}}">
                                                    <span class="errors">
                                                        {!! $errors->first('first_name') !!}
                                                    </span>                   
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">

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


                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">phone</i>
                                                </span>
                                                <div class="form-line">
                                                    {!! Form::number('phone',Input::old('phone'),['id'=>'phone', 'class' => 'form-control inputfield','placeholder'=>'Phone No', 'required']) !!}

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
                                                    {!! Form::textarea('address',Input::old('address'),['id'=>'address', 'class' => 'form-control inputfield','placeholder'=>'Address', 'required', 'rows'=>'3']) !!}

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

                                     <h5>Shipping address</h5>

                                     <div class="row">
                                        @if(isset($shipping) && count($shipping) > 0 )  
                                        @foreach($shipping as $key => $ship)
                                        

                                        <div class="col-md-6 col-sm-12  col-xs-12">
                                            <div class="from-chick-pmentb">
                                               <label class="form-check-label" for="shipping_{{$key}}">
                                                <ul style="font-size: 16px;">
                                                  <li>{{$ship->first_name}}</li>
                                                  <li>{{$ship->email}}</li>
                                                  <li>{{$ship->city}}, {{$ship->area}}</li>
                                                  <li>{{$ship->address}}</li>
                                              </ul>
                                          </label>
                                          <br>
                                          <input  type="radio"  name="shipping_value" id="shipping_{{$key}}" value="{{$ship->id}}" onclick="ajax_call_shipping('{{$ship->id}}')" />
                                          <input type="hidden" name="users_id" id="users_id" value="{{$ship->users_id}}" placeholder="">
                                      </div>

                                  </div>
                                  @endforeach

                                  <div class="col-sm-12"><a  data-toggle="modal" href="#open_modal" class="btn btn-primary btn-xs font-10 mt-5"><i class="material-icons" aria-hidden="true">add</i><span class="ml-2">Add New Address</span></a></div>
                                        @else
                                        <div class="col-sm-12"><a  data-toggle="modal" href="#open_modal" class="btn btn-primary btn-xs font-10 mt-5"><i class="material-icons" aria-hidden="true">add</i><span class="ml-2">Add New Address</span></a></div>   
                                        @endif      

                                    </div>



                                </div> <!-- end cart content -->
                            </div> <!-- end card body -->
                        </div> <!-- end cart cart part -->

                    </div> <!-- end col 6 -->

                </div> 


                <div class="row clearfix">

                    <div class="col-md-12">
                        <div class="form-group col-sm-12 shipping-method ">
                            <h5>Shipping Method</h5>

                            <div class="custom-control custom-radio">
                                <input type="radio" id="shipping_method_1" checked name="shipping_method" class="custom-control-input">
                                <label class="custom-control-label" for="shipping_method_1">Direct from our office</label>
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
                                              <label class="form-check-label" for="payment-method-2"><img src="{{URL::to('logo')}}/foster.png" style="max-height: 80px;" alt="bkash_payment"></label>
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
                                                                    <img class="img img-responsive" width="50" height="50" src="{{$cart['product_image']}}" alt="{{$cart['product_title']}}">
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
                                                                    <td>Tk <span id="gen_delivery_cost_show">{{$shipping_charge}}</span>

                                                                       <input type="hidden" name="gen_delivery_cost" value="{{$shipping_charge}}" id="gen_delivery_cost">
                                                                       

                                                                    </td>
                                                                </tr>
                                                                <tr class="total-total">
                                                                    <td>Total Cost</td>
                                                                    <td>Tk <span id="total_delivery_cost">{{number_format($cart_total['total']+$shipping_charge,2)}}</span></td>
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
                                        <center class="border border-bottom-0 border-left-0 border-right-0"><button class=" mt-3 btn btn-primary btn-sm" type="submit">checkout</button></center>
                                    </div>

                                </div>

                            </div>


                        </div>

                    </div>
                </div>

                {!! Form::close() !!}
            </div> <!-- end body -->

        </div>

    </div>



<div id="open_modal" class="modal fade" tabindex="" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Add Shipping Address</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['route' =>'admin.add.order.shipping.address',  'files'=> true, 'id'=>'order_refund', 'class' => 'form-horizontal attribute_option_form']) !!}

                @include('Order::newOrder._addressform')

                <input type="hidden" name="users_id" value="{{$user_data->id}}">
                <input type="hidden" name="type" value="shipping">
                {!! Form::close() !!}

            </div> <!-- / .modal-body -->
        </div> <!-- / .modal-content -->
    </div> 
</div>

<script type="text/javascript">
        
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

        function ajax_call_shipping(id) {

            var shipping_id = id;
            var users_id= $('#users_id').val();
            
            $.ajax({
                url: '{{ url('admin-ajax-shipping-wise-cost') }}',
                type: 'POST',
                data: { _token: '{!! csrf_token() !!}', shipping_id:shipping_id,users_id:users_id},
                dataType: "json",
                success: function (data) {

                    if(data.result == 'success'){

                        $('#gen_delivery_cost_show').html(data.data);
                        $('#gen_delivery_cost').val(data.data);
                        
                        var sub_total_amount = $('#sub_total_amount').html();
                        
                        var total_delivery_cost = parseFloat(replaceComma(data.data)) + parseFloat(replaceComma(sub_total_amount));
                        
                        
                        $('#total_delivery_cost').html(total_delivery_cost);
                        
                        var coupon_amount = $('#coupon_amount').html();
                        $('#total_coupon').html(parseFloat(total_delivery_cost) - parseFloat(coupon_amount));
                        
                        $('#courier_package').val(data.package_code);
                        
                    }else{
                        alert(data.message);
                    }
                }
            });

            return false;
        }

       </script>
@endsection