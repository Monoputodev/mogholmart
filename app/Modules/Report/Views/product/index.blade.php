@extends('Admin::layouts.master')
@section('body')

<div class="block-header block-header-2">
	<h2 class="pull-left">
	 PRODUCT REPORT DASHBOARD
	</h2>

	<a  href="javascript:history.back()" class="btn btn-warning waves-effect pull-right backbtn">Back</a>

</div>

<!-- Widgets -->
<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('admin.product.todays.product.report') }}" style="text-decoration: none;" class="info-box bg-pink hover-expand-effect" >
            <div class="icon">
                <i class="material-icons">list</i>
            </div>
            <div class="content">
                <div class="text">TODAY'S  REPORT</div>
                <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">({{$todays_product}})</div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('admin.product.fifteendays.product.report') }}" style="text-decoration: none;"class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">list</i>
            </div>
            <div class="content">
                <div class="text">LAST 15 DAY'S  REPORT</div>
                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">({{$last_15_days_product}})</div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
       <a href="{{ route('admin.product.last.onemonth.product.report') }}" style="text-decoration: none;" class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">list</i>
            </div>
            <div class="content">
                <div class="text">LAST 30 DAY'S  REPORT</div>
                <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">({{$last_30_days_product}})</div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
       <a href="{{ route('admin.product.onemonth.product.report') }}" style="text-decoration: none;" class="info-box bg-red hover-expand-effect">
            <div class="icon">
                <i class="material-icons">list</i>
            </div>
            <div class="content">
                <div class="text">CURRENT MONTH  REPORT</div>
                <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">({{$current_month_product}})</div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="#" style="text-decoration: none;" class="info-box bg-blue hover-expand-effect"  data-toggle="modal" data-target="#custom_product_popup">
            <div class="icon">
                <i class="material-icons">list</i>
            </div>
            <div class="content">
                <div class="text">DATE TO DATE  REPORT</div>
                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">Click Here</div>
            </div>
        </a>
    </div>

    {{-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="#" style="text-decoration: none;" class="info-box bg-black hover-expand-effect"  data-toggle="modal" data-target="#custom_admin_product_popup_entry">
            <div class="icon">
                <i class="material-icons">list</i>
            </div>
            <div class="content">
                <div class="text">PRODUCT ENTRY REPORT</div>
                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">Click Here</div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="#" style="text-decoration: none;" class="info-box bg-black hover-expand-effect"  data-toggle="modal" data-target="#custom_admin_product_popup">
            <div class="icon">
                <i class="material-icons">list</i>
            </div>
            <div class="content">
                <div class="text">PRODUCT UPDATE REPORT</div>
                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">Click Here</div>
            </div>
        </a>
    </div> --}}
</div>
<div class="modal fade" id="custom_product_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CUSTOM REPORT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('Report::product.customformshow')


      </div>
      
    </div>
  </div>
</div>

<div class="modal" id="custom_admin_product_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">PRODUCT UPDATE REPORT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        {!! Form::open(['route' => 'admin.product.update.form.submit', 'id'=>'orderreport', 'class' => 'form-horizontal']) !!}

            @include('Report::product.dataentry_show')

        {!! Form::close() !!}    


      </div>
      
    </div>
  </div>
</div>

<div class="modal" id="custom_admin_product_popup_entry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">PRODUCT ENTRY REPORT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        {!! Form::open(['route' => 'admin.product.entry.form.submit', 'id'=>'orderreport', 'class' => 'form-horizontal']) !!}

            @include('Report::product.dataentry_show')

        {!! Form::close() !!}

      </div>
      
    </div>
  </div>
</div>

<style type="text/css">
    .form-group .form-line{
        margin-bottom: 15px;
    }
    .datepicker{
        z-index: 9999;
    }
</style>

@endsection

