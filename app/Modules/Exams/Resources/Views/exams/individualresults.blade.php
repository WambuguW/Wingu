@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || View Results
@endsection



<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    View Results
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
                                                <i class="fa fa-globe"></i>Individual's Results
                                        </div>
                                </div>
                                
                                <div class="portlet-body dark_green">
                                    <div class="well dark_green">
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
                                        <div class="row">
                                            
                                            {{ Form::open(array('method' => 'POST')) }}
                                                
                                            <div class="col-md-6">
                                                    <label>Class:</label><br>
                                                    <select name="class" id="class" data-placeholder="Select Class" class="form-control input-medium select2me" required="required" id="class" id="select2_sample4"   >
                                                        <option></option>
                                                        @foreach($classes as $class)
                                                        <option value="{{ $class->id }}">{{ $class->name }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>  
                                            <div class="col-md-6">
                                                    <label>Student:</label><br>
                                                    <select name="admno" id="admno" data-placeholder="Select Student" class="form-control input-medium select2me" required="required" id="class" id="select2_sample4"   >
                                                        <option></option>
                                                        
                                                    </select>
                                                </div>        
                                            <div class="col-md-6">
                                                    <label>Term:</label>
                                                    <select name="term" class="form-control input-medium">
                                                        <option></option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                            <div class="col-md-6">
                                                    <label>Year:</label>
                                                    <input type="number" value="{{ date('Y') }}" name="year" class="form-control input-medium" placeholder="Year" min="2010">
                                                </div>
                                            <div class="col-md-6">
                                                    <label>Exam:</label><br>
                                                    <select name="exam" data-placeholder="Select Exam" class="form-control input-medium select2me" required="required" id="class" id="select2_sample4"   >
                                                        <option></option>
                                                        @if(isset($exams))
                                                        @foreach($exams as $exam)
                                                        <option value="{{ $exam->id }}">{{ strtoupper($exam->name) }} </option>
                                                        @endforeach
                                                    @endif
                                                    </select>
                                                </div>  
                                            <div class="col-md-6" id="newclass">
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <br><br>
                                                    <input type="submit" name="complete" class="btn blue" value="Complete"> &nbsp; &nbsp;
                                                    <input type="reset" name="clear" class="btn" value="Clear">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </div>
            </div>

                    <!-- END PAGE CONTENT-->
<!--------------------------------------------------------END OF PAGE CONTENT-------------------------------------------->
@endsection
                