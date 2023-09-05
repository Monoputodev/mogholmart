@extends('Admin::layouts.master')
@section('body')

<div class="block-header block-header-2">
    <h2 class="pull-left">
      View Of EMI
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
                            <th>Bank Name</th>
                            <td>{{ isset($data->bank_name)?ucfirst($data->bank_name):''}}</td>
                        </tr>
                        
                        <tr>
                            <th>Month</th>
                            <td>{{ isset($data->emi_month)?ucfirst($data->emi_month):''}}</td>
                        </tr>
                        <tr>
                            <th>EMI Rate</th>
                            <td>{{ isset($data->emi_rate)?ucfirst($data->emi_rate):''}}</td>
                        </tr>
                        <tr>
                            <th>EMI Interest Rate</th>
                            <td>{{ isset($data->emi_interest_rate)?ucfirst($data->emi_interest_rate):''}}</td>
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