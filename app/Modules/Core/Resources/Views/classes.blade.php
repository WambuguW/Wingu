@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Systems Configuration
@endsection



<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    Register Classes
@endsection
@section('page_content')
<script>
    function showalert(){
        if(confirm('Are you sure you want to delete class?')){
            return true;
        } else{
            return false;
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
                                                <i class="fa fa-globe"></i>Register Classes
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
                                            
<!--                                            {{ Form::open(array('method' => 'POST')) }}-->
                                            <form method="POST" action="">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    
                                            <div class="col-md-6">
                                                    <label>Class Name:</label>
                                                    <input type="text" name="class" id="classname" placeholder="Class name" class="form-control input-medium" required="required">
                                                    <br> <br>
                                                </div>
                                            <div class="col-md-6" id="newclass">
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <br><br>
                                                    <span class="btn blue" id="addclass">Add Class</span>&nbsp; &nbsp;
                                                    <input type="reset" name="clear" class="btn" value="Clear">
                                                </div>
                                            </form> 
                                            <div class="col-md-12">
                                            <table id="response" class="table table-striped table-bordered table-hover table-full-width">
                                                <tr>
                                                    <th>Class Id</th><th>Class Name</th><td>Action</td>
                                                </tr>
                                                    @foreach($classes as $class)
                                                    <tr><td>{{ $class->id }}</td><td>{{ $class->name }}</td><td><a href="{{ url('core/setup/classes/delete') }}/{{ $class->id }}" onclick="return showalert()"><span class="label label-danger label-sm">Delete</span></a></td></tr>
                                                    @endforeach
                                                
                                            </table>
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
                