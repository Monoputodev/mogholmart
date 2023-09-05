@extends('Admin::layouts.master')
@section('body')


<div class="block-header block-header-2">
    <h2 class="pull-left">
      View Of Attribute
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
                            <th> Title</th>
                            <td>{{ isset($data->frontend_title)?ucfirst($data->frontend_title):''}}</td>
                        </tr>

                        
                        
                        
                        <tr>
                            <th>Code column</th>
                            <td>{{ isset($data->code_column)?ucfirst($data->code_column):''}}</td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td>{{ isset($data->type)?ucfirst($data->type):''}}</td>
                        </tr>
                        <tr>
                            <th>Type is required</th>
                            <td>{{ isset($data->type_is_required)?ucfirst($data->type_is_required):''}}</td>
                        </tr>

                        <tr>
                            <th>Order</th>
                            <td>{{ isset($data->order)?ucfirst($data->order):''}}</td>
                            
                        </tr>
                        
                        <tr>
                            <th>Default Value</th>
                            <td>{{ isset($data->default_value)?ucfirst($data->default_value):''}}</td>
                            
                        </tr><tr>
                            <th>Use In Quick Search</th>
                            <td>{{ isset($data->use_in_quick_search)?ucfirst($data->use_in_quick_search):''}}</td>
                            
                        </tr><tr>
                            <th>Use In Advanced Search</th>
                            <td>{{ isset($data->use_in_advance_search)?ucfirst($data->use_in_advance_search):''}}</td>
                            
                        </tr><tr>
                            <th>Use In Filter</th>
                            <td>{{ isset($data->use_in_filter)?ucfirst($data->use_in_filter):''}}</td>
                            
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ isset($data->status)?ucfirst($data->status):''}}</td>
                            
                        </tr>
                        
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection  