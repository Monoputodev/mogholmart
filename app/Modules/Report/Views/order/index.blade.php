@extends('Admin::layouts.master')
  @section('body')

<div class="block-header block-header-2">
	<h2 class="pull-left">
	  
	</h2>

	<a href="javascript:history.back()"  class="btn btn-warning waves-effect pull-right backbtn">Back</a>

</div>

<!-- Widgets -->
<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('admin.order.todays.order.report') }}" style="text-decoration: none;" class="info-box bg-pink hover-expand-effect mousepointer">
            <div class="icon">
                <i class="material-icons">list</i>
            </div>
            <div class="content">
                <div class="text">TODAY'S ORDER</div>
                <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">({{$todays_order}})</div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('admin.order.fifteendays.order.report') }}" style="text-decoration: none;"class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">list</i>
            </div>
            <div class="content">
                <div class="text">LAST 15 DAY'S ORDER</div>
                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">({{$last_15_days_order}})</div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
       <a href="{{ route('admin.order.last.onemonth.order.report') }}" style="text-decoration: none;" class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">list</i>
            </div>
            <div class="content">
                <div class="text">LAST 30 DAY'S ORDER</div>
                <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">({{$last_30_days_order}})</div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
       <a href="{{ route('admin.order.onemonth.order.report') }}" style="text-decoration: none;" class="info-box bg-red hover-expand-effect">
            <div class="icon">
                <i class="material-icons">list</i>
            </div>
            <div class="content">
                <div class="text">CURRENT MONTH ORDER</div>
                <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">({{$current_month_order}})</div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="#" style="text-decoration: none;" class="info-box bg-blue hover-expand-effect"  data-toggle="modal" data-target="#custom_order_popup">
            <div class="icon">
                <i class="material-icons">list</i>
            </div>
            <div class="content">
                <div class="text">DATE TO DATE SEARCH</div>
                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">Click Here</div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="#" style="text-decoration: none;" class="info-box bg-purple hover-expand-effect"  data-toggle="modal" data-target="#custom_order_by_payment_popup">
            <div class="icon">
                <i class="material-icons">list</i>
            </div>
            <div class="content">
                <div class="text">FILTER BY PAYMENT TYPE</div>
                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">Click Here</div>
            </div>
        </a>
    </div>
</div>
<div class="modal fade" id="custom_order_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CUSTOM ORDER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('Report::order.customformshow')


      </div>
      
    </div>
  </div>
</div>

<div class="modal fade" id="custom_order_by_payment_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CUSTOM ORDER BY PAYMENT TYPE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('Report::order.customformbypayemnt')
        
      </div>
      
    </div>
  </div>
</div>

<style type="text/css" media="screen">
    .datepicker{
        z-index: 9999;
    }
</style>
@endsection

