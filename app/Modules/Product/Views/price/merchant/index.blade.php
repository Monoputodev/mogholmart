@extends('Admin::layouts.master')
@section('body')


<div class="block-header block-header-2">
    <h2 class="pull-left">
                   {{$pageTitle}}
    </h2>

    <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
    
</div>

<!-- Advanced Select -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <form action="{{ route('admin.price.update.merchant') }}" method="GET">
                                    {{ csrf_field()}}
                                <div class="col-md-3">
                                    <p>
                                        <b>Search With Merchant</b>
                                    </p>
                                    <select name="merchant_id" id="product_category" class="form-control show-tick" data-live-search="true" required="true">
                                @foreach ($merchant as $element)
                                
                                    <option value="{{$element->id}}"
                                        @php
                                        if(isset($form_data['merchant_id']) && ($element->id == $form_data['merchant_id']) )
                                          echo "selected";
                                      @endphp
                                    >{{$element->shop_name}}</option>
                                @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <p>
                                        <b>Order By</b>
                                    </p>
                                    <select name="asc_desc" id="asc_desc" class="form-control" required="true">
                                        <option value="ASC"
                                            @php
                                                if(isset($form_data['orderby']) && ($form_data['orderby'] == 'ASC') )
                                                 echo "selected";
                                            @endphp
                                        >ASC</option>
                                        <option value="DESC"
                                            @php
                                                if(isset($form_data['orderby']) && ($form_data['orderby'] == 'DESC') )
                                                 echo "selected";
                                            @endphp
                                        >DESC</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <p>
                                        <b>Number Of Product</b>
                                    </p>
                                    <select name="product_number" id="product_number" class="form-control" required="true">
                                        <option value="all"
                                            @php
                                                if(isset($form_data['product_num']) && ($form_data['product_num'] == 'all') )
                                                 echo "selected";
                                            @endphp
                                        >All</option>
                                        <option value="limit"
                                            @php
                                                if(isset($form_data['product_num']) && ($form_data['product_num'] == 'limit') )
                                                 echo "selected";
                                            @endphp
                                        >Limit</option>
                                    </select>
                                </div>

                                <?php
                                    if (isset($form_data['product_num']) && $form_data['product_num'] == 'limit') {
                                        $style = "";
                                        $limit_start = $form_data['limit_start'];
                                        $limit_end = $form_data['limit_end'];
                                    }else{
                                        $style = "display: none";
                                        $limit_start = 0;
                                        $limit_end = 0;
                                    }
                                ?>

                                <div class="col-md-2 limit_start" style="{{$style}}">
                                    <p>
                                        <b>Limit Start</b>
                                    </p>
                                    <input type="Number" value="<?=isset($limit_start)?$limit_start:''?>" name="limit_start" class="form-control" placeholder=" Start Limit" required>
                                </div>
                                
                                <div class="col-md-2 limit_end" style="{{$style}}">
                                    <p>
                                        <b>Limit End</b>
                                    </p>
                                    <input type="Number" value="<?=isset($limit_end)?$limit_end:''?>" name="limit_end" class="form-control" placeholder=" End Limit" required>
                                </div>
                                <div class="col-md-2 float-right">
                    <button id="product_category" class="btn btn-primary waves-effect">SEARCH</button>
                                </div>
                                
                            </div>

                            </form>  
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Select -->

            {{-- Merchant wish serach data show --}}
            @if (isset($data) && (count($data) > 0) )
            <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    SEARCH PRODUCT LIST
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
<form id="form_data" method="POST" action="{{ route('admin.price.update.store') }}">
                      {{ csrf_field()}}
                    <table class="table table-bordered table-striped table-hover">


                    <thead>
                     <tr>
                        <th>No</th>
                        <th>Item No</th>
                        <th> Title </th>
                        <th>Sell Price</th>
                        <th>Update sell Price</th>
                        <th>List Price</th>
                        <th>Update List Price</th>
                        <th> Last Update </th>
                        <th>Action</th>
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
                        <a target="new" href="{{ route('admin.product.edit', $values->id) }}">{{$values->item_no}}</a>
                        <input type="hidden" name="product_id[]" value="{{$values->id}}">
                    </td>
                    
                    <td>
                        {{$values->title}}
                    </td>

                    <td>
                        {{number_format($values->sell_price,2)}}
                        <input type="hidden" name="actual_price[]" id="actual_price" value="{{$values->sell_price}}">
                    </td>

                    <td>
                        <input type="text" name="update_price[]" value="" class="form-control" placeholder="Update Price">
                    </td>
                    
                    <td>
                         {{number_format($values->list_price,2)}}
                        
                        <input type="hidden" name="actual_list_price[]" id="actual_list_price" value="{{$values->list_price}}">
                    </td>

                    <td>
                        <input type="text" name="update_list_price[]" value="" class="form-control" placeholder="Update List Price">
                    </td>


                    @php
                            if ($values->created_at == $values->updated_at){
                                $update = "Just Added !";
                                $style = 'background:#ccffff';
                            }else{
                                $update = $values->updated_at;
                                $style = 'background:';

                            }

                            
                        @endphp
                    <td style="{{$style}}">
                        {{$update}}
                    </td>
                    <td>
                        {{-- <a  data-href="{{ route('admin.price.update.details',$values->id) }}" class="open-price-update-modal" title="VIEW DETAILS" style="cursor: pointer;"><i  class="material-icons" >calendar_view_day</i></a>

                        <a data-href="{{ route('admin.price.update.undo',$values->id) }}" class="open-price-update-modal demo-google-material-icon" title="SET PREVIOUS PRICE " style=" cursor: pointer;cursor: pointer;float: right;margin-top: -26px;margin-left: 26px;"><i style="border: 1px solid;" class="material-icons">undo</i></a> --}}

                        <a  data-href="{{ route('admin.price.update.details',$values->id) }}" class="open-price-update-modal" title="VIEW DETAILS" style="cursor: pointer;"><i style="border: 1px solid;" class="material-icons">calendar_view_day</i></a>

                        <a data-href="{{ route('admin.price.update.undo',$values->id) }}" class="open-price-update-modal demo-google-material-icon" title="SET PREVIOUS PRICE " style=" cursor: pointer;cursor: pointer;float: right;margin-top: -26px;margin-left: 26px;"><i style="border: 1px solid;" class="material-icons">undo</i></a>
                    </td>

             </tr>
             <?php
             $total_rows++;
             ?>

             @endforeach
         
             @endif

         </tbody>
         
     </table>
     <div class="col-md-2 col-md-offset-10">
            <button onClick="return confirm('Are you absolutely sure,you want to change price?')" type="submit" id="update" class="btn btn-primary waves-effect float-right">PRICE UPDATE</button>
        </div>
        </form>
        
     </div>

             
            </div>
        </div>
