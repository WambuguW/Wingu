@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
Wingu Client 1.0 || Exam Results
@endsection






<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
Exam Results
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
        setTimeout(function() {
            pwin.close();
        }, 100000);
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
                    <i class="fa fa-globe"></i>Individual Exam Results
                </div>
            </div>
            <div class="portlet-body dark_green">
                <div class="col-md-12 form-actions fluid">
                    <span class="btn badge blue" id="previous"><i class="fa fa-arrow-left"></i>Prev</span>
                    <div class="col-md-9 offset3">
                        <input type="hidden" id="classe" value="{{ $theclass }}">
                        <input type="hidden" id="theterm" value="{{ $term }}">
                        <input type="hidden" id="theyear" value="{{ $year }}">
                        <input type="hidden" id="theexam" value="{{ $exam }}">
                        <label>Student</label>
                        <select name="theadmno" id="theadmno" data-placeholder="Select Another Student" class="form-control input-medium select2me" required="required" id="ajaxnext" id="select2_sample4"   >
                            <option></option>
                            @foreach(\App\Modules\Exams\Helpers\ExamFunctions::get_class_students($theclass, $year) as $studentt)
                            <option value="{{ $studentt->admno }}">{{ \App\Modules\Core\Helpers\StudentsDetails::getstudentname($studentt->admno) }}</option>
                            @endforeach
                        </select>                                        
                    </div>
                    <span class="btn badge blue" id="next"><i class="fa fa-arrow-right"></i>Next</span>
                </div>
                <div class="well dark_green" id="printresults">
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



                    <div class="portlet-body" id="stdresults">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <!-- School details here-->
                            <tr>
                                <td rowspan="2" colspan="1"><img src="{{ asset('assets/img/students/') }}/{{ \App\Modules\Core\Helpers\StudentsDetails::get_student_photo($admno) }}" class="img-responsive" alt="" max-width="75px" height="75px" style="width:150px; height:auto"/></td>
                                <td colspan="2"><strong>NAME: {{ \App\Modules\Core\Helpers\StudentsDetails::getstudentname($admno) }}</strong></td><td colspan="2"><strong>CLASS: {{ $theclass }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>REG No.: {{ $admno }}</strong></td><td colspan="2"><strong>STREAM:</strong></td>
                            </tr>
                            <tr>
                                <th colspan="5">
                            <center><strong> Term {{ $term }}, {{ $year }}, {{ \App\Modules\Exams\Helpers\ExamFunctions::getexamname($exam) }} Exam Results</strong></center>
                            </th>
                            </tr>
                            <tr><td colspan="5">_________________________________________________________________________________________________________</td></tr>
                            <tr>
                                <th>SUBJECTS</th><th>MARKS</th><th>SUBJECT POS</th><th>COMMENTS</th><th>GRADE</th>
                            </tr>

                            <tbody>
                                <?php $totalmarks = 0; //to help calculate the total for all subjects  ?>
                                @foreach(\App\Modules\Exams\Helpers\ExamFunctions::getsubjects() as $subject)
                                <tr>
                                    <td>{{ $subject->name }}</td>                                                        
                                    <td>{{ \App\Modules\Exams\Helpers\ExamFunctions::get_subject_marks($admno, $term, $exam, $year, $subject->id) }}</td>
                                    <?php $totalmarks += \App\Modules\Exams\Helpers\ExamFunctions::get_subject_marks($admno, $term, $exam, $year, $subject->id); //calculate the subtotal  ?>
                                    <td>{{ \App\Modules\Exams\Helpers\ExamFunctions::get_subject_position($admno, $term, $year, $exam, $subject->id, $theclass) }}</td>
                                    <td>{{ \App\Modules\Exams\Helpers\ExamFunctions::get_subject_comments($admno, $term, $exam, $year, $subject->id) }}</td>
                                    <td>{{ \App\Modules\Exams\Helpers\ExamFunctions::get_mean_grade(\App\Modules\Exams\Helpers\ExamFunctions::get_subject_marks($admno, $term, $exam, $year, $subject->id)) }}</td>
                                </tr>                                                        
                                @endforeach
                                <tr><td><strong><center>TOTAL MARKS</center></strong></td><td><strong>{{ $totalmarks }}</strong></td><td></td><td></td><td><strong>Mean Grade: </strong></td></tr>
                                <tr><td><strong><center>CLASS POSITION</center></strong></td><td colspan="4"><strong>{{ \App\Modules\Exams\Helpers\ExamFunctions::rank($admno, $term, $year, $exam, $theclass) }}</strong></strong></td></tr>
                                <tr><td colspan="5"><strong>Class Teacher's Remarks:</strong> _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ </td></tr>
                                <tr><td colspan="3">  _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</td><td colspan="2"><strong>Sign:</strong>_ _ _ _ _ _ _ _ </td></tr>
                                <tr><td colspan="5"><strong>Head Teacher's Remarks: </strong> _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ </td></tr>
                                <tr><td colspan="3">  _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ </td><td colspan="2"><strong>Sign:</strong>_ _ _ _ _ _ _ _  </td></tr>
                            </tbody>
                        </table>


                    </div>


                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-9 offset3">
                    <input type="button" name="printresults" onclick="return printResults()" value="Print" class="btn blue no-print">
                </div>

            </div>


        </div>
    </div>
</div>

<!-- END PAGE CONTENT-->
<!--------------------------------------------------------END OF PAGE CONTENT-------------------------------------------->
@endsection