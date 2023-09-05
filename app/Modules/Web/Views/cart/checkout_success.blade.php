@extends('Web::layouts.master')

@section('body')
<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="bread-inner">
          <ul class="bread-list">
            <li><a href="{{URL::to('/')}}">Home<i class="ti-arrow-right"></i></a></li>
            
            <li><a href="#">Checkout Success</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="contact-us section">
  <div class="container">
    <div id="content" class="col-md-12 form-main">
        @if(isset($data))

        <h1 class="heading-title">
          Order &nbsp;#{{ $data->order_number }}
        </h1>
        @endif
        <div class="so-onepagecheckout layout1">
          <div class="row">

          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="checkout-content checkout-register">
              <fieldset id="account">
                <h2 class="secondary-title"><i class="fa fa-user-plus"></i>Billing Address</h2>
                <div class="payment-new box-inner">
                  @if(count($data->relOrderShipping) > 0)
                  @foreach($data->relOrderShipping as $shipping)
                  @if($shipping->type == 'billing')
                  <table class="table table-responsive"  style="margin-bottom: 7px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);border-radius: 2px;">
                    <tbody>
                      <tr>
                        <td>
                          <label class="form-check-label radio2" for="" style="width: 100% !important">
                            <span class="label2"></span>
                            <span class="row">
                              Name: {{$shipping->first_name}} {{$shipping->last_name}}<br> 
                              Phone: {{$shipping->phone}}<br>
                              City: {{$shipping->city}}<br>
                              Area: {{$shipping->area}}<br>
                              Address: {{$shipping->address}}<br>
                              Special Instruction: {{$shipping->special_instruction}}<br>
                            </span>
                          </label>
                        </td>
                      </tr>
                    </tbody>
                  </table> 
                  @endif
                  @endforeach
                  @endif
                </div>
              </fieldset>

              <fieldset id="shipping-address">
                <h2 class="secondary-title"><i class="fa fa-map-marker"></i>Shipping Address</h2>
                <div class="checkout-shipping-form">
                  <div class="box-inner">
                    <div class="col-md-6 col-sm-6  col-xs-6 text-left" style="">
                      @if(count($data->relOrderShipping) > 0)
                      @foreach($data->relOrderShipping as $shipping)
                      @if($shipping->type == 'shipping')
                      <table class="table table-responsive"  style="margin-bottom: 7px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);border-radius: 2px;">
                        <tbody>
                          <tr>
                            <td>
                              <label class="form-check-label radio2" for="" style="width: 100% !important">
                                <span class="label2"></span>
                                <span class="row">
                                  Name: {{$shipping->first_name}} {{$shipping->last_name}}<br> 
                                  Phone: {{$shipping->phone}}<br>
                                  City: {{$shipping->city}}<br>
                                  Area: {{$shipping->area}}<br>
                                  Address: {{$shipping->address}}<br>
                                  Special Instruction: {{$shipping->special_instruction}}<br>
                                </span>
                              </label>
                            </td>
                          </tr>
                        </tbody>
                      </table> 
                      @endif
                      @endforeach
                      @endif
                    </div>

                  </div>
                </div>
              </fieldset>
            </div>
          </div>

          <div class="col-right col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <section class="section-left">
              <div class="ship-payment">
                <div class="checkout-content checkout-shipping-methods">
                  <h2 class="secondary-title"><i class="fa fa-location-arrow"></i>Shipping Method</h2>
                  <div class="box-inner">
                    <p><strong>Flat Rate</strong></p>
                    <div class="radio flat flat flat.flat flat">
                      <label>
                        {{$data->shipping_method}}
                        
                      </label>
                    </div>
                  </div>
                </div>
                <div class="checkout-content checkout-payment-methods">
                  <h2 class="secondary-title"><i class="fa fa-credit-card"></i>Payment Method</h2>
                  <div class="box-inner">
                    <div class="radio">
                      <label>
                        @if ($data->payment_type=="cod")
                        Cash On Delivery
                        @else
                        Credit/Debit
                        @endif

                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </section>


            <section class="section-right">


              <div class="checkout-content checkout-cart">
                <h2 class="secondary-title"><i class="fa fa-shopping-cart"></i>Shopping Cart </h2>
                <div class="box-inner">
                  <div class="table-responsive checkout-product">
                    @if(count($data->relOrderDetail) > 0)
                    <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th class="text-left name" colspan="2">Product Name</th>
                          <th class="text-center quantity">Quantity</th>
                          <th class="text-center price">Unit Price</th>
                          <th class="text-right total">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data->relOrderDetail as $item)
                        <?php 
                        $item_data = $item->relProduct;
                        ?>
                        <tr >
                          <td class="text-left name" colspan="2">

                            @if(isset($item_data->image))
                            <img src="{{URL::to('uploads/product/'.$item_data->product_id.'/50x50/'.$item_data->image)}}" alt="{{$item_data->product_title}}" title="{{$item_data->product_title}}" class="img-thumbnail">
                            @else

                            <img src="{{URL::to('logo/nofound.png')}}" alt="{{$item_data->product_title}}" title="{{$item_data->product_title}}" class="img-thumbnail" style="max-height: 47px;max-width: 47px">

                            @endif

                            {{$item_data->product_title}}
                            <br>
                            &nbsp;

                          </td>
                          <td class="text-left quantity">
                            <div class="input-group">
                              {{$item->quantity}}
                            </div>
                          </td>
                          <td class="text-right price">{{__('messages.tk')}}{{number_format($item->price, 2)}}</td>
                          <td class="text-right total">{{__('messages.tk')}} {{number_format($item->price*$item->quantity,2)}}</td>
                        </tr>

                        @endforeach

                      </tbody>

                      <tfoot>
                        <tr>
                          <td colspan="4" class="text-left">Sub-Total:</td>
                          <td class="text-right">{{__('messages.tk')}} {{number_format($data->total_price,2)}}</td>
                        </tr>
                        <tr>
                          <td colspan="4" class="text-left">Flat Shipping Rate:</td>
                          <td class="text-right">{{__('messages.tk')}} {{number_format($data->shipping_value,2)}}</td>
                        </tr>
                        <tr>
                          <td colspan="4" class="text-left">Discount:</td>
                          <td class="text-right">{{__('messages.tk')}} &nbsp;<span id="coupon_amount" style="float: right;"> {{ number_format(($data->coupon_code_value),2) }}</span></td>
                        </tr>
                        <tr>
                          <td colspan="4" class="text-left">Total:</td>
                          <td class="text-right"><span id="total_coupon" style="float: right;">{{__('messages.tk')}} {{ number_format(( ($data->total_price+$data->shipping_value) - $data->coupon_code_value ),2) }}</span></td>
                        </tr>
                      </tfoot>

                    </table>
                    @endif

                  </div>

                </div>
              </div>
            </section>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection