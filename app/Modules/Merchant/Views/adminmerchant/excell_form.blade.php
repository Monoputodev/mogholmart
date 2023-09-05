@extends('Admin::layouts.master')
@section('body')

<?php
use Illuminate\Support\Facades\Input;
?>

<div class="block-header block-header-2">
    <h2 class="pull-left">
            {{isset($pageTitle)?$pageTitle:''}}
    </h2>

    <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
    <a href="{{ route('admin.merchant.create') }}" class="btn btn-primary waves-effect pull-right m-l-10">Add Merchant</a>
    <a href="{{ route('admin.merchant.excell') }}" class="btn btn-primary waves-effect pull-right m-l-10">Excell Sheet</a>
    
</div>



   <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                   LIST OF MERCHANT DATA


                   <input  class="btn btn-warning waves-effect pull-right" type="button" onclick="tableToExcel('testTable', 'Merchant Wise Product List')" value="Export to Excel">
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover table-responsive"  id="testTable" name="Merchant Table">
                        <caption> LIST OF MERCHANT</caption><colgroup align="center"></colgroup><colgroup align="left"></colgroup><colgroup span="2" align="center"></colgroup><colgroup span="3" align="center"></colgroup>
                    <thead>
                        <tr>
                            <th> #</th>
                            <th> Shop </th>
                            <th> Merchant </th>
                            <th> Email </th>
                            <th> Mobile </th>
                            <th> Aggrement</th>
                            <th> NID</th>
                            <th> TIN / Trade</th>
                            <th> Address</th>
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
                                {{$values->shop_name}}
                            </td>
                            <td>
                                {{$values->first_name}} {{$values->last_name}}
                            </td>
                            <td>
                                {{$values->email}}
                            </td>
                            <td>
                                {{$values->mobile_no}}
                            </td>
                            <td>
                                {{$values->merchant_agreement }}
                            </td>
                            <td>
                                {{$values->nid}}
                            </td>
                            <td>
                                {{$values->tin_no}}
                            </td>
                            <td>
                                {{$values->shop_address}}
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
              </div>
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

