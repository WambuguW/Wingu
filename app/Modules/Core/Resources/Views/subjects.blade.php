@extends('core::layouts.main')

<!------------------------------------THE PAGE TITLE GOES HERE------------------------------------------------------->
@section('page_title')
    Wingu Client 1.0 || Systems Configuration
@endsection



<!----------------------------------------------PAGE CONTENT GOES HERE--------------------------------------------------->
@section('section_title')
    Register Subject
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
<script>
<script>
    function delconfirm(mystring){
        if(confirm('Are you sure you want to delete subject code: ' + mystring + '?')){
            return true;
        }
        else{
            return false;
        }
        
    }
</script> 
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
                                                <i class="fa fa-globe"></i>Register Subject
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
                                                    <label>Subject Code:</label>
                                                    <input type="text" id="subjectcode" name="code" placeholder="Subject Code" class="form-control input-medium" required="required">
                                                    <br> <br>
                                                </div>        
                                            <div class="col-md-6">
                                                    <label>Suject Name:</label>
                                                    <input type="text" id="subjectname" name="subject" placeholder="Subject name" class="form-control input-medium" required="required">
                                                    <br> <br>
                                                </div>
                                            <div class="col-md-6" id="newclass">
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <br><br>
                                                    <span class="btn blue" id="addsubject">Add Subject</span>
                                                    <input type="reset" name="clear" class="btn" value="Clear">
                                                </div>
                                            </form>
                                            <div class="col-md-12">
                                            <table id="response" class="table table-striped table-bordered table-hover table-full-width">
                                                <tr>
                                                    <th>Subject Code</th><th>Subject Name</th><td>Action</td>
                                                </tr>
                                                    @foreach($subjects as $subject)
                                                    <tr><td>{{ $subject->code }}</td><td>{{ $subject->name }}</td><td><a href="{{ url('core/setup/subjects/delete') }}/{{ $subject->id }}" onclick="return delconfirm({{ $subject->code }})"><span class="label label-danger label-sm">Delete</span></a></td></tr>
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
                