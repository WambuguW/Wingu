@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Account Statement
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

<script>
    function printAccount()
    {

    var content = document.getElementById('printstatement').innerHTML;
            var pwin = window.open('', 'print_content', 'width=200,height=200');
            pwin.document.open();
            pwin.document.write('<html><link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css"><body style="font-family:Arial, Helvetica, width:90%;margin-left:5%; margin-right:5%; sans-serif; font-size:8px; text-align:center; background-color:#FFF;" onload="window.print()">' + content + '</body></html>');
            pwin.document.close();
            setTimeout(function(){pwin.close(); }, 100000);
            return true;
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
    Account Statement
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
                                                <i class="fa fa-globe"></i>Account Statement
                                        </div>
                                </div>
                                <div class="portlet-body" id="printstatement">
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
                                                <th colspan="2" align="right"><strong>Admno: </strong></th><th colspan="4" align="left">{{ $admno }}</th>
                                            </tr>
                                            <tr>
                                                <th colspan="2" align="right"><strong>Full Name: </strong></th><th colspan="4" align="left">{{ App\Modules\Core\Helpers\StudentsDetails::getstudentname($admno) }}</th>
                                            </tr>
                                            <tr>
                                                <th colspan="2" align="right"><strong>Current Class: </strong></th><th colspan="4" align="left">{{ App\Modules\Core\Helpers\StudentsDetails::get_student_current_class($admno) }}</th>
                                            </tr>
                                        <tr>
                                                <th>
                                                    DATE
                                                </th>
                                                <th>
                                                    TRANS TYPE
                                                </th>
                                                <th>
                                                    TRANS NO.
                                                </th>
                                                <th>
                                                    DESCRIPTION
                                                </th>
                                                <th>
                                                    AMOUNT
                                                </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $rct = 0; $inv = 0;  ?>
                                            @foreach($invoices as $invoice)
                                            <?php $inv += $invoice->invoice_amount; ?>
                                            <tr><td>{{ $invoice->invoice_date }}</td><td>INVOICE</td><td>{{ $invoice->invoice_no }}</td><td>{{ $invoice->description }}</td><td align="right">{{ number_format($invoice->invoice_amount, 2) }}</td></tr>
                                                @foreach(App\Modules\Finance\Helpers\FinanceFunctions::invoice_amt_paid($invoice->admno, $invoice->term, $invoice->year) as $invpayment)
                                                <?php $rct += $invpayment->amount; ?>
                                                <tr><td>{{ $invpayment->date }}</td><td>RECEIPT</td><td>{{ $invpayment->receiptno }}</td><td>{{ App\Modules\Finance\Helpers\FinanceFunctions::get_bank_name($invpayment->bank_id) }}</td><td align="right">-{{ number_format($invpayment->amount, 2) }}</td></tr>
                                                @endforeach
                                            @endforeach
                                            <tr><td colspan="4" align="right"><strong>Balance:</strong></td><td>{{ number_format($inv - $rct, 2) }}</td></tr>
                                        </tbody>
                                        </table>
                                    
                            </div>
                                <div class="col-md-12">
                                    <div class="col-md-9 col-md-offset-3">
                                        <input type="button" class="btn blue" onclick="return printAccount()" value="Print">
                                    </div>
                                </div>

                            <!-- END PORTLET-->
                        </div>
                    </div>

                    <!-- END PAGE CONTENT-->
<!--------------------------------------------------------END OF PAGE CONTENT-------------------------------------------->
@endsection
                