@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Fees Receipt
@endsection






<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    Fees Receipt
@endsection
@section('page_content')
<script>
            function printResults()
            {

            var content = document.getElementById('printresults').innerHTML;
                    var pwin = window.open('', 'print_content', 'width=200,height=200');
                    pwin.document.open();
                    pwin.document.write('<html><link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css"><body style="font-family:Arial, Helvetica, width:90%;margin-left:5%; margin-right:5%; sans-serif; font-size:8px; text-align:center; background-color:#FFF;" onload="window.print()">' + content + '</body></html>');
                    pwin.document.close();
                    setTimeout(function(){pwin.close(); }, 100000);
                    return true;
            }
        </script>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="row">
                        <!-- BEGIN PORTLET -->
                        <div class="col-md-10 col-sm-10 col-md-offset-1">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                        <div class="caption">
                                                <i class="fa fa-globe"></i>Fees Payment Receipt
                                        </div>
                                </div>
                                
                                <div class="portlet-body dark_green">
                                    <div class="well dark_green">
                                        @if(isset($success))
                                            <div class="app-alerts alert alert-info fade in">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                                {{ $success }}
                                            </div>
                                            @endif
                                        @if(isset($message_array))
                                            <div class="app-alerts alert alert-danger fade in">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                                @foreach($message_array as $message)
                                                    {{ $message }}<br>
                                                @endforeach
                                            </div>
                                            @endif
                                        @if(isset($error))
                                        <div class="app-alerts alert alert-danger fade in">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                            {{ $error }}
                                        </div>
                                        @endif
                                        
                                        
                                        
                                        <div class="portlet-body" id="printresults">
                                            <table class="table table-striped table-bordered table-advance table-hover">
                                                <!-- School details here-->
                                                <tr>
                                                    <td rowspan="2" colspan="1"><img src="{{ asset('assets/img/slogo.png') }}" class="img-responsive" alt="" max-width="30px" height="30px" style="width:150px; height:auto"/></td>
                                                    <td colspan="4"><strong><center>OFFICIAL RECEIPT</center></strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><strong>System No:</strong> {{ $systemno }}</td><td colspan="2"><strong>CHEQUE/RECEIPT NO:</strong> </td>
                                                </tr>
                                                    <tr>
                                                        <th colspan="5">
                                                    <center><strong>FAULU CENTER OF EXCELLENCE<br>P.O Box 111-00200 NAIROBI, KENYA<br>Tel.: (020) 2721417 </strong></center>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"><strong>Received From:</strong> <u>{{ strtoupper(App\Modules\Core\Helpers\StudentsDetails::getstudentname($admno)) }}</u></td><td colspan=""><strong>Reg. No:</strong> <u>{{ $admno }}</u></td><td colspan=""><strong>Printed On:</strong>  <u>{{ date('d/m/Y') }}</u></td>
                                                    </tr>
                                                    <tr><td colspan="5">_________________________________________________________________________________________________________</td></tr>
                                                    <tr>
                                                        <th colspan="2"><center>Vote Details</center></th><th colspan="2"><center>Description</center></th><th><center>AMOUNT (KSh.)</center></th>
                                                    </tr>                                                
                                                <tbody>
                                                    <?php $total = 0; ?>
                                                    @foreach($payments as $payment)
                                                        <?php $total += $payment->amount; ?>
                                                        @if(App\Modules\Finance\Helpers\FinanceFunctions::account_overpaid($payment->admno, $payment->receiptno, $payment->systemno, $payment->term, $payment->year, $payment->account_id))
                                                        <tr><td colspan="2"><center>{{ $payment->account_id }}</center></td><td colspan="2">{{ App\Modules\Finance\Helpers\FinanceFunctions::get_account_name($payment->account_id) }} (Term {{ $payment->term }}, {{ $payment->year }})</td><td><center>{{ number_format($payment->amount, 2) }}</center></td></tr>
                                                        @else
                                                        <tr><td colspan="2"><center>{{ $payment->account_id }}</center></td><td colspan="2">{{ App\Modules\Finance\Helpers\FinanceFunctions::get_account_name($payment->account_id) }}</td><td><center>{{ number_format($payment->amount, 2) }}</center></td></tr>
                                                        @endif
                                                    @endforeach
                                                    <tr height="120px">
                                                        <td colspan="2"><center>xxxxx</center></td><td colspan="2"><center><strong>TOTAL</strong></center></td><td><center><strong>KSh. {{ number_format($total, 2) }}</strong></center></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" align="right">Signature/Stamp</td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" align="right">You were Served By</td><td><center>{{ auth()->user()->username }}</center></td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                            
                                        </div>
                                            <input type="button" name="printresults" onclick="return printResults()" value="Print" class="btn blue no-print">
                                            <a href="{{ URL::to('finance/feepayment') }}" class="btn btn-warning">Next Payment</a>
                                        
                                    </div>
                                </div>
                        </div>
                        </div>
            </div>

                    <!-- END PAGE CONTENT-->
<!--------------------------------------------------------END OF PAGE CONTENT-------------------------------------------->
@endsection