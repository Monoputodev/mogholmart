@extends('Admin::layouts.master')
@section('body')
<div class="block-header block-header-2">
    <h2 class="pull-left">
      View Of Coupon
  </h2>    
  <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>            
</div>
<div class="row clearfix">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">

                <div class="table-responsive">  
                 
                    <table id="" class="table table-bordered  table-striped">
                        <tr>
                            <th>Name</th>
                            <td>{{ isset($data->coupon_name)?ucfirst($data->coupon_name):''}}</td>
                        </tr>

                        <tr>
                            <th>Coupon Code</th>
                            <td>{{ isset($data->coupon_code)?ucfirst($data->coupon_code):''}}</td>
                        </tr>
                        <tr>
                            <th>Coupon Type</th>
                            <td>{{ isset($data->coupon_type)?ucfirst($data->coupon_type):''}}</td>
                        </tr>
                        <tr>
                            <th>Uses Per Customer</th>
                            <td>{{ isset($data->user_per_customer)?ucfirst($data->user_per_customer):''}}</td>
                        </tr>
                        <tr>
                            <th>Uses Per Coupon</th>
                            <td>{{ isset($data->user_per_coupon)?ucfirst($data->user_per_coupon):''}}</td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td>{{ isset($data->amount)?ucfirst($data->amount):''}}</td>
                        </tr>
                        <tr>
                            <th>From Date</th>
                            <td>{{ isset($data->valid_from)?ucfirst($data->valid_from):''}}</td>
                        </tr>
                        <tr>
                            <th>To Date</th>
                            <td>{{ isset($data->valid_to)?ucfirst($data->valid_to):''}}</td>
                        </tr>
                        
                        <tr>
                            <th>Status</th>
                            <td>{{ isset($data->status)?ucfirst($data->status):'' }}</td>
                        </tr>
                        
                        <tr>
                            <th>Description</th>
                            <td>{!! $data->description !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- end panel-body -->
        </div>
    </div>
    <!-- end panel -->
</div>
@endsection  