@extends('Admin::layouts.master')
@section('body')

<?php
use Illuminate\Support\Facades\Input;
?>
<div class="block-header block-header-2">
    <h2 class="pull-left">
         Shipping Calculation
    </h2>

    <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
    <a href="{{route('admin.shipping.calculation.setting.create')}}" class="btn btn-primary waves-effect pull-right">Add  Shipping Calculation</a>
</div>

 {!! Form::open(['method' =>'GET', 'route' => 'admin.shipping.calculation.setting.search', 'id'=>'', 'class' => '']) !!}
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

    <!--Filter :Starts -->
    <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                   LIST OF SHIPPING CALCULATION DATA
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                    <thead>
                        <tr>
                            <th> No</th>
                            <th> Shipping Type </th>
                            <th> Condition </th>
                            <th> Method</th>
                            <th> Main Value</th>
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
                                    <td>
                                        {{$values->shipping_type}}
                                    </td>
                                    <td>
                                        {{$values->condition}}
                                    </td>
                                    <td>
                                        {{$values->method}}
                                    </td>
                                    <td>
                                        {{$values->main_value}}
                                    </td>
                                    <td>
                                        {{$values->status}}
                                    </td>
                                   
                                    <td>
                                       <a href="{{ route('admin.shipping.calculation.setting.show', $values->id) }}" class="demo-google-material-icon"><i class="material-icons">remove_red_eye</i></a>
                                       <a href="{{ route('admin.shipping.calculation.setting.edit', $values->id) }}" class="demo-google-material-icon" ><i class="material-icons">border_color</i></a>
                                       <a href="{{ route('admin.shipping.calculation.setting.destroy', $values->id) }}" class="demo-google-material-icon" onclick="return confirm('Are you sure to Delete?')" ><i class="material-icons">delete</i></a>
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

@endsection

