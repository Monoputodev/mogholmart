@extends('Merchant::merchant.merchant_master')
@section('body')

<section class="top-teacher-area" style="background-image: url({{URL::to('/')}}/frontend/img/core-img/texture.png);">
  <div class="clever-catagory bg-img d-flex align-items-center justify-content-center p-3" style="background-image: url({{ asset('uploads/user/') }}/{{$varifaid_user->image}}); height: 200px; margin-bottom: 20px;">
    <h3>
      MERCHANT DASHBOARD
      <br/>
      <span>{{$varifaid_user->shop_name}}</span>
    </h3>        
  </div>
  <div class="container">
    <div class="row">


    </div>

    <div class="row">                

      <div class="col-12 col-md-6">
        <a class="single-instructor bg-color1 d-flex align-items-center mb-30" href="{{ route('todays.order.list') }}">
          <span class="instructor-thumb">
            <img src="{{URL::to('/')}}/frontend/img/bg-img/order.png" alt="">
          </span>
          <span class="instructor-info">
            <h5>Today's order<br/>({{$todays_order}})</h5>
          </span>
        </a>
      </div>

      <div class="col-12 col-md-6">
        <a class="single-instructor bg-color2 d-flex align-items-center mb-30" href="{{ route('fifteendays.order.list') }}">
          <span class="instructor-thumb">
            <img src="{{URL::to('/')}}/frontend/img/bg-img/order.png" alt="">
          </span>
          <span class="instructor-info">
            <h5>Last 15 day's order<br/>({{$last_15_days_order}})</h5>
          </span>
        </a>
      </div>                

      <div class="col-12 col-md-6">
        <a class="single-instructor bg-color3 d-flex align-items-center mb-30" href="{{ route('current.month.order.list') }}">
          <span class="instructor-thumb">
            <img src="{{URL::to('/')}}/frontend/img/bg-img/order.png" alt="">
          </span>
          <span class="instructor-info">
            <h5>This month order<br/>({{$current_month_order}})</h5>
          </span>
        </a>
      </div>

      <div class="col-12 col-md-6">
        <a class="single-instructor bg-color4 d-flex align-items-center mb-30" href="{{ route('total.order.list') }}">
          <span class="instructor-thumb">
            <img src="{{URL::to('/')}}/frontend/img/bg-img/order.png" alt="">
          </span>
          <span class="instructor-info">
            <h5>Total order<br/>({{$total_order}})</h5>
          </span>
        </a>
      </div>                

      <div class="col-12 col-md-6">
        <a class="single-instructor bg-color5 d-flex align-items-center mb-30" href="{{ route('merchant.my.product') }}">
          <span class="instructor-thumb">
            <img src="{{URL::to('/')}}/frontend/img/bg-img/product.png" alt="">
          </span>
          <span class="instructor-info">
            <h5>Total product<br/>({{$total_product}})</h5>
          </span>
        </a>
      </div>

      <div class="col-12 col-md-6">
        <a class="single-instructor bg-color6 d-flex align-items-center mb-30" href="{{ route('current.month.product.list') }}">
          <span class="instructor-thumb">
            <img src="{{URL::to('/')}}/frontend/img/bg-img/product.png" alt="">
          </span>
          <span class="instructor-info">
            <h5>This month added product<br/>({{$thismonth_product}})</h5>
          </span>
        </a>
      </div>

      <div class="col-12 col-md-6">
        <a class="single-instructor bg-color7 d-flex align-items-center mb-30" href="{{ route('merchant.comission.details') }}">
          <span class="instructor-thumb">
            <img src="{{URL::to('/')}}/frontend/img/bg-img/payment.png" alt="">
          </span>
          <span class="instructor-info">
            <h5>Total sell <br/>({{__('messages.tk')}} {{number_format($totoal_sell_price->total_amount,2)}})</h5>
          </span>
        </a>
      </div>

      <div class="col-12 col-md-6">
        <a class="single-instructor bg-color8 d-flex align-items-center mb-30" href="#">
          <span class="instructor-thumb">
            <img src="{{URL::to('/')}}/frontend/img/bg-img/payment.png" alt="">
          </span>
          <span class="instructor-info">
            <h5>Get payment from zinismart <br/>()</h5>
          </span>
        </a>
      </div>


    </div>
  </div>
</section>

@endsection

