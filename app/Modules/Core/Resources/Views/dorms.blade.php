@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Systems Configuration
@endsection



<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    Register Dormitory
@endsection
@section('page_content')
<script>
    $(document).ready(function() {
        var scntDiv = $('#newclass');
        var i = $('#class p').size() + 1;
        
        $('#addclass').live('click', function() {
                $('<p><label for="class"><input type="text" id="class" size="20" name="class' + i +'" value="" placeholder="Class Name" /></label> <a href="#" id="remclass">Remove</a></p>').appendTo(scntDiv);
                i++;
                return false;
        });
        
        $('#remclass').live('click', function() { 
                if( i > 2 ) {
                        $(this).parents('p').remove();
                        i--;
                }
                return false;
        });
    });

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
                                                <i class="fa fa-globe"></i>Register Dormitory
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
                                                    <label>Dormitory Name:</label>
                                                    <input type="text" id="dormitory" name="dorm" placeholder="Dormitory name" class="form-control input-medium" required="required">
                                                    <br> <br>
                                                </div>
                                            <div class="col-md-6">
                                                    <label>Maximum Bed Capacity:</label>
                                                    <input type="number" id="capacity" name="capacity" placeholder="Capacity" class="form-control input-medium" required="required" min="0">
                                                    <br> <br>
                                                </div>
                                            <div class="col-md-6">
                                                    <label>Sex:</label>
                                                    <select name="sex" id="sex" class="form-control input-medium">
                                                        <option></option>
                                                        <option value="M">Male</option>
                                                        <option value="F">Female</option>
                                                    </select>
                                                    <br> <br>
                                                </div>
                                            <div class="col-md-6" id="newclass">
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <br><br>
                                                    <span class="btn blue" id="adddorm">Add Dormitory</span>&nbsp; &nbsp;
                                                    <input type="reset" name="clear" class="btn" value="Clear">
                                                </div>
                                            </form>
                                            <div class="col-md-12">
                                            <table id="response" class="table table-striped table-bordered table-hover table-full-width">
                                                <tr>
                                                    <th>Dorm Name</th><th>Sex</th><th>Capacity</th><td>Action</td>
                                                </tr>
                                                    @foreach($dorms as $dorm)
                                                    <tr><td>{{ $dorm->name }}</td><td>{{ $dorm->sex }}</td><td>{{ $dorm->capacity }}</td><td><a href="{{ url('core/setup/dorms/delete') }}/{{ $dorm->id }}"><span class="label label-danger label-sm">Delete</span></a></td></tr>
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
                