@extends('Admin::layouts.master')
@section('body')

<div class="block-header block-header-2">
    <h2 class="pull-left">
      View Of Shipping calculation
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
                        <th>Shipping Type</th>
                        <td>{{ isset($data->shipping_type)?ucfirst($data->shipping_type):''}}</td>
                    </tr>
                    <tr>
                        <th>Condition</th>
                        <td>{{ isset($data->condition)?ucfirst($data->condition):''}}</td>
                    </tr>
                    <tr>
                        <th>Method</th>
                        <td>{{ isset($data->method)?ucfirst($data->method):''}}</td>
                    </tr>
                    <tr>
                        <th>Main Value</th>
                        <td>{{ isset($data->main_value)?ucfirst($data->main_value):''}}</td>
                    </tr>
                   

                    <tr>
                        <th>Status</th>
                        <td>{{ isset($data->status)?ucfirst($data->status):'' }}</td>
                    </tr>

                </table>
            </div>
        </div>
        <!-- end panel-body -->
    </div>
    <!-- end panel -->
</div>
</div>
@endsection  