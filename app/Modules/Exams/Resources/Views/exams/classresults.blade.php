@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Class Results
@endsection
<script>
            function printResults()
            {

            var content = document.getElementById('export').innerHTML;
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
    Class Results
@endsection
@section('page_content')
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="row">
                        <!-- BEGIN PORTLET -->
                        <div class="col-md-12 col-sm-12">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                        <div class="caption">
                                                <i class="fa fa-globe"></i>Class Results
                                        </div>
                                        
                                </div>
                                <div class="portlet-body" id="export">
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
                                        
                                    <table id="printable" class="table table-striped table-bordered table-hover table-full-width dataTable" id="sample_1">
                                            <thead>
                                                <tr>
                                                    <th colspan="{{ 4 + count($subjects) }}"><center>Class {{ \App\Modules\Exams\Helpers\ExamFunctions::getclassname($class) . ' ' . ' Term '. $term . ', ' . $year . ' ' . \App\Modules\Exams\Helpers\ExamFunctions::getexamname($exam)}} Exam Results</center></th>
                                                </tr>
                                            </thead>
                                        <thead>
                                            <tr><!--  style="height: 100px;" -- Just in case the names are to be rotated and they are too long -->
                                                <th>
                                                        Pos
                                                </th>
                                                <th>
                                                         Adm No.
                                                </th>
                                                <th>
                                                         Name
                                                </th>
                                                @foreach($subjects as $subject)
                                                <th><!--  style="transform: rotate(90deg); transform-origin: 30% bottom 30%;" --Just in case the names are long and need be rotated  -->
                                                    {{ substr($subject->name, 0, 3) }}
                                                </th>
                                                @endforeach
                                                <th>
                                                    Total
                                                </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $position = 1; ?>
                                            @foreach($resultarray as $arr)
                                            <tr><td>{{ $position }}</td><td>{{ $arr['admno'] }}</td><td>{{ \App\Modules\Core\Helpers\StudentsDetails::getstudentname($arr['admno']) }}</td>
                                                <?php $total = 0; ?>
                                                
                                                @foreach($subjects as $subject)
                                                <td>{{ \App\Modules\Exams\Helpers\ExamFunctions::getstud_subject_marks($arr['admno'], $subject->id, $class, $term, $year, $exam) }}</td>
                                                <?php $total += \App\Modules\Exams\Helpers\ExamFunctions::getstud_subject_marks($arr['admno'], $subject->id, $class, $term, $year, $exam) ?>
                                                @endforeach
                                                
                                                <td>{{ $total }}</td>
                                                <?php $position++; ?>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                    
                                    
                            </div>
                                <div class="col-md-12">
                                    <div class="col-md-6 col-md-offset-4">
                                        <input type="button" class="btn btn-green no-print" onclick="return printResults()" value="Print">
                                        <input type="button" class="btn blue" onclick="tableToExcel('export')" value="Export to Excel">
                                    </div>
                                </div>
                            <!-- END PORTLET-->
                        </div>
                    </div>

                    <!-- END PAGE CONTENT-->
<!--------------------------------------------------------END OF PAGE CONTENT-------------------------------------------->
@endsection
                