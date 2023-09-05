@extends('Admin::layouts.master')
@section('body')

<div class="block-header block-header-2">
    <h2 class="pull-left">
      View Of Commission
    </h2>    
    <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>            
</div>

<div class="row clearfix">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">

                <div class="table-responsive">  
                    <table id="" class="table">
                        <tr>
                            <th>Name</th>
                                <td>
                                    @if(isset($data->relMerchant) && count($data->relMerchant) > 0)
                                    {{$data->relMerchant->first_name}} {{$data->relMerchant->last_name}}
                                @endif
                            </td>
                        </tr>
                     
                        <tr>
                            <th>Commission Rate</th>
                            <td>{{ isset($data->comission_rate)?ucfirst($data->comission_rate):''}}</td>
                        </tr>

                        <tr>
                            <th>Commission Type</th>
                            <td>{{ isset($data->comission_type)?ucfirst($data->comission_type):''}}</td>
                        </tr>
                      

                        <tr>
                            <th>From Date</th>
                            <td>{{ isset($data->from_date)?ucfirst($data->from_date):'' }}</td>
                        </tr>
                        <tr>
                            <th>To Date</th>
                            <td>{{ isset($data->to_date)?ucfirst($data->to_date):'' }}</td>
                        </tr>
                         <tr>
                            <th>Items</th>
                            <td>{{ isset($data->items)?ucfirst($data->items):'' }}</td>
                        </tr> 
                        <tr>
                            <th>Status</th>
                            <td>{{ isset($data->status)?ucfirst($data->status):'' }}</td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection  