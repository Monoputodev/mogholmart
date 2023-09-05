@extends('Admin::layouts.master')
@section('body')

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="margin-top: -19px;">
                  
                  <a  href="javascript:history.back()" class="btn btn-danger waves-effect pull-right backbtn">Back</a>
                   <input  class="btn btn-warning waves-effect pull-right" type="button" onclick="tableToExcel('testTable', 'TODAYS TOTAL ORDER LIST')" value="Export to Excel">
                  

                </h2>
            </div>
            <div class="body" id="pdfprint">
                <div class="table table-responsive">

                    <table class="table table-bordered table-striped"  id="testTable" name="Merchant Table">
                        <caption> {{$pageTitle}}</caption><colgroup align="center"></colgroup><colgroup align="left"></colgroup><colgroup span="2" align="center"></colgroup><colgroup span="3" align="center"></colgroup>
                    <thead>
                      
                         <tr>
                          <th>Serial No</th>
                          <th> Order Number </th>
                          <th> Date </th>
                          
                          <th> Price</th>
                          <th> Delivery Cost</th>
                          <th> Discount</th>
                          <th> Total Price</th>
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
                        {{ __('messages.tk') }} {{number_format($values->total_price,2)}}
                      </td>

                      <td>
                        {{ __('messages.tk') }} {{number_format($values->shipping_value,2)}}
                      </td>

                      <td>
                        {{ __('messages.tk') }} {{number_format($values->coupon_code_value,2)}}
                      </td>

                      <td>
                        {{ __('messages.tk') }} {{number_format( ($values->total_price + $values->shipping_value) - $values->coupon_code_value,2)}}
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

<script type="text/javascript">
    
    var tableToExcel = (function() {
      var uri = 'data:application/vnd.ms-excel;base64,'
      , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
      , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
      , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
      return function(table, name) {
        if (!table.nodeType) table = document.getElementById(table)
            var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
        window.location.href = uri + base64(format(template, ctx))
    }
})()


</script>
@endsection