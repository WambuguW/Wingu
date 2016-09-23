@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Fees Paid
@endsection
<script>
function filter(){
    inp = $('#inputdata').val()
    // This should ignore first row with th inside
    $("tr:not(:has(>th))").each(function() {
        if (~$(this).text().toLowerCase().indexOf( inp.toLowerCase() ) ) {
            // Show the row (in case it was previously hidden)
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}
</script>
<script>
    function delconfirm(mystring){
        if(confirm('Are you sure you want to delete adm. no.' + mystring + '?')){
            return true;
        }
        else{
            return false;
        }
        
    }
</script>

<script type="text/javascript">             var tableToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body class="page-header-fixed page-full-width" style="color:#272822; font-family:verdana; font-size:13px;"><table>{table}</table></body></html>'
             , base64 = function(s) {
                        return window.btoa(unescape(encodeURIComponent(s)))
    }
, format = function(s, c) {
return s.replace(/{(\w+)}/g, function(m, p) {
return c[p];
})
}
return function(table, name) {
if (!table.nodeType)
table = document.getElementById(table)
var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
window.location.href = uri + base64(format(template, ctx))
}
})()
        </script>

<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    Fees Paid
@endsection
@section('page_content')
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="row">
                        <!-- BEGIN PORTLET -->
                        <div class="col-md-10 col-sm-10 col-md-offset-1">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                        <div class="caption">
                                                <i class="fa fa-globe"></i>Fees Paid
                                        </div>
                                </div>
                                <div class="portlet-body" id="expt">
                                    @if(isset($success))
                                        <div class="app-alerts alert alert-success fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                            {{ $success }}
                                        </div>
                                        @endif
                                    @if(isset($error))
                                    <div class="app-alerts alert alert-danger fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                        {{ $error }}
                                    </div>
                                    @endif
                                        
                                        <table class="table table-striped table-bordered table-hover table-full-width">
                                        <thead>
                                            <tr>
                                                <th colspan="6"><center>TERM {{ $term }}, {{ $year }} FEES PAYMENT STATEMENT </center></th>
                                            </tr>
                                        <tr>
                                                <th>
                                                    CHEQUE/RECEIPT NO
                                                </th>
                                                <th>
                                                    BANK
                                                </th>
                                                <th>
                                                    PAYEE
                                                </th>
                                                <th>
                                                    PAID ON
                                                </th>
                                                <th>
                                                    AMOUNT
                                                </th>
                                                <th>
                                                    VIEW ACOUNT
                                                </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total = 0; ?>
                                            @foreach($feespaid as $fees)
                                            <?php $total += App\Modules\Finance\Helpers\FinanceFunctions::std_total_fees_paid($fees->admno, $fees->term, $fees->year); ?>
                                            <tr><td>{{ $fees->receiptno }}</td><td>{{ App\Modules\Finance\Helpers\FinanceFunctions::get_bank_name($fees->bank_id) }}</td><td>{{ $fees->admno }} {{ App\Modules\Core\Helpers\StudentsDetails::getstudentname($fees->admno) }}</td><td>{{ date("d-M-Y" ,strtotime($fees->paid_on)) }}</td><td>{{ number_format(App\Modules\Finance\Helpers\FinanceFunctions::std_total_fees_paid($fees->admno, $fees->term, $fees->year), 2) }}</td><td><a href="{{ url('finance/accounts/statement') }}/{{ $fees->admno }}" class="badge badge-primary">View</a></td></tr>
                                            @endforeach
                                            <tr><td colspan="4" align="right"><strong>TOTAL</strong></td><td><strong>{{ number_format($total, 2) }}</strong></td><td></td></tr>
                                            
                                        </tbody>
                                        </table>
                                    <input type="button" class="btn blue" onclick="tableToExcel('expt')" value="Export to Excel">
                            </div>

                            <!-- END PORTLET-->
                        </div>
                    </div>

                    <!-- END PAGE CONTENT-->
<!--------------------------------------------------------END OF PAGE CONTENT-------------------------------------------->
@endsection
                