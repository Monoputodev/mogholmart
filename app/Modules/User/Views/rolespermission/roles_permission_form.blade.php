@extends('Admin::layouts.master')
@section('body')


<div class="block-header block-header-2">
    <h2 class="pull-left">
        Roles Permission
    </h2>
    <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
</div>


<!--Filter :Starts -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    LIST OF PERMISSION
                </h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-md-6">

                        <h4>Unassigned Permission</h4>
                        <p><input type="checkbox" name="chkbx_all_first" id="chkbx_all_unsigned"
                          onclick="return check_all_first()" style="margin-top: 15px;margin-left: 5px;">
                          <label for="chkbx_all_unsigned" style="font-size: 14px;">Select all</label>
                      </p>

                      {!! Form::open(['route' => 'admin.roles.permission.store',  'files'=> true, 'class' => 'form-horizontal']) !!}

                      <input type="hidden" name="roles_id" value="{{$roles_id}}">

                      <div class="table-responsive">

                        <table class="table table-bordered table-striped table-hover dataTable js-basic-example">

                            <thead>
                                <th style="width: 20%">Checked</th>
                                <th style="width: 50%">Route</th>
                                <th style="width: 50%">Name</th>
                            </thead>

                            <tbody>

                                @if(count($permission_list) > 0)
                                @foreach($permission_list as $permission)

                                <tr>
                                    <td>
                                        <input type="checkbox" name="unassigned_permission[]"
                                        class="element_first" value='{{$permission->id}}'>
                                    </td>
                                    <td>
                                        {{$permission->route}}
                                    </td>
                                    <td>
                                        {{$permission->title}}
                                    </td>

                                </tr>

                                @endforeach
                                @endif

                            </tbody>

                        </table>

                        <div class="col-md-12">
                            {!! Form::submit('Assigned', ['class' => 'btn btn-primary pull-right btn-big font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                            &nbsp;
                        </div>

                    </div>

                    {!! Form::close() !!}

                </div>


                <div class="col-md-6">

                    <h4>Assigned Permission</h4>
                    <p>
                        <input type="checkbox" name="checkboxfoall" id="chkbx_all" onclick="return check_all()"
                        style="margin-top: 15px;margin-left: 5px;">
                        <label for="chkbx_all" style="font-size: 14px;">Select All</label>
                    </p>
                    {!! Form::open(['route' => 'admin.roles.permission.unassigned.store',  'files'=> true, 'class' => 'form-horizontal']) !!}

                    <input type="hidden" name="roles_id" value="{{$roles_id}}">

                    <div class="table-responsive" style="position: relative;">

                        <table class="table table-bordered table-striped table-hover dataTable js-basic-example">

                            <thead>

                                <th style="width: 20%">Checked</th>
                                <th style="width: 50%">Route</th>
                                <th style="width: 50%">Name</th>
                            </thead>

                            <tbody>

                                @if(count($asssigned_roles) > 0)
                                @foreach($asssigned_roles as $ass_permission)

                                <tr>
                                    <td>
                                        <input type="checkbox" name="assigned_permission[]"
                                        class="check_elmnt" value="{{$ass_permission->id}}">
                                    </td>
                                    <td>
                                        {{$ass_permission->relPermission->route}}
                                    </td>
                                    <td>
                                        {{$ass_permission->relPermission->title}}
                                    </td>
                                </tr>

                                @endforeach
                                @endif

                            </tbody>
                        </table>
                        <div class="col-md-12">
                            {!! Form::submit('Unassigned', ['class' => 'btn btn-warning pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                            &nbsp;
                        </div>

                    </div>
                    {!! Form::close() !!}
                </div>

            </div>


        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    function check_all_first() {

        if ($('#chkbx_all_unsigned').is(':checked')) {

            $('input.element_first').prop('checked', true);

        } else {

            $('input.element_first').prop('checked', false);

        }
    }


    function check_all() {

        if ($('#chkbx_all').is(':checked')) {

            $('input.check_elmnt').prop('checked', true);

        } else {

            $('input.check_elmnt').prop('checked', false);

        }
    }
</script>
@endsection
