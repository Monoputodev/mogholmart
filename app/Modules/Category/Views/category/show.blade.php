@extends('Admin::layouts.master')
@section('body')


<div class="block-header block-header-2">
    <h2 class="pull-left">
      View Of Category
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
                            <th>Meta Keyword</th>
                            <td>{{ $data->meta_keyword }}</td>
                        </tr>

                        <tr>
                            <th>Show in Main Menu</th>
                            <td>{{ $data->show_in_main_menu }}</td>
                        </tr>

                        <tr>
                            <th>Show in Main Menu</th>
                            <td>{{ $data->show_in_left_navigation_menu }}</td>
                        </tr>

                        <tr>
                            <th>Image</th>
                            <td>
                                @if(!empty($data->image_link))
                                <a target="_blank" href="{{URL::to('')}}/uploads/category/200x200/{{$data->image_link}}">
                                    <img width="50" height="50" src="{{URL::to('')}}/uploads/category/200x200/{{$data->image_link}}">            
                                </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Banner</th>
                            <td>
                                @if(!empty($data->banner_link))
                                <a target="_blank" href="{{URL::to('')}}/uploads/category/banner/{{$data->banner_link}}">
                                    <img width="50" height="50" src="{{URL::to('')}}/uploads/category/banner/{{$data->banner_link}}">            
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