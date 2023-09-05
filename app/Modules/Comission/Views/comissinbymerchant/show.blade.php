@extends('Admin::layouts.master')
@section('body')

<?php
use Illuminate\Support\Facades\Input;
?>

<div class="block-header block-header-2">
    <h2 class="pull-left">
        Merchant Wise Order & Product Details
    </h2>
    <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
</div>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="body">
                {!! Form::open(['method' =>'GET', 'route' => 'admin.comission.merchant.show.search']) !!}
                <?php
                $date_range = [
                    'all' => 'All',
                    'last_7' => 'Last 7 days',
                    'last_30' => 'Last 30 days',
                    'last_60' => 'Last 60 days',
                    'custom' => 'Custom Range'
                ];

                $order_status =  [
                    '' => 'Select Status',
                    'confirmed' => 'Confirmed',
                    'shipped' => 'Shipped',
                    'delivered' => 'Delivered',
                    'cancel' => 'Cancel'
                ];
                ?>
                <div class="input-group">

                    

                    <div class="col-md-3 col-sm-3" >
                        <div class="form-line">
                            <label>Merchant:</label>
                            {!! Form::Select('merchant_id',$merchant_list,Input::old('merchant_id'),['id'=>'merchant_id', 'class'=>'form-control ']) !!}
                            
                        </div>

                    </div>
                    <div class="col-md-2 col-sm-2" >
                        <div class="form-line">
                            <label>Filter by order status:</label>
                            {!! Form::Select('status',$order_status,Input::old('status'),['id'=>'status', 'class'=>'form-control ','placeholder'=>'Select status']) !!}
                            
                        </div>

                    </div>

                    <div class="col-md-2 col-sm-2" >
                        
                        <div class="form-line">
                            
                            <label>Date range:</label>
                            {!! Form::Select('date_range',$date_range,Input::old('date_range'),['id'=>'date_range', 'class'=>'form-control ']) !!}


                        </div>

                    </div>

                    <div class="col-md-2 col-sm-2" >
                        <div class="form-line">
                            
                            <label>From Date</label>
                            {!! Form::text('from_date',Input::old('from_date'),['id'=>'from_date', 'class'=>'form-control', 'placeholder'=>'From']) !!}
                        </div>

                    </div>

                    <div class="col-md-2 col-sm-2" >
                        <div class="form-line">
                            
                            <label>To Date</label>
                            {!! Form::text('to_date',Input::old('to_date'),['id'=>'to_date', 'class'=>'form-control ','placeholder'=>'To']) !!}
                        </div>

                    </div>

                    <div class="col-md-1 col-sm-1">
                        

                        <label>&nbsp;</label><br/>
                        {!! Form::submit('Search', array('class'=>'btn btn-w-lg btn-info','id'=>'button', 'data-placement'=>'right', 'data-content'=>'type code or title or both in specific field then click search button for required information')) !!}
                        

                    </div>

                </div>


                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
               @if(count($merchant_wise_data) > 0)
                             <h3>
                              Total Ammount  : <strong style="color: blue; font-size: 20px; font-weight: bold;">{{number_format($merchant_wise_data->total_amount,2)}} tk</strong> || 
                              Commission Rate : <strong style="color: blue; font-size: 20px; font-weight: bold;">{{ isset($merchant_wise_data->comission_rate)?$merchant_wise_data->comission_rate:'2.00'}} %</strong> || Commission Ammount : <strong style="color: blue; font-size: 20px; font-weight: bold;">{{number_format($merchant_wise_data->comission_amount,2)}} tk</strong>
                        </h3>
                        @endif
            </div>
            <div class="body">
                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th> Order</th>
                                <th> Date </th>
                                <th> Product</th>
                                <th> Billing</th>
                                <th> Shipping</th>
                                <th> Actual Price</th>
                                <th> Commission</th>
                                <th> Merchant payable</th>
                                <th> Status</th>
                              
                            </tr>
                        </thead>

                        <tbody>

                            @if(!empty($data))
                            @foreach($data as $key => $values)

                            <?php
                            $order_items = $values::getOrderItems($values);
                        
                            ?>
                            <tr>
                                <td>{{$key+1}}</td>
                                
                                <td><a href="{{ route('admin.order.show', $values->id) }}">{{$values->order_number}}</a></td>
                                <td>{{ date('M d, Y',strtotime($values->date)) }}</td>
                                <td>
                                    @if(count($order_items) > 0)
                                        @foreach($order_items as $item)
                                        
                                         @if ($item->product_merchant_id==$id)
                                                <strong>{{ $item->product_title }}</strong><br/>
                                                <small>QTY: {{ $item->quantity }}&nbsp;&nbsp;&nbsp;&nbsp;Item No: {{ $item->item_no }}</small><br/>
                                                <strong>{{ $item->shop_name }}</strong><br/>
                                                <small>{{ $item->first_contact_person_details }}</small><br/>
                                            @endif
                                        @endforeach
                                    @endif

                                </td>
                                <td>
                                    <?php
                                    if(isset($values->relOrderShipping)){
                                        foreach($values->relOrderShipping as $bill_data){

                                            if($bill_data->type == 'billing'){

                                                echo $bill_data->first_name . ' '.$bill_data->last_name.'<br/>';
                                                echo $bill_data->address . '<br/>';
                                                echo 'Email: '.$bill_data->email .'<br/>';
                                                echo "Phone: ".$bill_data->phone;

                                            }

                                        }
                                    }
                                    ?>

                                </td>

                                <td>
                                    <?php
                                    if(isset($values->relOrderShipping)){
                                        foreach($values->relOrderShipping as $bill_data){

                                            if($bill_data->type == 'shipping'){

                                                echo $bill_data->first_name . ' '.$bill_data->last_name.'<br/>';
                                                echo $bill_data->address . '<br/>';
                                                echo 'Email: '.$bill_data->email .'<br/>';
                                                echo "Phone: ".$bill_data->phone;

                                            }

                                        }
                                    }
                                    ?>

                                </td>

                                <td>
                                    Tk. {{number_format($values->total_price,2)}}
                                </td>
                                <td>
                                    Tk. {{number_format($values->comission_price,2)}}
                                </td>

                                <td>
                                   Tk. {{$values->total_price-$values->comission_price}}
                                </td>
                                <td>
                                    {{ucfirst($values->status)}}
                                </td>
                                

                            </tr>

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
    $('#from_date').datepicker({
        format: 'yyyy-mm-dd',
    });
    $('#to_date').datepicker({
        format: 'yyyy-mm-dd',
    });

    $(document).delegate('#date_range','change',function () {
        var range = $(this).val();
        var date_diff = 0;

        if(range == 'last_7'){
            date_diff = 7;
        }else if(range == 'last_30'){
            date_diff = 30;
        }else if(range == 'last_60'){
            date_diff = 60;
        }

        if(date_diff > 0){
            var today = new Date();
            var priorDate = new Date().setDate(today.getDate()-date_diff);
            var first_date = new Date(priorDate);

            var start_date = first_date.getFullYear()+'-'+(("0" + (first_date.getMonth() + 1)).slice(-2))+'-'+(("0" + first_date.getDate()).slice(-2));
            var end_date = today.getFullYear()+'-'+(("0" + (today.getMonth() + 1)).slice(-2))+'-'+(("0" + today.getDate()).slice(-2));

            $('#from_date').val(start_date);
            $('#to_date').val(end_date);
        }

        if(range == 'custom'){
            $('#from_date').attr('readonly',false);
            $('#to_date').attr('readonly',false);
        }else if(range == 'all'){
            $('#from_date').val('');
            $('#to_date').val('');
        }else{
            $('#from_date').attr('readonly',true);
            $('#to_date').attr('readonly',true);
        }

    })

    $('#date_range').trigger('change');
</script>

@endsection

