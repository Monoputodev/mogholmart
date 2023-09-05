@extends('Web::layouts.master')

@section('body')
<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="bread-inner">
          <ul class="bread-list">
            <li><a href="{{URL::to('/')}}">Home<i class="ti-arrow-right"></i></a></li>
            
            <li><a href="#">Checkout Fail</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="contact-us section">
  <div class="container">
    <div class="row">
      <div id="content" class="col-md-12 form-main">
        <div class="table-responsive">
          <center><img src="{{URL::to('logo/oops.jpg')}}" alt="" class="img img-responsive"></center>
          <center><strong><h2>Sorry !! Your checkout process has not been completed, please try again.!</h2></strong></center>

          <center>
            <ul>
              @if(isset($additional_data))
              @foreach($additional_data as $error)
              <li>{{$error}}</li>
              @endforeach
              @endif
            </ul>
          </center>
        </div>
        <div class="buttons clearfix">
          <div class="pull-left"><a href="{{URL::to('/')}}" class="btn btn-default">Continue Shopping</a></div>
          <div class="pull-right"><a href="{{route('web.cart.checkout')}}" class="btn btn-primary">Checkout</a></div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection