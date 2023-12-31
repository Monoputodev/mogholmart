@extends('Admin::layouts.master')
@section('body')

<?php
use Illuminate\Support\Facades\Input;
?>

<div class="block-header block-header-2">
    <h2 class="pull-left">
       Category Product List
   </h2>

   <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
</div>

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

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                       <tr>
                        <th>No</th>
                        <th> Item No </th>
                        <th> Title </th>
                        <th> Status</th>
                        <th> Action </th>
                    </tr>
                </thead>

                <tbody>
                  @if(count($data) > 0)
                  <?php
                  $total_rows = 1;
                  ?>
                  @foreach($data as $values)

                  <tr>
                    <td><?=$total_rows?></td>
                    <td><a href="{{ route('admin.product.edit', $values->id) }}">{{$values->item_no}}</a></td>
                    <td>
                        {{$values->title}}
                    </td>
                    <td>{{$values->status}}</td>

                    <td>
                       <a href="{{ route('admin.product.edit', $values->id) }}" class="demo-google-material-icon" ><i class="material-icons">border_color</i></a>
                   </td>

               </tr>
               <?php
               $total_rows++;
               ?>
               @endforeach
               @endif

           </tbody>
       </table>
       <table>
         {{$data->links()}}
     </table>

 </div>
</div>
</div>
</div>
</div>

@endsection

