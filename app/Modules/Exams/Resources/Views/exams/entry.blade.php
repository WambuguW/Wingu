@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Results Entry
@endsection






<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    Results Entry
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
                                                <i class="fa fa-globe"></i>Results Entry
                                        </div>
                                </div>
                                
                                <div class="portlet-body">
    <div class="tabbable-custom ">
        <ul class="nav nav-tabs ">
            <li class="active">
                <a href="#tab_5_1" data-toggle="tab">
                    Single Results Entry
                </a>
            </li>
            <li>
                <a href="#tab_5_2" data-toggle="tab">
                    From File
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_5_1">
                <div class="well dark_green">
                    @if(isset($success))
                        <div class="app-alerts alert alert-info fade in">
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
                    @if(isset($error_array))
                    <div class="app-alerts alert alert-danger fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        @foreach($error_array as $err)
                        {{ $err }}<br>
                        @endforeach
                    </div>
                    @endif
                    <div class="row">

                        {{ Form::open(array('method' => 'POST')) }}
                            <div class="col-md-6">
                                <label>Class:</label><br>
                                <select name="class" data-placeholder="Select Class" onchange="showClasses(this)" class="form-control input-medium select2me" required="required" id="class" id="select2_sample4"   >
                                    <option></option>
                                    @if(isset($classes))
                                    @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ strtoupper($class->name) }} </option>
                                    @endforeach
                                @endif
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Student Adm No:</label><br>
                                <select name="admno" id="admno" data-placeholder="Select Student" class="form-control input-medium select2me" required="required" id="country_list" id="select2_sample4"   >
                                    <option></option>

                                </select>
                            </div>
                        <div class="col-md-6">
                                <label>Exam Type:</label>
                                <select name="examtype" placeholder="Select Exam Tpe" class="form-control input-medium" required="required" >
                                    <option></option>
                                 @if(isset($examtypes))
                                    @foreach($examtypes as $examtype)
                                    <option value="{{ $examtype->id }}">{{ strtoupper($examtype->name) }} </option>
                                    @endforeach
                                @endif
                                </select>
                            </div>
                        <div class="col-md-6">
                                <label>Term:</label>
                                <select name="term" id="term" data-placeholder="Term" class="form-control input-medium" required="required" >
                                    <option></option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        <div class="col-md-6">
                                <label>Year:</label>
                                <input type="number" name="year" value="{{ date('Y') }}" placeholder="Year" class="form-control input-medium" required="required" min="2013">
                            </div>
                        <div class="col-md-6">
                                <label>Subject:</label>
                                <select name="subject" placeholder="Select Subject" class="form-control input-medium" required="required" >
                                    <option></option>
                                 @if(isset($subjects))
                                    @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ strtoupper($subject->name) }} </option>
                                    @endforeach
                                @endif
                                </select>
                            </div>
                        <div class="col-md-6">
                                <label>Marks:</label>
                                <input type="number" id="marks" name="marks" placeholder="Marks Scored" class="form-control input-medium" required="required" min="0">
                            </div>
                        <div class="col-md-6">
                                <label>Comments:</label>
                                <input type="text" id="comments" name="comments" placeholder="Brief Comment" class="form-control input-medium" required="required" min="0">
                            </div>
                        
                            <div class="col-md-12 form-actions fluid">
                                <br><br>
                                <div class="col-md-offset-4 col-md-9">
                                <input type="submit" name="complete" class="btn blue" value="Complete"> &nbsp; &nbsp;
                                <input type="reset" name="clear" class="btn" id="clear" onclick="announ()" value="Clear">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                <div class="tab-pane" id="tab_5_2">
                    <div class="well dark_green">
                        <div class="row">
                        {{ Form::open(array('method' => 'POST', 'files' => true, 'url' => 'exams/entry/bulk')) }}
                            <div class="col-md-12 form-group">
                                <br>
                                <h4 class="form-section">Upload From CSV File<br></h4>
                                <a href="{{ asset('../assets/templates/results_template.xltx') }}">Download Template</a><br>
                                {{ Form::label('file','File',array('id'=>'','class'=>'')) }}
                                {{ Form::file('file','',array('id'=>'','class'=>'')) }}
                                <div class="col-md-12 form-actions fluid">
                                    <br><br>
                                    <div class="col-md-offset-4 col-md-9">
                                    <input type="submit" name="complete" class="btn blue" value="Complete"> &nbsp; &nbsp;
                                    <input type="reset" name="clear" class="btn" id="clear" value="Clear">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
                        </div>
                        </div>
            </div>

                    <!-- END PAGE CONTENT-->
<!--------------------------------------------------------END OF PAGE CONTENT-------------------------------------------->
@endsection