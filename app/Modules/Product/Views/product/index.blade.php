@extends('Admin::layouts.master')
@section('body')

<?php
use Illuminate\Support\Facades\Input;
?>
<div class="block-header block-header-2">
  <h2 class="pull-left">
    Product
  </h2>

  <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
  <a style="margin-left: 10px;" href="{{route('admin.product.create')}}" class="btn btn-primary waves-effect pull-right">Add Product</a>
  <a  style="margin-left: 10px;" href="{{ route('admin.product.active') }}" class="btn btn-success waves-effect pull-right">Active Product</a>
  <a   style="margin-left: 10px;"href="{{ route('admin.product.inactive') }}" class="btn btn-warning waves-effect pull-right">InActive Product</a>
  <a  style="margin-left: 10px;"href="{{ route('admin.product.cancel') }}" class="btn btn-danger waves-effect pull-right">Cancel Product</a>

</div>

{!! Form::open(['method' =>'GET', 'route' => 'admin.product.search', 'id'=>'', 'class' => '']) !!}
<div class="input-group">
  <div class="form-line">            
   {!! Form::text('search_keywords',@Input::get('search_keywords')? Input::get('search_keywords') : null,['class' => 'form-control','placeholder'=>'Type Search Key']) !!}
 </div>
 <span class="input-group-addon">
  <button type="submit" class="btn bg-red waves-effect">
    Search
  </button>
</span>
</div>
{!! Form::close() !!}


<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
         LIST OF PRODUCT
       </h2>
     </div>
     <div class="body">
      <div class="table-responsive">
       @if(count($data) > 0)
       <div>
        {{$data->links()}}
      </div>
      @endif
      <table class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th> No</th>
            <th> Title </th>
            <th> Product Code </th>
            <th> Sell Price </th>
            <th> Attribute Set </th>
            <th> Status</th>
            <th> Action </th>

          </tr>
        </thead>
        <tbody>
         @if(count($data) > 0)

         @foreach($data as $key=> $values)
         <tr>
          <td>
            {{ ($data->currentpage()-1) * $data->perpage() + $key + 1 }}
          </td>
          <td>
            {{$values->title}}
          </td>
          <td>
            {{$values->item_no}}
          </td>
          <td>
           ৳ {{number_format($values->sell_price,2)}}
          </td>

          <td>

           @if(Input::path() === 'admin-product-search')
           {{$values->attribute_title}}
           @else
           {{isset($values->relAttribute->title)?$values->relAttribute->title:''}}
           @endif
         </td>
         
        <td>
          @if($values->status=='active')
          <button type="button" class="btn btn-success btn-sm">{{ucfirst($values->status)}}</button>
          @elseif($values->status=='inactive')
          <button type="button" class="btn btn-warning btn-sm">{{ucfirst($values->status)}}</button>
          @else
          <button type="button" class="btn btn-danger btn-sm">{{ucfirst($values->status)}}</button>
          @endif
        </td>

        <td>
          <a href="{{ route('admin.product.edit', $values->id) }}" class="demo-google-material-icon" title="Edit Product"><i class="material-icons">border_color</i></a>


          <a href="{{ route('admin.product.destroy', $values->id) }}" class="demo-google-material-icon" onclick="return confirm('Are you sure to Delete?')" title="Delete Product" ><i class="material-icons">delete</i></a>
        </td>
      </tr>

      @endforeach
      @endif
    </tbody>
  </table>
  @if(count($data) > 0)
  <div>
    {{$data->links()}}
  </div>
  @endif

</div>
</div>
</div>
</div>
</div>

@endsection

