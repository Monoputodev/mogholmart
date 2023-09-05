@extends('Admin::layouts.master')
@section('body')
<div class="block-header block-header-2">
    <h2 class="pull-left">
      View Of Review
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
                        <th> Rating </th>
                        <td>
                            {{$values->rating_value_score}}
                        </td>
                    </tr>

                    <tr>
                        <th> Product Name </th>
                        <td> @if (isset($values->relProduct))
                           {{$values->relProduct->product_title}}
                       @endif</td>
                   </tr>
                   <tr>
                        <th>Customer Name</th>
                        <td>@if (isset($values->relUser))
                                {{$values->relUser->first_name}} {{$values->relUser->last_name}}
                             @endif
                        </td>
                    </tr>
                   <tr>
                        <th>Title</th>
                        <td>{{$values->title}}</td>
                    </tr>
                    <tr>
                        <th>Review</th>
                        <td>
                            {!!$values->review!!}
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{$values->status}}</td>
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