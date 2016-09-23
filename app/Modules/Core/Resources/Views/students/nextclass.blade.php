@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Graduate Students
@endsection




<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    Graduate Students
@endsection
@section('page_content')
<script type="text/javascript">
    function showalert(){
        //alert('Cool');
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
                                                <i class="fa fa-globe"></i>Graduate To Next Class
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
                                            
                                            {{ Form::open(array('method' => 'GET')) }}
                                                
                                                    
                                            <div class="col-md-6">
                                                    <label>From Class:</label>
                                                    <select name="fromclass" id="fromclass" class="form-control input-medium fromclass select2me">
                                                        <option></option>
                                                        @foreach($classes as $class)
                                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <br> <br>
                                                </div>
                                            <div class="col-md-6" id="newclass">
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <br><br>
                                                    <span class="btn blue" id="pushtoclass">All to Next Class</span>&nbsp; &nbsp;
                                                    <input type="reset" name="clear" class="btn" value="Clear">
                                                </div>
                                            </form> 
                                            <div class="col-md-12">
                                                {{ Form::open(array('url' => 'core/students/nextclass', 'method' => 'POST')) }}
                                                
                                                <table id="classstudents" class="table table-striped table-bordered table-hover table-full-width">


                                                </table>
                                                <div class="col-md-9 col-md-offset-4" id="subm">
                                                    
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
                