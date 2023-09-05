@extends('Admin::layouts.master')
@section('body')
<div class="block-header block-header-2">
    <h2 class="pull-left">
        Software Documentaion
    </h2>
    <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
   
</div>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header"></div>

            <div class="body">
            	<iframe src="{{URL::to('logo/BanglamedDocumentaion.pdf')}}" style="width:100%; height: 700px;" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection