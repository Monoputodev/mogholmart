@extends('Merchant::merchant.merchant_master')
@section('body')

<section class="top-teacher-area section-padding-50" style="background-image: url({{asset('frontend')}}/img/core-img/texture.png);">
      <div class="container">
            <div class="row">
                  <div class="col-12">
                        <div class="section-heading">
                              <h2>MERCHANT COMMISSION</h2>
                              <h3>{{$varifaid_user->shop_name}}</h3>
                              <a href="javascript:history.back()" class="btn-style-1 float-right">Back</a>
                        </div>
                  </div>
            </div>

            <div class="row">   

                  <div class="col-12 col-md-12">
                        <div class="header">
                             @if(count($merchant_wise_data) > 0)
                             <h3>
                              Total Ammount  : <strong style="color: blue; font-size: 20px; font-weight: bold;">{{__('messages.tk')}} {{number_format($merchant_wise_data->total_amount,2)}}</strong> || 
                              Commission Rate : <strong style="color: blue; font-size: 20px; font-weight: bold;">{{ isset($merchant_wise_data->comission_rate)?$merchant_wise_data->comission_rate:'2.00'}} %</strong> || Commission Ammount : <strong style="color: blue; font-size: 20px; font-weight: bold;"> {{__('messages.tk')}} {{number_format($merchant_wise_data->comission_amount,2)}}</strong>
                        </h3>
                        @endif
                 </div>
                  </div>  



                  <div class="col-lg-12">

                        <div class="table-responsive">

                              <table class="table table-bordered table-striped table-hover dataTable js-basic-example">

                                    <thead>
                                          <tr>
                                                <th>Serial No</th>
                                                <th> Order Number </th>
                                                <th> Date </th>
                                                <th> Product</th>
                                                
                                                <th> Price</th>
                                                <th> Commission</th>
                                                <th> Status</th>


                                          </tr>
                                    </thead>

                                    <tbody>

                                          @if(!empty($merchant_wise_details))
                                          @foreach($merchant_wise_details as $key => $values)

                                          <?php
                                          $order_items = $values::getOrderItems($values);
                                          $merchant_id=Auth::guard()->user()->id;

                                          ?>
                                          <tr>
                                                <td>{{$key+1}}</td>

                                                <td>{{$values->order_number}}</td>
                                                <td>{{ date('M d, Y',strtotime($values->date)) }}</td>
                                                <td>
                                                      @if(count($order_items) > 0)
                                                      @foreach($order_items as $item)
                                                            @if ($item->product_merchant_id==$merchant_id)
                                                            <strong>{{ $item->product_title }}</strong><br/>
                                                            <small>QTY: {{ $item->quantity }}&nbsp;&nbsp;&nbsp;&nbsp;Item No: <?php
                                                                  $item_no_explode = explode('-',$item->item_no);

                                                                  if(isset($item_no_explode)){
                                                                        


                                                                        for($i=2;$i<(count($item_no_explode) - 1);$i++){
                                                                              echo $item_no_explode[$i];

                                                                              if($i < (count($item_no_explode) - 2)){
                                                                                    echo '-';
                                                                              }
                                                                        }
                                                                  }?></small><br/>
                                                            <strong>{{ $item->shop_name }}</strong><br/>
                                                            <small>{{ $item->first_contact_person_details }}</small><br/>
                                                      @endif
                                                      
                                                      @endforeach
                                                      @endif

                                                </td>
                                                
                                                <td>
                                                    {{__('messages.tk')}}{{number_format($values->total_price,2)}}
                                                </td>
                                                <td>
                                                      {{__('messages.tk')}}{{number_format($values->comission_price,2)}}
                                                </td>

                                                <td>
                                                      {{ucfirst($values->status)}}
                                                </td>


                                          </tr>

                                          @endforeach
                                          @endif

                                    </tbody>


                              </table>

                              <nav aria-label="Page navigation" class="float-right">
                                    <ul class="pagination">
                                          {{ $merchant_wise_details->links() }}
                                    </ul>
                              </nav>

                        </div>

                  </div>        

            </div>

      </div>
</section> 



@endsection