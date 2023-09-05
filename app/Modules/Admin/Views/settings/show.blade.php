@extends('Admin::layouts.master')
@section('body')


    <div class="block-header block-header-2">
        <h2 class="pull-left">
            View of setttings data
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
                                <th>Key</th>
                                <td>{{ isset($data->key)?ucfirst($data->key):''}}</td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td>{{ isset($data->type)?ucfirst($data->type):''}}</td>
                            </tr>

                            <tr>
                                <th>Value</th>

                                <td>

                                   @if(count($data->type=="file") > 0 && !empty($data->type=="file"))
                                       <img width="50" height="50"
                                       src="{{URL::to('')}}/uploads/generel_file/{{$data->value}}">
                                       @else
                                    {{ isset($data->value)?ucfirst($data->value):''}}
                                    @endif


                                </td>

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