</div>
            @endif

<div class="modal fade open_modal_update_details" tabindex="" role="dialog">
    <div class="modal-dialog modal-lg">
       
        <div class="modal-content">
             <div class="modal-header">
                <h4 class="modal-title">Price Update Details </h4>
                <button type="button" class="close" data-dismiss="modal" style="margin-top: -26px !important;">
                    <span aria-hidden="true">&times;</span>
                </button>                    
            </div>
            <div class="modal-body">
                
                

            </div> <!-- / .modal-body -->
        </div> <!-- / .modal-content -->
    </div> 
</div>

<script type="text/javascript">

    $(document).delegate('.open-price-update-modal','click',function () {
        // alert('raju');
        var url = $(this).attr('data-href');
        var id = '';

        $.ajax({
            url: url,
            method: "GET",
            data: {id:id},
            dataType: "json",
            beforeSend: function( xhr ) {

            }
        }).done(function( response ) {
            if(response.result == 'success'){
                // alert('raju');
                $('.open_modal_update_details .modal-body').html(response.content);
                
                $('.open_modal_update_details').modal('show');

            }else{
                alert('Update Details Not Available !');
            }
        }).fail(function( jqXHR, textStatus ) {

        });


        return false;


    });


    $('#data-table-responsive').attr('data-page-length','50');


    $(document).ready(function() {
        $('#product_number').on('change',function(){
            var product_number = $(this).val();
            // alert(product_number);
            if(product_number == 'all'){
                $('.limit_start').hide();
                $('.limit_end').hide();;
            }

            if(product_number == 'limit'){
                $('.limit_start').show();
                $('.limit_end').show();
            }
        });

      });   
</script>

<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap-select.js') }}"></script>

@endsection

