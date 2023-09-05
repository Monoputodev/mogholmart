@extends('Admin::layouts.master')
@section('body')

    <div class="block-header block-header-2">
        <h2 class="pull-left">
            Add Roles
        </h2>
        <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
    </div>

    <div class="row clearfix">

        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    {!! Form::open(['route' => 'admin.roles.store',  'files'=> true, 'id'=>'rolesform', 'class' => 'form-horizontal']) !!}

                    @include('User::roles._form')

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
