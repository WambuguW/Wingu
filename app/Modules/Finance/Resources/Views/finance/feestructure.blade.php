@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Fees Structure
@endsection






<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    Fees Structure
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
        
        <script>
            function additionalNotes(field){
                var info = field.value;
                //alert(info);
                document.getElementById('additions').innerHTML = info;
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
                                                <i class="fa fa-globe"></i>Fees Structure
                                        </div>
                                </div>
                                
                                <div class="portlet-body dark_green" id="printresults">
                                    <div class="well dark_green">
                                        @if(isset($success))
                                            <div class="app-alerts alert alert-success fade in">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                                {{ $success }}
                                            </div>
                                            @endif
                                        @if(isset($message_array))
                                            <div class="app-alerts alert alert-success fade in">
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
                                        
                                        
                                        
                                        <div class="portlet-body">
                                            <table class="table table-striped table-bordered table-advance table-hover">
                                                <!-- School details here-->
                                                <tr>
                                                    <th rowspan="2"><img src="{{ asset('assets/img/slogo.png') }}" class="img-responsive" alt="" max-width="30px" height="30px" style="width:150px; height:auto"/></th>
                                                    <th colspan="2"><strong><center>FEES STRUCTURE</center></strong></th>
                                                </tr>
                                                <tr>
                                                    <th><strong>Class:</strong> {{ $class }} <strong>Term:</strong> {{ $term }} <strong>, Year:</strong> {{ $year }}</th>
                                                </tr>  
                                                <tr>
                                                    <th><center>Account</center></th><th><center>Amount</center></th>
                                                </tr>
                                                <tbody>
                                                    <?php $total = 0; ?>
                                                    @foreach($structure as $struct)
                                                    <?php $total += $struct->amount; ?>
                                                    <tr><td>{{ App\Modules\Finance\Helpers\FinanceFunctions::get_account_name($struct->account) }}</td><td><center>{{ number_format($struct->amount, 2) }}</center></td></tr>
                                                    @endforeach
                                                    <tr height="120px">
                                                        <td align='right'><strong>TOTAL</strong></td><td><center><strong>KSh. {{ number_format($total, 2) }}</strong></center></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" id="additions"></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right">Signature/Stamp</td><td>______________________</td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                            
                                        </div>
                                    
                                        
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <textarea name="comments" class="form-control input-medium" onkeyup="additionalNotes(this)"></textarea>
                                    <div class="col-md-9 col-md-offset-3">
                                        <input type="button" name="printresults" onclick="return printResults()" value="Print" class="btn blue no-print">
                                    </div>
                                </div>
                        </div>
                        </div>
            </div>

                    <!-- END PAGE CONTENT-->
<!--------------------------------------------------------END OF PAGE CONTENT-------------------------------------------->
@endsection