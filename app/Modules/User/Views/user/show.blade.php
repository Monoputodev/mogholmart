@extends('Admin::layouts.master')
@section('body')




    <div class="block-header block-header-2">
        <h2 class="pull-left">
          View Of User
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
                        <th>Email</th>
                        <td>{{ isset($data->email)?ucfirst($data->email):''}}</td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td>{{ isset($data->first_name)?ucfirst($data->first_name):''}}</td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td>{{ isset($data->last_name)?ucfirst($data->last_name):''}}</td>
                    </tr>
                    <tr>
                        <th>Admin Roles</th>
                        <td>{{ isset($data->relUserRoles->title)?ucfirst($data->relUserRoles->title):''}}</td>
                    </tr>
                    <tr>
                        <th>Admin Type</th>
                        <td>{{ isset($data->type)?ucfirst($data->type):''}}</td>
                    </tr>
                    

                    <tr>
                        <th>Status</th>
                        <td>{{ isset($data->status)?ucfirst($data->status):'' }}</td>
                    </tr>
                    
                    <tr>
                        <th>Image</th>
                        <td>
                            @if(count($data->image) > 0 && !empty($data->image))
                                
                            <a target="_blank" href="{{URL::to('')}}/uploads/user/{{$data->image}}">
                                <img width="50" height="50" src="{{URL::to('')}}/uploads/user/{{$data->image}}">            
                            </a>
                            @endif
                        </td>
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