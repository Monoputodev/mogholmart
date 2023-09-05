@extends('Admin::layouts.master')
@section('body')

<div class="block-header block-header-2">
    <h2 class="pull-left">
      View Of Pages
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
                        <th>Title</th>
                        <td>{{ isset($data->title)?ucfirst($data->title):''}}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ isset($data->slug)?ucfirst($data->slug):''}}</td>
                    </tr>
                    <tr>
                        <th>Short Description</th>
                        <td>{!! $data->short_description !!}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{!! $data->description !!}</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>{{ isset($data->status)?ucfirst($data->status):'' }}</td>
                    </tr>
                    <tr>
                        <th>Meta Title</th>
                        <td>{{ $data->meta_title }}</td>
                    </tr>
                    <tr>
                        <th>Meta Description</th>
                        <td>{{ $data->meta_description }}</td>
                    </tr>
                    <tr>
                        <th>Meta Image Link</th>
                        <td>{{ $data->meta_image_link }}</td>
                    </tr>

                    <tr>
                        <th>Image</th>
                        <td>
                            @if(count($data->image_link) > 0 && !empty($data->image_link) )
                            <a target="_blank" href="{{URL::to('')}}/uploads/generalpages/{{$data->image_link}}">
                                <img width="50" height="50" src="{{URL::to('')}}/uploads/generalpages/{{$data->image_link}}">            
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