@extends('Admin::layouts.master')
@section('body')



<div class="block-header block-header-2">
    <h2 class="pull-left">
      View Of Product
    </h2>    
    <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
    <a style="margin-left: 10px;" href="{{route('admin.product.create')}}" class="btn btn-primary waves-effect pull-right">Add Product</a>
    <a  style="margin-left: 10px;" href="{{ route('admin.product.active') }}" class="btn btn-success waves-effect pull-right">Active Product</a>
    <a   style="margin-left: 10px;"href="{{ route('admin.product.inactive') }}" class="btn btn-warning waves-effect pull-right">InActive Product</a>
    <a  style="margin-left: 10px;"href="{{ route('admin.product.cancel') }}" class="btn btn-danger waves-effect pull-right">Cancel Product</a>
                
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
                        <th>Attribute Set</th>
                        <td>{{ isset($data->relAttribute->title)?ucfirst($data->relAttribute->title):''}}</td>
                    </tr>
                    <tr>
                        <th>Manufacturer</th>
                        <td>{{ isset($data->relManufacturer->title)?ucfirst($data->relManufacturer->title):''}}</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>{{ isset($data->type)?ucfirst($data->type):''}}</td>
                    </tr>
                    <tr>
                        <th>Item No</th>
                        <td>{{ isset($data->item_no)?ucfirst($data->item_no):''}}</td>
                    </tr>
                    <tr>
                        <th>Sell Price</th>
                        <td>{{ isset($data->sell_price)?ucfirst($data->sell_price):''}}</td>
                    </tr>
                    <tr>
                        <th>List Price</th>
                        <td>{{ isset($data->list_price)?ucfirst($data->list_price):''}}</td>
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
                        <th>Specification</th>
                        <td>{!! $data->specifition !!}</td>
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