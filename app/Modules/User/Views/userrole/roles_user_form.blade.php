@extends('Admin::layouts.master')
@section('body')

<div class="block-header block-header-2">
    <h2 class="pull-left">
        Roles User 
    </h2>

    <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
    
</div>

<!--Filter :Starts -->
   <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                   LIST OF ROLE
                   
                </h2>
            </div>
            <div class="body">
            
            <div class="row">
                <div class="col-md-6">

                    <h4>Unassigned User</h4>

                    {!! Form::open(['route' => 'admin.roles.user.store',  'files'=> true, 'class' => 'form-horizontal']) !!}

                    <input type="hidden" name="user_id" value="{{$user_id}}">
                    
                    <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                            <thead>
                                <th style="width: 50%">Checkbox</th>
                                <th style="width: 50%">Roles</th>
                            </thead>

                            <tbody>
                                
                                @if(count($role_user_list) > 0)
                                    @foreach($role_user_list as $user)

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="unassigned_user[]" value='{{$user->id}}'>
                                            </td>
                                            <td>
                                                {{$user->title}}
                                            </td>

                                        </tr>
                                        
                                    @endforeach
                                @endif

                            </tbody>

                        </table>

                        <div class="col-md-12">
                            {!! Form::submit('Assigned', ['class' => 'btn btn-primary pull-right btn-big font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
                        </div>
                            
                    </div>

                    {!! Form::close() !!}

                </div>


                <div class="col-md-6">

                    <h4>Assigned User</h4>

                    {!! Form::open(['route' => 'admin.roles.user.unassigned.store',  'files'=> true, 'class' => 'form-horizontal']) !!}

                    <input type="hidden" name="user_id" value="{{$user_id}}">

                    <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                            <thead>
                                <th style="width: 50%">Checkbox</th>
                                <th style="width: 50%">Roles</th>
                            </thead>

                            <tbody>

                                @if(count($asssigned_roles) > 0)
                                    @foreach($asssigned_roles as $ass_permission)

                                        <tr>
                                            <td>
                                                <input type="checkbox" name="assigned_user[]" value="{{$ass_permission->id}}">
                                            </td>
                                            <td>
                                                {{$ass_permission->relRoles->title}}
                                            </td>
                                           
                                        </tr>
                                        
                                    @endforeach
                                @endif
                                
                            </tbody>
                        </table>
                        <div class="col-md-12">
                            {!! Form::submit('Unassigned', ['class' => 'btn btn-warning pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
                        </div>

                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
            

        </div>
    </div>
</div>

@endsection
