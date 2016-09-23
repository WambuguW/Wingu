@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Fees Balance
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
<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    Fees Balance
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
                                                <i class="fa fa-globe"></i>Fees Balances
                                        </div>
                                </div>
                                <div class="portlet-body">
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
                                        
                                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th colspan="5"><center>TERM {{ $term }}, {{ $year }} FEES BALANCE STATEMENT </center></th>
                                            </tr>
                                        <tr>
                                                <th>
                                                    ADMNO
                                                </th>
                                                <th>
                                                    NAME
                                                </th>
                                                <th>
                                                    TERM FEES (KSh)
                                                </th>
                                                <th>
                                                    AMOUNT PAID (KSh)
                                                </th>
                                                <th>
                                                    BALANCE (KSh)
                                                </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($students_with_balance as $student)
                                            <tr><td>{{ $student['admno'] }}</td><td>{{ App\Modules\Core\Helpers\StudentsDetails::getstudentname($student['admno']) }}</td><td>{{ number_format(App\Modules\Finance\Helpers\FinanceFunctions::get_semester_fees($term, $year, $student['currentclass']), 2) }}</td><td>{{ number_format(App\Modules\Finance\Helpers\FinanceFunctions::student_fees_paid($student['admno'], $term, $year), 2) }}</td><td>{{ number_format($student['balance'], 2) }}</td></tr>
                                            @endforeach
                                            
                                        </tbody>
                                        </table>
                            </div>

                            <!-- END PORTLET-->
                        </div>
                    </div>

                    <!-- END PAGE CONTENT-->
<!--------------------------------------------------------END OF PAGE CONTENT-------------------------------------------->
@endsection
                