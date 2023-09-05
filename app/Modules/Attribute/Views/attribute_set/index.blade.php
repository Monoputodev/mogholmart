@extends('Admin::layouts.master')
@section('body')

<?php
use Illuminate\Support\Facades\Input;
?>

    
<div class="block-header block-header-2">
    <h2 class="pull-left">
        Attribute Set
    </h2>

    <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
    <a href="{{route('admin.attribute.set.create')}}" class="btn btn-primary waves-effect pull-right">Add Attribute Set</a>
</div>

 {!! Form::open(['method' =>'GET', 'route' => 'admin.attribute.set.search', 'id'=>'', 'class' => '']) !!}
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
                   LIST OF ATTRIBUTE SET
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                    <thead>
                        <tr>
                            <th> No</th>
                            <th> Title </th>
                            
                            <th> Slug </th>
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
                                    <td>
                                        <?=$total_rows?>
                                    </td>
                                    <td>
                                        {{$values->title}}
                                    </td>
                                    
                                    <td>
                                        {{$values->slug}}
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
                                        
                                        <a href="{{ route('admin.attribute.set.show', $values->id) }}" class="demo-google-material-icon"><i class="material-icons">remove_red_eye</i></a>
                                        <a href="{{ route('admin.attribute.set.edit', $values->id) }}" class="demo-google-material-icon" ><i class="material-icons">border_color</i></a>
                                        <a href="{{ route('admin.attribute.set.destroy', $values->id) }}" class="demo-google-material-icon" onclick="return confirm('Are you sure to Delete?')" ><i class="material-icons">delete</i></a>
                                        <a type="button" href="{{ route('admin.attribute.set.items', $values->id) }}" class="btn btn-info btn-xs" style="    height: 25px; margin-top: -20px;">
                                            <i class="material-icons">list</i>
                                            <span>Items</span>
                                        </a>
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

