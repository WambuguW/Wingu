@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Edit Student Details
@endsection

<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    Edit Student Details
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
                                        <i class="fa fa-reorder"></i> Edit Student Details
                                    </div>

                                </div>
                                <div class="portlet-body dark_green">
                                    <div class="well dark_green">
                                        <div class="row">
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
                                            <form action="{{ url('core/students/edit') }}" method="POST">
                                                {{ csrf_field() }}
                                                <div class="col-md-6">
                                                    <label> Admission No.:</label>
                                                    <input type="number" name="admno" class="form-control" placeholder="Adm No" required="required" value="{{ $student->admno }}" readonly="readonly">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>First Name:</label>
                                                    <input type="text" name="fname" class="form-control" placeholder="First Name" required="required" value="{{ $student->fname }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Last Name:</label>
                                                    <input type="text" name="lname" class="form-control" placeholder="Last Name" required="required" value="{{ $student->lname }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Surname:</label>
                                                    <input type="text" name="sname" class="form-control" placeholder="Surname" required="required" value="{{ $student->surname }}">
                                                </div>
                                                <div class="col-md-6"> 
                                                    <label>Date of Birth:</label>
                                                    <input type="date" name="dob" class="form-control" required="required" value="{{ $student->dob }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Phone Number:</label>
                                                    <input type="text" name="phone" class="form-control" placeholder="Parent or guardians phone" required="required" value="{{ $student->contact }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Address:</label>
                                                    <input type="text" name="address" class="form-control" placeholder="Address" required="required" value="{{ $student->address }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <br><br>
                                                    <input type="submit" name="register" class="btn blue" value="Save Changes"> &nbsp; &nbsp;
                                                    <input type="reset" name="clear" class="btn" value="Clear">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- END PORTLET-->
                        </div>
                    </div>

                    <!-- END PAGE CONTENT-->
<!--------------------------------------------------------END OF PAGE CONTENT-------------------------------------------->
@endsection
                