@extends('Admin::layouts.master')
@section('body')

<?php
use Illuminate\Support\Facades\Input;
?>
<div class="block-header block-header-2">
<h2 class="pull-left">
    Category
</h2>

<a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
<a href="{{route('admin.category.create')}}" class="btn btn-primary waves-effect pull-right">Add Category</a>
</div>

{!! Form::open(['method' =>'GET', 'route' => 'admin.category.search', 'id'=>'', 'class' => '']) !!}
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
               LIST OF CATEGORY
           </h2>
       </div>
       <div class="body">
        <div class="table-responsive">

            <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                <thead>
                   <tr>
                    <th>No</th>
                    
                    <th> Title </th>
                    
                    <th> Slug </th>
                    <th> Status</th>
                    <th> Image</th>
                    <th> Action </th>
                    <th> Sub Category</th>
                    <th> Product List</th>

                </tr>
            </thead>

            <tbody>
              @if(count($data) > 0)
              <?php
              $total_rows = 1;
              ?>
              @foreach($data as $values)
              <?php

              $product_id_list_data = DB::table('category')->join('product_category', 'product_category.category_id', '=', 'category.id')
              ->where('category.id',$values->id)
              ->where('category.status','active')
              ->select('product_category.product_id')
              ->get();

              ?>

              <tr>
                <td><?=$total_rows?></td>
                
                <td>
                    {{$values->title}}
                    ({{count($values->relCategoryChild)}})
                </td>
                
                <td>{{$values->slug}}</td>
                <td>{{$values->status}}</td>
                <td>
                    @if(!empty($values->image_link))
                    <img width="50" height="50" src="{{URL::to('')}}/uploads/category/200x200/{{$values->image_link}}">
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.category.show', $values->id) }}" class="demo-google-material-icon"><i class="material-icons">remove_red_eye</i></a>
                    <a href="{{ route('admin.category.edit', $values->id) }}" class="demo-google-material-icon" ><i class="material-icons">border_color</i></a>
                    <a href="{{ route('admin.category.destroy', $values->id) }}" class="demo-google-material-icon" onclick="return confirm('Are you sure to Delete?')" ><i class="material-icons">delete</i></a>
                </td>
                <td>
                    @if(count($values->relCategoryChild) > 0)
                    <a href="{{ route('admin.sub.category', $values->id) }}">More Category</a>
                    @endif
                </td>
                <td>
                    <a target="__blank" href="{{ route('admin.category.product.list', $values->id) }}">Total Product ({{count($product_id_list_data)}})</a>
                </td>
            </tr>
            <?php
            $total_rows++;
            ?>
            @endforeach
            @endif

        </tbody>
    </table>

</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">

$('#data-table-responsive').attr('data-page-length','50');
</script>
@endsection

