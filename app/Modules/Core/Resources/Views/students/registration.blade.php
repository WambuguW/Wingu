@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Student Registration
@endsection

<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    Student Registration
@endsection
@section('page_content')
<script>
function classMismatch(){
    var joined = document.getElementById('joined').value;
    var current = document.getElementById('current').value;
    if(current < joined){
        alert('The current class cannot be before the class joined in');
    }
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
                                        <i class="fa fa-reorder"></i>Student Details
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
                                            {{ Form::open(array('method'=>'POST','files'=>true)) }}
                                                <div class="col-md-6">
                                                    <label>First Name:</label>
                                                    <input type="text" name="fname" class="form-control" placeholder="First Name" required="required">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Last Name:</label>
                                                    <input type="text" name="lname" class="form-control" placeholder="Last Name" required="required">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Surname:</label>
                                                    <input type="text" name="sname" class="form-control" placeholder="Surname" required="required">
                                                </div>
                                                <div class="col-md-6"> 
                                                    <label>Date of Birth:</label>
                                                    <input type="text" name="dob" class="form-control date-picker" data-date-format="dd-mm-yyyy" required="required">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Sex:</label>
                                                    <select class="form-control" name="sex" id="gender">
                                                        <option value="">---Select an option---</option>
                                                        <option value="M">Male</option>
                                                        <option value="F">Female</option>                        
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Phone Number:</label>
                                                    <input type="text" name="phone" class="form-control" placeholder="Parent or guardians phone" required="required">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Address:</label>
                                                    <input type="text" name="address" class="form-control" placeholder="Address" required="required">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Admission No.:</label>
                                                    <input type="number" name="admno" readonly="readonly" value="{{ $regno }}" class="form-control" placeholder="Adm No" required="required">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Joined in Class:</label>
                                                    <select class="form-control" name="class" id="joined">
                                                        <option value="">---select one option---</option>
                                                        @foreach($classes as $class)
                                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Current Class:</label>
                                                    <select class="form-control" name="currentclass" onchange="classMismatch()" id="current">
                                                        <option value="">---select one option---</option>
                                                        @foreach($classes as $class)
                                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label> Stream:</label>
                                                    <select class="form-control" name="stream">
                                                        <option value="">---select one option---</option>
                                                        @foreach($streams as $stream)
                                                        <option value="{{ $stream->id }}">{{ $stream->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Assign Dormitory:</label>
                                                    <select class="form-control" id="dormitoryname" name="dorm">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Date of Registration:</label>
                                                    <input type="text" name="regdate" class="form-control input-medium date-picker" placeholder="" data-date-format="dd-mm-yyyy" name="date">
                                                </div>
                                                <div class="col-md-6">
                                                    {{ Form::label('file','Student Photo:',array('id'=>'','class'=>'')) }}
                                                    {{ Form::file('file','',array('id'=>'','class'=>'')) }}
                                                </div>
                                            <div class="col-md-12 form-actions fluid">
                                                    <div class="col-md-offset-4 col-md-9">
                                                        <br><br>
                                                        <input type="submit" name="register" class="btn blue" value="Register"> &nbsp; &nbsp;
                                                        <input type="reset" name="clear" class="btn" value="Clear">
                                                    </div>
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
                