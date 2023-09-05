@extends('Admin::layouts.master')
@section('body')

<?php
use Illuminate\Support\Facades\Input;
?>

<div class="block-header block-header-2">
    <h2 class="pull-left">
            User information
    </h2>

    <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
    <a href="{{route('admin.user.create')}}" class="btn btn-primary waves-effect pull-right m-l-10">Add User</a>
    
</div>

 {!! Form::open(['method' =>'GET', 'route' => 'admin.user.search', 'id'=>'', 'class' => '']) !!}
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
                   LIST OF USER DATA
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                    <thead>
                        <tr>
                            <th> No</th>
                            <th> Admin Roles </th>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Admin Type </th>
                            <th> Status</th>
                            <th> Image</th>
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
                                {{isset($values->relUserRoles)?$values->relUserRoles->title:''}}
                            </td>
                            <td>
                                {{$values->first_name}} {{$values->last_name}}
                            </td>
                            <td>
                                {{$values->email}}
                            </td>
                            <td>
                                {{$values->type}}
                            </td>
                            <td>
                                {{$values->status}}
                            </td>
                            <td>
                                @if(count($values->image) > 0 && !empty($values->image))
                                    <img width="50" height="50" src="{{URL::to('')}}/uploads/user/{{$values->image}}">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.user.show', $values->id) }}" class="demo-google-material-icon"><i class="material-icons">remove_red_eye</i></a>

                                <a href="{{ route('admin.user.edit', $values->id) }}" class="demo-google-material-icon" ><i class="material-icons">border_color</i></a>

                                <a href="{{ route('admin.user.destroy', $values->id) }}" class="demo-google-material-icon" onclick="return confirm('Are you sure to Delete?')" ><i class="material-icons">delete</i></a>
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

