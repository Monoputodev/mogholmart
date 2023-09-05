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
                           <th> No</th>
                            
                            <th> Title </th>
                            <th> Item No </th>
                            <th> Sales Price </th>
                            <th> List Price </th>
                            <th> Reguler Price </th>
                            <th> Attribute Set </th>
                           
                            <th> Status</th>
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
                                    {{$values->title}}
                                </td>
                                 <td>
                                    {{$values->item_no}}
                                </td>
                                <td>
                                    {{ __('messages.tk') }} {{number_format($values->sell_price,2)}}
                                </td>
                                <td>
                                   {{ __('messages.tk') }} {{number_format($values->list_price,2)}}
                                </td>

                                <td>
                                   
                                  {{ __('messages.tk') }} {{number_format($values->offer_price,2)}}
                                   
                                </td>

                                <td>
                                    {{isset($values->relAttribute->title)?$values->relAttribute->title:''}}
                                   
                                </td>
                                
                                <td>
                                    {{$values->status}}
                                </td>
                                
                               
                            </tr>
                            <?php
                                $total_rows++;
                            ?>
                            @endforeach
                           
                        @endif

                    </tbody>
                </table>
                <table>
                
                  <thead>
                    <tr>
                      <th>{{$data->links()}}</th>
                    </tr>
                  </thead>
                  
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