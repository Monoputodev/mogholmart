@extends('Admin::layouts.master')
@section('body')

<?php
use Illuminate\Support\Facades\Input;
?>

<div class="block-header block-header-2">
    <h2 class="pull-left">
       Commission By Merchant 
    </h2>

    <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
    
</div>

{!! Form::open(['method' =>'GET', 'route' => 'admin.comission.merchant.search', 'id'=>'', 'class' => '']) !!}
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

<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                   LIST OF COMMISSION BY MERCHANT <strong style="color: blue; font-size: 20px; font-weight: bold;">( Default commission is 2.00 % )</strong>
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                        <thead>
                           <tr>
                                <th>#</th>
                                <th> Name </th>
                                <th> Type </th>
                                <th> Total order ammout</th>
                                <th> Rate </th>
                                <th> Only Confirmed order commission amount</th>
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
                                {{$values->shop_name}}
                           
                        </td>
                        
                        <td>

                            {{ isset($values->comission_type)?$values->comission_type:'default'}}
                        </td>
                        <td>
                            {{number_format($values->total_amount,2)}} tk
                        </td>
                        <td>
                            {{ isset($values->comission_rate)?$values->comission_rate:'2.00'}} %
                        </td>
                        <td>
                            {{number_format($values->comission_amount,2)}} tk
                        </td>
                        <td>
                            <a href="{{ route('admin.comission.merchant.show', $values->product_merchant_id) }}" class="demo-google-material-icon"><i class="material-icons"></i>Details</a>
                            
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

