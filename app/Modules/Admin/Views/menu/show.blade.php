@extends('Admin::layouts.master')
@section('body')

<div class="block-header block-header-2">
    <h2 class="pull-left">
      View Of Menu
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
                            <th>Title</th>
                            <td>{{ isset($data->title)?ucfirst($data->title):''}}</td>
                        </tr>
                        
                        <tr>
                            <th>Slug</th>
                            <td>{{ isset($data->slug)?ucfirst($data->slug):''}}</td>
                        </tr>

                        <tr>
                            <th>Position</th>
                            <td>{{ isset($data->position)?ucfirst($data->position):''}}</td>
                        </tr>
                      

                        <tr>
                            <th>Description</th>
                            <td>{{ isset($data->description)?ucfirst($data->description):'' }}</td>
                        </tr>
                         <tr>
                            <th>Order</th>
                            <td>{{ isset($data->short_order)?ucfirst($data->short_order):'' }}</td>
                        </tr> 
                        <tr>
                            <th>Status</th>
                            <td>{{ isset($data->status)?ucfirst($data->status):'' }}</td>
                        </tr>
                        

                        <tr>
                            <th>Image</th>
                            <td>
                                @if(isset($data->image_link) > 0 && !empty ($data->image_link))
                                    
                                <a target="_blank" href="{{URL::to('')}}/uploads/menu/{{$data->image_link}}">
                                    <img width="50" height="50" src="{{URL::to('')}}/uploads/menu/{{$data->image_link}}">            
                                </a>
                                @endif
                            </td>
                        </tr>

                    </table>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection  