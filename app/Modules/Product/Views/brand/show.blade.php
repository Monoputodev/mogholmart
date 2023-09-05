@extends('Admin::layouts.master')
@section('body')
<div class="block-header block-header-2">
    <h2 class="pull-left">
      View Of Brand
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
                        <th>Dealer Title</th>
                        <td>
                            @if(isset($data->relManufacturer) && count($data->relManufacturer) > 0)
                                {{$data->relManufacturer->title}}
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Title</th>
                        <td>{{ isset($data->title)?ucfirst($data->title):''}}</td>
                    </tr>
                    
                    <tr>
                        <th>Slug</th>
                        <td>{{ isset($data->slug)?ucfirst($data->slug):''}}</td>
                    </tr>
                    <tr>
                        <th>Is Top Brand</th>
                        <td>{{ isset($data->is_top_brand)?ucfirst($data->is_top_brand):''}}</td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td>
                            @if(count($data->image_link) > 0 && !empty($data->image_link))
                            <a target="_blank" href="{{URL::to('')}}/uploads/brand/{{$data->image_link}}">
                                <img width="50" height="50" src="{{URL::to('')}}/uploads/brand/{{$data->image_link}}">            
                            </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ isset($data->status)?ucfirst($data->status):'' }}</td>
                    </tr>
                    <tr>
                        <th>Meta Title</th>
                        <td>{{ isset($data->meta_title)?ucfirst($data->meta_title):''}}</td>
                    </tr>
                    <tr>
                        <th>Meta Description</th>
                        <td>{!! $data->meta_description !!}</td>
                    </tr>
                    <tr>
                        <th>Meta Image Link</th>
                        <td>{{ isset($data->meta_image_link)?ucfirst($data->meta_image_link):''}}</td>
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