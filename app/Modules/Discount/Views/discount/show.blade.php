@extends('Admin::layouts.master')
@section('body')

<div class="block-header block-header-2">
    <h2 class="pull-left">
      View Of Discount
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
                            <th>Category Title</th>
                            <td>{{ isset($data->category_id)?ucfirst($data->category_id):''}}</td>
                        </tr>
                        
                        <tr>
                            <th>Discount Percentage</th>
                            <td>{{ isset($data->disc_percentage)?ucfirst($data->disc_percentage):''}}</td>
                        </tr>
                        <tr>
                            <th>Start Date</th>
                            <td>{{ isset($data->start_date)?ucfirst($data->start_date):''}}</td>
                        </tr>
                        <tr>
                            <th>End Date</th>
                            <td>{{ isset($data->end_date)?ucfirst($data->end_date):''}}</td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td>{{ isset($data->type)?ucfirst($data->type):''}}</td>
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